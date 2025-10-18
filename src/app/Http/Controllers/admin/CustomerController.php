<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Customer;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomerExport;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Hiển thị trang quản lý khách hàng
     */
    public function index()
    {
        $totalCustomers = Customer::count();
        $activeCustomers = Customer::where('status', 'active')->count();
        $inactiveCustomers = Customer::where('status', 'inactive')->count();
        $highValueCustomers = Customer::where('total_orders', '>', 5)->count(); // Giả định khách hàng giá trị cao

        return view('customer', compact('totalCustomers', 'activeCustomers', 'inactiveCustomers', 'highValueCustomers'));
    }

    /**
     * API: Lấy danh sách khách hàng với bộ lọc
     */
    public function getCustomers(Request $request)
    {
        $query = Customer::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $customers = $query->get();

        return response()->json($customers);
    }

    /**
     * API: Lấy danh sách cảnh báo (ví dụ: khách hàng không hoạt động lâu)
     */
    public function getAlerts()
    {
        $alerts = Customer::where('status', 'inactive')
                         ->orWhere('last_order_date', '<', now()->subMonths(6))
                         ->get();

        return response()->json($alerts);
    }

    /**
     * API: Lấy chi tiết khách hàng
     */
    public function getCustomerDetails($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    /**
     * API: Cập nhật thông tin khách hàng
     */
    public function updateCustomer(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'total_orders' => 'nullable|integer|min:0',
            'last_order_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return response()->json(['message' => 'Cập nhật khách hàng thành công', 'customer' => $customer]);
    }

    /**
     * API: Xóa khách hàng
     */
    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customerName = $customer->name;
        $customer->delete();

        return response()->json(['message' => "Xóa khách hàng '$customerName' thành công"]);
    }

    /**
     * API: Xuất dữ liệu ra Excel/CSV
     */
    public function export(Request $request)
    {
        $request->validate([
            'range' => 'required|in:all,current,selected',
            'format' => 'required|in:xlsx,csv',
            'file_name' => 'required|string|max:255',
            'include_headers' => 'boolean',
            'include_timestamp' => 'boolean',
            'include_stats' => 'boolean',
            'statuses' => 'array',
            'columns' => 'array',
            'selected_ids' => 'array|required_if:range,selected',
        ]);

        $fileName = $request->file_name . '-' . now()->format('Y-m-d') . '.' . $request->format;

        return Excel::download(new CustomerExport($request->all()), $fileName);
    }
}