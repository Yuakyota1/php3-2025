<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // Lấy danh sách sản phẩm yêu thích của người dùng
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->with('product')->get();
        return view('favorites.index', compact('favorites'));
    }

    // Thêm sản phẩm vào danh sách yêu thích
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
    
        Favorite::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id
        ]);
    
        $favorites = Favorite::where('user_id', Auth::id())->with('product')->get();
        return view('favorites.index', compact('favorites'));
    }

    // Xóa sản phẩm khỏi danh sách yêu thích
    public function destroy($id)
    {
        $favorite = Favorite::where('user_id', Auth::id())->where('product_id', $id)->first();
    
        if ($favorite) {
            $favorite->delete();
        }
    
        $favorites = Favorite::where('user_id', Auth::id())->with('product')->get();
        return view('favorites.index', compact('favorites'));
    }
    
}
