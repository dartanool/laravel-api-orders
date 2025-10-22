<?php

use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});
Route::middleware('apiKey')->group(function () {
    Route::get('/sales', [SaleController::class, 'index']);
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index']);
    Route::get('/stocks', [\App\Http\Controllers\StockController::class, 'index']);
    Route::get('/incomes', [\App\Http\Controllers\IncomeController::class, 'index']);
});


