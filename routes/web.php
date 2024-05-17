<?php

use App\Http\Controllers\Admin\Administrator;
use App\Http\Controllers\Page\PageController;
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

Route::get('/', [PageController::class, 'index'])->name('index');

// Route::get('/dashboard', [Administrator::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth','verified']], function () {
    Route::group(['prefix' => 'admin','as' => 'admin.'], function () {
        Route::get('/dashboard', [Administrator::class, 'index'])->name('dashboard');
        Route::get('/event', [Administrator::class, 'event'])->name('event');
        Route::get('/create', [Administrator::class, 'create'])->name('create');
        Route::post('/store', [Administrator::class, 'store'])->name('store');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
