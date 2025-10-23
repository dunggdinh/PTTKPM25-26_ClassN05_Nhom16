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
        $query = Appointment::with(['user', 'order', 'warranty.product']);
        // $query = Appointment::with(['user', 'order', 'warranty.product'])->get()->fresh();
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
                $query->where('status', $request->status);
            }
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
            $sortBy = $request->get('sort_by', 'appointment_id');
            $sortDirection = $request->get('sort_direction', 'desc');
            $warranties = $query->orderBy($sortBy, $sortDirection)
                                ->paginate(10)
                                ->withQueryString();
            $warranties->load(['warranty.product']); // ✅ nạp lại dữ liệu 
            $statusMap = [
                'pending'    => 'Đang chờ xác nhận',
                'processing' => 'Đang xử lý',
                'completed'  => 'Đã xác nhận',
                'cancelled'  => 'Đã hủy',
            ];

            $totalWarranty      = Appointment::count();
            $pendingWarranty    = Appointment::where('status', $statusMap['pending'])->count();
            $completedWarranty  = Appointment::where('status', $statusMap['completed'])->count();
            $appointments_today = Appointment::whereDate('appointment_date', today())->count();


            // 📊 Thống kê
            // $totalWarranty      = Appointment::count();
            // $pendingWarranty    = Appointment::where('status', 'pending')->count();
            // $completedWarranty  = Appointment::where('status', 'completed')->count();
            // $pendingWarranty    = Appointment::where('status', 'Đang chờ xác nhận')->count();
            // $completedWarranty  = Appointment::where('status', 'Đã xác nhận')->count();

            $appointments_today = Appointment::whereDate('appointment_date', today())->count();

            return view('admin.warranty', compact(
                'warranties', 'totalWarranty', 'pendingWarranty', 'completedWarranty', 'appointments_today'
            ));
        }

    public function destroy($id)
    {
        $warranty = Appointment::findOrFail($id);
        $warranty->delete();

        return redirect()->back()->with('success', 'Bảo hành đã được xóa.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Đã xác nhận,Đang chờ xác nhận,Đã hủy'
        ]);

        $warranty = Appointment::findOrFail($id);
        $warranty->status = $request->status;
        $warranty->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái bảo hành thành công!');
    }

   public function reload()
    {
        $warranties = Appointment::with(['user', 'Warranty.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        $html = '';

        foreach ($warranties as $w) {
            $statusColors = [
                'Đang chờ xác nhận' => 'bg-yellow-100 text-yellow-800',
                'Đã xác nhận' => 'bg-green-100 text-green-800',
                'Đã hủy' => 'bg-red-100 text-red-800',
            ];
            $statusClass = $statusColors[$w->status] ?? 'bg-gray-100 text-gray-800';

            $userName = $w->user->name ?? 'Không xác định';
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
