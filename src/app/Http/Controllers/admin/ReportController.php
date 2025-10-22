<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Order;
use App\Models\admin\OrderItem;
use App\Models\admin\Product;
use App\Models\admin\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        // ===== Tổng doanh thu =====
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');

        // Doanh thu tháng trước
        $lastMonthRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('total_amount');

        // Doanh thu tháng hiện tại
        $currentMonthRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');

        // Tính phần trăm tăng/giảm
        if ($lastMonthRevenue == 0) {
            $revenueDiff = '+100%'; // hoặc 'N/A'
        } else {
            $diff = ($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue * 100;
            $revenueDiff = ($diff >= 0 ? '+' : '') . number_format($diff, 1) . '%';
        }


        // ===== Tổng đơn hàng =====
        $totalOrders = Order::count();

        // Đơn hàng tuần hiện tại
        $currentWeekOrders = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $lastWeekOrders = Order::whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])->count();
        $ordersDiff = $lastWeekOrders == 0 ? '+100%' : (($currentWeekOrders - $lastWeekOrders)/$lastWeekOrders*100);
        $ordersDiff = ($ordersDiff >=0 ? '+' : '') . number_format($ordersDiff,1) . '%';

        // ===== Khách hàng mới =====
        $newCustomers = User::where('role', 'customer')->count();

        // Số khách hàng tháng trước
        $lastMonthCustomers = User::where('role', 'customer')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        // Số khách hàng tháng hiện tại
        $currentMonthCustomers = User::where('role', 'customer')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Tính phần trăm tăng/giảm
        if ($lastMonthCustomers == 0) {
            $customersDiff = '+100%'; // hoặc 'N/A' nếu muốn
        } else {
            $diff = ($currentMonthCustomers - $lastMonthCustomers) / $lastMonthCustomers * 100;
            $customersDiff = ($diff >= 0 ? '+' : '') . number_format($diff, 1) . '%';
        }


        // ===== Top 5 sản phẩm bán chạy =====
        $topProducts = OrderItem::with('product')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(quantity * unit_price) as total_revenue'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        $currentWeekTopProducts = OrderItem::whereHas('order', function($q){
            $q->whereBetween('created_at',[now()->startOfWeek(), now()->endOfWeek()]);
        })->sum('quantity');

        $lastWeekTopProducts = OrderItem::whereHas('order', function($q){
            $q->whereBetween('created_at',[now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()]);
        })->sum('quantity');

        $topProductsDiff = $lastWeekTopProducts == 0 ? '+100%' : (($currentWeekTopProducts - $lastWeekTopProducts)/$lastWeekTopProducts*100);
        $topProductsDiff = ($topProductsDiff >=0 ? '+' : '') . number_format($topProductsDiff,1) . '%';

        // ===== Doanh thu theo tháng =====
        $monthlyRevenue = Order::where('status','completed')
            ->whereYear('created_at', now()->year)
            ->get()
            ->groupBy(fn($order) => $order->created_at->format('m'))
            ->map(fn($items) => $items->sum('total_amount'));

        // ===== Phân tích đơn hàng theo trạng thái =====
        $orderAnalysis = Order::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        // ===== Đơn hàng gần đây =====
        $recentOrders = Order::with('User')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('admin.report', compact(
            'totalRevenue','totalOrders','newCustomers','topProducts',
            'monthlyRevenue','orderAnalysis','recentOrders',
            'revenueDiff','ordersDiff','customersDiff','topProductsDiff'
        ));
    }
}
