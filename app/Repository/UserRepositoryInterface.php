<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\FlareClient\Http\Exceptions\NotFound;

interface UserRepositoryInterface
{
    /**
     * Get all users with pagination.
     *
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator;

    /**
     * Get a user with relations.
     *
     * @param int $id
     * @return User
     * @throws NotFound
     */
    public function find(int $id): Model;

    /**
     * Update user information.
     *
     * @param array $params
     * @param int $id
     * @return User
     * @throws NotFound
     */
    public function update(array $params, int $id): User;
}
