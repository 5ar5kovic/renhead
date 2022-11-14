<?php

namespace App\Services;

use App\Http\Requests\PaymentRequest;
use App\Repository\PaymentRepositoryInterface;
use App\Traits\RespondWithHttpStatus;
use Exception;
use Illuminate\Http\JsonResponse;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class PaymentService
{
    use RespondWithHttpStatus;

    /**
     * @var PaymentRepositoryInterface
     */
    private PaymentRepositoryInterface $paymentRepository;

    /**
     * UserController constructor.
     *
     * @param PaymentRepositoryInterface $paymentRepository
     */
    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Get all payments with pagination.
     *
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        $payments = $this->paymentRepository->all();

        return $this->success('OK', 200, $payments);
    }

    /**
     * Get a payment with relations.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function find(int $id): JsonResponse
    {
        try {
            $payment = $this->paymentRepository->find($id);
        } catch (NotFound $notFoundException) {
            return $this->failure($notFoundException->getMessage(), $notFoundException->getCode());
        }

        return $this->success('OK', 200, $payment);
    }

    /**
     * Create payment.
     *
     * @param PaymentRequest $request
     * @return JsonResponse
     */
    public function create(PaymentRequest $request): JsonResponse
    {
        try {
            $payment = $this->paymentRepository->create($request->post());
        } catch (Exception) {
            return $this->failure('Bad Request', 400);
        }

        return $this->success('Created', 201, $payment);
    }

    /**
     * Update payment information.
     *
     * @param PaymentRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(PaymentRequest $request, int $id): JsonResponse
    {
        try {
            $payment = $this->paymentRepository->update($request->post(), $id);
        } catch (NotFound $notFoundException) {
            return $this->failure($notFoundException->getMessage(), $notFoundException->getCode());
        } catch (Exception) {
            return $this->failure('Bad Request', 400);
        }

        return $this->success('OK', 200, $payment);
    }

    /**
     * Delete payment.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $this->paymentRepository->delete($id);
        } catch (NotFound $notFoundException) {
            return $this->failure($notFoundException->getMessage(), $notFoundException->getCode());
        } catch (Exception) {
            return $this->failure('Bad Request', 400);
        }

        return $this->success('OK', 200);
    }
}
