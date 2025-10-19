@extends('admin.layout')
@section('title', 'Bảo hành')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Quản lý Bảo hành & Lịch hẹn</h1>
            <p class="text-gray-600">Theo dõi và quản lý các yêu cầu bảo hành và lịch hẹn khách hàng</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-600">Tổng yêu cầu</p>
                        <!-- <p class="text-2xl font-bold text-gray-900">247</p> -->
                        <p class="text-2xl font-bold text-gray-900">{{ $total }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-600">Đang xử lý</p>
                        <!-- <p class="text-2xl font-bold text-gray-900">32</p> -->
                        <p class="text-2xl font-bold text-gray-900">{{ $processing }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-600">Hoàn thành</p>
                        <!-- <p class="text-2xl font-bold text-gray-900">198</p> -->
                        <p class="text-2xl font-bold text-gray-900">{{ $completed }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-600">Lịch hẹn hôm nay</p>
                        <!-- <p class="text-2xl font-bold text-gray-900">8</p> -->
                        <p class="text-2xl font-bold text-gray-900">{{ $appointments_today ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-6">
                    <button onclick="switchTab(\'warranty\')" id="warranty-tab" class="tab-active py-4 px-1 border-b-2 border-transparent font-medium text-sm">
                        🔧 Quản lý Bảo hành
                    </button>
                    <button onclick="switchTab(\'appointments\')" id="appointments-tab" class="py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700">
                        📅 Lịch hẹn
                    </button>
                </nav>
            </div>
        </div>

        <!-- Warranty Management Tab -->
        <div id="warranty-content" class="tab-content">
            <div class="bg-white rounded-lg shadow-sm">
                <!-- Filters and Search -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" placeholder="Tìm kiếm theo mã đơn, khách hàng..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" onkeypress="if(event.key===\'Enter\') applyFilters()">
                        </div>
                        <select id="status-filter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" onchange="applyFilters()">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending">Chờ xử lý</option>
                            <option value="processing">Đang xử lý</option>
                            <option value="completed">Hoàn thành</option>
                            <option value="cancelled">Đã hủy</option>
                        </select>
                        <select id="product-filter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" onchange="applyFilters()">
                            <option value="">Tất cả sản phẩm</option>
                            <option value="phone">Điện thoại</option>
                            <option value="laptop">Laptop</option>
                            <option value="headphone">Tai nghe</option>
                            <option value="accessory">Phụ kiện</option>
                        </select>
                        <button onclick="applyFilters()" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            Tìm kiếm
                        </button>
                        <button onclick="showExportModal()" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors flex items-center">
                            📊 Xuất Excel
                        </button>
                    </div>
                </div>

                <!-- Warranty List -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" id="select-all" onchange="toggleSelectAll()" class="text-blue-600 focus:ring-blue-500">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã yêu cầu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách hàng</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vấn đề</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tạo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                            </tr>
                        </thead>
                        <!-- <tbody class="bg-white divide-y divide-gray-200" id="warranty-list">
                            Warranty items will be populated here
                        </tbody> -->
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($warranties as $w)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $w->warranty_id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $w->order_item_id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $w->product_serial }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($w->start_date)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($w->end_date)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if($w->status == 'active') bg-green-100 text-green-800
                                        @elseif($w->status == 'claimed') bg-yellow-100 text-yellow-800
                                        @elseif($w->status == 'expired') bg-gray-200 text-gray-800
                                        @else bg-blue-100 text-blue-800
                                        @endif">
                                        {{ ucfirst($w->status) }}
                                    </span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $w->service_center }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $w->notes }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Hiển thị <span class="font-medium">1</span> đến <span class="font-medium">10</span> của <span class="font-medium">97</span> kết quả
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50">Trước</button>
                        <button class="px-3 py-1 bg-blue-600 text-white rounded text-sm">1</button>
                        <button class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50">2</button>
                        <button class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50">3</button>
                        <button class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50">Sau</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointments Tab -->
        <div id="appointments-content" class="tab-content hidden">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Calendar -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Lịch hẹn tháng 10/2024</h3>
                        <div class="flex space-x-2">
                            <button onclick="previousMonth()" class="p-2 hover:bg-gray-100 rounded">←</button>
                            <button onclick="nextMonth()" class="p-2 hover:bg-gray-100 rounded">→</button>
                        </div>
                    </div>
                    <div class="grid grid-cols-7 gap-1 mb-4">
                        <div class="text-center text-sm font-medium text-gray-500 py-2">CN</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">T2</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">T3</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">T4</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">T5</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">T6</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">T7</div>
                    </div>
                    <div class="grid grid-cols-7 gap-1" id="calendar-grid">
                        <!-- Calendar days will be populated here -->
                    </div>
                </div>

                <!-- Today\'s Appointments -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Lịch hẹn hôm nay</h3>
                    <div class="space-y-4" id="today-appointments">
                        <!-- Today\'s appointments will be populated here -->
                    </div>
                    <button class="w-full mt-4 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors" onclick="showAddAppointmentModal()">
                        + Thêm lịch hẹn
                    </button>
                </div>
            </div>

            <!-- Upcoming Appointments -->
            <div class="mt-6 bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Lịch hẹn sắp tới</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách hàng</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dịch vụ</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày & Giờ</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="appointments-list">
                            <!-- Appointments will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Excel Modal -->
    <div id="export-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg w-full max-w-4xl mx-4 max-h-[90vh] overflow-y-auto">
            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Xuất dữ liệu Excel</h3>
                        <p class="text-sm text-gray-600">Tùy chỉnh dữ liệu xuất theo nhu cầu</p>
                    </div>
                </div>
                <button onclick="hideExportModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Export Range -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Phạm vi xuất</h4>
                            <div class="space-y-3">
                                <label class="flex items-center">
                                    <input type="radio" name="export-range" value="all" checked class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Tất cả khách hàng (247 yêu cầu)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="export-range" value="current" class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Trang hiện tại (10 yêu cầu)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="export-range" value="selected" class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Yêu cầu đã chọn (<span id="selected-count">0</span> yêu cầu)</span>
                                </label>
                            </div>
                        </div>

                        <!-- File Format & Name -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Định dạng file</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option>Excel (.xlsx)</option>
                                    <option>CSV (.csv)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tên file</label>
                                <input type="text" value="danh-sach-bao-hanh" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <p class="text-xs text-gray-500 mt-1">Tên file sẽ được thêm ngày tháng tự động</p>
                            </div>
                        </div>

                        <!-- Filter by Status -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Lọc theo trạng thái</h4>
                            <div class="space-y-3">
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Chờ xử lý</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Đang xử lý</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Hoàn thành</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Đã hủy</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Column Selection -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Chọn cột xuất</h4>
                            <div class="max-h-64 overflow-y-auto border border-gray-200 rounded-lg p-4">
                                <div class="space-y-3">
                                    <label class="flex items-center">
                                        <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Mã yêu cầu</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Tên khách hàng</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Số điện thoại</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Sản phẩm</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Địa chỉ</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Vấn đề</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Mức độ ưu tiên</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Trạng thái</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Ngày tạo</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Ghi chú</span>
                                    </label>
                                </div>
                            </div>
                            <div class="flex space-x-3 mt-3">
                                <button onclick="selectAllColumns()" class="text-sm text-blue-600 hover:text-blue-800">Chọn tất cả</button>
                                <button onclick="deselectAllColumns()" class="text-sm text-gray-600 hover:text-gray-800">Bỏ chọn tất cả</button>
                            </div>
                        </div>

                        <!-- Additional Options -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Tùy chọn bổ sung</h4>
                            <div class="space-y-3">
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Bao gồm tiêu đề cột</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Thêm thời gian xuất</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Thêm thống kê tổng quan</span>
                                </label>
                            </div>
                        </div>

                        <!-- Preview -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h5 class="font-medium text-gray-900 mb-2">Xem trước thông tin xuất</h5>
                            <div class="text-sm text-gray-600 space-y-1">
                                <p>Sẽ xuất: <span class="font-medium">247 yêu cầu bảo hành</span></p>
                                <p>Định dạng: <span class="font-medium">Excel (.xlsx)</span></p>
                                <p>Cột: <span class="font-medium">8 cột</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                    <p class="text-sm text-gray-500 flex items-center">
                        📎 File sẽ được tải xuống tự động
                    </p>
                    <div class="flex space-x-3">
                        <button onclick="hideExportModal()" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Hủy
                        </button>
                        <button onclick="exportExcel()" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center">
                            Xuất Excel
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Warranty Detail Modal -->
    <div id="warranty-detail-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Chi tiết yêu cầu bảo hành</h3>
                        <p class="text-sm text-gray-600" id="warranty-detail-id">Mã: BH001</p>
                    </div>
                </div>
                <button onclick="hideWarrantyDetailModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Customer Information -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 border-b pb-2">Thông tin khách hàng</h4>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tên khách hàng</label>
                            <p class="mt-1 text-sm text-gray-900" id="detail-customer">Nguyễn Văn A</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                            <p class="mt-1 text-sm text-gray-900" id="detail-phone">0901234567</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Địa chỉ</label>
                            <p class="mt-1 text-sm text-gray-900" id="detail-address">123 Đường ABC, Quận 1, TP.HCM</p>
                        </div>
                    </div>
                    
                    <!-- Product Information -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 border-b pb-2">Thông tin sản phẩm</h4>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sản phẩm</label>
                            <p class="mt-1 text-sm text-gray-900" id="detail-product">iPhone 14 Pro</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Serial Number</label>
                            <p class="mt-1 text-sm text-gray-900" id="detail-serial">F2LMQXYZ1234</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ngày mua</label>
                            <p class="mt-1 text-sm text-gray-900" id="detail-purchase-date">15/06/2024</p>
                        </div>
                    </div>
                </div>
                
                <!-- Issue Information -->
                <div class="mt-6 space-y-4">
                    <h4 class="text-lg font-semibold text-gray-900 border-b pb-2">Thông tin vấn đề</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Vấn đề</label>
                            <p class="mt-1 text-sm text-gray-900" id="detail-issue">Màn hình bị vỡ</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mức độ ưu tiên</label>
                            <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full" id="detail-priority">Cao</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mô tả chi tiết</label>
                        <p class="mt-1 text-sm text-gray-900 bg-gray-50 p-3 rounded-lg" id="detail-description">Khách hàng làm rơi điện thoại, màn hình bị nứt</p>
                    </div>
                </div>
                
                <!-- Status and Timeline -->
                <div class="mt-6 space-y-4">
                    <h4 class="text-lg font-semibold text-gray-900 border-b pb-2">Trạng thái & Lịch sử</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Trạng thái hiện tại</label>
                            <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full" id="detail-status">Đang xử lý</span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ngày tạo</label>
                            <p class="mt-1 text-sm text-gray-900" id="detail-date">15/12/2024</p>
                        </div>
                    </div>
                    
                    <!-- Timeline -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Lịch sử xử lý</label>
                        <div class="space-y-3" id="detail-timeline">
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-3"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Yêu cầu được tạo</p>
                                    <p class="text-xs text-gray-500">15/12/2024 - 09:30</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-yellow-500 rounded-full mt-2 mr-3"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Đang kiểm tra sản phẩm</p>
                                    <p class="text-xs text-gray-500">15/12/2024 - 14:15</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center justify-end space-x-3 p-6 border-t border-gray-200">
                <button onclick="hideWarrantyDetailModal()" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Đóng
                </button>
                <button onclick="showUpdateStatusModal()" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Cập nhật trạng thái
                </button>
            </div>
        </div>
    </div>

    <!-- Update Status Modal -->
    <div id="update-status-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg w-full max-w-md mx-4">
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Cập nhật trạng thái</h3>
                <button onclick="hideUpdateStatusModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <form onsubmit="updateWarrantyStatusSubmit(event)">
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mã yêu cầu</label>
                        <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded" id="update-warranty-id">BH001</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái mới</label>
                        <select id="new-status" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Chọn trạng thái</option>
                            <option value="pending">Chờ xử lý</option>
                            <option value="processing">Đang xử lý</option>
                            <option value="completed">Hoàn thành</option>
                            <option value="cancelled">Đã hủy</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ghi chú cập nhật</label>
                        <textarea id="update-notes" rows="3" placeholder="Nhập ghi chú về việc cập nhật trạng thái..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Thời gian ước tính hoàn thành</label>
                        <input type="datetime-local" id="estimated-completion" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                
                <div class="flex items-center justify-end space-x-3 p-6 border-t border-gray-200">
                    <button type="button" onclick="hideUpdateStatusModal()" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Hủy
                    </button>
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Appointment Modal -->
    <div id="appointment-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
            <h3 class="text-lg font-semibold mb-4">Thêm lịch hẹn mới</h3>
            <form onsubmit="addAppointment(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tên khách hàng</label>
                        <input type="text" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                        <input type="tel" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dịch vụ</label>
                        <select required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Chọn dịch vụ</option>
                            <option>Bảo hành sản phẩm</option>
                            <option>Sửa chữa</option>
                            <option>Tư vấn kỹ thuật</option>
                            <option>Kiểm tra định kỳ</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ngày</label>
                            <input type="date" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Giờ</label>
                            <input type="time" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ghi chú</label>
                        <textarea rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                </div>
                <div class="flex space-x-3 mt-6">
                    <button type="button" onclick="hideAddAppointmentModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Hủy
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Thêm lịch hẹn
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Global variables
        let selectedItems = new Set();
        let currentFilters = {
            status: \'\',
            product: \'\',
            search: \'\'
        };

        // Global variables
        let currentWarrantyId = null;

        // Sample data
        // const warrantyData = [
        //     {
        //         id: \'BH001\',
        //         customer: \'Nguyễn Văn A\',
        //         phone: \'0901234567\',
        //         address: \'123 Đường ABC, Quận 1, TP.HCM\',
        //         product: \'iPhone 14 Pro\',
        //         productType: \'phone\',
        //         serial: \'F2LMQXYZ1234\',
        //         purchaseDate: \'2024-06-15\',
        //         issue: \'Màn hình bị vỡ\',
        //         status: \'processing\',
        //         priority: \'high\',
        //         date: \'2024-12-15\',
        //         description: \'Khách hàng làm rơi điện thoại, màn hình bị nứt\',
        //         timeline: [
        //             { action: \'Yêu cầu được tạo\', date: \'2024-12-15\', time: \'09:30\', status: \'completed\' },
        //             { action: \'Đang kiểm tra sản phẩm\', date: \'2024-12-15\', time: \'14:15\', status: \'current\' },
        //             { action: \'Chờ phê duyệt sửa chữa\', date: \'\', time: \'\', status: \'pending\' }
        //         ]
        //     },
        //     {
        //         id: \'BH002\',
        //         customer: \'Trần Thị B\',
        //         phone: \'0912345678\',
        //         address: \'456 Đường DEF, Quận 3, TP.HCM\',
        //         product: \'MacBook Air M2\',
        //         productType: \'laptop\',
        //         serial: \'FVFXM2ABC567\',
        //         purchaseDate: \'2023-11-20\',
        //         issue: \'Pin không sạc\',
        //         status: \'pending\',
        //         priority: \'medium\',
        //         date: \'2024-12-14\',
        //         description: \'Pin không nhận sạc sau 1 năm sử dụng\',
        //         timeline: [
        //             { action: \'Yêu cầu được tạo\', date: \'2024-12-14\', time: \'10:15\', status: \'completed\' }
        //         ]
        //     },
        //     {
        //         id: \'BH003\',
        //         customer: \'Lê Văn C\',
        //         phone: \'0923456789\',
        //         address: \'789 Đường GHI, Quận 7, TP.HCM\',
        //         product: \'AirPods Pro\',
        //         productType: \'headphone\',
        //         serial: \'HWXYZ789DEF\',
        //         purchaseDate: \'2024-03-10\',
        //         issue: \'Mất âm thanh bên trái\',
        //         status: \'completed\',
        //         priority: \'low\',
        //         date: \'2024-12-13\',
        //         description: \'Tai nghe trái không có âm thanh\',
        //         timeline: [
        //             { action: \'Yêu cầu được tạo\', date: \'2024-12-13\', time: \'08:45\', status: \'completed\' },
        //             { action: \'Kiểm tra và thay thế\', date: \'2024-12-13\', time: \'15:30\', status: \'completed\' },
        //             { action: \'Hoàn thành sửa chữa\', date: \'2024-12-13\', time: \'16:45\', status: \'completed\' }
        //         ]
        //     },
        //     {
        //         id: \'BH004\',
        //         customer: \'Phạm Văn D\',
        //         phone: \'0934567890\',
        //         address: \'321 Đường JKL, Quận 5, TP.HCM\',
        //         product: \'iPad Pro\',
        //         productType: \'phone\',
        //         serial: \'DMPQR456GHI\',
        //         purchaseDate: \'2024-08-05\',
        //         issue: \'Màn hình không phản hồi\',
        //         status: \'pending\',
        //         priority: \'high\',
        //         date: \'2024-12-16\',
        //         description: \'Màn hình cảm ứng không hoạt động\',
        //         timeline: [
        //             { action: \'Yêu cầu được tạo\', date: \'2024-12-16\', time: \'11:20\', status: \'completed\' }
        //         ]
        //     },
        //     {
        //         id: \'BH005\',
        //         customer: \'Hoàng Thị E\',
        //         phone: \'0945678901\',
        //         address: \'654 Đường MNO, Quận 2, TP.HCM\',
        //         product: \'Dell XPS 13\',
        //         productType: \'laptop\',
        //         serial: \'DELLXPS13789\',
        //         purchaseDate: \'2023-09-15\',
        //         issue: \'Quạt tản nhiệt ồn\',
        //         status: \'processing\',
        //         priority: \'medium\',
        //         date: \'2024-12-15\',
        //         description: \'Quạt chạy liên tục và có tiếng ồn lớn\',
        //         timeline: [
        //             { action: \'Yêu cầu được tạo\', date: \'2024-12-15\', time: \'13:10\', status: \'completed\' },
        //             { action: \'Đang chẩn đoán vấn đề\', date: \'2024-12-15\', time: \'16:00\', status: \'current\' }
        //         ]
        //     }
        // ];
        const warrantyData = @json($warranties);

        const appointmentsData = [
            {
                id: 1,
                customer: \'Phạm Văn D\',
                phone: \'0934567890\',
                service: \'Bảo hành sản phẩm\',
                date: \'2024-12-16\',
                time: \'09:00\',
                status: \'confirmed\',
                notes: \'Kiểm tra iPad bị lag\'
            },
            {
                id: 2,
                customer: \'Hoàng Thị E\',
                phone: \'0945678901\',
                service: \'Tư vấn kỹ thuật\',
                date: \'2024-12-16\',
                time: \'14:30\',
                status: \'pending\',
                notes: \'Tư vấn nâng cấp laptop\'
            },
            {
                id: 3,
                customer: \'Lê Minh F\',
                phone: \'0956789012\',
                service: \'Sửa chữa\',
                date: \'2024-12-18\',
                time: \'10:00\',
                status: \'confirmed\',
                notes: \'Thay màn hình laptop\'
            },
            {
                id: 4,
                customer: \'Trần Văn G\',
                phone: \'0967890123\',
                service: \'Kiểm tra định kỳ\',
                date: \'2024-12-20\',
                time: \'15:30\',
                status: \'pending\',
                notes: \'Bảo dưỡng máy tính\'
            },
            {
                id: 5,
                customer: \'Nguyễn Thị H\',
                phone: \'0978901234\',
                service: \'Bảo hành sản phẩm\',
                date: \'2025-01-05\',
                time: \'09:30\',
                status: \'confirmed\',
                notes: \'Kiểm tra điện thoại\'
            },
            {
                id: 6,
                customer: \'Pham Văn I\',
                phone: \'0989012345\',
                service: \'Tư vấn kỹ thuật\',
                date: \'2025-01-10\',
                time: \'14:00\',
                status: \'pending\',
                notes: \'Tư vấn mua laptop mới\'
            },
            {
                id: 7,
                customer: \'Hoàng Văn J\',
                phone: \'0990123456\',
                service: \'Sửa chữa\',
                date: \'2024-11-25\',
                time: \'11:00\',
                status: \'confirmed\',
                notes: \'Sửa bàn phím\'
            },
            {
                id: 8,
                customer: \'Nguyễn Văn K\',
                phone: \'0901111111\',
                service: \'Bảo hành sản phẩm\',
                date: \'2024-10-11\',
                time: \'09:30\',
                status: \'confirmed\',
                notes: \'Kiểm tra máy tính\'
            },
            {
                id: 9,
                customer: \'Trần Thị L\',
                phone: \'0902222222\',
                service: \'Tư vấn kỹ thuật\',
                date: \'2024-10-11\',
                time: \'14:00\',
                status: \'pending\',
                notes: \'Tư vấn nâng cấp phần cứng\'
            }
        ];

        // Initialize page
        document.addEventListener(\'DOMContentLoaded\', function() {
            updateStatistics(); // Initialize statistics first
            loadWarrantyData();
            loadAppointmentsData();
            generateCalendar();
            loadTodayAppointments();
        });

        // Tab switching
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll(\'.tab-content\').forEach(content => {
                content.classList.add(\'hidden\');
            });
            
            // Remove active class from all tabs
            document.querySelectorAll(\'[id$="-tab"]\').forEach(tab => {
                tab.classList.remove(\'tab-active\');
                tab.classList.add(\'text-gray-500\', \'hover:text-gray-700\');
            });
            
            // Show selected tab content
            document.getElementById(tabName + \'-content\').classList.remove(\'hidden\');
            
            // Add active class to selected tab
            const activeTab = document.getElementById(tabName + \'-tab\');
            activeTab.classList.add(\'tab-active\');
            activeTab.classList.remove(\'text-gray-500\', \'hover:text-gray-700\');
        }

        // Load warranty data
        function loadWarrantyData() {
            const tbody = document.getElementById(\'warranty-list\');
            tbody.innerHTML = \'\';
            
            // Filter data based on current filters
            let filteredData = warrantyData.filter(item => {
                const matchesStatus = !currentFilters.status || item.status === currentFilters.status;
                const matchesProduct = !currentFilters.product || item.productType === currentFilters.product;
                const matchesSearch = !currentFilters.search || 
                    item.customer.toLowerCase().includes(currentFilters.search.toLowerCase()) ||
                    item.id.toLowerCase().includes(currentFilters.search.toLowerCase()) ||
                    item.product.toLowerCase().includes(currentFilters.search.toLowerCase());
                
                return matchesStatus && matchesProduct && matchesSearch;
            });
            
            filteredData.forEach(item => {
                const statusClass = `status-${item.status}`;
                const priorityClass = `priority-${item.priority}`;
                const isSelected = selectedItems.has(item.id);
                
                const row = document.createElement(\'tr\');
                row.className = `hover:bg-gray-50 ${priorityClass}`;
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" ${isSelected ? \'checked\' : \'\'} onchange="toggleItemSelection(\'${item.id}\')" class="text-blue-600 focus:ring-blue-500">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${item.id}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${item.customer}</div>
                        <div class="text-sm text-gray-500">${item.phone}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.product}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.issue}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full ${statusClass}">
                            ${getStatusText(item.status)}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formatDate(item.date)}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button onclick="viewWarranty(\'${item.id}\')" class="text-blue-600 hover:text-blue-900 mr-3">Xem</button>
                        <button onclick="updateWarrantyStatus(\'${item.id}\')" class="text-green-600 hover:text-green-900">Cập nhật</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
            
            // Update statistics based on filtered data
            updateStatistics(filteredData);
            updateSelectAllCheckbox();
        }

        // Update statistics cards
        function updateStatistics(filteredData = warrantyData) {
            const totalRequests = filteredData.length;
            const processingCount = filteredData.filter(item => item.status === \'processing\').length;
            const completedCount = filteredData.filter(item => item.status === \'completed\').length;
            
            // Count today\'s appointments (always show actual today\'s appointments, not filtered)
            const today = new Date();
            const todayString = today.toISOString().split(\'T\')[0];
            const todayAppointments = appointmentsData.filter(apt => apt.date === todayString).length;
            
            // Find and update each stat card by looking for the specific text content
            const statCards = document.querySelectorAll(\'.bg-white.rounded-lg.shadow-sm.p-6\');
            
            statCards.forEach(card => {
                const label = card.querySelector(\'.text-sm.font-medium.text-gray-600\');
                const value = card.querySelector(\'.text-2xl.font-bold.text-gray-900\');
                
                if (label && value) {
                    const labelText = label.textContent.trim();
                    
                    switch(labelText) {
                        case \'Tổng yêu cầu\':
                            value.textContent = totalRequests;
                            break;
                        case \'Đang xử lý\':
                            value.textContent = processingCount;
                            break;
                        case \'Hoàn thành\':
                            value.textContent = completedCount;
                            break;
                        case \'Lịch hẹn hôm nay\':
                            value.textContent = todayAppointments;
                            break;
                    }
                }
            });
            
            // Update pagination info
            updatePaginationInfo(totalRequests);
        }

        //  Update pagination information
        function updatePaginationInfo(totalCount) {
            const paginationText = document.querySelector(\'.text-sm.text-gray-700\');
            if (paginationText) {
                const displayedCount = Math.min(10, totalCount);
                paginationText.innerHTML = `
                    Hiển thị <span class="font-medium">1</span> đến <span class="font-medium">${displayedCount}</span> của <span class="font-medium">${totalCount}</span> kết quả
                `;
            }
        }

        // Load appointments data
        function loadAppointmentsData() {
            const tbody = document.getElementById(\'appointments-list\');
            tbody.innerHTML = \'\';
            
            // Sort appointments by date and time
            const sortedAppointments = [...appointmentsData].sort((a, b) => {
                const dateA = new Date(a.date + \' \' + a.time);
                const dateB = new Date(b.date + \' \' + b.time);
                return dateA - dateB;
            });
            
            sortedAppointments.forEach(item => {
                const row = document.createElement(\'tr\');
                row.className = \'hover:bg-gray-50\';
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${item.customer}</div>
                        <div class="text-sm text-gray-500">${item.phone}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.service}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        ${formatDate(item.date)} - ${item.time}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full ${item.status === \'confirmed\' ? \'bg-green-100 text-green-800\' : \'bg-yellow-100 text-yellow-800\'}">
                            ${item.status === \'confirmed\' ? \'Đã xác nhận\' : \'Chờ xác nhận\'}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button onclick="confirmAppointment(${item.id})" class="text-green-600 hover:text-green-900 mr-3">Xác nhận</button>
                        <button onclick="cancelAppointment(${item.id})" class="text-red-600 hover:text-red-900">Hủy</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // Generate calendar
        function generateCalendar() {
            const grid = document.getElementById(\'calendar-grid\');
            grid.innerHTML = \'\';
            
            // Get days in current month
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            
            // Add empty cells for days before month starts
            for (let i = 0; i < firstDay; i++) {
                const cell = document.createElement(\'div\');
                cell.className = \'h-12\';
                grid.appendChild(cell);
            }
            
            // Get today\'s date for highlighting
            const today = new Date();
            const isCurrentMonth = currentMonth === today.getMonth() && currentYear === today.getFullYear();
            const todayDate = today.getDate();
            
            // Add days of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const cell = document.createElement(\'div\');
                cell.className = \'h-12 flex items-center justify-center text-sm cursor-pointer hover:bg-blue-50 rounded relative\';
                cell.textContent = day;
                
                // Highlight today
                if (isCurrentMonth && day === todayDate) {
                    cell.className += \' bg-blue-600 text-white hover:bg-blue-700\';
                }
                
                // Check for appointments on this day
                const dateString = `${currentYear}-${String(currentMonth + 1).padStart(2, \'0\')}-${String(day).padStart(2, \'0\')}`;
                const dayAppointments = appointmentsData.filter(apt => apt.date === dateString);
                
                if (dayAppointments.length > 0) {
                    const indicator = document.createElement(\'div\');
                    indicator.className = \'w-2 h-2 bg-red-500 rounded-full absolute bottom-1 right-1\';
                    cell.appendChild(indicator);
                    
                    // Add tooltip on hover
                    cell.title = `${dayAppointments.length} lịch hẹn`;
                }
                
                // Add click handler to show appointments for that day
                cell.onclick = () => showDayAppointments(dateString, day);
                
                grid.appendChild(cell);
            }
        }

        // Show appointments for selected day
        function showDayAppointments(dateString, day) {
            console.log(\'Checking appointments for date:\', dateString);
            console.log(\'All appointments:\', appointmentsData);
            
            const dayAppointments = appointmentsData.filter(apt => {
                console.log(\'Comparing:\', apt.date, \'with\', dateString);
                return apt.date === dateString;
            });
            
            console.log(\'Found appointments:\', dayAppointments);
            
            if (dayAppointments.length === 0) {
                // Create a nice modal instead of alert for empty days
                showDayAppointmentModal(dateString, day, []);
                return;
            }
            
            // Show modal with appointments
            showDayAppointmentModal(dateString, day, dayAppointments);
        }

        // Show day appointment modal
        function showDayAppointmentModal(dateString, day, appointments) {
            // Create modal if it doesn\'t exist
            let modal = document.getElementById(\'day-appointments-modal\');
            if (!modal) {
                modal = document.createElement(\'div\');
                modal.id = \'day-appointments-modal\';
                modal.className = \'fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50\';
                modal.innerHTML = `
                    <div class="bg-white rounded-lg w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
                        <div class="flex items-center justify-between p-6 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900" id="day-modal-title">Lịch hẹn ngày</h3>
                                    <p class="text-sm text-gray-600" id="day-modal-date"></p>
                                </div>
                            </div>
                            <button onclick="hideDayAppointmentModal()" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="p-6">
                            <div id="day-appointments-content" class="space-y-4">
                                <!-- Appointments will be populated here -->
                            </div>
                            
                            <button onclick="showAddAppointmentForDate(\'${dateString}\')" class="w-full mt-4 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Thêm lịch hẹn cho ngày này
                            </button>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
            }
            
            // Update modal content
            const monthNames = [\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'];
            document.getElementById(\'day-modal-title\').textContent = `Lịch hẹn ngày ${day}`;
            document.getElementById(\'day-modal-date\').textContent = `${day}/${monthNames[currentMonth]}/${currentYear}`;
            
            const content = document.getElementById(\'day-appointments-content\');
            content.innerHTML = \'\';
            
            if (appointments.length === 0) {
                content.innerHTML = `
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-medium text-gray-900 mb-2">Không có lịch hẹn</h4>
                        <p class="text-gray-500 text-sm">Chưa có lịch hẹn nào được đặt cho ngày này</p>
                    </div>
                `;
            } else {
                appointments.forEach((apt, index) => {
                    const appointmentDiv = document.createElement(\'div\');
                    appointmentDiv.className = \'border border-gray-200 rounded-lg p-4 hover:bg-gray-50\';
                    appointmentDiv.innerHTML = `
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <div class="w-2 h-2 ${apt.status === \'confirmed\' ? \'bg-green-500\' : \'bg-yellow-500\'} rounded-full mr-2"></div>
                                    <span class="font-medium text-gray-900">${apt.time}</span>
                                    <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full ${apt.status === \'confirmed\' ? \'bg-green-100 text-green-800\' : \'bg-yellow-100 text-yellow-800\'}">
                                        ${apt.status === \'confirmed\' ? \'Đã xác nhận\' : \'Chờ xác nhận\'}
                                    </span>
                                </div>
                                <h5 class="font-medium text-gray-900">${apt.customer}</h5>
                                <p class="text-sm text-gray-600">${apt.service}</p>
                                <p class="text-sm text-gray-500 mt-1">${apt.phone}</p>
                                ${apt.notes ? `<p class="text-xs text-gray-500 mt-2 italic">${apt.notes}</p>` : \'\'}
                            </div>
                            <div class="flex flex-col space-y-1 ml-4">
                                ${apt.status !== \'confirmed\' ? `
                                    <button onclick="confirmAppointment(${apt.id}); hideDayAppointmentModal();" class="text-xs bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700">
                                        Xác nhận
                                    </button>
                                ` : \'\'}
                                <button onclick="cancelAppointment(${apt.id}); hideDayAppointmentModal();" class="text-xs bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">
                                    Hủy
                                </button>
                            </div>
                        </div>
                    `;
                    content.appendChild(appointmentDiv);
                });
            }
            
            // Show modal
            modal.classList.remove(\'hidden\');
            modal.classList.add(\'flex\');
        }

        // Hide day appointment modal
        function hideDayAppointmentModal() {
            const modal = document.getElementById(\'day-appointments-modal\');
            if (modal) {
                modal.classList.add(\'hidden\');
                modal.classList.remove(\'flex\');
            }
        }

        // Show add appointment modal with pre-filled date
        function showAddAppointmentForDate(dateString) {
            hideDayAppointmentModal();
            showAddAppointmentModal();
            
            // Pre-fill the date field
            const dateInput = document.querySelector(\'#appointment-modal input[type="date"]\');
            if (dateInput) {
                dateInput.value = dateString;
            }
        }

        // Load today\'s appointments
        function loadTodayAppointments() {
            const container = document.getElementById(\'today-appointments\');
            container.innerHTML = \'\';
            
            // Get today\'s date in YYYY-MM-DD format
            const today = new Date();
            const todayString = today.toISOString().split(\'T\')[0];
            
            const todayAppointments = appointmentsData.filter(apt => apt.date === todayString);
            
            if (todayAppointments.length === 0) {
                const div = document.createElement(\'div\');
                div.className = \'text-center text-gray-500 py-4\';
                div.innerHTML = `
                    <div class="text-sm">Không có lịch hẹn nào hôm nay</div>
                    <div class="text-xs mt-1">${formatDate(todayString)}</div>
                `;
                container.appendChild(div);
                return;
            }
            
            todayAppointments.forEach(apt => {
                const div = document.createElement(\'div\');
                div.className = \'border-l-4 border-blue-500 pl-4 py-2\';
                div.innerHTML = `
                    <div class="font-medium text-gray-900">${apt.time} - ${apt.customer}</div>
                    <div class="text-sm text-gray-600">${apt.service}</div>
                    <div class="text-xs text-gray-500 mt-1">${apt.notes}</div>
                `;
                container.appendChild(div);
            });
        }

        // Utility functions
        function getStatusText(status) {
            const statusMap = {
                \'pending\': \'Chờ xử lý\',
                \'processing\': \'Đang xử lý\',
                \'completed\': \'Hoàn thành\',
                \'cancelled\': \'Đã hủy\'
            };
            return statusMap[status] || status;
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString(\'vi-VN\');
        }

        // Modal functions
        function showAddAppointmentModal() {
            document.getElementById(\'appointment-modal\').classList.remove(\'hidden\');
            document.getElementById(\'appointment-modal\').classList.add(\'flex\');
        }

        function hideAddAppointmentModal() {
            document.getElementById(\'appointment-modal\').classList.add(\'hidden\');
            document.getElementById(\'appointment-modal\').classList.remove(\'flex\');
        }

        // Action functions
        function viewWarranty(id) {
            const warranty = warrantyData.find(item => item.id === id);
            if (!warranty) return;
            
            currentWarrantyId = id;
            
            // Populate modal with warranty data
            document.getElementById(\'warranty-detail-id\').textContent = `Mã: ${warranty.id}`;
            document.getElementById(\'detail-customer\').textContent = warranty.customer;
            document.getElementById(\'detail-phone\').textContent = warranty.phone;
            document.getElementById(\'detail-address\').textContent = warranty.address;
            document.getElementById(\'detail-product\').textContent = warranty.product;
            document.getElementById(\'detail-serial\').textContent = warranty.serial;
            document.getElementById(\'detail-purchase-date\').textContent = formatDate(warranty.purchaseDate);
            document.getElementById(\'detail-issue\').textContent = warranty.issue;
            document.getElementById(\'detail-description\').textContent = warranty.description;
            document.getElementById(\'detail-date\').textContent = formatDate(warranty.date);
            
            // Set priority badge
            const priorityElement = document.getElementById(\'detail-priority\');
            const priorityText = warranty.priority === \'high\' ? \'Cao\' : warranty.priority === \'medium\' ? \'Trung bình\' : \'Thấp\';
            const priorityClass = warranty.priority === \'high\' ? \'bg-red-100 text-red-800\' : 
                                warranty.priority === \'medium\' ? \'bg-yellow-100 text-yellow-800\' : \'bg-green-100 text-green-800\';
            priorityElement.textContent = priorityText;
            priorityElement.className = `mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full ${priorityClass}`;
            
            // Set status badge
            const statusElement = document.getElementById(\'detail-status\');
            const statusText = getStatusText(warranty.status);
            const statusClass = `status-${warranty.status}`;
            statusElement.textContent = statusText;
            statusElement.className = `mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full ${statusClass}`;
            
            // Populate timeline
            const timelineElement = document.getElementById(\'detail-timeline\');
            timelineElement.innerHTML = \'\';
            warranty.timeline.forEach(item => {
                const timelineItem = document.createElement(\'div\');
                timelineItem.className = \'flex items-start\';
                
                const dotColor = item.status === \'completed\' ? \'bg-green-500\' : 
                               item.status === \'current\' ? \'bg-blue-500\' : \'bg-gray-300\';
                
                timelineItem.innerHTML = `
                    <div class="w-2 h-2 ${dotColor} rounded-full mt-2 mr-3"></div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">${item.action}</p>
                        ${item.date ? `<p class="text-xs text-gray-500">${formatDate(item.date)} - ${item.time}</p>` : \'<p class="text-xs text-gray-500">Chưa thực hiện</p>\'}
                    </div>
                `;
                timelineElement.appendChild(timelineItem);
            });
            
            // Show modal
            document.getElementById(\'warranty-detail-modal\').classList.remove(\'hidden\');
            document.getElementById(\'warranty-detail-modal\').classList.add(\'flex\');
        }

        function updateWarrantyStatus(id) {
            currentWarrantyId = id;
            document.getElementById(\'update-warranty-id\').textContent = id;
            
            // Show update modal
            document.getElementById(\'update-status-modal\').classList.remove(\'hidden\');
            document.getElementById(\'update-status-modal\').classList.add(\'flex\');
        }

        // Modal functions for warranty detail
        function hideWarrantyDetailModal() {
            document.getElementById(\'warranty-detail-modal\').classList.add(\'hidden\');
            document.getElementById(\'warranty-detail-modal\').classList.remove(\'flex\');
        }

        function showUpdateStatusModal() {
            hideWarrantyDetailModal();
            updateWarrantyStatus(currentWarrantyId);
        }

        function hideUpdateStatusModal() {
            document.getElementById(\'update-status-modal\').classList.add(\'hidden\');
            document.getElementById(\'update-status-modal\').classList.remove(\'flex\');
        }

        function updateWarrantyStatusSubmit(event) {
            event.preventDefault();
            
            const newStatus = document.getElementById(\'new-status\').value;
            const notes = document.getElementById(\'update-notes\').value;
            const estimatedCompletion = document.getElementById(\'estimated-completion\').value;
            
            if (!newStatus) {
                alert(\'Vui lòng chọn trạng thái mới\');
                return;
            }
            
            // Find and update warranty in data
            const warrantyIndex = warrantyData.findIndex(item => item.id === currentWarrantyId);
            if (warrantyIndex !== -1) {
                warrantyData[warrantyIndex].status = newStatus;
                
                // Add to timeline
                const now = new Date();
                const timeString = now.toLocaleTimeString(\'vi-VN\', { hour: \'2-digit\', minute: \'2-digit\' });
                const dateString = now.toISOString().split(\'T\')[0];
                
                warrantyData[warrantyIndex].timeline.push({
                    action: `Cập nhật trạng thái: ${getStatusText(newStatus)}${notes ? ` - ${notes}` : \'\'}`,
                    date: dateString,
                    time: timeString,
                    status: \'completed\'
                });
            }
            
            // Refresh the warranty list and update statistics
            loadWarrantyData();
            
            // Force update statistics with current filtered data
            let filteredData = warrantyData.filter(item => {
                const matchesStatus = !currentFilters.status || item.status === currentFilters.status;
                const matchesProduct = !currentFilters.product || item.productType === currentFilters.product;
                const matchesSearch = !currentFilters.search || 
                    item.customer.toLowerCase().includes(currentFilters.search.toLowerCase()) ||
                    item.id.toLowerCase().includes(currentFilters.search.toLowerCase()) ||
                    item.product.toLowerCase().includes(currentFilters.search.toLowerCase());
                
                return matchesStatus && matchesProduct && matchesSearch;
            });
            updateStatistics(filteredData);
            
            // Show success message
            alert(`Đã cập nhật trạng thái thành công cho yêu cầu ${currentWarrantyId}`);
            
            // Hide modal and reset form
            hideUpdateStatusModal();
            document.getElementById(\'new-status\').value = \'\';
            document.getElementById(\'update-notes\').value = \'\';
            document.getElementById(\'estimated-completion\').value = \'\';
        }

        function confirmAppointment(id) {
            const appointmentIndex = appointmentsData.findIndex(apt => apt.id === id);
            if (appointmentIndex !== -1) {
                appointmentsData[appointmentIndex].status = \'confirmed\';
                loadAppointmentsData();
                loadTodayAppointments();
                updateStatistics();
                
                // Show success message
                const appointment = appointmentsData[appointmentIndex];
                alert(`Đã xác nhận lịch hẹn cho khách hàng ${appointment.customer} vào ${appointment.time} ngày ${formatDate(appointment.date)}`);
            }
        }

        function cancelAppointment(id) {
            if (confirm(\'Bạn có chắc chắn muốn hủy lịch hẹn này?\')) {
                const appointmentIndex = appointmentsData.findIndex(apt => apt.id === id);
                if (appointmentIndex !== -1) {
                    const appointment = appointmentsData[appointmentIndex];
                    appointmentsData.splice(appointmentIndex, 1);
                    loadAppointmentsData();
                    loadTodayAppointments();
                    updateStatistics();
                    
                    alert(`Đã hủy lịch hẹn cho khách hàng ${appointment.customer}`);
                }
            }
        }

        function addAppointment(event) {
            event.preventDefault();
            
            const form = event.target;
            
            const newAppointment = {
                id: Date.now(), // Use timestamp for unique ID
                customer: form.querySelector(\'input[type="text"]\').value,
                phone: form.querySelector(\'input[type="tel"]\').value,
                service: form.querySelector(\'select\').value,
                date: form.querySelector(\'input[type="date"]\').value,
                time: form.querySelector(\'input[type="time"]\').value,
                status: \'pending\',
                notes: form.querySelector(\'textarea\').value || \'Không có ghi chú\'
            };
            
            console.log(\'Adding new appointment:\', newAppointment);
            
            appointmentsData.push(newAppointment);
            
            console.log(\'Updated appointments data:\', appointmentsData);
            
            // Refresh all related displays
            loadAppointmentsData();
            loadTodayAppointments();
            updateStatistics();
            generateCalendar(); // Refresh calendar to show new appointment
            
            alert(`Đã thêm lịch hẹn mới cho khách hàng ${newAppointment.customer} vào ${newAppointment.time} ngày ${formatDate(newAppointment.date)}`);
            
            // Reset form and hide modal
            form.reset();
            hideAddAppointmentModal();
        }

        // Calendar navigation variables
        let currentMonth = 9; // October (0-based)
        let currentYear = 2024;

        function previousMonth() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            updateCalendarHeader();
            generateCalendar();
        }

        function nextMonth() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            updateCalendarHeader();
            generateCalendar();
        }

        function updateCalendarHeader() {
            const monthNames = [
                \'Tháng 1\', \'Tháng 2\', \'Tháng 3\', \'Tháng 4\', \'Tháng 5\', \'Tháng 6\',
                \'Tháng 7\', \'Tháng 8\', \'Tháng 9\', \'Tháng 10\', \'Tháng 11\', \'Tháng 12\'
            ];
            
            const headerElement = document.querySelector(\'.text-lg.font-semibold.text-gray-900\');
            if (headerElement) {
                headerElement.textContent = `Lịch hẹn ${monthNames[currentMonth]}/${currentYear}`;
            }
        }

        // Selection functions
        function toggleSelectAll() {
            const selectAllCheckbox = document.getElementById(\'select-all\');
            const itemCheckboxes = document.querySelectorAll(\'#warranty-list input[type="checkbox"]\');
            
            if (selectAllCheckbox.checked) {
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = true;
                    const itemId = checkbox.getAttribute(\'onchange\').match(/\'([^\']+)\'/)[1];
                    selectedItems.add(itemId);
                });
            } else {
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                    const itemId = checkbox.getAttribute(\'onchange\').match(/\'([^\']+)\'/)[1];
                    selectedItems.delete(itemId);
                });
            }
            
            updateSelectedCount();
        }

        function toggleItemSelection(itemId) {
            if (selectedItems.has(itemId)) {
                selectedItems.delete(itemId);
            } else {
                selectedItems.add(itemId);
            }
            
            updateSelectAllCheckbox();
            updateSelectedCount();
        }

        function updateSelectAllCheckbox() {
            const selectAllCheckbox = document.getElementById(\'select-all\');
            const itemCheckboxes = document.querySelectorAll(\'#warranty-list input[type="checkbox"]\');
            const checkedItems = document.querySelectorAll(\'#warranty-list input[type="checkbox"]:checked\');
            
            if (itemCheckboxes.length === 0) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = false;
            } else if (checkedItems.length === itemCheckboxes.length) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = true;
            } else if (checkedItems.length > 0) {
                selectAllCheckbox.indeterminate = true;
                selectAllCheckbox.checked = false;
            } else {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = false;
            }
        }

        function updateSelectedCount() {
            const countElement = document.getElementById(\'selected-count\');
            if (countElement) {
                countElement.textContent = selectedItems.size;
            }
        }

        // Filter functions
        function applyFilters() {
            currentFilters.status = document.getElementById(\'status-filter\').value;
            currentFilters.product = document.getElementById(\'product-filter\').value;
            currentFilters.search = document.querySelector(\'input[type="text"]\').value;
            
            loadWarrantyData();
        }

        // Export modal functions
        function showExportModal() {
            document.getElementById(\'export-modal\').classList.remove(\'hidden\');
            document.getElementById(\'export-modal\').classList.add(\'flex\');
        }

        function hideExportModal() {
            document.getElementById(\'export-modal\').classList.add(\'hidden\');
            document.getElementById(\'export-modal\').classList.remove(\'flex\');
        }

        function selectAllColumns() {
            const checkboxes = document.querySelectorAll(\'#export-modal input[type="checkbox"]\');
            checkboxes.forEach(checkbox => {
                if (checkbox.closest(\'.space-y-3\').previousElementSibling?.textContent.includes(\'Chọn cột xuất\')) {
                    checkbox.checked = true;
                }
            });
            updatePreview();
        }

        function deselectAllColumns() {
            const checkboxes = document.querySelectorAll(\'#export-modal input[type="checkbox"]\');
            checkboxes.forEach(checkbox => {
                if (checkbox.closest(\'.space-y-3\').previousElementSibling?.textContent.includes(\'Chọn cột xuất\')) {
                    checkbox.checked = false;
                }
            });
            updatePreview();
        }

        function updatePreview() {
            const checkedColumns = document.querySelectorAll(\'#export-modal input[type="checkbox"]:checked\').length;
            const previewElement = document.querySelector(\'#export-modal .bg-gray-50 .text-sm\');
            if (previewElement) {
                previewElement.innerHTML = `
                    <p>Sẽ xuất: <span class="font-medium">247 yêu cầu bảo hành</span></p>
                    <p>Định dạng: <span class="font-medium">Excel (.xlsx)</span></p>
                    <p>Cột: <span class="font-medium">${checkedColumns} cột</span></p>
                `;
            }
        }

        function exportExcel() {
            // Simulate export process
            const button = event.target;
            const originalText = button.innerHTML;
            
            button.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Đang xuất...
            `;
            button.disabled = true;

            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
                alert(\'Đã xuất file Excel thành công! File đã được tải xuống.\');
                hideExportModal();
            }, 2000);
        }
    </script>
</div>
</html>
@endsection