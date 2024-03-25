<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    // Route::get('/home', [HomeController::class, 'index'])->name('home');

     //News
     Route::group(['prefix' => 'home' , 'as' => 'home.'], function(){
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::get('/getData', [HomeController::class, 'getData'])->name('getData');
        Route::get('/create', [HomeController::class, 'create'])->name('create');
        Route::post('/store', [HomeController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [HomeController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [HomeController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [HomeController::class, 'destroy'])->name('destroy');
    });
});