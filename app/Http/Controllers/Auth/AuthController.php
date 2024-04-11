<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Auth\AuthRepository;
use App\Http\Requests\Auth\LoginRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authRepository;

    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->authRepository = new AuthRepository();
    }

    /**
     * Handles user login
     * 
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $login = $this->authRepository->login($request);

            return response()->json([
                'message'     => 'Login Success',
                'user'        => $login['user'],
                'accessToken' => $login['token']
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'error'   => 'internal server error',
                'message' => $error->getMessage()
            ], 500);
        }
    }

    /**
     * Handles user logout
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            $this->authRepository->logout($request);

            return response()->json([
                'message' => 'Logout Success'
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'error'   => 'internal server error',
                'message' => $error->getMessage()
            ], 500);
        }
    }
}
