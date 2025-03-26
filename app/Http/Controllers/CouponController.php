<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:coupons',
            'type' => 'required|in:percentage,fixed',
            'discount' => 'required|numeric',
            'usage_limit' => 'nullable|integer',
            'expiry_date' => 'nullable|date',
            'status' => 'required|boolean',
        ]);

        Coupon::create($request->all());

        return redirect()->route('admin.coupon.index')->with('success', 'Mã giảm giá đã được tạo.');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code,'.$id,
            'type' => 'required|in:percentage,fixed',
            'discount' => 'required|numeric',
            'usage_limit' => 'nullable|integer',
            'expiry_date' => 'nullable|date',
            'status' => 'required|boolean',
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->update($request->all());

        return redirect()->route('admin.coupon.index')->with('success', 'Cập nhật thành công.');
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.coupon.index')->with('success', 'Đã xóa thành công.');
    }
    public function apply(Request $request) {
        $coupon = Coupon::where('code', $request->code)->first();
    
        if (!$coupon) {
            return response()->json(['error' => 'Mã giảm giá không hợp lệ!'], 400);
        }
    
        $total = (float) $request->total; // Chuyển về số thực
        $discount = 0.0; // Đặt giá trị mặc định là số thực
    
        if ($coupon->type === 'percentage') {
            $discount = round(($total * $coupon->discount) / 100, 2); // Làm tròn 2 chữ số thập phân
        } else {
            $discount = (float) $coupon->discount; // Đảm bảo là số thực
        }
    
        $newTotal = max(0, $total - $discount); // Đảm bảo không bị âm
    
        return response()->json([
            'discount_applied' => $discount, // Trả về số thực thay vì chuỗi
            'new_total' => $newTotal
        ]);
    }
    
    
    
    
}
