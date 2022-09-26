<?php

use App\Http\Controllers\ScoreController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('video.index');
});

Route::prefix('first')->group(function () {
    Route::resource('/video', VideoController::class)->except(['show']);
});

Route::prefix('second')->group(function () {
    Route::resource('/score', ScoreController::class)->except(['show']);
});
