<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\ProductSizeColor;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {
    public function index() {
        $carts = Auth::check() 
            ? Cart::where('user_id', Auth::id())->get() 
            : session()->get('cart', []);

        return view('cart.index', compact('carts'));
    }

    public function store(Request $request) {
        if (Auth::check()) {
            $sizeName = \App\Models\Size::where('id', $request->size)->value('size_name') ?? 'Không có';
    
            // Tìm sản phẩm đã có trong giỏ hàng
            $cartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->where('size', $sizeName)
                ->where('color', $request->color)
                ->first();
    
            if ($cartItem) {
                $cartItem->increment('quantity', $request->quantity);
                $cartItem->update(['total_price' => $cartItem->quantity * $cartItem->price]);
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'size' => $sizeName,
                    'color' => $request->color,
                    'name' => $request->name,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'total_price' => $request->quantity * $request->price,
                    'image' => $request->image
                ]);
            }
        } else {
            $cart = session()->get('cart', []);
    
            foreach ($cart as &$item) {
                if ($item['product_id'] == $request->product_id &&
                    $item['size'] == $request->size &&
                    $item['color'] == $request->color) {
                    $item['quantity'] += $request->quantity;
                    $item['total_price'] = $item['quantity'] * $item['price'];
                    session()->put('cart', $cart);
                    return response()->json(['message' => 'Sản phẩm đã cập nhật trong giỏ hàng']);
                }
            }
    
            // Nếu chưa có sản phẩm trong giỏ hàng, thêm mới
            $cart[] = [
                'product_id' => $request->product_id,
                'size' => $request->size,
                'color' => $request->color,
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'total_price' => $request->quantity * $request->price,
                'image' => $request->image
            ];
    
            session()->put('cart', $cart);
        }
    
        return response()->json(['message' => 'Sản phẩm đã thêm vào giỏ hàng']);
    }
    

    public function destroy($id) {
        if (Auth::check()) {
            Cart::where('id', $id)->where('user_id', Auth::id())->delete();
        } else {
            $cart = session()->get('cart', []);
            foreach ($cart as $key => $item) {
                if ($item['product_id'] == $id) {
                    unset($cart[$key]);
                    break;
                }
            }
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để cập nhật giỏ hàng.');
        }
    
        $cart = Cart::find($id);
        if ($cart) {
            $availableStock = ProductSizeColor::where('idProduct', $cart->product_id)
                ->where('color', $cart->color)
                ->where('idSize', \App\Models\Size::where('size_name', $cart->size)->value('id'))
                ->value('quantity');
    
            if ($request->quantity > $availableStock) {
                return redirect()->back()->with('error_'.$id, 'Số lượng yêu cầu đã vượt quá tồn kho!');
            }
    
            $cart->quantity = $request->quantity;
            $cart->total_price = $cart->quantity * $cart->price;
            $cart->save();
        }
    
        return redirect()->back()->with('success', 'Cập nhật số lượng thành công!');
    }
    

    // 🆕 Xóa toàn bộ giỏ hàng
    public function clearCart() {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }
    
        return back()->with('success', 'Giỏ hàng đã được làm trống.');
    }
    
}
