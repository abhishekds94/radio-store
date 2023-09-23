<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/simplinamdhari', function () {
    return view('welcome');
});

Route::get('/simplinamdhari/test-data', function () {
    $ipLogs = \App\Models\IPLog::all();
    return view('test-data')->with('ipLogs', $ipLogs);
})->middleware(['auth', 'verified'])->name('test');

Route::get('/simplinamdhari/dashboard', function () {
    $stores = \App\Models\Store::all();
    return view('dashboard')->with('stores', $stores);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/simplinamdhari/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/simplinamdhari/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/simplinamdhari/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
