<?php

namespace App\Http\Middleware;

use App\Models\Payment;
use App\Models\TravelPayment;
use App\Traits\RespondWithHttpStatus;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OnlyHisOwn
{
    use RespondWithHttpStatus;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (str_contains($request->url(), '/users/')) {
            return $this->users($request, $next);
        }

        if (str_contains($request->url(), '/payments/')) {
            return $this->payments($request, $next);
        }

        if (str_contains($request->url(), '/travel-payments/')) {
            return $this->travelPayments($request, $next);
        }
    }

    /**
     * Handle user endpoints
     *
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|mixed
     */
    private function users(Request $request, Closure $next): mixed
    {
        if ($request->route('id') != auth()->id()) {
            return $this->failure('Method not allowed.', 405);
        }

        return $next($request);
    }

    /**
     * Handle payment endpoints.
     *
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|mixed
     */
    private function payments(Request $request, Closure $next): mixed
    {
        $payment = Payment::find($request->route('id'));
        if (!$payment) {
            return $next($request);
        }

        if ($payment->user_id != auth()->id()) {
            return $this->failure('Method not allowed.', 405);
        }

        return $next($request);
    }

    /**
     * Handle travel payment endpoints.
     *
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|mixed
     */
    private function travelPayments(Request $request, Closure $next): mixed
    {
        $travelPayment = TravelPayment::find($request->route('id'));
        if (!$travelPayment) {
            return $next($request);
        }

        if ($travelPayment->user_id != auth()->id()) {
            return $this->failure('Method not allowed.', 405);
        }

        return $next($request);
    }
}
