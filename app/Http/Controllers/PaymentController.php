<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    /**
     * @var PaymentService
     */
    private PaymentService $paymentService;

    /**
     * PaymentController constructor.
     *
     * @param PaymentService $paymentService
     */
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Get all payments with pagination.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->paymentService->all();
    }

    /**
     * Get a payment with relations.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->paymentService->find((int)$id);
    }

    /**
     * Create payment.
     *
     * @param PaymentRequest $request
     * @return JsonResponse
     */
    public function create(PaymentRequest $request): JsonResponse
    {
        return $this->paymentService->create($request);
    }

    /**
     * Update payment information.
     *
     * @param PaymentRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(PaymentRequest $request, $id): JsonResponse
    {
        return $this->paymentService->update($request, (int)$id);
    }

    /**
     * Delete payment.
     *
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        return $this->paymentService->delete((int)$id);
    }
}
