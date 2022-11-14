<?php

namespace App\Repository;

use App\Models\User;

interface AuthRepositoryInterface
{
    /**
     * Register a new user.
     *
     * @param array $userData
     * @return User
     */
    public function register(array $userData): User;

    /**
     * Login for user.
     *
     * @return string
     */
    public function login(): string;

    /**
     * Logout for user.
     *
     * @return void
     */
    public function logout(): void;
}
