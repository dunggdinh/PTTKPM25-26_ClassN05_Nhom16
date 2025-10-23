<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\SupportTicket;

class SupportTicketController extends Controller
{
    /**
     * Lưu yêu cầu hỗ trợ mới (customer hoặc admin)
     */
    public function store(Request $request)
    {
        // ✅ Validate đầu vào
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'email'       => 'required|email|max:100',
            'phone'       => 'nullable|string|max:20',
            'order_id'    => 'nullable|string|max:10',
            'issue_type'  => 'required|string|max:50',
            'priority'    => 'required|string|max:50',
            'description' => 'required|string',
        ]);

        // ✅ Tạo mã phiếu tự động (TIC_001, TIC_002, ...)
        $lastTicket = SupportTicket::orderByDesc('ticket_id')->first();
        $nextNumber = 1;
        if ($lastTicket && preg_match('/TIC_(\d+)/', $lastTicket->ticket_id, $matches)) {
            $nextNumber = intval($matches[1]) + 1;
        }
        $ticket_id = 'TIC_' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // ✅ Bắt đúng guard (web cho khách hàng, admin cho quản trị viên)
        $user = auth('web')->user() ?? auth('admin')->user();

        // ✅ Ánh xạ giá trị tiếng Anh → tiếng Việt theo enum DB
        $mapIssue = [
            'order'    => 'Vấn đề về đơn hàng',
            'product'  => 'Vấn đề về sản phẩm',
            'payment'  => 'Vấn đề về thanh toán',
            'shipping' => 'Vấn đề về vận chuyển',
            'return'   => 'Đổi trả sản hàng',
            'technical'=> 'Hỗ trợ kỹ thuật',
            'other'    => 'Khác',
        ];

        $mapPriority = [
            'low'    => 'Thấp',
            'medium' => 'Trung bình',
            'high'   => 'Cao',
        ];

        // ✅ Lưu vào database
        $ticket = SupportTicket::create([
            'ticket_id'   => $ticket_id,
            'user_id'     => $user?->user_id, // tự động gán nếu user đăng nhập
            'order_id'    => $validated['order_id'] ?: null,
            'name'        => $validated['name'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'] ?? null,
            'issue_type'  => $mapIssue[$validated['issue_type']] ?? 'Khác',
            'priority'    => $mapPriority[$validated['priority']] ?? 'Trung bình',
            'description' => $validated['description'],
            'status'      => 'Mới tạo',
        ]);

        return response()->json([
            'success'   => true,
            'ticket_id' => $ticket->ticket_id,
            'message'   => '✅ Yêu cầu hỗ trợ đã được tạo thành công!',
        ]);
    }

    /**
     * Hiển thị danh sách phiếu hỗ trợ (Admin xem)
     */
    public function index()
    {
        // $tickets = SupportTicket::orderByDesc('created_at')->get();
        // return view('admin.support_tickets.index', compact('tickets'));
        // return view('admin.support', compact('tickets'));
        $tickets = \App\Models\admin\SupportTicket::orderByDesc('created_at')->get();
        return view('admin.support', compact('tickets'));
    }

    /**
     * Xem chi tiết phiếu hỗ trợ
     */
    public function show($id)
    {
        // ✅ Lấy theo ticket_id thay vì auto increment
        $ticket = SupportTicket::where('ticket_id', $id)
            ->with(['user', 'order'])
            ->firstOrFail();

        return response()->json($ticket);
    }
}


