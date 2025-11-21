<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;

Route::get('/', [AuthController::class, 'index']);


// Auth routes with controller 


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

//auth register 
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');


Route::get('/Admin/Dashboard', [AuthController::class, 'index'])->name('Admin.Dashboard');
Route::get('/User/Dashboard', [AuthController::class, 'index'])->name('User.Dashboard');
