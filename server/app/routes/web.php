<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandController;


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
});


Route::prefix('demand')->name('demand.')->group(function (){
  
    Route::get('entry', [DemandController::class, 'entry'])->name('entry');
    Route::post('entryDone', [DemandController::class, 'entryDone'])->name('entryDone');
     Route::get('item/entry', [DemandController::class, 'itemEntry'])->name('item.entry');
    Route::post('item/entryDone', [DemandController::class, 'itemEntryDone'])->name('item.entryDone');
  
    Route::get('showAll', [DemandController::class, 'showAll'])->name('showAll');
    Route::get('showItemAll', [DemandController::class, 'showItemAll'])->name('showItemAll');
   
 });
 


// Route::get('/request', [RequestController::class, 'index'])->name('request.index');
// Route::post('/requestDone', [RequestController::class, 'store'])->name('request.store');
// Route::get('/requestALL', function () {
//     return view('request.requestALL');
// })->name('request.requestALL');
// Route::get('/requestItem', [RequestController::class, 'item'])->name('request.item');
// Route::post('/requestItemDone', [RequestController::class, 'requestItemDone'])->name('request.requestItemDone');
// Route::get('/requestItemAll', [RequestController::class, 'requestItemAll'])->name('request.requestItemAll');
