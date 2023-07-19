<?php

use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\ReadController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the 'web' middleware group. Make something great!
|
*/

Route::get('/', [AdminController::class, 'index'])->middleware('auth')->name('homepage');
Route::get('/user_detail', [AdminController::class, 'user_detail'])->middleware('auth');
Route::post('/user_detail', [AuthController::class, 'update_user'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| LOGIN, LOGOUT, REGISTER
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_action']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'register_action']);

Route::get('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| Forgot Password
|--------------------------------------------------------------------------
*/
Route::get('/forgot_password', [AuthController::class, 'forgot_password'])->middleware('guest');
Route::post('/forgot_password', [AuthController::class, 'forgot_password_request'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'forgot_password_form'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'forgot_password_action'])->middleware('guest')->name('password.update');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'forgot_password_redirect_dari_email'])->middleware(['auth', 'signed'])->name('verification.verify');

/*
|--------------------------------------------------------------------------
| CRUD
|--------------------------------------------------------------------------
*/
Route::get('/create', [CreateController::class, 'index']);
Route::post('/create/action', [CreateController::class, 'action']);

Route::get('/read', [ReadController::class, 'index']);
Route::get('/read/{id}', [ReadController::class, 'detail']);

Route::get('/update', [UpdateController::class, 'index']);
Route::get('/update/{id}', [UpdateController::class, 'detail']);
Route::post('/update/action', [UpdateController::class, 'action']);

Route::get('/delete', [DeleteController::class, 'index']);
Route::get('/delete/{id}', [DeleteController::class, 'action']);
