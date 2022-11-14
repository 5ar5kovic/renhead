<?php

namespace App\Http\Controllers;

use App\Http\Requests\TravelPaymentRequest;
use App\Services\TravelPaymentService;
use Illuminate\Http\JsonResponse;

class TravelPaymentController extends Controller
{
    /**
     * @var TravelPaymentService
     */
    private TravelPaymentService $travelPaymentService;

    /**
     * PaymentController constructor.
     *
     * @param TravelPaymentService $travelPaymentService
     */
    public function __construct(TravelPaymentService $travelPaymentService)
    {
        $this->travelPaymentService = $travelPaymentService;
    }

    /**
     * Get all payments with pagination.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->travelPaymentService->all();
    }

    /**
     * Get a payment with relations.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->travelPaymentService->find((int)$id);
    }

    /**
     * Create payment.
     *
     * @param TravelPaymentRequest $request
     * @return JsonResponse
     */
    public function create(TravelPaymentRequest $request): JsonResponse
    {
        return $this->travelPaymentService->create($request);
    }

    /**
     * Update payment information.
     *
     * @param TravelPaymentRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(TravelPaymentRequest $request, $id): JsonResponse
    {
        return $this->travelPaymentService->update($request, (int)$id);
    }

    /**
     * Delete payment.
     *
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        return $this->travelPaymentService->delete((int)$id);
    }
}
