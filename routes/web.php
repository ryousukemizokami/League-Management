<?php

use App\Http\Controllers\ProfileController;
//admin側操作
use App\Http\Controllers\Admin\UsersController as AdminUsersController; //adminの選手操作
use App\Http\Controllers\Admin\GamesController as AdminGamesController; //adminの試合操作
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController; //adminのダッシュボード操作
use App\Http\Controllers\Admin\UserGamesController as AdminUserGamesController; //adminの試合の出欠確定操作
//Player側操作
use App\Http\Controllers\UsersController as PlayerUsersController; //選手の選手情報操作
use App\Http\Controllers\GamesController as PlayerGamesController; //選手の試合操作
use App\Http\Controllers\DashboardController as playerDashboardController; //選手のダッシュボード操作
use App\Http\Controllers\UserGamesController as PlayerUserGamesController; //選手の試合の出欠回答操作

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
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/dashboard',[PlayerDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/users',[playerUsersController::class, 'index'])->name('users.index');
    Route::get('/users/{id}',[PlayerUsersController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit',[PlayerUsersController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}/update',[PlayerUsersController::class, 'update'])->name('users.update');
    
    Route::get('/games/{id}',[PlayerGamesController::class, 'show'])->name('games.show');
    Route::post('/games/{id}/submit',[PlayerUserGamesController::class, 'store'])->name('games.submit');
    
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
        Route::get('/games/{id}/edit',[AdminGamesController::class, 'edit'])->name('games.edit');
        Route::put('/games/{id}/update',[AdminGamesController::class, 'update'])->name('games.update');
        Route::delete('/games/{id}/destroy',[AdminGamesController::class, 'destroy'])->name('games.destroy');
        
        Route::put('/games/{id}/position/update',[AdminUserGamesController::class, 'update'])->name('games.position.update');
        
        
        Route::get('/dashboard',[AdminDashboardController::class, 'index'])->name('dashboard');
        
    });

    require __DIR__.'/admin.php';
});