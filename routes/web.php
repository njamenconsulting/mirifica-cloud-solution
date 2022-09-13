<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DigikeyController;
use App\Http\Controllers\MouserController;
use App\Http\Controllers\Element14Controller;
use App\Http\Controllers\TrenzController;
use App\Http\Controllers\PlentymarketController;
use App\Http\Controllers\UpdatingController;
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
    Route::get('/', 'index');
    Route::post('/about', 'about');
});

Route::controller(MouserController::class)->group(function () {
    Route::get('mouser', 'index');
    Route::get('mouser/keywordSearch', 'getFormKeywordSearch');
    Route::post('mouser/keywordSearch', 'postFormKeywordSearch');
});
 
Route::controller(Element14Controller::class)->group(function () {
    Route::get('element14', 'index');
    Route::get('element14/keywordSearch', 'getFormKeywordSearch');
    Route::post('element14/keywordSearch', 'postFormKeywordSearch');
});

Route::controller(PlentymarketController::class)->group(function () {
    Route::get('plentymarket', 'index');
    Route::get('plentymarket/checking', 'updateDb');
});

Route::controller(TrenzController::class)->group(function () {
    Route::get('trenz', 'index');
    Route::get('trenz/getAll', 'getAllArticles');
    Route::post('trenz/keywordSearch', 'postFormKeywordSearch');
});

Route::controller(UpdatingController::class)->group(function () {
    Route::get('updating', 'index');
    Route::get('updating/price', 'updateVariationPrice');
    Route::post('updating/stock', 'updateVariationStock');
});
