<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'category_count' => Category::count(),
        ]);
    }
}
