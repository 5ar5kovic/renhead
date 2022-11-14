<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * UserController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get all users with pagination.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->userService->all();
    }

    /**
     * Get a user with relations.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->userService->find((int)$id);
    }

    /**
     * Update user information.
     *
     * @param UserRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UserRequest $request, $id): JsonResponse
    {
        return $this->userService->update($request, (int)$id);
    }
}
