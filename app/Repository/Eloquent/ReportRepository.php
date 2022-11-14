<?php

namespace App\Repository\Eloquent;

use App\Repository\ReportRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ReportRepository implements ReportRepositoryInterface
{

    /**
     * Make a report.
     *
     * @return array
     */
    public function sumOfApprovedPaymentsForApprovers(): array
    {
        return DB::select(
            DB::raw("
                SELECT report.user_id, report.first_name, report.last_name, SUM(report.amount) AS final_amount
                FROM (
                    SELECT *
                    FROM (
                        SELECT 'payment', COUNT(*) as number_of_counts, pa.payment_id, pa.status, SUM(p.total_amount) as amount, u.id as user_id, u.first_name, u.last_name
                        FROM payment_approvals pa
                        LEFT JOIN payments p ON p.id = pa.payment_id AND pa.payment_type = 'App\\\Models\\\Payment'
                        LEFT JOIN users u ON u.id = p.user_id
                        WHERE u.`type` = 'APPROVER'
                        GROUP BY pa.payment_id, pa.status
                    ) t
                    GROUP BY t.payment_id
                    HAVING COUNT(*) = 1 AND t.status = 'APPROVED'

                    UNION

                    SELECT *
                    FROM (
                        SELECT 'travel_payment', COUNT(*) as number_of_counts, pa.payment_id, pa.status, SUM(tp.amount), u.id as user_id, u.first_name, u.last_name
                        FROM payment_approvals pa
                        LEFT JOIN travel_payments tp ON tp.id = pa.payment_id AND pa.payment_type = 'App\\\Models\\\TravelPayment'
                        LEFT JOIN users u ON u.id = tp.user_id
                        WHERE u.`type` = 'APPROVER'
                        GROUP BY pa.payment_id, pa.status
                    ) t2
                    GROUP BY t2.payment_id
                    HAVING COUNT(*) = 1 AND t2.status = 'APPROVED'
                ) report
                GROUP BY report.user_id
                ORDER BY report.amount DESC
            ")
        );
    }
}
