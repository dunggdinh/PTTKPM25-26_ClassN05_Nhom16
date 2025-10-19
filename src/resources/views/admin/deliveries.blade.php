@extends('admin.layout')
@section('title', 'Quản lý nhập hàng')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Quản Lý Hàng Nhập</h1>
            <p class="text-gray-600">Theo dõi và quản lý các lô hàng nhập kho</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Tổng lô hàng</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalBatches }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-100">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Đã nhập kho</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $completedBatches }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-yellow-100">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Đang chờ</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $pendingBatches }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-purple-100">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Tổng giá trị</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalValue }}</p>
                    </div>
                </div>
            </div>
        </div>



        <!-- Controls -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <form action="{{ route('deliveries') }}" method="GET" class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex flex-col sm:flex-row gap-4">
                    <!-- Ô tìm kiếm -->
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input 
                            type="text" 
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Tìm kiếm lô hàng..." 
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full sm:w-80">
                    </div>

                    <!-- Bộ lọc trạng thái -->
                    <select name="status" onchange="this.form.submit()" 
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Đang chờ</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Đã nhập kho</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>

                    <!-- Bộ lọc nhà cung cấp -->
                    <select name="supplier" onchange="this.form.submit()" 
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Tất cả nhà cung cấp</option>
                        <option value="Samsung Electronics" {{ request('supplier') == 'Samsung Electronics' ? 'selected' : '' }}>Samsung Electronics</option>
                        <option value="Apple Inc." {{ request('supplier') == 'Apple Inc.' ? 'selected' : '' }}>Apple Inc.</option>
                        <option value="Xiaomi Corp." {{ request('supplier') == 'Xiaomi Corp.' ? 'selected' : '' }}>Xiaomi Corp.</option>
                        <option value="Sony Corporation" {{ request('supplier') == 'Sony Corporation' ? 'selected' : '' }}>Sony Corporation</option>
                    </select>
                </div>

                <!-- Hành động -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('deliveries.export') }}" 
                    class="border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-2 rounded-lg font-medium transition-colors flex items-center justify-center gap-2 whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Xuất Excel
                    </a>

                    <a href="{{ route('deliveries.reload') }}" 
                    class="border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-2 rounded-lg font-medium transition-colors flex items-center justify-center gap-2 whitespace-nowrap">
                        🔄 Tải lại
                    </a>

                    <button type="button" onclick="openAddModal()" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors flex items-center justify-center gap-2 whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Thêm lô hàng mới
                    </button>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="selectAll" class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã lô hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nhà cung cấp</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số lượng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giá trị</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày nhập</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($deliveries as $delivery)
                            <tr>
                                <td class="px-6 py-4 text-sm">
                                    <input type="checkbox" class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $delivery->delivery_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $delivery->supplier->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $delivery->product->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $delivery->quantity }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ number_format($delivery->total_value, 0, ',', '.') }} ₫</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $delivery->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium 
                                        @if($delivery->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($delivery->status == 'completed') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($delivery->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex gap-2">
                                        <a href="#" class="text-blue-600 hover:underline">Sửa</a>
                                        <form action="{{ route('deliveries.destroy', $delivery->delivery_id) }}" method="POST" onsubmit="return confirm('Xóa lô hàng này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Xóa</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-4">
                {{ $deliveries->links() }}
            </div>
        </div>


        <!-- Pagination -->
        <div class="bg-white px-6 py-3 flex items-center justify-between border-t border-gray-200 mt-6 rounded-lg shadow-sm">
            <div class="flex-1 flex justify-between sm:hidden">
                <button onclick="changePage(currentPage - 1)" id="prevBtnMobile" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">Trước</button>
                <button onclick="changePage(currentPage + 1)" id="nextBtnMobile" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">Sau</button>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">Hiển thị <span class="font-medium" id="startRecord">1</span> đến <span class="font-medium" id="endRecord">5</span> của <span class="font-medium" id="totalRecords">5</span> kết quả</p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" id="paginationNav">
                        <!-- Pagination buttons will be generated by JavaScript -->
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Excel Modal -->
    <div id="exportModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-8 mx-auto p-6 border w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 shadow-lg rounded-lg bg-white max-w-4xl">
            <!-- Header -->
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">Xuất dữ liệu Excel</h3>
                    <p class="text-sm text-gray-600 mt-1">Tùy chỉnh dữ liệu xuất theo nhu cầu</p>
                </div>
                <button onclick="closeExportModal()" class="text-gray-400 hover:text-gray-600 p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Panel -->
                <div class="space-y-6">
                    <!-- 1. Phạm vi xuất -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-900 mb-3">Phạm vi xuất</h4>
                        <div class="space-y-3">
                            <label class="flex items-center">
                                <input type="radio" name="dataRange" value="all" checked class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Tất cả lô hàng (<span id="totalCustomers">15</span> lô hàng)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="dataRange" value="current" class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Trang hiện tại (<span id="currentCustomers">10</span> lô hàng)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="dataRange" value="selected" class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Lô hàng đã chọn (<span id="selectedCustomers">0</span> lô hàng)</span>
                            </label>
                        </div>
                    </div>

                    <!-- 2. Định dạng file & Tên file -->
                    <div class="mb-6">
                        <div class="space-y-4">
                            <!-- Định dạng file -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Định dạng file</label>
                                <select id="fileFormat" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="xlsx">Excel (.xlsx)</option>
                                    <option value="csv">CSV (.csv)</option>
                                </select>
                            </div>
                            
                            <!-- Tên file -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tên file</label>
                                <input type="text" id="fileName" value="danh-sach-khach-hang" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <p class="text-xs text-gray-500 mt-1">Tên file sẽ được thêm ngày tháng tự động</p>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Lọc theo trạng thái -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-900 mb-3">Lọc theo trạng thái</h4>
                        <div class="space-y-3">
                            <label class="flex items-center">
                                <input type="checkbox" name="statusFilter" value="active" checked class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Hoạt động</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="statusFilter" value="inactive" checked class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Không hoạt động</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="statusFilter" value="locked" checked class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Bị khóa</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Right Panel -->
                <div class="space-y-6">
                    <!-- 4. Chọn cột xuất -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-900 mb-3">Chọn cột xuất</h4>
                        <div class="max-h-48 overflow-y-auto space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="columns" value="id" checked class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">ID</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="columns" value="name" checked class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Họ và tên</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="columns" value="email" checked class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Email</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="columns" value="phone" checked class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Số điện thoại</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="columns" value="address" class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Địa chỉ</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="columns" value="type" checked class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Loại khách hàng</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="columns" value="orders" checked class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Số đơn hàng</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="columns" value="spending" checked class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Tổng chi tiêu</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="columns" value="status" checked class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Trạng thái</span>
                            </label>
                        </div>
                        <div class="flex gap-4 mt-3 pt-3">
                            <button onclick="selectAllColumns()" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Chọn tất cả</button>
                            <button onclick="deselectAllColumns()" class="text-sm text-gray-600 hover:text-gray-800 font-medium">Bỏ chọn tất cả</button>
                        </div>
                    </div>

                    <!-- 5. Tùy chọn bổ sung -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-900 mb-3">Tùy chọn bổ sung</h4>
                        <div class="space-y-3">
                            <label class="flex items-center">
                                <input type="checkbox" id="includeHeader" checked class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Bao gồm tiêu đề cột</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="includeTimestamp" checked class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Thêm thời gian xuất</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="includeStats" class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                <span class="ml-3 text-sm text-gray-700">Thêm thống kê tổng quan</span>
                            </label>
                        </div>
                    </div>

                    <!-- 6. Xem trước thông tin xuất -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="text-sm text-gray-700 space-y-1">
                            <p><strong>Sẽ xuất:</strong> <span id="previewCustomers">20</span> khách hàng</p>
                            <p><strong>Định dạng:</strong> <span id="previewFormat">Excel (.xlsx)</span></p>
                            <p><strong>Cột:</strong> <span id="previewColumns">8</span> cột</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex justify-end gap-3">
                    <button onclick="closeExportModal()" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors">
                        Hủy
                    </button>
                    <button onclick="processExport()" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors flex items-center gap-2">
                        Xuất Excel
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-3 text-center">File sẽ được tải xuống tự động</p>
            </div>
        </div>
    </div>

    <!-- Add Shipment Modal -->
    <div id="addModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Thêm lô hàng mới</h3>
                    <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <form onsubmit="addShipment(event)" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mã lô hàng</label>
                            <input type="text" id="shipmentCode" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="LH001" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nhà cung cấp</label>
                            <select id="supplier" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                <option value="">Chọn nhà cung cấp</option>
                                <option value="Samsung Electronics">Samsung Electronics</option>
                                <option value="Apple Inc.">Apple Inc.</option>
                                <option value="Xiaomi Corp.">Xiaomi Corp.</option>
                                <option value="Sony Corporation">Sony Corporation</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sản phẩm</label>
                            <input type="text" id="product" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="iPhone 15 Pro Max" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Số lượng</label>
                            <input type="number" id="quantity" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="100" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Giá trị (VNĐ)</label>
                            <input type="number" id="value" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="50000000" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ngày nhập dự kiến</label>
                            <input type="date" id="expectedDate" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ghi chú</label>
                        <textarea id="notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Ghi chú thêm về lô hàng..."></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeAddModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Hủy</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Thêm lô hàng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Filter state and pagination
        let currentFilters = {
            search: \'\',
            status: \'\',
            supplier: \'\',
            selectedItems: new Set()
        };
        
        let currentPage = 1;
        let itemsPerPage = 10;
        let filteredShipments = [];

        // Sample data
        const shipments = [
            {
                id: \'LH001\',
                supplier: \'Samsung Electronics\',
                product: \'Galaxy S24 Ultra\',
                quantity: 50,
                value: 75000000,
                date: \'2024-01-15\',
                status: \'completed\'
            },
            {
                id: \'LH002\',
                supplier: \'Apple Inc.\',
                product: \'iPhone 15 Pro Max\',
                quantity: 30,
                value: 120000000,
                date: \'2024-01-14\',
                status: \'pending\'
            },
            {
                id: \'LH003\',
                supplier: \'Xiaomi Corp.\',
                product: \'Redmi Note 13 Pro\',
                quantity: 100,
                value: 45000000,
                date: \'2024-01-13\',
                status: \'completed\'
            },
            {
                id: \'LH004\',
                supplier: \'Sony Corporation\',
                product: \'WH-1000XM5\',
                quantity: 25,
                value: 18750000,
                date: \'2024-01-12\',
                status: \'pending\'
            },
            {
                id: \'LH005\',
                supplier: \'Samsung Electronics\',
                product: \'Galaxy Watch 6\',
                quantity: 40,
                value: 32000000,
                date: \'2024-01-11\',
                status: \'completed\'
            },
            {
                id: \'LH006\',
                supplier: \'Apple Inc.\',
                product: \'MacBook Pro M3\',
                quantity: 15,
                value: 90000000,
                date: \'2024-01-10\',
                status: \'pending\'
            },
            {
                id: \'LH007\',
                supplier: \'Xiaomi Corp.\',
                product: \'Mi Band 8\',
                quantity: 200,
                value: 30000000,
                date: \'2024-01-09\',
                status: \'completed\'
            },
            {
                id: \'LH008\',
                supplier: \'Sony Corporation\',
                product: \'PlayStation 5\',
                quantity: 20,
                value: 60000000,
                date: \'2024-01-08\',
                status: \'completed\'
            },
            {
                id: \'LH009\',
                supplier: \'Samsung Electronics\',
                product: \'Galaxy Tab S9\',
                quantity: 35,
                value: 42000000,
                date: \'2024-01-07\',
                status: \'pending\'
            },
            {
                id: \'LH010\',
                supplier: \'Apple Inc.\',
                product: \'iPad Pro 12.9\',
                quantity: 25,
                value: 75000000,
                date: \'2024-01-06\',
                status: \'completed\'
            },
            {
                id: \'LH011\',
                supplier: \'Xiaomi Corp.\',
                product: \'Redmi Buds 4\',
                quantity: 150,
                value: 22500000,
                date: \'2024-01-05\',
                status: \'pending\'
            },
            {
                id: \'LH012\',
                supplier: \'Sony Corporation\',
                product: \'Alpha A7 IV\',
                quantity: 10,
                value: 65000000,
                date: \'2024-01-04\',
                status: \'completed\'
            },
            {
                id: \'LH013\',
                supplier: \'Samsung Electronics\',
                product: \'Galaxy Buds2 Pro\',
                quantity: 80,
                value: 24000000,
                date: \'2024-01-03\',
                status: \'completed\'
            },
            {
                id: \'LH014\',
                supplier: \'Apple Inc.\',
                product: \'Apple Watch Series 9\',
                quantity: 45,
                value: 54000000,
                date: \'2024-01-02\',
                status: \'pending\'
            },
            {
                id: \'LH015\',
                supplier: \'Xiaomi Corp.\',
                product: \'Xiaomi 13 Ultra\',
                quantity: 60,
                value: 72000000,
                date: \'2024-01-01\',
                status: \'completed\'
            }
        ];

        function formatCurrency(amount) {
            return new Intl.NumberFormat(\'vi-VN\', {
                style: \'currency\',
                currency: \'VND\'
            }).format(amount);
        }

        function updateStatsCards() {
            // Calculate stats from current shipments data
            const totalShipments = shipments.length;
            const completedShipments = shipments.filter(s => s.status === \'completed\').length;
            const pendingShipments = shipments.filter(s => s.status === \'pending\').length;
            const totalValue = shipments.reduce((sum, s) => sum + s.value, 0);
            
            // Update the DOM elements
            const statsElements = document.querySelectorAll(\'.text-2xl.font-semibold.text-gray-900\');
            if (statsElements.length >= 4) {
                statsElements[0].textContent = totalShipments;
                statsElements[1].textContent = completedShipments;
                statsElements[2].textContent = pendingShipments;
                statsElements[3].textContent = formatValueShort(totalValue);
            }
        }

        function formatValueShort(value) {
            if (value >= 1000000000) {
                return (value / 1000000000).toFixed(1) + \'B VNĐ\';
            } else if (value >= 1000000) {
                return (value / 1000000).toFixed(1) + \'M VNĐ\';
            } else if (value >= 1000) {
                return (value / 1000).toFixed(1) + \'K VNĐ\';
            }
            return value + \' VNĐ\';
        }

        function formatDate(dateString) {
            return new Date(dateString).toLocaleDateString(\'vi-VN\');
        }

        function getStatusBadge(status) {
            const statusMap = {
                \'pending\': { class: \'bg-yellow-100 text-yellow-800\', text: \'Đang chờ\' },
                \'completed\': { class: \'bg-green-100 text-green-800\', text: \'Đã nhập kho\' },
                \'cancelled\': { class: \'bg-red-100 text-red-800\', text: \'Đã hủy\' }
            };
            
            const statusInfo = statusMap[status] || statusMap[\'pending\'];
            return `<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusInfo.class}">${statusInfo.text}</span>`;
        }

        function applyFilters() {
            // Get current filter values
            currentFilters.search = document.getElementById(\'searchInput\').value.toLowerCase();
            currentFilters.status = document.getElementById(\'statusFilter\').value;
            currentFilters.supplier = document.getElementById(\'supplierFilter\').value;
            
            // Filter shipments
            filteredShipments = shipments.filter(shipment => {
                // Search filter
                const matchesSearch = !currentFilters.search || 
                    shipment.id.toLowerCase().includes(currentFilters.search) ||
                    shipment.supplier.toLowerCase().includes(currentFilters.search) ||
                    shipment.product.toLowerCase().includes(currentFilters.search);
                
                // Status filter
                const matchesStatus = !currentFilters.status || shipment.status === currentFilters.status;
                
                // Supplier filter
                const matchesSupplier = !currentFilters.supplier || shipment.supplier === currentFilters.supplier;
                
                return matchesSearch && matchesStatus && matchesSupplier;
            });
            
            // Reset to first page when filters change
            currentPage = 1;
            
            // Render with pagination
            renderShipmentsWithPagination();
        }

        function renderShipments(shipmentsToRender = shipments) {
            const tbody = document.getElementById(\'shipmentTable\');
            tbody.innerHTML = shipmentsToRender.map(shipment => `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" class="shipment-checkbox text-blue-600 focus:ring-blue-500 w-4 h-4" value="${shipment.id}" ${currentFilters.selectedItems.has(shipment.id) ? \'checked\' : \'\'} onchange="updateSelectedCount()">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${shipment.id}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${shipment.supplier}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${shipment.product}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${shipment.quantity}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${formatCurrency(shipment.value)}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${formatDate(shipment.date)}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${getStatusBadge(shipment.status)}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button onclick="viewShipment(\'${shipment.id}\')" class="text-blue-600 hover:text-blue-900 mr-3">Xem</button>
                        <button onclick="editShipment(\'${shipment.id}\')" class="text-indigo-600 hover:text-indigo-900 mr-3">Sửa</button>
                        <button onclick="deleteShipment(\'${shipment.id}\')" class="text-red-600 hover:text-red-900">Xóa</button>
                    </td>
                </tr>
            `).join(\'\');
        }
        
        function renderShipmentsWithPagination() {
            // Calculate pagination
            const totalItems = filteredShipments.length;
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = Math.min(startIndex + itemsPerPage, totalItems);
            
            // Get current page items
            const currentPageItems = filteredShipments.slice(startIndex, endIndex);
            
            // Render table
            renderShipments(currentPageItems);
            
            // Update pagination info
            updatePaginationInfo(startIndex + 1, endIndex, totalItems);
            
            // Render pagination controls
            renderPaginationControls(totalPages);
        }
        
        function updatePaginationInfo(start, end, total) {
            document.getElementById(\'startRecord\').textContent = total > 0 ? start : 0;
            document.getElementById(\'endRecord\').textContent = end;
            document.getElementById(\'totalRecords\').textContent = total;
        }
        
        function renderPaginationControls(totalPages) {
            const nav = document.getElementById(\'paginationNav\');
            let paginationHTML = \'\';
            
            // Previous button
            paginationHTML += `
                <button onclick="changePage(${currentPage - 1})" 
                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 ${currentPage === 1 ? \'opacity-50 cursor-not-allowed\' : \'\'}" 
                        ${currentPage === 1 ? \'disabled\' : \'\'}>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Trước</span>
                </button>
            `;
            
            // Page numbers
            const maxVisiblePages = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
            
            // Adjust start page if we\'re near the end
            if (endPage - startPage < maxVisiblePages - 1) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }
            
            // First page and ellipsis
            if (startPage > 1) {
                paginationHTML += `
                    <button onclick="changePage(1)" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">1</button>
                `;
                if (startPage > 2) {
                    paginationHTML += `<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>`;
                }
            }
            
            // Page numbers
            for (let i = startPage; i <= endPage; i++) {
                const isActive = i === currentPage;
                paginationHTML += `
                    <button onclick="changePage(${i})" 
                            class="${isActive ? \'bg-blue-50 border-blue-500 text-blue-600\' : \'bg-white border-gray-300 text-gray-500 hover:bg-gray-50\'} relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                        ${i}
                    </button>
                `;
            }
            
            // Last page and ellipsis
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    paginationHTML += `<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>`;
                }
                paginationHTML += `
                    <button onclick="changePage(${totalPages})" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">${totalPages}</button>
                `;
            }
            
            // Next button
            paginationHTML += `
                <button onclick="changePage(${currentPage + 1})" 
                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 ${currentPage === totalPages ? \'opacity-50 cursor-not-allowed\' : \'\'}" 
                        ${currentPage === totalPages ? \'disabled\' : \'\'}>
                    <span class="sr-only">Sau</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            `;
            
            nav.innerHTML = paginationHTML;
            
            // Update mobile buttons
            const prevBtnMobile = document.getElementById(\'prevBtnMobile\');
            const nextBtnMobile = document.getElementById(\'nextBtnMobile\');
            
            if (prevBtnMobile && nextBtnMobile) {
                prevBtnMobile.disabled = currentPage === 1;
                nextBtnMobile.disabled = currentPage === totalPages;
                
                if (currentPage === 1) {
                    prevBtnMobile.classList.add(\'opacity-50\', \'cursor-not-allowed\');
                } else {
                    prevBtnMobile.classList.remove(\'opacity-50\', \'cursor-not-allowed\');
                }
                
                if (currentPage === totalPages) {
                    nextBtnMobile.classList.add(\'opacity-50\', \'cursor-not-allowed\');
                } else {
                    nextBtnMobile.classList.remove(\'opacity-50\', \'cursor-not-allowed\');
                }
            }
        }
        
        function changePage(newPage) {
            const totalPages = Math.ceil(filteredShipments.length / itemsPerPage);
            
            if (newPage < 1 || newPage > totalPages) {
                return;
            }
            
            currentPage = newPage;
            renderShipmentsWithPagination();
            
            // Scroll to top of table
            document.querySelector(\'.bg-white.rounded-lg.shadow-sm.border.border-gray-200.overflow-hidden\').scrollIntoView({ 
                behavior: \'smooth\', 
                block: \'start\' 
            });
        }

        function openAddModal() {
            document.getElementById(\'addModal\').classList.remove(\'hidden\');
            document.getElementById(\'addModal\').classList.add(\'fade-in\');
        }

        function closeAddModal() {
            document.getElementById(\'addModal\').classList.add(\'hidden\');
            document.getElementById(\'addModal\').classList.remove(\'fade-in\');
        }

        function addShipment(event) {
            event.preventDefault();
            
            const newShipment = {
                id: document.getElementById(\'shipmentCode\').value,
                supplier: document.getElementById(\'supplier\').value,
                product: document.getElementById(\'product\').value,
                quantity: parseInt(document.getElementById(\'quantity\').value),
                value: parseInt(document.getElementById(\'value\').value),
                date: document.getElementById(\'expectedDate\').value,
                status: \'pending\'
            };
            
            shipments.push(newShipment);
            
            // Update stats cards
            updateStatsCards();
            
            // Re-apply filters and render
            applyFilters();
            
            closeAddModal();
            
            // Reset form
            event.target.reset();
            
            // Show success message
            alert(\'Đã thêm lô hàng mới thành công!\');
        }

        function viewShipment(id) {
            const shipment = shipments.find(s => s.id === id);
            if (shipment) {
                const statusText = shipment.status === \'pending\' ? \'Đang chờ\' : shipment.status === \'completed\' ? \'Đã nhập kho\' : \'Đã hủy\';
                
                const detailHtml = `
                    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" id="viewModal">
                        <div class="relative top-20 mx-auto p-6 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-lg bg-white">
                            <div class="flex items-start justify-between mb-6">
                                <h3 class="text-xl font-bold text-gray-900">Chi tiết lô hàng ${id}</h3>
                                <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600 p-1">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Mã lô hàng</label>
                                        <p class="mt-1 text-sm text-gray-900 font-semibold">${shipment.id}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nhà cung cấp</label>
                                        <p class="mt-1 text-sm text-gray-900">${shipment.supplier}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Sản phẩm</label>
                                        <p class="mt-1 text-sm text-gray-900">${shipment.product}</p>
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Số lượng</label>
                                        <p class="mt-1 text-sm text-gray-900">${shipment.quantity}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Giá trị</label>
                                        <p class="mt-1 text-sm text-gray-900 font-semibold text-green-600">${formatCurrency(shipment.value)}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Ngày nhập</label>
                                        <p class="mt-1 text-sm text-gray-900">${formatDate(shipment.date)}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700">Trạng thái</label>
                                <div class="mt-1">${getStatusBadge(shipment.status)}</div>
                            </div>
                            
                            <div class="mt-8 flex justify-end space-x-3">
                                <button onclick="closeViewModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Đóng</button>
                                <button onclick="closeViewModal(); editShipment(\'${id}\')" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Chỉnh sửa</button>
                            </div>
                        </div>
                    </div>
                `;
                
                document.body.insertAdjacentHTML(\'beforeend\', detailHtml);
            }
        }

        function closeViewModal() {
            const modal = document.getElementById(\'viewModal\');
            if (modal) {
                modal.remove();
            }
        }

        function editShipment(id) {
            const shipment = shipments.find(s => s.id === id);
            if (!shipment) return;
            
            const editHtml = `
                <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" id="editModal">
                    <div class="relative top-10 mx-auto p-6 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-lg bg-white">
                        <div class="flex items-start justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Chỉnh sửa lô hàng ${id}</h3>
                            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 p-1">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <form onsubmit="updateShipment(event, \'${id}\')" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Mã lô hàng</label>
                                    <input type="text" id="editShipmentCode" value="${shipment.id}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-100" readonly>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nhà cung cấp</label>
                                    <select id="editSupplier" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                        <option value="Samsung Electronics" ${shipment.supplier === \'Samsung Electronics\' ? \'selected\' : \'\'}>Samsung Electronics</option>
                                        <option value="Apple Inc." ${shipment.supplier === \'Apple Inc.\' ? \'selected\' : \'\'}>Apple Inc.</option>
                                        <option value="Xiaomi Corp." ${shipment.supplier === \'Xiaomi Corp.\' ? \'selected\' : \'\'}>Xiaomi Corp.</option>
                                        <option value="Sony Corporation" ${shipment.supplier === \'Sony Corporation\' ? \'selected\' : \'\'}>Sony Corporation</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Sản phẩm</label>
                                    <input type="text" id="editProduct" value="${shipment.product}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Số lượng</label>
                                    <input type="number" id="editQuantity" value="${shipment.quantity}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Giá trị (VNĐ)</label>
                                    <input type="number" id="editValue" value="${shipment.value}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Ngày nhập</label>
                                    <input type="date" id="editDate" value="${shipment.date}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Trạng thái</label>
                                    <select id="editStatus" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                        <option value="pending" ${shipment.status === \'pending\' ? \'selected\' : \'\'}>Đang chờ</option>
                                        <option value="completed" ${shipment.status === \'completed\' ? \'selected\' : \'\'}>Đã nhập kho</option>
                                        <option value="cancelled" ${shipment.status === \'cancelled\' ? \'selected\' : \'\'}>Đã hủy</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="flex justify-end space-x-3 pt-6">
                                <button type="button" onclick="closeEditModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Hủy</button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            `;
            
            document.body.insertAdjacentHTML(\'beforeend\', editHtml);
        }

        function closeEditModal() {
            const modal = document.getElementById(\'editModal\');
            if (modal) {
                modal.remove();
            }
        }

        function updateShipment(event, id) {
            event.preventDefault();
            
            const shipmentIndex = shipments.findIndex(s => s.id === id);
            if (shipmentIndex === -1) return;
            
            // Update shipment data
            shipments[shipmentIndex] = {
                ...shipments[shipmentIndex],
                supplier: document.getElementById(\'editSupplier\').value,
                product: document.getElementById(\'editProduct\').value,
                quantity: parseInt(document.getElementById(\'editQuantity\').value),
                value: parseInt(document.getElementById(\'editValue\').value),
                date: document.getElementById(\'editDate\').value,
                status: document.getElementById(\'editStatus\').value
            };
            
            // Update stats cards
            updateStatsCards();
            
            // Re-apply filters and render
            applyFilters();
            
            // Close modal
            closeEditModal();
            
            // Show success message
            alert(`Đã cập nhật lô hàng ${id} thành công!`);
        }

        function deleteShipment(id) {
            // Find the shipment to get its details for confirmation
            const shipment = shipments.find(s => s.id === id);
            if (!shipment) {
                alert(\'Không tìm thấy lô hàng để xóa!\');
                return;
            }
            
            // Show detailed confirmation
            const confirmMessage = `Bạn có chắc chắn muốn xóa lô hàng này?\n\n` +
                                 `Mã lô hàng: ${shipment.id}\n` +
                                 `Sản phẩm: ${shipment.product}\n` +
                                 `Nhà cung cấp: ${shipment.supplier}\n` +
                                 `Số lượng: ${shipment.quantity}\n\n` +
                                 `⚠️ Hành động này không thể hoàn tác!`;
            
            if (confirm(confirmMessage)) {
                // Find and remove shipment from array
                const index = shipments.findIndex(s => s.id === id);
                if (index > -1) {
                    // Remove shipment from main array
                    shipments.splice(index, 1);
                    
                    // Remove from selected items if it was selected
                    currentFilters.selectedItems.delete(id);
                    
                    // Update stats cards
                    updateStatsCards();
                    
                    // Re-apply current filters to update the display
                    applyFilters();
                    
                    // Show success message
                    alert(`Đã xóa lô hàng ${id} thành công!`);
                } else {
                    alert(\'Có lỗi xảy ra khi xóa lô hàng. Vui lòng thử lại!\');
                }
            }
        }
        
        function showSuccessNotification(message) {
            // Create notification element
            const notification = document.createElement(\'div\');
            notification.className = \'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 fade-in\';
            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    ${message}
                </div>
            `;
            
            // Add to page
            document.body.appendChild(notification);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.opacity = \'0\';
                notification.style.transform = \'translateX(100%)\';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        function toggleSelectAll() {
            const selectAllCheckbox = document.getElementById(\'selectAll\');
            const shipmentCheckboxes = document.querySelectorAll(\'.shipment-checkbox\');
            
            shipmentCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
                if (selectAllCheckbox.checked) {
                    currentFilters.selectedItems.add(checkbox.value);
                } else {
                    currentFilters.selectedItems.delete(checkbox.value);
                }
            });
            
            updateSelectedCount();
        }

        function updateSelectedCount() {
            // Update selected items set
            currentFilters.selectedItems.clear();
            const selectedCheckboxes = document.querySelectorAll(\'.shipment-checkbox:checked\');
            selectedCheckboxes.forEach(checkbox => {
                currentFilters.selectedItems.add(checkbox.value);
            });
            
            const count = selectedCheckboxes.length;
            document.getElementById(\'selectedCustomers\').textContent = count;
            
            // Update select all checkbox state
            const selectAllCheckbox = document.getElementById(\'selectAll\');
            const allCheckboxes = document.querySelectorAll(\'.shipment-checkbox\');
            
            if (count === 0) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = false;
            } else if (count === allCheckboxes.length) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = true;
            } else {
                selectAllCheckbox.indeterminate = true;
            }
            
            updatePreviewInfo();
        }

        function openExportModal() {
            document.getElementById(\'exportModal\').classList.remove(\'hidden\');
            document.getElementById(\'exportModal\').classList.add(\'fade-in\');
            
            // Update counts in modal
            document.getElementById(\'totalCustomers\').textContent = filteredShipments.length;
            
            // Calculate current page items
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = Math.min(startIndex + itemsPerPage, filteredShipments.length);
            const currentPageCount = endIndex - startIndex;
            document.getElementById(\'currentCustomers\').textContent = currentPageCount;
            
            updatePreviewInfo();
        }

        function closeExportModal() {
            document.getElementById(\'exportModal\').classList.add(\'hidden\');
            document.getElementById(\'exportModal\').classList.remove(\'fade-in\');
        }

        function selectAllColumns() {
            const checkboxes = document.querySelectorAll(\'input[name="columns"]\');
            checkboxes.forEach(cb => cb.checked = true);
            updatePreviewInfo();
        }

        function deselectAllColumns() {
            const checkboxes = document.querySelectorAll(\'input[name="columns"]\');
            checkboxes.forEach(cb => cb.checked = false);
            updatePreviewInfo();
        }

        function resetExportSettings() {
            // Reset file format
            document.querySelector(\'input[name="fileFormat"][value="xlsx"]\').checked = true;
            
            // Reset data range
            document.querySelector(\'input[name="dataRange"][value="all"]\').checked = true;
            
            // Reset columns
            selectAllColumns();
            
            // Reset file settings
            document.getElementById(\'fileName\').value = \'danh-sach-lo-hang\';
            document.getElementById(\'includeTimestamp\').checked = true;
            document.getElementById(\'includeHeader\').checked = true;
            
            // Reset export options
            document.getElementById(\'formatNumbers\').checked = true;
            document.getElementById(\'formatDates\').checked = true;
            document.getElementById(\'autoWidth\').checked = true;
            document.getElementById(\'freezeHeader\').checked = false;
            
            updatePreviewInfo();
        }

        function updatePreviewInfo() {
            const selectedColumns = document.querySelectorAll(\'input[name="columns"]:checked\');
            const fileFormat = document.getElementById(\'fileFormat\').value;
            const dataRange = document.querySelector(\'input[name="dataRange"]:checked\')?.value || \'all\';
            
            let recordCount = 0;
            if (dataRange === \'all\') {
                recordCount = filteredShipments.length;
            } else if (dataRange === \'current\') {
                // Calculate current page items count
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = Math.min(startIndex + itemsPerPage, filteredShipments.length);
                recordCount = endIndex - startIndex;
            } else if (dataRange === \'selected\') {
                recordCount = document.querySelectorAll(\'.shipment-checkbox:checked\').length;
            }
            
            const columnCount = selectedColumns.length;
            
            document.getElementById(\'previewCustomers\').textContent = recordCount;
            document.getElementById(\'previewColumns\').textContent = columnCount;
            document.getElementById(\'previewFormat\').textContent = fileFormat === \'xlsx\' ? \'Excel (.xlsx)\' : \'CSV (.csv)\';
        }

        function processExport() {
            // Get export settings
            const fileFormat = document.getElementById('fileFormat').value || 'xlsx';
            const dataRange = document.querySelector('input[name="dataRange"]:checked')?.value || 'all';
            const selectedColumns = Array.from(document.querySelectorAll('input[name="columns"]:checked')).map(cb => cb.value) || ['code', 'supplier', 'product', 'quantity', 'value', 'date', 'status'];
            const fileName = document.getElementById('fileName').value || 'danh-sach-lo-hang';
            const includeTimestamp = document.getElementById('includeTimestamp')?.checked || true;
            const includeHeader = document.getElementById('includeHeader')?.checked || true;
            const includeStats = document.getElementById('includeStats')?.checked || false;
            const exportTime = document.getElementById('exportTime').value || '{{ now()->format('H:i d/m/Y') }}';

            if (selectedColumns.length === 0) {
                alert('Vui lòng chọn ít nhất một cột để xuất!');
                return;
            }

            let dataToExport = [];
            if (dataRange === 'all') {
                dataToExport = [...filteredShipments];
            } else if (dataRange === 'current') {
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = Math.min(startIndex + itemsPerPage, filteredShipments.length);
                dataToExport = filteredShipments.slice(startIndex, endIndex);
            } else if (dataRange === 'selected') {
                const selectedIds = Array.from(document.querySelectorAll('.shipment-checkbox:checked')).map(cb => cb.value);
                dataToExport = filteredShipments.filter(shipment => selectedIds.includes(shipment.id));
            }

            if (dataToExport.length === 0) {
                alert('Không có dữ liệu để xuất!');
                return;
            }

            const headers = selectedColumns.map(col => ({
                'id': 'Mã lô hàng',
                'supplier': 'Nhà cung cấp',
                'product': 'Sản phẩm',
                'quantity': 'Số lượng',
                'value': 'Giá trị',
                'date': 'Ngày nhập',
                'status': 'Trạng thái'
            }[col]));

            const rows = dataToExport.map(shipment => {
                return selectedColumns.map(col => {
                    let value = shipment[col];
                    if (col === 'value') value = formatCurrency(value);
                    else if (col === 'date') value = formatDate(value);
                    else if (col === 'status') value = value === 'pending' ? 'Đang chờ' : value === 'completed' ? 'Đã nhập kho' : 'Đã hủy';
                    return value;
                });
            });

            let finalFileName = fileName;
            if (includeTimestamp) {
                finalFileName += `-${exportTime.replace(/[:/]/g, '-')}`;
            }
            finalFileName += `.${fileFormat}`;

            let content = [];
            if (includeStats) {
                content.push('=== THỐNG KÊ TỔNG QUAN ===');
                content.push(`Tổng số lô hàng: ${dataToExport.length}`);
                content.push(`Ngày xuất: ${exportTime}`);
                content.push('');
            }
            if (includeHeader) content.push(headers.join(','));
            content.push(...rows.map(row => row.map(cell => typeof cell === 'string' && cell.includes(',') ? `"${cell}"` : cell).join(',')));
            const finalContent = '\uFEFF' + content.join('\n');

            const mimeType = fileFormat === 'xlsx' ? 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' : 'text/csv;charset=utf-8;';
            const blob = new Blob([finalContent], { type: mimeType });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = finalFileName;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);

    closeExportModal();
    setTimeout(() => alert(`Đã xuất file ${fileFormat.toUpperCase()} thành công!\nFile: ${finalFileName}\nSố lô hàng: ${dataToExport.length}\nSố cột: ${selectedColumns.length}`), 100);
}



        // Initialize the page
        document.addEventListener(\'DOMContentLoaded\', function() {
            // Initialize filtered shipments with all data
            filteredShipments = [...shipments];
            
            // Update stats cards with initial data
            updateStatsCards();
            
            // Render with pagination
            renderShipmentsWithPagination();
            
            // Add event listeners for real-time preview updates
            document.addEventListener(\'change\', function(e) {
                if (e.target.name === \'columns\' || e.target.id === \'fileFormat\' || e.target.name === \'dataRange\') {
                    updatePreviewInfo();
                }
            });
        });
    </script>
</div>
</html>
@endsection