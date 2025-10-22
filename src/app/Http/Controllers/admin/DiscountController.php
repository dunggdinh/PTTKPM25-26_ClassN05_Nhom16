<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Discount;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DiscountController extends Controller
{
    // Trang danh sách khuyến mãi
    public function index()
    {
        $discounts = Discount::orderByDesc('start_date')->get();
        return view('admin.promotion', compact('discounts'));
    }

    // Tạo khuyến mãi mới
    public function store(Request $r)
    {
        $r->validate([
            'code' => 'required|unique:discounts,code|max:50',
            'type' => 'required',
            'value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        Discount::create([
            'discount_id' => Str::uuid(),
            'code'        => $r->code,
            'type'        => $r->type,
            'value'       => $r->value,
            'status'      => $r->has('isActive') ? 'active' : 'scheduled',
            'start_date'  => Carbon::parse($r->start_date),
            'end_date'    => Carbon::parse($r->end_date),
        ]);

        return response()->json(['success' => true, 'message' => 'Khuyến mãi đã được tạo thành công!']);
    }

    // Cập nhật
    public function update(Request $r, $id)
    {
        $discount = Discount::findOrFail($id);
        $discount->update([
            'code' => $r->code,
            'type' => $r->type,
            'value' => $r->value,
            'status' => $r->status,
            'start_date' => Carbon::parse($r->start_date),
            'end_date' => Carbon::parse($r->end_date),
        ]);

        return response()->json(['success' => true, 'message' => 'Khuyến mãi đã được cập nhật!']);
    }

    // Xóa
    public function destroy($id)
    {
        Discount::where('discount_id', $id)->delete();
        return response()->json(['success' => true, 'message' => 'Khuyến mãi đã được xóa thành công!']);
    }

    // API: lấy danh sách (cho JS)
    public function list()
    {
        return response()->json(Discount::all());
    }
}
