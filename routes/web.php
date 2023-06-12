<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController; //adminの選手操作
use App\Http\Controllers\Admin\GamesController as AdminGamesController; //adminの試合操作
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController; //adminのダッシュボード操作
use App\Http\Controllers\ProfileController as ProfileOfAdminController; //追加
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//admin.phpを読み込む
Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth:admin', 'verified'])->name('dashboard');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/profile', [ProfileOfAdminController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileOfAdminController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileOfAdminController::class, 'destroy'])->name('profile.destroy');
        
        Route::get('/users',[AdminUsersController::class, 'index'])->name('users.index');
        Route::get('/users/create',[AdminUsersController::class, 'create'])->name('users.create');
        Route::post('/users/store',[AdminUsersController::class, 'store'])->name('users.store');
        Route::get('/users/{id}',[AdminUsersController::class, 'show'])->name('users.show');
        
        Route::get('/games/create',[AdminGamesController::class, 'create'])->name('games.create');
        Route::post('/games/store',[AdminGamesController::class, 'store'])->name('games.store');
        Route::get('/games/{id}',[AdminGamesController::class, 'show'])->name('games.show');
        
        
        Route::get('/dashboard',[AdminDashboardController::class, 'index'])->name('dashboard');
        
    });

    require __DIR__.'/admin.php';
});