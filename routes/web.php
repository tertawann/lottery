<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LotteryController;

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

Route::get('/lottery', [LotteryController::class, 'index']);

Route::post('/lottery/draw', [LotteryController::class, 'draw']);
Route::post('/lottery/find', [LotteryController::class, 'find']);


Route::get('/', function () {
    return view('lottery.index');
});
