<?php

namespace App\Http\Repositories\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
    public function login(LoginRequest $request): array;
    public function logout(Request $request): void;
}
