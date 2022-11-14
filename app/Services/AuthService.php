<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repository\AuthRepositoryInterface;
use App\Traits\RespondWithHttpStatus;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    use RespondWithHttpStatus;

    /**
     * @var AuthRepositoryInterface
     */
    private AuthRepositoryInterface $authRepository;

    /**
     * AuthController constructor.
     *
     * @param AuthRepositoryInterface $authRepository
     */
    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * Get all users with pagination.
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = $this->authRepository->register($request->post());
        } catch (Exception) {
            return $this->failure('Bad Request', 400);
        }

        $responseData = ['token' => $user->createToken('API Token')->plainTextToken];

        return $this->success('Created.', 201, $responseData);
    }

    /**
     * Login for user.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->post())) {
            return $this->failure('Credentials not match', 401);
        }

        try {
            $token = $this->authRepository->login();
        } catch (Exception) {
            return $this->failure('Bad Request', 400);
        }

        return $this->success('OK', 200, ['token' => $token]);
    }

    /**
     * Logout for user.
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        try {
            $this->authRepository->logout();
        } catch (Exception) {
            return $this->failure('Bad Request', 400);
        }

        return $this->success('Tokens Revoked', 200);
    }
}
