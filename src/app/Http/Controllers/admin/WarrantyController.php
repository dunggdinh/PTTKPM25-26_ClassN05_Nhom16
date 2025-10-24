<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Warranty;
use App\Models\admin\Order;
use App\Models\admin\User;
use App\Models\admin\Product;
use App\Models\admin\Appointment;
use Carbon\Carbon;


class WarrantyController extends Controller
{
    public function index(Request $request)
    {
        // Định nghĩa map status một lần và dùng xuyên suốt
        $statusMap = [
            'pending'    => 'Đang chờ xác nhận',
            'processing' => 'Đang xử lý',
            'completed'  => 'Đã xác nhận',
            'cancelled'  => 'Đã hủy'
        ];

        $query = Appointment::with(['user', 'order', 'warranty.product']);

        // 🔍 Tìm kiếm theo mã, khách hàng, sản phẩm
        if ($request->has('search') && !empty($request->search)) {
            $search = strtolower($request->search);
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(warranty_id) LIKE ?', ["%{$search}%"])
                    ->orWhereHas('user', function ($sub) use ($search) {
                        $sub->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
                    })
                    ->orWhereHas('warranty.product', function ($sub) use ($search) {
                        $sub->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
                    });
            });
        }

        // 🔖 Lọc theo trạng thái
        if ($request->filled('status') && $request->status != 'all') {
            // Chuyển từ tiếng Anh sang tiếng Việt để tìm trong DB
            $status = $statusMap[$request->status] ?? $request->status;
            $query->where('status', $status);
        }

    // 📅 Lọc theo ngày (hôm nay / tuần này / tháng này)
    if ($request->filled('date')) {
        if ($request->date === 'today') {
            $query->whereDate('appointment_date', today());
        } elseif ($request->date === 'week') {
            $query->whereBetween('appointment_date', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($request->date === 'month') {
            $query->whereMonth('appointment_date', now()->month)
                ->whereYear('appointment_date', now()->year);
        }
    }

    // 🔃 Sắp xếp
    $sortBy = $request->get('sort_by', 'appointment_id');
    $sortDirection = $request->get('sort_direction', 'asc');
    $warranties = $query->orderBy($sortBy, $sortDirection)
                        ->paginate(10)
                        ->withQueryString();

    $warranties->load(['warranty.product']); // ✅ nạp lại dữ liệu

    // 📊 Thống kê tổng quan
    $totalWarranty      = Appointment::count();
    $pendingWarranty    = Appointment::where('status', $statusMap['pending'])->count();
    $completedWarranty  = Appointment::where('status', $statusMap['completed'])->count();
    $appointments_today = Appointment::whereDate('appointment_date', today())->count();

    // ✅ Trả về view
    return view('admin.warranty', compact(
        'warranties',
        'totalWarranty',
        'pendingWarranty',
        'completedWarranty',
        'appointments_today'
    ));
}

    public function edit($appointment_id)
{
    try {
        // 🔍 Lấy thông tin cuộc hẹn bảo hành cùng các quan hệ liên quan
        $appointment = Appointment::with(['user', 'order', 'warranty.product'])
            ->findOrFail($appointment_id);

        // Map trạng thái từ tiếng Việt sang tiếng Anh để hiển thị đúng trong form
        $statusMap = [
            'Đang chờ xác nhận' => 'pending',
            'Đang xử lý' => 'processing',
            'Đã xác nhận' => 'completed',
            'Đã hủy' => 'cancelled'
        ];

        // ✅ Trả về dữ liệu JSON cho modal edit trong warranty.blade.php
        return response()->json([
            'id'               => $appointment->appointment_id,
            'status'           => $statusMap[$appointment->status] ?? 'pending',
            'service_type'     => $appointment->service_type ?? '',
            'appointment_date' => optional($appointment->appointment_date)
                                    ? Carbon::parse($appointment->appointment_date)->format('Y-m-d')
                                    : null,
            'appointment_time' => $appointment->appointment_time ?? null,
            'notes'            => $appointment->notes ?? '',
            'customer'         => optional($appointment->user)->name ?? 'N/A',
            'order_code'       => optional($appointment->order)->order_code ?? 'N/A',
            'product'          => optional($appointment->warranty->product)->name ?? 'N/A',
            'product_serial'   => $appointment->warranty->product_serial ?? '-',
            'created_at'       => $appointment->created_at
                                    ? $appointment->created_at->format('d/m/Y H:i')
                                    : null,
        ]);
    } catch (\Exception $e) {
        \Log::error('Warranty Edit Error', [
            'id' => $appointment_id,
            'message' => $e->getMessage(),
        ]);
        return response()->json(['error' => 'Không thể tải thông tin bảo hành.'], 500);
    }
}
   
    public function destroy($id)
    {
        $warranty = Appointment::findOrFail($id);
        $warranty->delete();

        return redirect()->back()->with('success', 'Bảo hành đã được xóa.');
    }

    public function update(Request $request, $id)
    {
        \Log::info('Update request received', [
            'id' => $id,
            'data' => $request->all()
        ]);

        try {
            $validated = $request->validate([
                'status' => 'required|in:pending,processing,completed,cancelled',
                'appointment_date' => 'required|date',
                'appointment_time' => 'required',
                'notes' => 'nullable|string|max:500'
            ]);

            \Log::info('Validation passed', ['validated' => $validated]);

            $warranty = Appointment::findOrFail($id);
            
            // Map trạng thái từ tiếng Anh sang tiếng Việt
            $statusMap = [
                'pending' => 'Đang chờ xác nhận',
                'processing' => 'Đang xử lý',
                'completed' => 'Đã xác nhận',
                'cancelled' => 'Đã hủy'
            ];
            
            // Cập nhật thông tin
            $warranty->status = $statusMap[$request->status];
            $warranty->appointment_date = $request->appointment_date;
            $warranty->appointment_time = $request->appointment_time;
            $warranty->notes = $request->notes;
            $warranty->save();

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thông tin bảo hành thành công!'
            ]);
        } catch (\Exception $e) {
            \Log::error('Warranty Update Error', [
                'id' => $id,
                'message' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật thông tin bảo hành!'
            ], 500);
        }
    }

    public function reload()
    {
        $warranties = Appointment::with(['user', 'warranty.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        $html = '';

        $statusColors = [
            'Đang chờ xác nhận' => 'bg-yellow-100 text-yellow-800',
            'Đang xử lý' => 'bg-blue-100 text-blue-800',
            'Đã xác nhận' => 'bg-green-100 text-green-800',
            'Đã hủy' => 'bg-red-100 text-red-800',
        ];

        foreach ($warranties as $w) {
            $statusClass = $statusColors[$w->status] ?? 'bg-gray-100 text-gray-800';            $userName = $w->user->name ?? 'Không xác định';
            $productName = $w->warranty && $w->warranty->product ? $w->warranty->product->name : 'Sản phẩm không tồn tại';
            $productSerial = $w->warranty->product_serial ?? '-';

            $html .= "
            <tr class='hover:bg-gray-50 transition'>
                <td class='px-6 py-4 text-sm text-gray-900'>
                    <input type='checkbox' name='selected[]' value='{$w->appointment_id}' class='text-blue-600 focus:ring-blue-500'>
                </td>
                <td class='px-6 py-4 text-sm text-gray-900 font-medium'>{$w->appointment_id}</td>
                <td class='px-6 py-4 text-sm text-gray-700'>{$userName}</td>
                <td class='px-6 py-4 text-sm text-gray-700'>{$productName}</td>
                <td class='px-6 py-4 text-sm text-gray-700'>{$productSerial}</td>
                <td class='px-6 py-4 text-sm text-gray-700'>{$w->service_type}</td>
                <td class='px-6 py-4 text-sm text-gray-700'>".($w->appointment_date ? \Carbon\Carbon::parse($w->appointment_date)->format('d/m/Y') : '-')."</td>
                <td class='px-6 py-4 text-sm text-gray-700'>{$w->appointment_time}</td>
                <td class='px-6 py-4 text-sm'>
                    <span class='px-3 py-1 rounded-full text-xs font-semibold {$statusClass}'>".ucfirst($w->status)."</span>
                </td>
                <td class='px-6 py-4 text-sm text-gray-700'>{$w->notes}</td>
                <td class='px-6 py-4 text-sm text-gray-700'>
                    <div class='flex space-x-2'>
                        <button onclick=\"openEdit('{$w->appointment_id}')\" class='text-blue-600 hover:underline'>Sửa</button>
                        <button onclick=\"openDelete('{$w->appointment_id}')\" class='text-red-600 hover:underline'>Xóa</button>
                    </div>
                </td>
            </tr>
            ";
        }

        if ($warranties->isEmpty()) {
            $html = "<tr><td colspan='11' class='text-center py-6 text-gray-500'>Không có dữ liệu bảo hành.</td></tr>";
        }
        return response()->json(['html' => $html]);
    }
}
