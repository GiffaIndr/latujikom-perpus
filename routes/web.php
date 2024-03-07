<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Models\Auth;
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

//Auth controller
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/auth', [AuthController::class, 'auth'])->name('login.auth');
Route::post('/register/post', [AuthController::class, 'registerUser'])->name('register.auth');
//bookController
//admin
Route::get('/dashboard', [BookController::class, 'dashboard'])->name('dashboard');

//user
Route::get('/landing', [BookController::class, 'index'])->name('landing');