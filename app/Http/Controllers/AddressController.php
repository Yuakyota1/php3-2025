<?php
namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->addresses;
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        $cities = ['Hà Nội', 'TP Hồ Chí Minh', 'Đà Nẵng', 'Hải Phòng', 'Cần Thơ'];
        $states = ['Bình Dương', 'Đồng Nai', 'Quảng Nam', 'Thừa Thiên Huế', 'Kiên Giang'];
        $countries = ['Việt Nam'];
    
        return view('addresses.create', compact('cities', 'states', 'countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'required|string|max:10',
            'country' => 'required|string|max:100',
            'is_default' => 'boolean',
        ]);
    
        if ($request->is_default) {
            Auth::user()->addresses()->update(['is_default' => false]);
        }
    
        Auth::user()->addresses()->create($request->all());
    
        return redirect()->route('addresses.index')->with('success', 'Địa chỉ đã được thêm.');
    }

    public function edit(Address $address)
    {
        $cities = ['Hà Nội', 'TP Hồ Chí Minh', 'Đà Nẵng', 'Hải Phòng', 'Cần Thơ'];
        $states = ['Bình Dương', 'Đồng Nai', 'Quảng Nam', 'Thừa Thiên Huế', 'Kiên Giang'];
        $countries = ['Việt Nam'];
    
        return view('addresses.edit', compact('address', 'cities', 'states', 'countries'));
    }

    public function update(Request $request, Address $address)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'required|string|max:10',
            'country' => 'required|string|max:100',
            'is_default' => 'boolean',
        ]);

        if ($request->is_default) {
            Auth::user()->addresses()->update(['is_default' => false]);
        }

        $address->update($request->all());

        return redirect()->route('addresses.index')->with('success', 'Địa chỉ đã được cập nhật.');
    }

    public function destroy($id)
    {
        $address = Address::find($id);
        
        if (!$address) {
            return back()->with('error', 'Không tìm thấy địa chỉ.');
        }
    
        $address->delete();
        return redirect()->route('addresses.index')->with('success', 'Địa chỉ đã được xóa.');
    }
}
