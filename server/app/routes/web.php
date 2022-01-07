<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RequestController;

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


Route::get('/test', function () {
    return view('test');
});

Route::get('/request', [RequestController::class, 'index'])->name('request.index');
Route::post('/requestDone', [RequestController::class, 'store'])->name('request.store');
Route::get('/requestALL', function () {
    return view('request.requestALL');
});