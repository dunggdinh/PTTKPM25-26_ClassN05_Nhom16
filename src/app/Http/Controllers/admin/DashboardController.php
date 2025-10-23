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
        $totalRevenue = Order::where('status', 'Hoàn tất')->sum('total_amount');
        
        // Doanh thu tuần trước
        $lastWeekRevenue = Order::where('status', 'Hoàn tất')
            ->whereBetween('created_at', [
                Carbon::now()->subWeek()->startOfWeek(),
                Carbon::now()->subWeek()->endOfWeek()
            ])->sum('total_amount');

        // Doanh thu tuần này
        $thisWeekRevenue = Order::where('status', 'Hoàn tất')
            ->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])->sum('total_amount');

        // Tính % tăng trưởng
        $revenueGrowth = $lastWeekRevenue > 0 
            ? round(($thisWeekRevenue - $lastWeekRevenue) / $lastWeekRevenue * 100, 1)
            : 0;

        // ==== Đơn hàng và % tăng ====
        $totalOrders = Order::count();
        
        // So sánh với tuần trước
        $lastWeekOrders = Order::whereBetween('created_at', [
            Carbon::now()->subWeek()->startOfWeek(),
            Carbon::now()->subWeek()->endOfWeek()
        ])->count();

        $thisWeekOrders = Order::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();

        $orderGrowth = $lastWeekOrders > 0
            ? round(($thisWeekOrders - $lastWeekOrders) / $lastWeekOrders * 100, 1)
            : 0;

        // ==== Khách hàng và số khách mới ====
        $totalCustomers = User::where('role', 'customer')->count();
        
        // Đếm khách hàng mới trong tuần này
        $newCustomers = User::where('role', 'customer')
            ->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])->count();

        // ==== Sản phẩm và sản phẩm sắp hết ====
        $totalProducts = Product::count();

        // ==== Sản phẩm sắp hết hàng (<=10 sp) ====
        $lowStockProducts = Product::where('quantity', '<=', 10)->count();

        // ==== Tính doanh thu theo tháng ====
        $monthlyRevenue = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_amount) as total')
            )
            ->whereYear('created_at', date('Y'))
            ->where('status', 'Hoàn tất')
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
            'revenueGrowth',
            'totalOrders', 
            'orderGrowth',
            'totalCustomers',
            'newCustomers',
            'totalProducts',
            'lowStockProducts',
            'monthlyRevenue',
            'topProducts'
        ));
    }
}
