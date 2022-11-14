<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private AuthService $authService;

    /**
     * AuthController constructor.
     *
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register a new user.
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
       return $this->authService->register($request);
    }

    /**
     * Login for user.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->authService->login($request);
    }

    /**
     * Logout for user.
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        return $this->authService->logout();
    }
}
