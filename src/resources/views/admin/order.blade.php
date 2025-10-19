@extends('admin.layout')
@section('title', 'Quản lý đơn hàng')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <header class="mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Quản Lý Đơn Hàng</h1>
                <p class="text-gray-600 mt-1">Theo dõi và xử lý đơn hàng của khách hàng</p>
            </div>
        </header>

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

        <!-- Filters and Search -->
        <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
            <form action="{{ route('admin.order.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 items-end">
                <!-- Ô tìm kiếm -->
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Tìm Kiếm</label>
                    <input type="text" name="search" id="search"
                        value="{{ request('search') }}"
                        placeholder="Tìm theo mã đơn, tên khách hàng..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Lọc trạng thái -->
                <div class="w-full sm:w-40">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Trạng Thái</label>
                    <select name="status" id="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Tất cả</option>
                        <option value="Chờ xử lý" {{ request('status') == 'Chờ xử lý' ? 'selected' : '' }}>Chờ xử lý</option>
                        <option value="Đang giao" {{ request('status') == 'Đang giao' ? 'selected' : '' }}>Đang giao</option>
                        <option value="Đã giao" {{ request('status') == 'Đã giao' ? 'selected' : '' }}>Đã giao</option>
                        <option value="Đã hủy" {{ request('status') == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>

                <!-- Lọc theo thời gian -->
                <div class="w-full sm:w-36">
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Thời Gian</label>
                    <select name="date" id="date"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Tất cả</option>
                        <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>Hôm nay</option>
                        <option value="week" {{ request('date') == 'week' ? 'selected' : '' }}>Tuần này</option>
                        <option value="month" {{ request('date') == 'month' ? 'selected' : '' }}>Tháng này</option>
                    </select>
                </div>

                <!-- Nút tìm kiếm -->
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors whitespace-nowrap">
                    🔍 Tìm Kiếm
                </button>

                <!-- Nút xuất Excel -->
                <a href="{{ route('admin.order.export') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition-colors whitespace-nowrap">
                    ⬇ Xuất Excel
                </a>
            </form>
        </div>


        <!-- Orders Table -->
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Danh Sách Đơn Hàng</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="select-all" onchange="toggleSelectAll()" 
                                    class="text-blue-600 focus:ring-blue-500 rounded">
                            </th>
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

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($orders as $order)
                            <tr>

                                <!-- Mã đơn -->
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $order->order_id }}
                                </td>

                                <!-- Khách hàng -->
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $order->customer->name ?? 'Không xác định' }}
                                </td>

                                <!-- Sản phẩm -->
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    @foreach ($order->orderItems as $item)
                                        <div>{{ $item->product->name ?? 'Sản phẩm không tồn tại' }} (x{{ $item->quantity }})</div>
                                    @endforeach
                                </td>


                                <!-- Tổng tiền -->
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ number_format($order->total_amount, 0, ',', '.') }} ₫
                                </td>

                                <!-- Trạng thái -->
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

                                <!-- Địa chỉ -->
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $order->shipping_address }}
                                </td>

                                <!-- Ngày đặt -->
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}
                                </td>

                                <!-- Thao tác -->
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex gap-2">
                                        <a href="{{ route('order.show', $order->order_id) }}" 
                                        class="text-blue-600 hover:underline">Xem</a>
                                        <a href="{{ route('order.edit', $order->order_id) }}" 
                                        class="text-green-600 hover:underline">Sửa</a>
                                        <form action="{{ route('order.destroy', $order->order_id) }}" method="POST" onsubmit="return confirm('Xóa đơn hàng này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Xóa</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-6 text-gray-500">Không có đơn hàng nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>



            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Hiển thị <span class="font-medium">1</span> đến <span class="font-medium">10</span> 
                    trong tổng số <span class="font-medium">247</span> đơn hàng
                </div>
                <div class="flex items-center gap-2">
                    <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 disabled:opacity-50" disabled>
                        Trước
                    </button>
                    <button class="px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md">1</button>
                    <button class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">2</button>
                    <button class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">3</button>
                    <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Sau
                    </button>
                </div>
            </div>
        </div>

        <!-- Export Excel Modal -->
        <div id="export-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="bg-green-100 p-2 rounded-lg">
                                <span class="text-xl">📊</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Xuất dữ liệu Excel</h3>
                                <p class="text-sm text-gray-600">Tùy chỉnh dữ liệu xuất theo nhu cầu</p>
                            </div>
                        </div>
                        <button onclick="closeExportModal()" class="text-gray-400 hover:text-gray-600">
                            <span class="text-2xl">×</span>
                        </button>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <!-- Phạm vi xuất -->
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-3">Phạm vi xuất</h4>
                                    <div class="space-y-2">
                                        <label class="flex items-center">
                                            <input type="radio" name="export-range" value="all" checked class="text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2 text-sm text-gray-700">Tất cả đơn hàng (247 đơn hàng)</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="export-range" value="current" class="text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2 text-sm text-gray-700">Kết quả hiện tại (5 đơn hàng)</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="export-range" value="selected" class="text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2 text-sm text-gray-700">Đơn hàng đã chọn (<span id="selected-count">0</span> đơn hàng)</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Định dạng file -->
                                <div>
                                    <label for="file-format" class="block text-sm font-medium text-gray-700 mb-2">Định dạng file</label>
                                    <select id="file-format" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="xlsx">Excel (.xlsx)</option>
                                        <option value="csv">CSV (.csv)</option>
                                    </select>
                                </div>

                                <!-- Tên file -->
                                <div>
                                    <label for="file-name" class="block text-sm font-medium text-gray-700 mb-2">Tên file</label>
                                    <input type="text" id="file-name" value="danh-sach-don-hang" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <p class="text-xs text-gray-500 mt-1">Tên file sẽ được thêm ngày tháng tự động</p>
                                </div>

                                <!-- Lọc theo trạng thái -->
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-3">Lọc theo trạng thái</h4>
                                    <div class="space-y-2">
                                        <label class="flex items-center">
                                            <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500 rounded">
                                            <span class="ml-2 text-sm text-gray-700">Chờ xử lý</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500 rounded">
                                            <span class="ml-2 text-sm text-gray-700">Đang xử lý</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500 rounded">
                                            <span class="ml-2 text-sm text-gray-700">Đã gửi hàng</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500 rounded">
                                            <span class="ml-2 text-sm text-gray-700">Đã giao</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" class="text-blue-600 focus:ring-blue-500 rounded">
                                            <span class="ml-2 text-sm text-gray-700">Đã hủy</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <!-- Chọn cột xuất -->
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-3">Chọn cột xuất</h4>
                                    <div class="border rounded-lg p-4 max-h-64 overflow-y-auto">
                                        <div class="space-y-2">
                                            <label class="flex items-center">
                                                <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500 rounded">
                                                <span class="ml-2 text-sm text-gray-700">Mã đơn hàng</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500 rounded">
                                                <span class="ml-2 text-sm text-gray-700">Tên khách hàng</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500 rounded">
                                                <span class="ml-2 text-sm text-gray-700">Email</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500 rounded">
                                                <span class="ml-2 text-sm text-gray-700">Số điện thoại</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" class="text-blue-600 focus:ring-blue-500 rounded">
                                                <span class="ml-2 text-sm text-gray-700">Địa chỉ</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500 rounded">
                                                <span class="ml-2 text-sm text-gray-700">Sản phẩm</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500 rounded">
                                                <span class="ml-2 text-sm text-gray-700">Tổng tiền</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500 rounded">
                                                <span class="ml-2 text-sm text-gray-700">Trạng thái</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500 rounded">
                                                <span class="ml-2 text-sm text-gray-700">Ngày đặt</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="flex gap-2 mt-3">
                                        <button onclick="selectAllColumns()" class="text-sm text-blue-600 hover:text-blue-800">Chọn tất cả</button>
                                        <button onclick="deselectAllColumns()" class="text-sm text-gray-600 hover:text-gray-800">Bỏ chọn tất cả</button>
                                    </div>
                                </div>

                                <!-- Tùy chọn bổ sung -->
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-3">Tùy chọn bổ sung</h4>
                                    <div class="space-y-2">
                                        <label class="flex items-center">
                                            <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500 rounded">
                                            <span class="ml-2 text-sm text-gray-700">Bao gồm tiêu đề cột</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500 rounded">
                                            <span class="ml-2 text-sm text-gray-700">Thêm thời gian xuất</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" class="text-blue-600 focus:ring-blue-500 rounded">
                                            <span class="ml-2 text-sm text-gray-700">Thêm thống kê tổng quan</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Xem trước -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h5 class="font-medium text-gray-900 mb-2">Xem trước thông tin xuất</h5>
                                    <div class="text-sm text-gray-600 space-y-1">
                                        <div>Sẽ xuất: <span class="font-medium">247 đơn hàng</span></div>
                                        <div>Định dạng: <span class="font-medium">Excel (.xlsx)</span></div>
                                        <div>Cột: <span class="font-medium">8 cột</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200 mt-6">
                            <div class="flex items-center text-sm text-gray-500">
                                <span class="mr-1">📎</span>
                                File sẽ được tải xuống tự động
                            </div>
                            <div class="flex gap-3">
                                <button onclick="closeExportModal()" 
                                        class="px-6 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium">
                                    Hủy
                                </button>
                                <button onclick="exportToExcel()" 
                                        class="px-6 py-2 text-white bg-green-600 hover:bg-green-700 rounded-lg font-medium flex items-center gap-2">
                                    <span>📊</span>
                                    Xuất Excel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Detail Modal -->
        <div id="order-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Chi Tiết Đơn Hàng</h3>
                        <button onclick="closeOrderModal()" class="text-gray-400 hover:text-gray-600">
                            <span class="text-2xl">×</span>
                        </button>
                    </div>
                    <div id="order-detail-content" class="p-6">
                        <!-- Order details will be populated here -->
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Sample order data
        const orders = [
            {
                id: 'DH001',
                customer: 'Nguyễn Văn An',
                email: 'an.nguyen@email.com',
                phone: '0901234567',
                products: [
                    { name: 'iPhone 15 Pro Max', quantity: 1, price: 29990000 },
                    { name: 'AirPods Pro', quantity: 1, price: 6990000 }
                ],
                total: 36980000,
                status: 'pending',
                date: '2024-01-15',
                address: '123 Nguyễn Huệ, Q1, TP.HCM'
            },
            {
                id: 'DH002',
                customer: 'Trần Thị Bình',
                email: 'binh.tran@email.com',
                phone: '0912345678',
                products: [
                    { name: 'Samsung Galaxy S24', quantity: 1, price: 22990000 }
                ],
                total: 22990000,
                status: 'processing',
                date: '2024-01-14',
                address: '456 Lê Lợi, Q3, TP.HCM'
            },
            {
                id: 'DH003',
                customer: 'Lê Minh Cường',
                email: 'cuong.le@email.com',
                phone: '0923456789',
                products: [
                    { name: 'MacBook Air M3', quantity: 1, price: 28990000 },
                    { name: 'Magic Mouse', quantity: 1, price: 2290000 }
                ],
                total: 31280000,
                status: 'shipped',
                date: '2024-01-13',
                address: '789 Võ Văn Tần, Q3, TP.HCM'
            },
            {
                id: 'DH004',
                customer: 'Phạm Thị Dung',
                email: 'dung.pham@email.com',
                phone: '0934567890',
                products: [
                    { name: 'iPad Pro 12.9"', quantity: 1, price: 26990000 }
                ],
                total: 26990000,
                status: 'delivered',
                date: '2024-01-12',
                address: '321 Pasteur, Q1, TP.HCM'
            },
            {
                id: 'DH005',
                customer: 'Hoàng Văn Em',
                email: 'em.hoang@email.com',
                phone: '0945678901',
                products: [
                    { name: 'Apple Watch Series 9', quantity: 1, price: 9990000 }
                ],
                total: 9990000,
                status: 'cancelled',
                date: '2024-01-11',
                address: '654 Điện Biên Phủ, Q3, TP.HCM'
            }
        ];

        const statusLabels = {
            pending: 'Chờ xử lý',
            processing: 'Đang xử lý',
            shipped: 'Đã gửi hàng',
            delivered: 'Đã giao',
            cancelled: 'Đã hủy'
        };

        function formatCurrency(amount) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(amount);
        }

        function formatDate(dateString) {
            return new Date(dateString).toLocaleDateString('vi-VN');
        }

        function getStatusBadge(status) {
            return `<span class="px-2 py-1 text-xs font-medium rounded-full status-${status}">
                ${statusLabels[status]}
            </span>`;
        }

        function renderOrders(ordersToRender = orders) {
            const tbody = document.getElementById('orders-table');
            tbody.innerHTML = ordersToRender.map(order => `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" class="order-checkbox text-blue-600 focus:ring-blue-500 rounded" 
                               value="${order.id}" onchange="updateSelectedCount()">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                        ${order.id}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${order.customer}</div>
                        <div class="text-sm text-gray-500">${order.email}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">
                            ${order.products.length} sản phẩm
                        </div>
                        <div class="text-sm text-gray-500">
                            ${order.products[0].name}${order.products.length > 1 ? '...' : ''}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        ${formatCurrency(order.total)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        ${getStatusBadge(order.status)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        ${formatDate(order.date)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center gap-2">
                            <button onclick="viewOrder('${order.id}')" 
                                    class="text-blue-600 hover:text-blue-900">Xem</button>
                            <button onclick="updateOrderStatus('${order.id}')" 
                                    class="text-green-600 hover:text-green-900">Cập nhật</button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function viewOrder(orderId) {
            const order = orders.find(o => o.id === orderId);
            if (!order) return;

            const content = `
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">Thông Tin Đơn Hàng</h4>
                            <div class="space-y-2 text-sm">
                                <div><span class="font-medium">Mã đơn:</span> ${order.id}</div>
                                <div><span class="font-medium">Ngày đặt:</span> ${formatDate(order.date)}</div>
                                <div><span class="font-medium">Trạng thái:</span> ${getStatusBadge(order.status)}</div>
                                <div><span class="font-medium">Tổng tiền:</span> ${formatCurrency(order.total)}</div>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">Thông Tin Khách Hàng</h4>
                            <div class="space-y-2 text-sm">
                                <div><span class="font-medium">Tên:</span> ${order.customer}</div>
                                <div><span class="font-medium">Email:</span> ${order.email}</div>
                                <div><span class="font-medium">Điện thoại:</span> ${order.phone}</div>
                                <div><span class="font-medium">Địa chỉ:</span> ${order.address}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-3">Sản Phẩm</h4>
                        <div class="border rounded-lg overflow-hidden">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Sản phẩm</th>
                                        <th class="px-4 py-2 text-center">Số lượng</th>
                                        <th class="px-4 py-2 text-right">Đơn giá</th>
                                        <th class="px-4 py-2 text-right">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    ${order.products.map(product => `
                                        <tr>
                                            <td class="px-4 py-2">${product.name}</td>
                                            <td class="px-4 py-2 text-center">${product.quantity}</td>
                                            <td class="px-4 py-2 text-right">${formatCurrency(product.price)}</td>
                                            <td class="px-4 py-2 text-right">${formatCurrency(product.price * product.quantity)}</td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <button onclick="closeOrderModal()" 
                                class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg">
                            Đóng
                        </button>
                        <button onclick="updateOrderStatus('${order.id}')" 
                                class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
                            Cập Nhật Trạng Thái
                        </button>
                    </div>
                </div>
            `;

            document.getElementById('order-detail-content').innerHTML = content;
            document.getElementById('order-modal').classList.remove('hidden');
        }

        function closeOrderModal() {
            document.getElementById('order-modal').classList.add('hidden');
        }

        function updateOrderStatus(orderId) {
            const order = orders.find(o => o.id === orderId);
            if (!order) return;

            const statusOptions = [
                { value: 'pending', label: 'Chờ xử lý' },
                { value: 'processing', label: 'Đang xử lý' },
                { value: 'shipped', label: 'Đã gửi hàng' },
                { value: 'delivered', label: 'Đã giao' },
                { value: 'cancelled', label: 'Đã hủy' }
            ];

            const content = `
                <div class="space-y-4">
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-3">Cập Nhật Trạng Thái Đơn Hàng</h4>
                        <p class="text-sm text-gray-600 mb-4">Đơn hàng: <span class="font-medium">${orderId}</span></p>
                        
                        <label for="new-status" class="block text-sm font-medium text-gray-700 mb-2">Trạng thái mới</label>
                        <select id="new-status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            ${statusOptions.map(option => `
                                <option value="${option.value}" ${option.value === order.status ? 'selected' : ''}>
                                    ${option.label}
                                </option>
                            `).join('')}
                        </select>
                    </div>
                    
                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <button onclick="closeOrderModal()" 
                                class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg">
                            Hủy
                        </button>
                        <button onclick="saveOrderStatus('${orderId}')" 
                                class="px-4 py-2 text-white bg-green-600 hover:bg-green-700 rounded-lg">
                            Lưu Thay Đổi
                        </button>
                    </div>
                </div>
            `;

            document.getElementById('order-detail-content').innerHTML = content;
            document.getElementById('order-modal').classList.remove('hidden');
        }

        function saveOrderStatus(orderId) {
            const newStatus = document.getElementById('new-status').value;
            const orderIndex = orders.findIndex(o => o.id === orderId);
            
            if (orderIndex !== -1) {
                orders[orderIndex].status = newStatus;
                renderOrders();
                closeOrderModal();
                
                // Show success message
                showNotification('Cập nhật trạng thái đơn hàng thành công!', 'success');
            }
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 ${
                type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        function filterOrders() {
            const searchTerm = document.getElementById('search').value.toLowerCase();
            const statusFilter = document.getElementById('status-filter').value;
            const dateFilter = document.getElementById('date-filter').value;

            let filteredOrders = orders.filter(order => {
                const matchesSearch = order.id.toLowerCase().includes(searchTerm) ||
                                    order.customer.toLowerCase().includes(searchTerm) ||
                                    order.email.toLowerCase().includes(searchTerm);
                
                const matchesStatus = !statusFilter || order.status === statusFilter;
                
                let matchesDate = true;
                if (dateFilter) {
                    const orderDate = new Date(order.date);
                    const today = new Date();
                    
                    switch (dateFilter) {
                        case 'today':
                            matchesDate = orderDate.toDateString() === today.toDateString();
                            break;
                        case 'week':
                            const weekAgo = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);
                            matchesDate = orderDate >= weekAgo;
                            break;
                        case 'month':
                            matchesDate = orderDate.getMonth() === today.getMonth() &&
                                        orderDate.getFullYear() === today.getFullYear();
                            break;
                    }
                }
                
                return matchesSearch && matchesStatus && matchesDate;
            });

            renderOrders(filteredOrders);
        }

        // Event listeners
        document.getElementById('search').addEventListener('input', filterOrders);
        document.getElementById('status-filter').addEventListener('change', filterOrders);
        document.getElementById('date-filter').addEventListener('change', filterOrders);

        function openExportModal() {
            document.getElementById('export-modal').classList.remove('hidden');
        }

        function closeExportModal() {
            document.getElementById('export-modal').classList.add('hidden');
        }

        function selectAllColumns() {
            const checkboxes = document.querySelectorAll('#export-modal input[type="checkbox"]');
            const columnCheckboxes = Array.from(checkboxes).slice(8, 17); // Only column checkboxes
            columnCheckboxes.forEach(checkbox => checkbox.checked = true);
        }

        function deselectAllColumns() {
            const checkboxes = document.querySelectorAll('#export-modal input[type="checkbox"]');
            const columnCheckboxes = Array.from(checkboxes).slice(8, 17); // Only column checkboxes
            columnCheckboxes.forEach(checkbox => checkbox.checked = false);
        }

        function exportToExcel() {
            // Get selected options
            const range = document.querySelector('input[name="export-range"]:checked').value;
            const format = document.getElementById('file-format').value;
            const fileName = document.getElementById('file-name').value;
            
            // Determine which orders to export
            let ordersToExport = [];
            switch (range) {
                case 'all':
                    ordersToExport = orders;
                    break;
                case 'current':
                    // Get currently displayed orders (filtered results)
                    const currentRows = document.querySelectorAll('#orders-table tr');
                    const currentIds = Array.from(currentRows).map(row => {
                        const checkbox = row.querySelector('.order-checkbox');
                        return checkbox ? checkbox.value : null;
                    }).filter(id => id);
                    ordersToExport = orders.filter(order => currentIds.includes(order.id));
                    break;
                case 'selected':
                    ordersToExport = getSelectedOrders();
                    if (ordersToExport.length === 0) {
                        showNotification('Vui lòng chọn ít nhất một đơn hàng để xuất!', 'error');
                        return;
                    }
                    break;
            }
            
            // Create CSV content
            const headers = ['Mã Đơn', 'Khách Hàng', 'Email', 'Điện Thoại', 'Sản Phẩm', 'Tổng Tiền', 'Trạng Thái', 'Ngày Đặt'];
            let csvContent = headers.join(',') + '\n';
            
            ordersToExport.forEach(order => {
                const row = [
                    order.id,
                    `"${order.customer}"`,
                    order.email,
                    order.phone,
                    `"${order.products[0].name}${order.products.length > 1 ? '...' : ''}"`,
                    order.total,
                    statusLabels[order.status],
                    formatDate(order.date)
                ];
                csvContent += row.join(',') + '\n';
            });
            
            // Create and download file
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            const url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            
            const today = new Date().toISOString().split('T')[0];
            const extension = format === 'xlsx' ? 'xlsx' : 'csv';
            link.setAttribute('download', `${fileName}-${today}.${extension}`);
            
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            closeExportModal();
            showNotification(`Xuất file thành công! (${ordersToExport.length} đơn hàng)`, 'success');
        }

        // Close modal when clicking outside
        document.getElementById('order-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeOrderModal();
            }
        });

        document.getElementById('export-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeExportModal();
            }
        });

        // Checkbox functions
        function toggleSelectAll() {
            const selectAllCheckbox = document.getElementById('select-all');
            const orderCheckboxes = document.querySelectorAll('.order-checkbox');
            
            orderCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            
            updateSelectedCount();
        }

        function updateSelectedCount() {
            const selectedCheckboxes = document.querySelectorAll('.order-checkbox:checked');
            const count = selectedCheckboxes.length;
            
            // Update count in export modal
            const selectedCountElement = document.getElementById('selected-count');
            if (selectedCountElement) {
                selectedCountElement.textContent = count;
            }
            
            // Update select all checkbox state
            const selectAllCheckbox = document.getElementById('select-all');
            const allCheckboxes = document.querySelectorAll('.order-checkbox');
            
            if (count === 0) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = false;
            } else if (count === allCheckboxes.length) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = true;
            } else {
                selectAllCheckbox.indeterminate = true;
            }
        }

        function getSelectedOrders() {
            const selectedCheckboxes = document.querySelectorAll('.order-checkbox:checked');
            const selectedIds = Array.from(selectedCheckboxes).map(cb => cb.value);
            return orders.filter(order => selectedIds.includes(order.id));
        }

        // Initialize
        renderOrders();
    </script>
</div>
</html>
@endsection