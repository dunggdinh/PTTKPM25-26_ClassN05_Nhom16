<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\admin\Discount;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PromotionController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        // Chỉ lấy KM có hiệu lực hiện tại và không "Tạm dừng"
        $promos = Discount::query()
            ->where('status', '!=', 'Tạm dừng')
            ->where(function ($q) use ($now) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', $now);
            })
            ->orderBy('end_date', 'asc')
            ->get()
            ->map(function ($d) use ($now) {
                // Chuẩn hoá kiểu giảm giá cho UI
                $typeUi = match ($d->type) {
                    'percent' => 'percentage',
                    'amount'  => 'fixed',
                    default   => $d->type,
                };

                // Tính thời gian còn lại (nếu có end_date)
                $remainingSeconds = null;
                $remainingHuman   = 'Không giới hạn';
                $endsAtIso        = null;

                if ($d->end_date) {
                    $remainingSeconds = max(0, $now->diffInSeconds($d->end_date, false));
                    $remainingHuman   = $remainingSeconds > 0
                        ? $now->diffForHumans($d->end_date, true)   // vd: "2 ngày 3 giờ"
                        : 'Đã hết hạn';
                    $endsAtIso        = $d->end_date->toIso8601String();
                }

                return (object)[
                    'discount_id' => $d->discount_id,
                    'code'        => $d->code,
                    'type'        => $typeUi,      // 'percentage' | 'fixed' | ...
                    'value'       => (float)$d->value,
                    'start_date'  => optional($d->start_date)->format('Y-m-d H:i:s'),
                    'end_date'    => optional($d->end_date)->format('Y-m-d H:i:s'),
                    'ends_at_iso' => $endsAtIso,
                    'remaining_human'   => $remainingHuman,
                    'remaining_seconds' => $remainingSeconds,
                ];
            });

        return view('customer.promotion', ['promos' => $promos]);
    }

    // Nếu bạn có API JSON cho khách dùng, có thể tái sử dụng cùng logic:
    public function vouchersJson()
    {
        $now = Carbon::now();

        $data = Discount::orderBy('start_date', 'asc')
            ->get()
            ->map(function ($d) use ($now) {
                $statusCode = 'active';
                if (trim((string) $d->status) === 'Tạm dừng')           $statusCode = 'paused';
                elseif ($d->end_date && $now->gt($d->end_date))         $statusCode = 'expired';
                elseif ($d->start_date && $now->lt($d->start_date))     $statusCode = 'scheduled';

                return [
                    'discount_id' => (string) $d->discount_id,
                    'code'        => (string) $d->code,
                    'type'        => $d->type,           // 'percent' | 'amount'
                    'value'       => (float) $d->value,
                    'status_code' => $statusCode,        // 'active' | 'scheduled' | 'expired' | 'paused'
                    'start_date'  => optional($d->start_date)->format('Y-m-d H:i:s'),
                    'end_date'    => optional($d->end_date)->format('Y-m-d H:i:s'),
                ];
            });

        return response()->json($data);
    }
}
