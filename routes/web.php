<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\dashboardController;

Route::get('register', [authController::class, 'showRegisterForm'])->name('register');
Route::post('register', [authController::class, 'register']);
Route::get('login', [authController::class, 'showLoginForm'])->name('login');
Route::post('login', [authController::class, 'login']);
Route::post('logout', [authController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth','checkRole:admin,user']],function(){
  Route::get('dashboard', [dashboardController::class, 'index'])->name('dashboard');
});

Route::group(['middleware' => ['auth','checkRole:admin']],function(){
  Route::resource('announcement','App\Http\Controllers\announcementController');
});