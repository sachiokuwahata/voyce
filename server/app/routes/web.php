<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandController;
use App\Http\Controllers\ClientController;


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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return view('test');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('demand')->name('demand.')->middleware('auth')->group(function (){
  
    Route::get('entry', [DemandController::class, 'entry'])->name('entry');
    Route::post('entryDone', [DemandController::class, 'entryDone'])->name('entryDone');

    Route::get('item/entry', [DemandController::class, 'itemEntry'])->name('item.entry');
    Route::post('item/entryDone', [DemandController::class, 'itemEntryDone'])->name('item.entryDone');
  
    Route::get('showAll', [DemandController::class, 'showAll'])->name('showAll');
    Route::get('showItemAll', [DemandController::class, 'showItemAll'])->name('showItemAll');
   
 });

 Route::prefix('client')->name('client.')->middleware('auth')->group(function (){

    Route::get('entry', [ClientController::class, 'entry'])->name('entry');
    Route::post('entryDone', [ClientController::class, 'entryDone'])->name('entryDone');
   
 });



require __DIR__.'/auth.php';
