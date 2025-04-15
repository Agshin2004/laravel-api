<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\V1\InvoiceController;
use App\Http\Controllers\api\V1\CustomerController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('invoices', InvoiceController::class);

    // Could use legacy Route::post('invoices/bulk', ['uses' => 'InvoiceController@bulkStore])
    // But for that namespace key must be added to group ('namespace' => 'App\Http\Controllers\api\V1)
    Route::post('invoices/bulk', [InvoiceController::class, 'bulkStore']);
});
