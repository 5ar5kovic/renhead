<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Spatie\FlareClient\Http\Exceptions\NotFound;

interface PaymentApprovalRepositoryInterface
{

    /**
     * Approve payment.
     *
     * @param array $params
     * @param int $id
     * @return Model
     * @throws NotFound
     */
    public function create(array $params, int $id): Model;
}
