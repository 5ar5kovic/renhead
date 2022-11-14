<?php

namespace App\Repository\Eloquent;

use App\Models\TravelPayment;
use App\Repository\TravelPaymentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class TravelPaymentRepository extends BaseRepository implements TravelPaymentRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param TravelPayment $model
     */
    public function __construct(TravelPayment $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all payments with pagination.
     *
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        return $this->model->with('user')->paginate();
    }

    /**
     * Get a payment with relations.
     *
     * @param int $id
     * @return Model
     * @throws NotFound
     */
    public function find(int $id): Model
    {
        $this->model = $this->model->with('paymentApprovals', 'paymentApprovals.user')->find($id);
        if (!$this->model) {
            throw new NotFound('Not Found.', 404);
        }

        return $this->model;
    }

    /**
     * Create payment.
     *
     * @param array $params
     * @return Model
     */
    public function create(array $params): Model
    {
        $this->model = new TravelPayment();
        $this->model->user_id = auth()->id();
        $this->model->amount = $params['amount'];
        $this->model->save();

        return $this->model->with('user')->find($this->model->id);
    }

    /**
     * Update payment information.
     *
     * @param array $params
     * @param int $id
     * @return TravelPayment
     * @throws NotFound
     */
    public function update(array $params, int $id): TravelPayment
    {
        $this->model = $this->model->find($id);
        if (!$this->model) {
            throw new NotFound('Not Found.', 404);
        }

        $this->model->update($params);
        $this->model->paymentApprovals()->delete();

        return $this->model;
    }

    /**
     * Delete payment.
     *
     * @param int $id
     * @return void
     * @throws NotFound
     */
    public function delete(int $id): void
    {
        $this->model = $this->model->find($id);
        if (!$this->model) {
            throw new NotFound('Not Found.', 404);
        }

        $this->model->paymentApprovals()->delete();
        $this->model->delete();
    }
}
