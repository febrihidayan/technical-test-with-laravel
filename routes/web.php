<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PrepaidBalanceController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\SuccessController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::middleware('auth')->group( function() {

    Route::get('product', [ProductPageController::class, 'index'])
        ->name('product');

    Route::post('product', [ProductPageController::class, 'store'])
        ->name('product.store');

    Route::get('prepaid-balance', [PrepaidBalanceController::class, 'index'])
        ->name('prepaid-balance');

    Route::post('prepaid-balance', [PrepaidBalanceController::class, 'store'])
        ->name('prepaid-balance.store');

    Route::get('success', SuccessController::class)
        ->name('success');

    Route::get('payment', [PaymentController::class, 'index'])
        ->name('payment');

    Route::post('payment', [PaymentController::class, 'store'])
        ->name('payment.store');

    Route::get('order', OrderController::class)
        ->name('order');

});