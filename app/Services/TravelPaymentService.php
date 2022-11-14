<?php

namespace App\Services;

use App\Http\Requests\TravelPaymentRequest;
use App\Repository\TravelPaymentRepositoryInterface;
use App\Traits\RespondWithHttpStatus;
use Exception;
use Illuminate\Http\JsonResponse;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class TravelPaymentService
{
    use RespondWithHttpStatus;

    /**
     * @var TravelPaymentRepositoryInterface
     */
    private TravelPaymentRepositoryInterface $travelPaymentRepository;

    /**
     * TravelPaymentController constructor.
     *
     * @param TravelPaymentRepositoryInterface $travelPaymentRepository
     */
    public function __construct(TravelPaymentRepositoryInterface $travelPaymentRepository)
    {
        $this->travelPaymentRepository = $travelPaymentRepository;
    }

    /**
     * Get all travel payments with pagination.
     *
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        $payments = $this->travelPaymentRepository->all();

        return $this->success('OK', 200, $payments);
    }

    /**
     * Get a travel payment with relations.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function find(int $id): JsonResponse
    {
        try {
            $payment = $this->travelPaymentRepository->find($id);
        } catch (NotFound $notFoundException) {
            return $this->failure($notFoundException->getMessage(), $notFoundException->getCode());
        }

        return $this->success('OK', 200, $payment);
    }

    /**
     * Create travel payment.
     *
     * @param TravelPaymentRequest $request
     * @return JsonResponse
     */
    public function create(TravelPaymentRequest $request): JsonResponse
    {
        try {
            $payment = $this->travelPaymentRepository->create($request->post());
        } catch (Exception) {
            return $this->failure('Bad Request', 400);
        }

        return $this->success('Created', 201, $payment);
    }

    /**
     * Update travel payment information.
     *
     * @param TravelPaymentRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(TravelPaymentRequest $request, int $id): JsonResponse
    {
        try {
            $payment = $this->travelPaymentRepository->update($request->post(), $id);
        } catch (NotFound $notFoundException) {
            return $this->failure($notFoundException->getMessage(), $notFoundException->getCode());
        } catch (Exception) {
            return $this->failure('Bad Request', 400);
        }

        return $this->success('OK', 200, $payment);
    }

    /**
     * Delete travel payment.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $this->travelPaymentRepository->delete($id);
        } catch (NotFound $notFoundException) {
            return $this->failure($notFoundException->getMessage(), $notFoundException->getCode());
        } catch (Exception) {
            return $this->failure('Bad Request', 400);
        }

        return $this->success('OK', 200);
    }
}
