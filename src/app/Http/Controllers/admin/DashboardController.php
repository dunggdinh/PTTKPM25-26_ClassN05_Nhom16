<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Query stats từ DB
        $totalRevenue = Order::sum('total_amount'); // Tổng doanh thu
        $totalOrders = Order::count(); // Tổng đơn hàng
        $totalCustomers = Customer::count(); // Tổng khách hàng
        $totalProducts = Product::count(); // Tổng sản phẩm
        $lowStockProducts = Product::where('stock', '<', 50)->count(); // Sản phẩm sắp hết (giả sử threshold 50)

        // Top products (sản phẩm bán chạy dựa trên orders)
        $topProducts = Product::withCount('orders') // Giả sử có relation orders ở Product model
            ->orderBy('orders_count', 'desc')
            ->take(4)
            ->get();

        // Recent orders
        $recentOrders = Order::latest()->take(4)->get();

        return view('admin.dashboard', compact(
            'totalRevenue', 
            'totalOrders', 
            'totalCustomers', 
            'totalProducts', 
            'lowStockProducts', 
            'topProducts', 
            'recentOrders'
        ));
    }
}