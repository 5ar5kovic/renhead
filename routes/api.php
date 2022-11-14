<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentApprovalController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TravelPaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::put('users/{id}', [UserController::class, 'update'])->middleware('only.his.own');

    Route::get('payments', [PaymentController::class, 'index']);
    Route::get('payments/{id}', [PaymentController::class, 'show']);
    Route::post('payments', [PaymentController::class, 'create']);
    Route::patch('payments/{id}', [PaymentController::class, 'update'])->middleware('only.his.own');
    Route::delete('payments/{id}', [PaymentController::class, 'delete'])->middleware('only.his.own');

    Route::get('travel-payments', [TravelPaymentController::class, 'index']);
    Route::get('travel-payments/{id}', [TravelPaymentController::class, 'show']);
    Route::post('travel-payments', [TravelPaymentController::class, 'create']);
    Route::patch('travel-payments/{id}', [TravelPaymentController::class, 'update'])->middleware('only.his.own');
    Route::delete('travel-payments/{id}', [TravelPaymentController::class, 'delete'])->middleware('only.his.own');

    Route::post('payments/{id}/approve', [PaymentApprovalController::class, 'create'])->middleware('approver');
    Route::post('travel-payments/{id}/approve', [PaymentApprovalController::class, 'create'])->middleware('approver');

    Route::get('report', [ReportController::class, 'sumOfApprovedPaymentsForApprovers'])->middleware('approver');
});
