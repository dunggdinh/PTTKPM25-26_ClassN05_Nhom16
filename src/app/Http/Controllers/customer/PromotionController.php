<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\admin\Discount;

class PromotionController extends Controller
{
    public function index()
    {
        $active = Discount::active()
            ->orderBy('start_date', 'desc')
            ->get()
            ->map(function ($d) {
                $type = ($d->type === 'amount') ? 'fixed' : $d->type; // ✅ map amount→fixed

                return [
                    'code'        => $d->code,           // ✅ đúng tên cột
                    'type'        => $type,              // percent | fixed
                    'discount'    => $d->value,          // % nếu percent
                    'value'       => $d->value,          // số tiền nếu fixed
                    'description' => $d->description ?? ('Mã ' . $d->code),
                    'minOrder'    => $d->min_order ?? 0,
                    'start_date'  => optional($d->start_date)->toIso8601String(),
                    'end_date'    => optional($d->end_date)->toIso8601String(),
                ];
            });

        return view('customer.promotion', ['vouchers' => $active]);
    }

    public function vouchersJson()
    {
        $active = Discount::active()->get()->map(function ($d) {
            $type = ($d->type === 'amount') ? 'fixed' : $d->type;
            return [
                'code'        => $d->code,
                'type'        => $type,
                'discount'    => $d->value,
                'value'       => $d->value,
                'description' => $d->description ?? ('Mã ' . $d->code),
                'minOrder'    => $d->min_order ?? 0,
                'start_date'  => optional($d->start_date)->toIso8601String(),
                'end_date'    => optional($d->end_date)->toIso8601String(),
            ];
        });

        return response()->json($active);
    }
}
