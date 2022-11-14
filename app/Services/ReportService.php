<?php

namespace App\Services;

use App\Repository\ReportRepositoryInterface;
use App\Traits\RespondWithHttpStatus;
use Exception;
use Illuminate\Http\JsonResponse;

class ReportService
{
    use RespondWithHttpStatus;

    /**
     * @var ReportRepositoryInterface
     */
    private ReportRepositoryInterface $reportRepository;

    /**
     * UserController constructor.
     *
     * @param ReportRepositoryInterface $reportRepository
     */
    public function __construct(ReportRepositoryInterface $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    /**
     * Make a report.
     *
     * @return JsonResponse
     */
    public function sumOfApprovedPaymentsForApprovers(): JsonResponse
    {
        try {
            $report = $this->reportRepository->sumOfApprovedPaymentsForApprovers();
        } catch (Exception) {
            return $this->failure('Bad Request', 400);
        }

        return $this->success('OK', 200, $report);
    }
}
