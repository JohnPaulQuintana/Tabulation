<?php

use App\Http\Controllers\Admin\Administrator;
use App\Http\Controllers\JudgeController;
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
// judge controller
// Route::post('/authenticate',[JudgeController::class, 'authenticate'])->name('authenticate');

Route::group(['middleware' => ['auth','verified']], function () {
    Route::group(['prefix' => 'admin','middleware' => 'is_admin','as' => 'admin.'], function () {
        Route::get('/dashboard', [Administrator::class, 'index'])->name('dashboard');
        Route::get('/event', [Administrator::class, 'event'])->name('event');
        Route::get('/event/edit/{id}', [Administrator::class, 'editEvent'])->name('event.edit');
        Route::post('/event/update', [Administrator::class, 'updateEvent'])->name('event.update');
        Route::get('/create', [Administrator::class, 'create'])->name('create');
        Route::post('/store', [Administrator::class, 'store'])->name('store');
        Route::get('/category/{id}', [Administrator::class, 'category'])->name('category');
        Route::post('/category/store', [Administrator::class, 'categoryStore'])->name('category.store');
        Route::get('/judge/{id}', [Administrator::class, 'judge'])->name('judge');
        Route::post('/judge/store', [Administrator::class, 'judgeStore'])->name('judge.store');
        Route::post('/judge/update', [Administrator::class, 'judgeUpdate'])->name('judge.update');
        Route::post('/judge/code', [Administrator::class, 'judgeCode'])->name('judge.code');
        Route::get('/candidate/{id}', [Administrator::class, 'candidate'])->name('candidate');
        Route::post('/candidate/store', [Administrator::class, 'candidateStore'])->name('candidate.store');
        Route::post('/candidate/update', [Administrator::class, 'candidateUpdate'])->name('candidate.update');
        Route::get('/candidate/destroy/{id}', [Administrator::class, 'candidateDestroy'])->name('candidate.destroy');
        // start the event
        Route::get('/start/{id}', [Administrator::class, 'startEvent'])->name('event.start');
        Route::get('/start/cancel/{id}', [Administrator::class, 'cancelEvent'])->name('event.cancel');
        Route::post('/set-status', [Administrator::class, 'updateStatus'])->name('event.setStatus');
        Route::get('/start-voting/{id}', [Administrator::class, 'startVoting'])->name('event.start.voting');
        Route::get('/edit', [Administrator::class, 'edit'])->name('category.edit');
        Route::post('/update', [Administrator::class, 'update'])->name('category.update');

        // sports
        Route::get('/sports', [Administrator::class, 'sports'])->name('sports');
        Route::get('/sports/create', [Administrator::class, 'createSports'])->name('sports.create');
        Route::post('/sports/store', [Administrator::class, 'storeSports'])->name('sports.store');
        Route::post('/sports/store/team', [Administrator::class, 'storeTeam'])->name('sports.store.team');
        Route::get('/sports/team/{id}', [Administrator::class, 'team'])->name('sports.team');
        Route::post('/sports/update/team', [Administrator::class, 'updateTeam'])->name('sports.update.team');
        Route::post('/sports/store/player', [Administrator::class, 'storePlayer'])->name('sports.store.player');
    });

    // judge
    Route::group(['middleware' => ['auth']], function () {
        Route::group(['prefix' => 'judge','as' => 'judge.'], function () {
            Route::get('/dashboard',[JudgeController::class, 'index'])->name('dashboard');
            Route::get('/candidates',[JudgeController::class, 'candidates'])->name('candidates');
            Route::post('/vote',[JudgeController::class, 'vote'])->name('vote');
            Route::get('/edit',[JudgeController::class, 'edit'])->name('edit');
            Route::post('/update',[JudgeController::class, 'update'])->name('update');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
