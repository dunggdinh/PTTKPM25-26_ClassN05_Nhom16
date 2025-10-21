<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ReturnRequest;

class ReturnController extends Controller
{
    // Hiển thị danh sách yêu cầu trả hàng
    public function index(Request $request)
    {
        $query = ReturnRequest::query();

        // 🔹 Lọc trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 🔹 Lọc theo ngày
        if ($request->filled('date')) {
            $query->whereDate('requested_at', $request->date);
        }

        // 🔹 Lọc theo loại
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // 🔹 Tìm kiếm theo return_id, order_item_id, lý do
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(reason) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(return_id) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(order_item_id) LIKE ?', ["%{$search}%"]);
            });
        }

        // 🔹 Sắp xếp (mặc định: mới nhất trước)
        $sortBy = $request->get('sort_by', 'requested_at');
        $sortDirection = $request->get('sort_direction', 'desc');

        $returns = $query->orderBy($sortBy, $sortDirection)
                         ->paginate(10)
                         ->withQueryString();

        // 🧮 Thống kê
        $pendingRequest = ReturnRequest::where('status', 'Chờ xử lý')->count();
        $processingRequest = ReturnRequest::where('status', 'Đang xử lý')->count();
        $completedRequest = ReturnRequest::where('status', 'Hoàn tất')->count();
        $rejectedRequest = ReturnRequest::where('status', 'Từ chối')->count();


        return view('admin.return', compact(
            'returns',
            'pendingRequest',
            'processingRequest',
            'completedRequest',
            'rejectedRequest'
        ));
    }

    public function update(Request $request, $id)
    {
        $return = ReturnRequest::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Chờ xử lý,Đang xử lý,Hoàn tất,Từ chối',
        ]);

        $return->status = $request->status;

        // Nếu muốn lưu thời gian xử lý khi trạng thái thay đổi
        if (in_array($request->status, ['approved', 'completed', 'rejected'])) {
            $return->processed_at = now();
        }

        $return->save();

        return redirect()->back()->with('success', 'Trạng thái yêu cầu đã được cập nhật.');
    }

    /**
     * Xóa yêu cầu trả hàng
     */
    public function destroy($id)
    {
        $return = ReturnRequest::findOrFail($id);

        $return->delete();

        return redirect()->back()->with('success', 'Yêu cầu trả hàng đã được xóa.');
    }

    // Reload danh sách trả hàng (AJAX) tương tự InventoryController::reload
    public function reload()
    {
        $returns = ReturnRequest::orderByDesc('requested_at')->get();

        $html = '';
        foreach ($returns as $r) {
            $statusClass = match($r->status) {
                'Chờ xử lý' => 'bg-yellow-100 text-yellow-700',
                'Đang xử lý' => 'bg-blue-100 text-blue-700',
                'Hoàn tất', 'Đã duyệt' => 'bg-green-100 text-green-700',
                'Từ chối' => 'bg-red-100 text-red-700',
                default => 'bg-gray-100 text-gray-700'
            };

            $html .= "
                <tr class='hover:bg-gray-50 transition'>
                    <td class='px-6 py-4 text-sm font-medium'>{$r->return_id}</td>
                    <td class='px-6 py-4 text-sm'>{$r->order_item_id}</td>
                    <td class='px-6 py-4 text-sm'>{$r->reason}</td>
                    <td class='px-6 py-4 text-sm'>
                        <span class='px-2 py-1 text-xs font-semibold rounded-full {$statusClass}'>{$r->status}</span>
                    </td>
                    <td class='px-6 py-4 text-sm'>{$r->requested_at->format('Y-m-d H:i')}</td>
                    <td class='px-6 py-4 text-sm'>
                        <a href='".route('admin.return.show', $r->id)."' class='text-blue-600 hover:text-blue-800'>Chi tiết</a>
                    </td>
                </tr>
            ";
        }

        if ($returns->isEmpty()) {
            $html = "<tr><td colspan='6' class='px-6 py-4 text-center text-gray-500 text-sm'>Không có yêu cầu trả hàng nào.</td></tr>";
        }

        return response()->json(['html' => $html]);
    }
}
