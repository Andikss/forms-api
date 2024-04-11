<?php

namespace App\Http\Repositories\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

/**
 * Interface for authentication repository.
 */
interface AuthRepositoryInterface
{
    /**
     * Handles user login
     * 
     * @param LoginRequest $request
     * @return array
     * @throws Exception
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request): array;

    /**
     * Log out the authenticated user.
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request): void;
}
