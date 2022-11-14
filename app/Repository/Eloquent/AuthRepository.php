<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\AuthRepositoryInterface;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{
    /**
     * AuthRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Register a new user.
     *
     * @param array $userData
     * @return User
     */
    public function register(array $userData): User
    {
        return $this->model->create($userData);
    }

    /**
     * Login for user.
     *
     * @return string
     */
    public function login(): string
    {
        return auth()->user()->createToken('API Token')->plainTextToken;
    }

    /**
     * Logout for user.
     *
     * @return void
     */
    public function logout(): void
    {
        auth()->user()->tokens()->delete();
    }
}
