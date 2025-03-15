<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ProductSizeColorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostCategoryController;
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

    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::put('/{id}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
    });
    
    Route::prefix('sizes')->group(function () {
        Route::get('/', [SizeController::class, 'index'])->name('admin.size.index');
        Route::get('/create', [SizeController::class, 'create'])->name('admin.size.create');
        Route::post('/', [SizeController::class, 'store'])->name('admin.size.store');
        Route::get('/{id}/edit', [SizeController::class, 'edit'])->name('admin.size.edit');
        Route::put('/{id}', [SizeController::class, 'update'])->name('admin.size.update');
        Route::delete('/{id}', [SizeController::class, 'destroy'])->name('admin.size.destroy');
    });
    Route::prefix('product-size-color')->group(function () {
        Route::get('/', [ProductSizeColorController::class, 'index'])->name('admin.product_size_color.index');
        Route::get('/create', [ProductSizeColorController::class, 'create'])->name('admin.product_size_color.create');
        Route::post('/', [ProductSizeColorController::class, 'store'])->name('admin.product_size_color.store');
        Route::get('/{id}/edit', [ProductSizeColorController::class, 'edit'])->name('admin.product_size_color.edit');
        Route::put('/{id}', [ProductSizeColorController::class, 'update'])->name('admin.product_size_color.update');
        Route::delete('/{id}', [ProductSizeColorController::class, 'destroy'])->name('admin.product_size_color.destroy');
    });
    
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });


Route::prefix('coupon')->group(function () {
    Route::get('/', [CouponController::class, 'index'])->name('admin.coupon.index');
    Route::get('/create', [CouponController::class, 'create'])->name('admin.coupon.create');
    Route::post('/', [CouponController::class, 'store'])->name('admin.coupon.store');
    Route::get('/{id}/edit', [CouponController::class, 'edit'])->name('admin.coupon.edit');
    Route::put('/{id}', [CouponController::class, 'update'])->name('admin.coupon.update');
    Route::delete('/{id}', [CouponController::class, 'destroy'])->name('admin.coupon.destroy');
});


Route::prefix('banner')->group(function () {
    Route::get('/', [BannerController::class, 'index'])->name('admin.banner.index');
    Route::get('/create', [BannerController::class, 'create'])->name('admin.banner.create');
    Route::post('/', [BannerController::class, 'store'])->name('admin.banner.store');
    Route::get('/{banner}/edit', [BannerController::class, 'edit'])->name('admin.banner.edit');
    Route::put('/{banner}', [BannerController::class, 'update'])->name('admin.banner.update');
    Route::delete('/{banner}', [BannerController::class, 'destroy'])->name('admin.banner.destroy');
});

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('admin.blog.index');
    Route::get('/create', [BlogController::class, 'create'])->name('admin.blog.create');
    Route::post('/store', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::put('/{blog}', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('/{blog}', [BlogController::class, 'destroy'])->name('admin.blog.destroy');
});
// Blog Categories Routes
Route::prefix('post-category')->group(function () {
    Route::get('/', [PostCategoryController::class, 'index'])->name('admin.post_category.index');
    Route::get('/create', [PostCategoryController::class, 'create'])->name('admin.post_category.create');
    Route::post('/', [PostCategoryController::class, 'store'])->name('admin.post_category.store');
    Route::get('/{id}/edit', [PostCategoryController::class, 'edit'])->name('admin.post_category.edit');
    Route::put('/{id}', [PostCategoryController::class, 'update'])->name('admin.post_category.update');
    Route::delete('/{id}', [PostCategoryController::class, 'destroy'])->name('admin.post_category.destroy');
});

});

// Authentication Routes
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Product;

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/product', [ProductController::class, 'shop'])->name('products');
Route::get('product/detail/{id}', [ProductController::class, 'show'])->name('product.detail');

