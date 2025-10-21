@extends('admin.layout')
@section('title', 'Quản lý đơn hàng')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Quản Lý Đơn Hàng</h1>
                <p class="text-gray-600 mt-1">Theo dõi và xử lý đơn hàng của khách hàng</p>
            </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center gap-4">
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <span class="text-2xl">📦</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Tổng Đơn Hàng</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalOrders }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center gap-4">
                    <div class="bg-yellow-100 p-3 rounded-lg">
                        <span class="text-2xl">⏳</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Chờ Xử Lý</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $pendingOrders }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center gap-4">
                    <div class="bg-green-100 p-3 rounded-lg">
                        <span class="text-2xl">💰</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Doanh Thu</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $revenue }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center gap-4">
                    <div class="bg-purple-100 p-3 rounded-lg">
                        <span class="text-2xl">✅</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Đã Giao</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $completedOrders }}</p>
                    </div>
                </div>
            </div>
        </div>

            <div class="bg-white rounded-xl shadow-md">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Danh sách đơn hàng</h2>
                    <!-- Filters and Search -->
                        <form method="GET" action="{{ route('admin.order') }}" 
                            class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">

                            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                                <div class="relative">
                                    <input type="text" name="search" placeholder="Tìm kiếm đơn hàng..." 
                                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent w-full md:w-64"
                                        value="{{ request('search') }}">
                                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>

                                <!-- Lọc trạng thái -->
                                <select name="status" id="status"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="Chờ xử lý" {{ request('status') == 'Chờ xử lý' ? 'selected' : '' }}>Chờ xử lý</option>
                                    <option value="Đang giao" {{ request('status') == 'Đang giao' ? 'selected' : '' }}>Đang giao</option>
                                    <option value="Đã giao" {{ request('status') == 'Đã giao' ? 'selected' : '' }}>Đã giao</option>
                                    <option value="Đã hủy" {{ request('status') == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                                </select>

                                <!-- Lọc theo thời gian -->
                                <select name="date" id="date"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Tất cả</option>
                                    <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>Hôm nay</option>
                                    <option value="week" {{ request('date') == 'week' ? 'selected' : '' }}>Tuần này</option>
                                    <option value="month" {{ request('date') == 'month' ? 'selected' : '' }}>Tháng này</option>
                                </select>
                            </div>

                            <div class="flex space-x-3">
                                <button onclick="exportInventory()" class="bg-green-600 hover:bg-green-700 text-white border border-green-600 px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span>Xuất Excel</span>
                                </button>

                                <a href="{{ route('admin.order') }}"
                                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    <span>Làm mới</span>
                                </a>
                            </div>

            </form>
        </div>
        <!-- Orders Table -->          
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã Đơn Hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách Hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản Phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng Tiền</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng Thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Địa Chỉ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày Đặt</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao Tác</th>
                        </tr>
                    </thead>

                    <tbody id="orderTable" class="bg-white divide-y divide-gray-200">
                        @forelse ($orders as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $order->order_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $order->user->name ?? 'Không xác định' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    @foreach ($order->orderItems as $item)
                                        <div>{{ $item->product->name ?? 'Sản phẩm không tồn tại' }} (x{{ $item->quantity }})</div>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ number_format($order->total_amount, 0, ',', '.') }} ₫</td>

                                <td class="px-6 py-4 text-sm">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'processing' => 'bg-blue-100 text-blue-800',
                                            'shipped' => 'bg-purple-100 text-purple-800',
                                            'delivered' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">{{ $order->shipping_address }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</td>
                                
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.order.show', $order->order_id) }}" class="text-blue-600 hover:underline">Xem</a>
                                        <form action="{{ route('admin.order.destroy', $order->order_id) }}" method="POST" onsubmit="return confirm('Xóa đơn hàng này?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Xóa</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500 text-sm">Không có đơn hàng nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="flex flex-col items-center mt-4 bg-white px-4 py-2 rounded-b-xl">
                        <div>
                            {{ $orders->withQueryString()->links('pagination::simple-tailwind') }}
                        </div>
                        <div class="text-sm text-gray-500 mt-1">
                            Trang {{ $orders->currentPage() }} / {{ $orders->lastPage() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.querySelector("input[name='search']");
    const statusFilter = document.querySelector("select[name='status']");
    const dateFilter = document.querySelector("select[name='date']");
    const reloadBtn = document.getElementById("reload-btn"); // nếu có nút reload
    const tableBody = document.getElementById("orderTable");

    // --- Lọc dữ liệu khi thay đổi ---
    [statusFilter, dateFilter].forEach(select => {
        if (select) {
            select.addEventListener("change", () => applyFilters());
        }
    });

    if (searchInput) {
        searchInput.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                applyFilters();
            }
        });
    }

    function applyFilters() {
        const params = new URLSearchParams(window.location.search);
        params.set("search", searchInput?.value || '');
        params.set("status", statusFilter?.value || '');
        params.set("date", dateFilter?.value || '');
        window.location.search = params.toString();
    }

    // --- AJAX reload ---
    if (reloadBtn) {
        reloadBtn.addEventListener("click", async function(e) {
            e.preventDefault();
            tableBody.innerHTML = `<tr><td colspan="8" class="text-center py-4">Đang tải dữ liệu...</td></tr>`;
            try {
                const response = await fetch(this.dataset.url, {
                    headers: { "X-Requested-With": "XMLHttpRequest" }
                });
                const data = await response.json();
                tableBody.innerHTML = data.html || `<tr><td colspan="8" class="text-center text-red-500">Không có dữ liệu.</td></tr>`;
            } catch (error) {
                tableBody.innerHTML = `<tr><td colspan="8" class="text-center text-red-500">Lỗi khi tải dữ liệu.</td></tr>`;
            }
        });
    }
});
</script>


</div>
</html>
@endsection