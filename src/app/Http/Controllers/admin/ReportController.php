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
        $totalRevenue = Order::where('status', 'Hoàn tất')
            ->where('payment_status', 'Đã thanh toán')
            ->sum('total_amount');

        // Doanh thu tháng trước
        $lastMonthRevenue = Order::where('status', 'Hoàn tất')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('total_amount');

        // Doanh thu tháng hiện tại
        $currentMonthRevenue = Order::where('status', 'Hoàn tất')
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
        // ==== Sản phẩm bán chạy (chỉ từ đơn hoàn tất và đã thanh toán) ====
        $topProducts = OrderItem::select(
                'product_id',
                DB::raw('SUM(quantity) as total_sold'),
                DB::raw('SUM(quantity * unit_price) as total_revenue')
            )
            ->whereHas('order', function($query) {
                $query->where('status', 'Hoàn tất')
                      ->where('payment_status', 'Đã thanh toán');
            })
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->with('product')
            ->get();

        $currentWeekTopProducts = OrderItem::whereHas('order', function($q){
            $q->whereBetween('created_at',[now()->startOfWeek(), now()->endOfWeek()]);
        })->sum('quantity');

        $lastWeekTopProducts = OrderItem::whereHas('order', function($q){
            $q->whereBetween('created_at',[now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()]);
        })->sum('quantity');

        $topProductsDiff = $lastWeekTopProducts == 0 ? '+100%' : (($currentWeekTopProducts - $lastWeekTopProducts)/$lastWeekTopProducts*100);
        $topProductsDiff = ($topProductsDiff >=0 ? '+' : '') . number_format($topProductsDiff,1) . '%';

        // ==== Tính doanh thu theo tháng (chỉ từ đơn hoàn tất và đã thanh toán) ====
        $monthlyRevenue = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_amount) as total')
            )
            ->whereYear('created_at', date('Y'))
            ->where('status', 'Hoàn tất')
            ->where('payment_status', 'Đã thanh toán')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        // ===== Phân tích đơn hàng theo trạng thái =====
        $orderAnalysis = Order::select('status', 'payment_status', DB::raw('COUNT(*) as count'))
            ->groupBy('status', 'payment_status')
            ->get()
            ->groupBy('status')
            ->map(function($statusGroup) {
                return [
                    'total' => $statusGroup->sum('count'),
                    'by_payment' => $statusGroup->pluck('count', 'payment_status')->toArray(),
                ];
            });
        // Tạo dữ liệu đơn giản cho chart: chỉ lấy tổng theo trạng thái
        $orderChartData = Order::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');


        // ===== Thống kê theo thời gian =====
        $timeAnalysis = [
            'today' => Order::whereDate('created_at', today())->count(),
            'this_week' => Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Order::whereMonth('created_at', now()->month)
                                ->whereYear('created_at', now()->year)
                                ->count(),
        ];

        // ===== Đơn hàng gần đây (kèm thông tin thanh toán) =====
        $recentOrders = Order::with(['User', 'orderItems.product'])
            ->select('orders.*') // Đảm bảo lấy tất cả trường từ bảng orders
            ->whereNotNull('created_at') // Đảm bảo có ngày tạo
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('admin.report', compact(
            'totalRevenue','totalOrders','newCustomers','topProducts',
            'monthlyRevenue','orderAnalysis','recentOrders','timeAnalysis',
            'revenueDiff','ordersDiff','customersDiff','topProductsDiff','orderChartData'
        ));
    }
}
