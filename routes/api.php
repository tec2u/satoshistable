<?php

use App\Http\Controllers\Admin\OrderAdmin\AdminOrderController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\BinarioController;
use Illuminate\Http\Request;
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
Route::get('/registerBinario/{id}', [BinarioController::class, 'registerBinario'])->name('api.registerBinario');

Route::post('/notify', [PaymentController::class, 'notify'])->name('notify');
Route::post('/notify-sunvolt', [PaymentController::class, 'notify'])->name('notify_sunvolt');

Route::controller(UserAdminController::class)->group(function () {
    Route::post('/add-credit', 'addCredit')->name('api.add_credit');//autentica login de usuarios
});

