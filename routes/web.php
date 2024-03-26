<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\StoreController;

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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'customers' , 'as' => 'customers.'], function(){
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/getData', [CustomerController::class, 'getData'])->name('getData');
        Route::get('/create', [CustomerController::class, 'create'])->name('create');
        Route::post('/store', [CustomerController::class, 'store'])->name('store');
        Route::get('/{id}/show', [CustomerController::class, 'show'])->name('show');
        Route::get('getDataInvoice', [CustomerController::class, 'getDataInvoice'])->name('getDataInvoice');
        Route::get('/{id}/edit', [CustomerController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [CustomerController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [CustomerController::class, 'destroy'])->name('destroy');

        //Store
        Route::group(['prefix' => '{customerId}/warehouse' , 'as' => 'warehouse.'], function(){
            Route::get('/index', [StoreController::class, 'index'])->name('index');
            Route::get('/getData', [StoreController::class, 'getData'])->name('getData');
            Route::get('/create', [StoreController::class, 'create'])->name('create');
            Route::post('/store', [StoreController::class, 'store'])->name('store');
        });

        //Invoice
        Route::group(['prefix' => '{customerId}/invoice' , 'as' => 'invoice.'], function(){
            Route::get('/index', [ReceiptController::class, 'index'])->name('index');
            Route::get('/getData', [ReceiptController::class, 'getData'])->name('getData');
            Route::get('/create', [ReceiptController::class, 'create'])->name('create');
            Route::post('/store', [ReceiptController::class, 'store'])->name('store');
        });

    });
});