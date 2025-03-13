<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
Route::get('/', function () {
    return view('welcome');
});

// Group Admin Routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Categories
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
    });

    // Subcategories
    Route::prefix('subcategories')->group(function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('admin.subcategory.index');
        Route::get('/create', [SubCategoryController::class, 'create'])->name('admin.subcategory.create');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('admin.subcategory.store');
        Route::get('/{id}/edit', [SubCategoryController::class, 'edit'])->name('admin.subcategory.edit');
        Route::put('/{id}', [SubCategoryController::class, 'update'])->name('admin.subcategory.update');
        Route::delete('/{id}', [SubCategoryController::class, 'destroy'])->name('admin.subcategory.destroy');
    });
});

// Authentication Routes
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');
use App\Http\Controllers\Auth\RegisterController;

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
