<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    /**
     * @var ReportService
     */
    private ReportService $reportService;

    /**
     * ReportController constructor.
     *
     * @param ReportService $reportService
     */
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * Make a report.
     *
     * @return JsonResponse
     */
    public function sumOfApprovedPaymentsForApprovers(): JsonResponse
    {
        return $this->reportService->sumOfApprovedPaymentsForApprovers();
    }
}
