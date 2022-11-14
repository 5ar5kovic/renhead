<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all users with pagination.
     *
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        return $this->model->paginate();
    }

    /**
     * Get a user with relations.
     *
     * @param int $id
     * @return Model
     * @throws NotFound
     */
    public function find(int $id): Model
    {
        $this->model = $this->model->with(
            'payments',
            'travelPayments',
            'payments.paymentApprovals',
            'travelPayments.paymentApprovals',
            'payments.paymentApprovals.user',
            'travelPayments.paymentApprovals.user'
        )->find($id);

        if (!$this->model) {
            throw new NotFound('Not Found.', 404);
        }

        return $this->model;
    }

    /**
     * Update user information.
     *
     * @param array $params
     * @param int $id
     * @return User
     * @throws NotFound
     */
    public function update(array $params, int $id): User
    {
        $this->model = $this->model->find($id);

        if (!$this->model) {
            throw new NotFound('Not Found.', 404);
        }

        $this->model->update($params);

        return $this->model;
    }
}
