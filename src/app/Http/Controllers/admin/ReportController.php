<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // === Tổng doanh thu ===
        $totalRevenue = DB::table('orders')
            ->where('status', 'completed')
            ->sum('total_amount');

        // === Tổng đơn hàng ===
        $totalOrders = DB::table('orders')->count();

        // === Khách hàng mới (30 ngày gần đây) ===
        $newCustomers = DB::table('users')
            ->where('role', 'customer')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();

        // === Sản phẩm bán chạy nhất ===
        $topProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.product_id')
            ->select(
                'products.name as product_name',
                DB::raw('SUM(order_items.quantity) as total_sold'),
                // DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue')
                // DB::raw('SUM(order_items.subtotal) as total_revenue')
                // DB::raw('SUM(order_items.total_price) as total_revenue')
                DB::raw('SUM(order_items.quantity * order_items.unit_price) as total_revenue')
            )
            ->groupBy('products.product_id', 'products.name')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // === Đơn hàng gần đây ===
        $recentOrders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.user_id')
            ->select('orders.*', 'users.name as customer_name')
            ->orderByDesc('orders.created_at')
            ->take(5)
            ->get();

        return view('admin.report', compact(
            'totalRevenue',
            'totalOrders',
            'newCustomers',
            'topProducts',
            'recentOrders'
        ));
    }
}
