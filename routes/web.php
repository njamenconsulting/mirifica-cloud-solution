<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Articles\TrenzarticleController;
use App\Http\Controllers\Articles\PlentyarticleController;
use App\Http\Controllers\Articles\PlentySystemController;
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

Route::controller(WelcomeController::class)->group(function () {
    Route::get('/h', 'index');
    Route::post('/about', 'about');
});
Route::get('/', function () {
    return view('index');
});


Route::resource('trenz-articles', TrenzarticleController::class)->only([
    'index', 'create','store', 'edit', 'update', 'destroy'
]);
Route::resource('plenty-articles', PlentyarticleController::class)->only([
    'index', 'create','store', 'edit', 'update', 'destroy'
]);
Route::controller(PlentySystemController::class)->group(function () {
    Route::get('update-sales-price', 'updateSalePrice');
    Route::get('update-stock', 'updateBulkStock');
});



