<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DigikeyController;
use App\Http\Controllers\MouserController;
use App\Http\Controllers\Element14Controller;

use App\Http\Controllers\Articles\PmArticleController;
use App\Http\Controllers\Articles\TrenzArticleController;
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

Route::controller(PmArticleController::class)->group(function () {
    Route::get('plentymarket', 'index');
    Route::get('plentymarket/getReport', 'getReport');
    Route::get('plentymarket/updateOrCreateArticle', 'updateOrCreateArticle');
});

Route::controller(TrenzArticleController::class)->group(function () {
    Route::get('trenz', 'index');
    Route::get('trenz/create', 'create');
});
/*
Route::controller(UpdatingController::class)->group(function () {
    Route::get('updating', 'index');
    Route::get('updating/price', 'updateVariationPrice');
    Route::post('updating/stock', 'updateVariationStock');
});*/


