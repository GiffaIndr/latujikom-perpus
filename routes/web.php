<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
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

Route::middleware(['isguest'])->group(function () {

    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/auth', [AuthController::class, 'auth'])->name('login.auth');
    Route::post('/register/post', [AuthController::class, 'registerUser'])->name('register.auth');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/error', [BookController::class, 'error'])->name('error');

Route::middleware(['islogin', 'checkRole:admin,staff'])->group(function () {
    //ini category
    Route::get('/dashboard/category', [BookController::class, 'category'])->name('category');
    Route::post('/dashboard/category/create', [BookController::class, 'createCategory'])->name('create.category');
    Route::delete('/dashboard/category/delete', [BookController::class, 'deleteCategory'])->name('delete.category');

    //ini untuk book 
    Route::get('/dashboard/book', [BookController::class, 'book'])->name('book');
    Route::post('/dashboard/book/add', [BookController::class, 'createBook'])->name('book.add');
    Route::patch('/dashboard/book/{id}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/dashboard/book/{id}', [BookController::class, 'destroy'])->name('delete.book');

    //ini untuk pinjam
    Route::get('/dashboard/pinjam/', [BookController::class, 'pinjam'])->name('pinjam');
    Route::patch('/dashboard/pinjam/completed/{id}', [BookController::class, 'updatePeminjam'])->name('update.pinjam');
});

Route::middleware(['islogin', 'checkRole:user,staff,admin'])->group(function () {
    //admin
    Route::get('/landing', [BookController::class, 'index'])->name('landing');
});

Route::middleware(['islogin', 'checkRole:user'])->group(function () {
    //user
    Route::get('/collection', [BookController::class, 'collection'])->name('collection');
    Route::get('/review', [BookController::class, 'review'])->name('review');
    Route::get('/borrow', [BookController::class, 'pinjamUser'])->name('borrow');
    Route::get('/borrow/book/{id}', [BookController::class, 'borrowBook'])->name('borrow.book');
    Route::put('/pengembalian/{pinjam}', [BookController::class, 'pengembalian'])->name('pengembalian');
});

Route::middleware(['islogin', 'checkRole:admin'])->group(function () {
    //ini user
    Route::get('/dashboard/user', [AuthController::class, 'user'])->name('user');
    Route::post('/dashboard/users/create', [AuthController::class, 'createUser'])->name('user.create');
    Route::patch('/dashboard/user/edit/{id}', [AuthController::class, 'update'])->name('edit.user');
    Route::delete('/dashboard/user/delete/{id}', [AuthController::class, 'destroy'])->name('delete.user');
});
