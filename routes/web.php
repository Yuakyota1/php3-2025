<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.category.store');

    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin.category.update');

    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
});
Route::prefix('admin')->group(function () {
    Route::get('/subcategories', [SubCategoryController::class, 'index'])->name('admin.subcategory.index');
    Route::get('/subcategories/create', [SubCategoryController::class, 'create'])->name('admin.subcategory.create');
    Route::post('/subcategories/store', [SubCategoryController::class, 'store'])->name('admin.subcategory.store');
    Route::get('/subcategories/{id}/edit', [SubCategoryController::class, 'edit'])->name('admin.subcategory.edit');
    Route::put('/subcategories/{id}/update', [SubCategoryController::class, 'update'])->name('admin.subcategory.update');
    Route::delete('/subcategories/{id}', [SubCategoryController::class, 'destroy'])->name('admin.subcategory.destroy');
});
