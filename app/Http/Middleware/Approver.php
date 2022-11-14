<?php

namespace App\Http\Middleware;

use App\Traits\RespondWithHttpStatus;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Approver
{
    use RespondWithHttpStatus;

    /**
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (auth()->user()->type != 'APPROVER') {
            return $this->failure('Method not allowed.', 405);
        }

        return $next($request);
    }
}
