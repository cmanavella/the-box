<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\DetailsAccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AccountsController::class, 'index'])->name('main');
Route::get('/accounts/{id}', [AccountsController::class, 'show'])->name('accounts.get');

Route::post('/detailsaccount/{id_account}/{id_detail_type}/{fecha}/{monto}/{observaciones?}',
    [DetailsAccountController::class, 'ajax_add_movimiento'])->name('detailsaccount.add_movimiento');
