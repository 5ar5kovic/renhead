<?php

namespace App\Providers;

use App\Repository\AuthRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\AuthRepository;
use App\Repository\Eloquent\PaymentApprovalRepository;
use App\Repository\Eloquent\PaymentRepository;
use App\Repository\Eloquent\ReportRepository;
use App\Repository\Eloquent\TravelPaymentRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\PaymentApprovalRepositoryInterface;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\ReportRepositoryInterface;
use App\Repository\TravelPaymentRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(TravelPaymentRepositoryInterface::class, TravelPaymentRepository::class);
        $this->app->bind(PaymentApprovalRepositoryInterface::class, PaymentApprovalRepository::class);
        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
