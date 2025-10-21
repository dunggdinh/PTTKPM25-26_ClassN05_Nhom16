<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\admin\CustomerExport;

class UserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index(Request $request)
    {
        $query = User::query();

        // 🔹 Lọc theo vai trò
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // 🔹 Tìm kiếm
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(email) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(user_id) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(phone) LIKE ?', ["%{$search}%"]);
            });
        }

        // 🔹 Sắp xếp
        $sortBy = $request->get('sort_by', 'name');
        $sortDirection = $request->get('sort_direction', 'asc');
        $users = $query->orderBy($sortBy, $sortDirection)
                       ->paginate(10)
                       ->withQueryString();

        // Thống kê
        $totalCustomers = User::where('role', 'customer')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $newToday = User::whereDate('created_at', now()->toDateString())->count();
        $newYesterday = User::whereDate('created_at', now()->subDay()->toDateString())->count();

        $growth = $newYesterday == 0 ? ($newToday > 0 ? '+100%' : '0%')
                                     : round((($newToday - $newYesterday) / $newYesterday * 100), 2) . '%';

        return view('admin.user', compact(
            'users', 'totalCustomers', 'totalAdmins', 'newToday', 'growth'
        ));
    }

    // Reload bảng người dùng bằng Ajax
    public function reload()
    {
        $users = User::orderBy('name', 'asc')->get();

        $html = '';
        foreach ($users as $user) {
            $html .= "
                <tr class='hover:bg-gray-50 transition'>
                    <td class='px-6 py-4 text-sm text-gray-900 font-medium'>{$user->user_id}</td>
                    <td class='px-6 py-4 text-sm text-gray-900'>{$user->name}</td>
                    <td class='px-6 py-4 text-sm text-gray-900'>{$user->email}</td>
                    <td class='px-6 py-4 text-sm text-gray-900'>{$user->role}</td>
                    <td class='px-6 py-4 text-sm text-gray-900'>{$user->dob}</td>
                    <td class='px-6 py-4 text-sm text-gray-900'>{$user->gender}</td>
                    <td class='px-6 py-4 text-sm text-gray-900'>{$user->phone}</td>
                    <td class='px-6 py-4 text-sm text-gray-900'>{$user->address}</td>
                    <td class='px-6 py-4 text-sm text-gray-900'>{$user->created_at->format('Y-m-d')}</td>
                </tr>
            ";
        }

        if ($users->isEmpty()) {
            $html = "<tr><td colspan='9' class='px-6 py-4 text-center text-gray-500 text-sm'>Không có người dùng nào.</td></tr>";
        }

        return response()->json(['html' => $html]);
    }

    // Xuất Excel
    public function export(Request $request)
    {
        $columns = $request->columns 
            ? json_decode($request->columns, true) 
            : ['user_id','name','email','role','dob','gender','phone','address','created_at'];

        $format = $request->format ?? 'xlsx';
        $fileName = ($request->fileName ?? 'user-export') . '-' . now()->format('Y-m-d') . '.' . $format;

        return Excel::download(new CustomerExport($columns), $fileName);
    }
}
