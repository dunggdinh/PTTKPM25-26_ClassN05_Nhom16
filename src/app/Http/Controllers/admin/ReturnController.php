<?php

// namespace App\Http\Controllers\admin; 

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\admin\ReturnRequest;

// class ReturnController extends Controller
// {
//     public function index(Request $request)
//     {
//         $query = ReturnRequest::query();

//         if ($request->filled('status')) {
//             $query->where('status', $request->status);
//         }

//         if ($request->filled('date')) {
//             $query->whereDate('requested_at', $request->date);
//         }

//         if ($request->filled('search')) {
//             $query->where('reason', 'like', "%{$request->search}%")
//                   ->orWhere('return_id', 'like', "%{$request->search}%")
//                   ->orWhere('order_item_id', 'like', "%{$request->search}%");
//         }

//         $returns = $query->orderByDesc('requested_at')->paginate(10);

//         $stats = [
//             'pending' => ReturnRequest::where('status', 'pending')->count(),
//             'processing' => ReturnRequest::where('status', 'processing')->count(),
//             'completed' => ReturnRequest::whereIn('status', ['completed', 'approved'])->count(),
//             'rejected' => ReturnRequest::where('status', 'rejected')->count(),
//         ];

//         return view('admin.return', compact('returns', 'stats'));
//     }
// }
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ReturnRequest;
class ReturnController extends Controller
{
    public function index(Request $request)
    {
        $query = ReturnRequest::query();

        // Lọc trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Lọc theo ngày
        if ($request->filled('date')) {
            $query->whereDate('requested_at', $request->date);
        }

        // Tìm kiếm
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('reason', 'like', "%{$search}%")
                  ->orWhere('return_id', 'like', "%{$search}%")
                  ->orWhere('order_item_id', 'like', "%{$search}%");
            });
        }

        $returns = $query->orderByDesc('requested_at')->paginate(10);

        // 🧮 Tính thống kê với giá trị tiếng Việt trong DB
        $stats = [
            'pending'    => ReturnRequest::where('status', 'Chờ xử lý')->count(),
            'processing' => ReturnRequest::where('status', 'Đang xử lý')->count(),
            'completed'  => ReturnRequest::whereIn('status', ['Hoàn tất', 'Đã duyệt'])->count(),
            'rejected'   => ReturnRequest::where('status', 'Từ chối')->count(),
        ];

        return view('admin.return', compact('returns', 'stats'));
    }
}

