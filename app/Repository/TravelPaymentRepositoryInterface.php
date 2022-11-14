<?php

namespace App\Repository;

use App\Models\TravelPayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\FlareClient\Http\Exceptions\NotFound;

interface TravelPaymentRepositoryInterface
{
    /**
     * Get all payments with pagination.
     *
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator;

    /**
     * Get a payment with relations.
     *
     * @param int $id
     * @return Model
     * @throws NotFound
     */
    public function find(int $id): Model;

    /**
     * Create payment.
     *
     * @param array $params
     * @return Model
     */
    public function create(array $params): Model;

    /**
     * Update payment information.
     *
     * @param array $params
     * @param int $id
     * @return TravelPayment
     * @throws NotFound
     */
    public function update(array $params, int $id): TravelPayment;
}
