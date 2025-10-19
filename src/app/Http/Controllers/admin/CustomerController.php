<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\customer;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\admin\CustomerExport;


class CustomerController extends Controller
{
    /**
     * Hiển thị danh sách khách hàng với phân trang, tìm kiếm và thống kê
     */
    public function index(Request $request)
    {
        $query = customer::query();

        // Tìm kiếm
        if ($request->has('search') && !empty($request->search)) {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(email) LIKE ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(user_id) LIKE ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(phone) LIKE ?', ["%{$search}%"]);
            });
        }

        // Sắp xếp
        $sortBy = $request->get('sort_by', 'name');
        $sortDirection = $request->get('sort_direction', 'asc');
        $customers = $query->orderBy($sortBy, $sortDirection)
                        ->paginate(10)
                        ->withQueryString();

        // Thống kê
        $totalCustomers = customer::where('role', 'customer')->count();
        $totalAdmins = customer::where('role', 'admin')->count();
        $newToday = customer::whereDate('created_at', now()->toDateString())->count();
        $newYesterday = customer::whereDate('created_at', now()->subDay()->toDateString())->count();

        $growth = $newYesterday == 0 ? ($newToday > 0 ? '+100%' : '0%')
                                    : (($newToday - $newYesterday) / $newYesterday * 100) . '%';

        return view('admin.customer', compact(
            'customers', 'totalCustomers', 'totalAdmins', 'newToday', 'growth'
        ));
    }


    /**
     * Xuất danh sách khách hàng ra Excel
     */
    public function exportExcel()
    {
        return Excel::download(new CustomerExport, 'customers.xlsx');
    }

    public function reload()
    {
        $customers = customer::orderBy('name', 'asc')->paginate(10);

        $totalCustomers = customer::where('role', 'customer')->count();
        $totalAdmins = customer::where('role', 'admin')->count();
        $newToday = customer::whereDate('created_at', now()->toDateString())->count();
        $newYesterday = customer::whereDate('created_at', now()->subDay()->toDateString())->count();

        // Tính tăng trưởng
        if ($newYesterday == 0) {
            $growth = $newToday > 0 ? '+100%' : '0%';
        } else {
            $growthValue = (($newToday - $newYesterday) / $newYesterday) * 100;
            $growth = ($growthValue >= 0 ? '+' : '') . number_format($growthValue, 1) . '%';
        }

        return view('admin.customer', compact(
            'customers',
            'totalCustomers',
            'totalAdmins',
            'newToday',
            'growth'
        ));
    }



}
