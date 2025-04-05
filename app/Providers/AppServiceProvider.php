<?php
namespace App\Providers; // Dòng này phải có

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $categories = Category::with('subcategories')->get();
            $view->with('categories', $categories);
        });
    }
}
