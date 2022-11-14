<?php

namespace App\Services;

use App\Http\Requests\PaymentApprovalRequest;
use App\Repository\PaymentApprovalRepositoryInterface;
use App\Traits\RespondWithHttpStatus;
use Exception;
use Illuminate\Http\JsonResponse;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class PaymentApprovalService
{
    use RespondWithHttpStatus;

    /**
     * @var PaymentApprovalRepositoryInterface
     */
    private PaymentApprovalRepositoryInterface $paymentApprovalRepository;

    /**
     * UserController constructor.
     *
     * @param PaymentApprovalRepositoryInterface $paymentApprovalRepository
     */
    public function __construct(PaymentApprovalRepositoryInterface $paymentApprovalRepository)
    {
        $this->paymentApprovalRepository = $paymentApprovalRepository;
    }

    /**
     * Approve payment.
     *
     * @param PaymentApprovalRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function create(PaymentApprovalRequest $request, int $id): JsonResponse
    {
        try {
            $payment = $this->paymentApprovalRepository->create($request->post(), $id);
        } catch (NotFound $notFoundException) {
            return $this->failure($notFoundException->getMessage(), $notFoundException->getCode());
        } catch (Exception) {
            return $this->failure('Bad Request', 400);
        }

        return $this->success('Created', 201, $payment);
    }
}
