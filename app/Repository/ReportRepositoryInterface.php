<?php

namespace App\Repository;

interface ReportRepositoryInterface
{
    /**
     * Make a report.
     *
     * @return array
     */
    public function sumOfApprovedPaymentsForApprovers(): array;
}
