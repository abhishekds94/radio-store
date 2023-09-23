<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Middlewares\LogIpAddressesMiddleware;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/guest/set_address', [StoreController::class, 'setAddress']);

Route::get('/store/{id}/set_active', [StoreController::class, 'setActive']);
Route::get('/store/{id}/set_inactive', [StoreController::class, 'setInactive']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
