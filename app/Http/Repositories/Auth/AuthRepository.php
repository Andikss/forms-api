<?php

namespace App\Http\Repositories\Auth;

use App\Exceptions\ExceptionHandler;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

/**
 * Repository for handling authentication requests.
 * 
 * @author Andika Dwi Saputra || @Andikss
 * @created 11 May 2024
 */

class AuthRepository implements AuthRepositoryInterface
{
    public function login(LoginRequest $request): array
    {
        try {
            $credentials = $request->only(['email', 'password']);

            if (Auth::attempt($credentials)) {
                $user  = Auth::user();
                $token = $this->getToken($user);

                return [
                    'user'  => $user,
                    'token' => $token,
                ];
            }

            throw new AuthenticationException("Your credentials don't match our records");
        } catch (Throwable $error) {
            ExceptionHandler::throw($error, 'Error while logging in');
        }
    }

    public function logout(Request $request): void
    {
        try {
            $request->user()->currentAccessToken()->delete();
        } catch (Exception $error) {
            ExceptionHandler::throw($error, 'Error while logging out');
        }
    }

    /**
     * Generates a token for the user
     * 
     * @param User $user
     * @return string
     */
    protected static function getToken(User $user): string
    {
        $user  = User::find($user->id);
        $token = $user->createToken('auth_token')->plainTextToken;

        return $token;
    }
}
