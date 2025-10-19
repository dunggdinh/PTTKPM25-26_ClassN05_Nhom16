<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
    

class PaymentController extends Controller
{
    public function index()
    {
        // Lấy toàn bộ danh sách giao dịch
        $transactions = DB::table('payments')
            ->join('users', 'payments.user_id', '=', 'users.user_id')
            ->select(
                'payments.payment_id',
                'users.name',
                'payments.amount',
                'payments.method_id',
                'payments.status',
                'payments.transaction_date'
            )
            ->orderBy('payments.transaction_date', 'desc')
            ->get();

        // Lấy các giao dịch đang chờ xác thực
        $pendingPayments = DB::table('payments')
            ->join('users', 'payments.user_id', '=', 'users.user_id')
            ->where('payments.status', '=', 'pending')
            ->select(
                'payments.payment_id',
                'users.name',
                'payments.amount',
                'payments.method_id',
                'payments.transaction_date'
            )
            ->orderBy('payments.transaction_date', 'desc')
            ->get();

        return view('admin.payments_gateway', compact('transactions', 'pendingPayments'));
    }

    public function verify($id)
    {
        DB::table('payments')->where('payment_id', $id)->update(['status' => 'completed']);
        return redirect()->back()->with('success', '✅ Đã xác nhận thanh toán.');
    }

    public function reject($id)
    {
        DB::table('payments')->where('payment_id', $id)->update(['status' => 'failed']);
        return redirect()->back()->with('success', '❌ Đã từ chối thanh toán.');
    }
}
