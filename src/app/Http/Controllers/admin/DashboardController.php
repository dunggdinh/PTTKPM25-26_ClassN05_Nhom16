<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Order;
use App\Models\admin\User;
use App\Models\admin\Product;
use App\Models\admin\OrderItem;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ==== Tổng doanh thu ====
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');

        // ==== Đơn hàng ====
        $totalOrders = Order::count();

        // ==== Khách hàng ====
        $totalCustomers = User::where('role', 'customer')->count();

        // ==== Sản phẩm ====
        $totalProducts = Product::count();

        // ==== Sản phẩm sắp hết hàng (<=10 sp) ====
        $lowStockProducts = Product::where('quantity', '<=', 10)->count();

        // ==== Tính doanh thu theo tháng ====
        $monthlyRevenue = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_amount) as total')
            )
            ->whereYear('created_at', date('Y'))
            ->where('status', 'completed')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        // ==== Sản phẩm bán chạy ====
        $topProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->with('product')
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalCustomers',
            'totalProducts',
            'lowStockProducts',
            'monthlyRevenue',
            'topProducts'
        ));
    }
}
