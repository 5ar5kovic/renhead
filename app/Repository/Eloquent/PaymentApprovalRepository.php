<?php

namespace App\Repository\Eloquent;

use App\Models\Payment;
use App\Models\PaymentApproval;
use App\Models\TravelPayment;
use App\Repository\PaymentApprovalRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class PaymentApprovalRepository implements PaymentApprovalRepositoryInterface
{

    /**
     * Approve payment.
     *
     * @param array $params
     * @param int $id
     * @return Model
     * @throws NotFound
     */
    public function create(array $params, int $id): Model
    {
        $this->model = new PaymentApproval();
        $this->model->user_id = auth()->user()->id;

        $url = Route::getCurrentRoute()->uri;
        if (!str_contains($url, '/travel-payments/') && !str_contains($url, '/payments/')) {
            throw new NotFound('Not found.', 404);
        }
        if (str_contains($url, '/payments/')) {
            $this->model->payment_type = Payment::class;
        } else {
            $this->model->payment_type = TravelPayment::class;
        }

        $this->model->payment_id = $id;
        $this->model->status = $params['status'];
        $this->model->save();

        return $this->model->with('user')->find($this->model->id);
    }
}
