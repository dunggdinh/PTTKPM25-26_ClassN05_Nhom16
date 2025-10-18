<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Customer;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomerExport;

class CustomerController extends Controller
{
    /**
     * Hiển thị danh sách khách hàng với phân trang, tìm kiếm và thống kê
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        // Tìm kiếm theo tên hoặc email
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Lấy danh sách khách hàng phân trang 10 bản ghi/trang
        $customers = $query->orderBy('name', 'asc')->paginate(10)->withQueryString();

        // Thống kê nhanh
        $totalCustomers = Customer::where('role', 'customer')->count();
        $totalAdmins = Customer::where('role', 'admin')->count();
        $newToday = Customer::whereDate('created_at', now()->toDateString())->count();
        $newYesterday = Customer::whereDate('created_at', now()->subDay()->toDateString())->count();

        // Tính tăng trưởng so với hôm qua
        if ($newYesterday == 0) {
            $growth = $newToday > 0 ? '+100%' : '0%';
        } else {
            $growthValue = (($newToday - $newYesterday) / $newYesterday) * 100;
            $growth = ($growthValue >= 0 ? '+' : '') . number_format($growthValue, 1) . '%';
        }

        // Trả dữ liệu ra view
        return view('admin.customer', compact(
            'customers',
            'totalCustomers',
            'totalAdmins',
            'newToday',
            'growth'
        ));
    }

    /**
     * Xuất danh sách khách hàng ra Excel
     */
    public function exportExcel()
    {
        return Excel::download(new CustomerExport, 'customer.xlsx');
    }

    /**
     * Xem chi tiết khách hàng
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customer_detail', compact('customer'));
    }

    /**
     * Xóa khách hàng
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customer')
                         ->with('success', 'Khách hàng đã được xóa thành công!');
    }
}
