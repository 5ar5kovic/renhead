<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentApprovalRequest;
use App\Services\PaymentApprovalService;
use Illuminate\Http\JsonResponse;

class PaymentApprovalController extends Controller
{
    /**
     * @var PaymentApprovalService
     */
    private PaymentApprovalService $paymentApprovalService;

    /**
     * PaymentController constructor.
     *
     * @param PaymentApprovalService $paymentApprovalService
     */
    public function __construct(PaymentApprovalService $paymentApprovalService)
    {
        $this->paymentApprovalService = $paymentApprovalService;
    }

    /**
     * Approve payment.
     *
     * @param PaymentApprovalRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function create(PaymentApprovalRequest $request, $id): JsonResponse
    {
        return $this->paymentApprovalService->create($request, (int)$id);
    }
}
