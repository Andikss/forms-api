<?php

namespace App\Http\Repositories\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * Handles user login
     * 
     * @param LoginRequest $request
     * @return array
     * @throws Exception
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request): array
    {
        try {
            $credentials = $request->only(['email', 'password']);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                $user  = Auth::user();
                $token = $this->getToken($user);

                return [
                    'data' => $user,
                    'token' => $token,
                ];
            }

            throw new AuthenticationException("Your credentials don't match our records");
        } catch (AuthenticationException $error) {
            throw $error;
        } catch (Exception $error) {
            throw new Exception('Error while logging in: ' . $error->getMessage());
        }
    }


    /**
     * Logs out the currently authenticated user
     * 
     * @param Request $request
     * @throws Exception
     */
    public function logout(Request $request): void
    {
        try {
            Auth::logout();
        } catch (Exception $error) {
            throw new Exception('Error while logging out : ' . $error->getMessage());
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
