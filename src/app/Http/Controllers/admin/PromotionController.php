<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Discount;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; 

class PromotionController extends Controller
{
    // Trang Blade
    public function index()
    {
        return view('admin.promotion');
    }

    // JSON cho bảng /admin/promotion/list
    public function list(Request $request)
    {
        try {
            $rows = Discount::orderByDesc('start_date')->get();
            $data = $rows->map(function ($d) {
                $now = Carbon::now();

                $status =
                    ($d->status === 'Tạm dừng') ? 'paused' :
                    (($d->end_date && $now->gt($d->end_date)) ? 'expired' :
                    (($d->start_date && $now->lt($d->start_date)) ? 'scheduled' : 'active'));

                // DB type -> UI type
                $type = match($d->type) {
                    'percent' => 'percentage',
                    'amount'  => 'fixed',
                    default   => $d->type,
                };

                return [
                    'discount_id' => (string) $d->discount_id,
                    'code'        => (string) ($d->code ?? ''),
                    'type'        => $type,
                    'value'       => (float)  ($d->value ?? 0),
                    'status'      => $status,
                    'start_date'  => optional($d->start_date)->format('Y-m-d H:i:s'),
                    'end_date'    => optional($d->end_date)->format('Y-m-d H:i:s'),
                ];
            });

            return response()->json($data, 200);
        } catch (\Throwable $e) {
            \Log::error('Promotion list error', ['msg' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
     // === API tạo khuyến mãi mới ===
    public function store(Request $request)
    {
        try {
            // Lấy field từ form (tên trong Blade)
            $code      = $request->input('code', $request->input('promoCode'));
            $typeIn    = $request->input('type', $request->input('discountType'));
            $value     = $request->input('value', $request->input('discountValue'));
            $start     = $request->input('start_date', $request->input('startDate'));
            $end       = $request->input('end_date', $request->input('endDate'));
            $isActive  = $request->boolean('isActive');

            // Chuẩn hoá type cho đúng DB
            $normalizedType = match ($typeIn) {
                'percentage', 'percent' => 'percent',
                'fixed', 'amount'       => 'amount',
                default                 => null,
            };

            // Validate
            $v = Validator::make([
                'code'       => $code,
                'type'       => $normalizedType,
                'value'      => $value,
                'start_date' => $start,
                'end_date'   => $end,
            ], [
                'code'       => 'required|string|max:50|unique:discounts,code',
                'type'       => 'required|in:percent,amount',
                'value'      => 'required|numeric|min:0',
                'start_date' => 'nullable|date',
                'end_date'   => 'nullable|date|after_or_equal:start_date',
            ]);

            if ($v->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $v->errors()->first()
                ], 422);
            }

            $discount = Discount::create([
                'code'        => $code,
                'type'        => $normalizedType,
                'value'       => (float)$value,
                'status'      => $isActive ? 'Đang diễn ra' : 'Tạm dừng',
                'start_date'  => $start ? Carbon::parse($start) : null,
                'end_date'    => $end ? Carbon::parse($end) : null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Tạo khuyến mãi thành công!',
                'data'    => $discount,
            ], 201);

        } catch (\Throwable $e) {
            \Log::error('promotion.store', ['e' => $e]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    // === API cập nhật khuyến mãi ===
    
    public function update(Request $request, $id)
    {
        try {
            $discount = Discount::findOrFail($id);

            // 1) Đọc đúng tên field từ form
            $code     = $request->input('promoCode');        // <input name="promoCode">
            $typeIn   = $request->input('discountType');     // <select name="discountType">
            $value    = $request->input('discountValue');    // <input name="discountValue">
            $start    = $request->input('startDate');        // <input name="startDate">
            $end      = $request->input('endDate');          // <input name="endDate">
            $isActive = $request->boolean('isActive');       // <input type="checkbox" name="isActive">

            // 2) Chuẩn hoá type theo DB
            $normalizedType = match ($typeIn) {
                'percentage','percent' => 'percent',
                'fixed','amount'       => 'amount',
                default                => null,
            };

            // 3) Merge về đúng key mà rule validate sử dụng
            $request->merge([
                'code'       => $code,
                'type'       => $normalizedType,
                'value'      => $value,
                'start_date' => $start,
                'end_date'   => $end,
            ]);

            // 4) Validate (unique code nhưng bỏ qua bản ghi hiện tại)
            $this->validate($request, [
                'code'       => ['required','string','max:50',
                    Rule::unique('discounts','code')->ignore($discount->discount_id, 'discount_id')
                ],
                'type'       => 'nullable|in:percent,amount',
                'value'      => 'nullable|numeric|min:0',
                'start_date' => 'nullable|date',
                'end_date'   => 'nullable|date|after_or_equal:start_date',
            ], [], [
                'code'       => 'Mã khuyến mãi',
                'type'       => 'Loại',
                'value'      => 'Giá trị',
                'start_date' => 'Ngày bắt đầu',
                'end_date'   => 'Ngày kết thúc',
            ]);

            // 5) Cập nhật DB
            $discount->update([
                'code'       => $request->code,
                'type'       => $request->type ?? $discount->type,
                'value'      => $request->value !== null ? (float)$request->value : $discount->value,
                'status'     => $isActive ? 'Đang diễn ra' : 'Tạm dừng',
                'start_date' => $request->start_date ? \Carbon\Carbon::parse($request->start_date) : null,
                'end_date'   => $request->end_date ? \Carbon\Carbon::parse($request->end_date) : null,
            ]);

            return response()->json(['success'=>true,'message'=>'Cập nhật thành công!']);

        } catch (\Throwable $e) {
            \Log::error('promotion.update', ['e' => $e]);
            return response()->json(['success'=>false,'message'=>$e->getMessage()], 500);
        }
    }

    // === API bật / tắt ===
    public function toggle($id)
    {
        try {
            $discount = Discount::findOrFail($id);
            $discount->status = $discount->status === 'Tạm dừng' ? 'Đang diễn ra' : 'Tạm dừng';
            $discount->save();

            return response()->json(['success'=>true,'message'=>'Đã cập nhật trạng thái!','status'=>$discount->status]);
        } catch (\Throwable $e) {
            return response()->json(['success'=>false,'message'=>$e->getMessage()], 500);
        }
    }


    // === API xoá khuyến mãi ===
    public function destroy($id)
    {
        try {
            Discount::where('discount_id', $id)->delete();
            return response()->json(['message' => 'Xoá khuyến mãi thành công!']);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function stats()
    {
        $now = Carbon::now();

        // Tổng tất cả
        $total = Discount::count();

        // Đang hoạt động: không "Tạm dừng" và đang trong khoảng thời gian (nếu có)
        $active = Discount::where('status', '!=', 'Tạm dừng')
            ->where(function ($q) use ($now) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', $now);
            })
            ->count();

        // Sắp hết hạn: end_date trong khoảng [now, now + 1 day]
        $nearly = Discount::whereNotNull('end_date')
            ->whereBetween('end_date', [$now, (clone $now)->addDay()])
            ->count();

        // Đã kết thúc: end_date < now
        $expired = Discount::whereNotNull('end_date')
            ->where('end_date', '<', $now)
            ->count();

        // (tuỳ chọn) Đã lên lịch: start_date > now
        $scheduled = Discount::whereNotNull('start_date')
            ->where('start_date', '>', $now)
            ->count();

        return response()->json([
            'total'     => $total,
            'active'    => $active,
            'nearly'    => $nearly,
            'expired'   => $expired,
            'scheduled' => $scheduled,
        ]);
    }
}
