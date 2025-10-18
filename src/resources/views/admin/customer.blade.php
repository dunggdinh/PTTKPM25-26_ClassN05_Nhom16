@extends('admin.layout')
@section('title', 'Quản lý khách hàng')
@section('content')
<body class="ml-64 w-[calc(100%-16rem)] min-h-screen p-8 pt-24 transition-all bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="min-h-full p-6">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Quản Lý Khách Hàng</h1>
            <p class="text-gray-600">Quản lý thông tin và hoạt động của khách hàng</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100 mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Tổng khách hàng</p>
                        <p class="text-2xl font-semibold text-gray-900">2,847</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-100 mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Hoạt động</p>
                        <p class="text-2xl font-semibold text-gray-900">1,923</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-yellow-100 mr-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Mới hôm nay</p>
                        <p class="text-2xl font-semibold text-gray-900">47</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-purple-100 mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Tăng trưởng</p>
                        <p class="text-2xl font-semibold text-gray-900">+12.5%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Actions -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Tìm kiếm khách hàng..." 
                                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full sm:w-80">
                            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        
                        <select id="statusFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Tất cả trạng thái</option>
                            <option value="active">Hoạt động</option>
                            <option value="inactive">Không hoạt động</option>
                            <option value="blocked">Bị khóa</option>
                        </select>
                        
                        <select id="typeFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Loại khách hàng</option>
                            <option value="vip">VIP</option>
                            <option value="regular">Thường</option>
                            <option value="new">Mới</option>
                        </select>
                    </div>
                    
                    <div class="flex gap-3">
                        <button id="exportBtn" type="button" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Xuất Excel
                        </button>
                        <button id="addCustomerBtn" type="button" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Thêm khách hàng
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Liên hệ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loại</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Đơn hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng chi tiêu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tham gia</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="customerTableBody" class="bg-white divide-y divide-gray-200">
                        <!-- Customer rows will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button id="prevPageMobile" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">Trước</button>
                    <button id="nextPageMobile" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">Sau</button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Hiển thị <span class="font-medium" id="showingFrom">1</span> đến <span class="font-medium" id="showingTo">5</span> của <span class="font-medium" id="totalResults">5</span> kết quả
                        </p>
                    </div>
                    <div>
                        <nav id="paginationNav" class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                            <!-- Pagination buttons will be generated by JavaScript -->
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Excel Modal -->
    <div id="exportModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 modal-backdrop hidden z-50">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <div class="bg-white px-6 pt-6 pb-4">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="p-2 bg-green-100 rounded-lg mr-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Xuất dữ liệu Excel</h3>
                                <p class="text-sm text-gray-500">Tùy chỉnh dữ liệu xuất theo nhu cầu</p>
                            </div>
                        </div>
                        <button id="closeExportModalBtn" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Left Column - Export Options -->
                        <div class="space-y-6">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Phạm vi xuất</h4>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="exportRange" value="all" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Tất cả khách hàng (<span id="totalCustomers">0</span> khách hàng)</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="exportRange" value="currentPage" class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Trang hiện tại (<span id="currentPageCustomers">0</span> khách hàng)</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="exportRange" value="selected" class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Khách hàng đã chọn (<span id="selectedCustomers">0</span> khách hàng)</span>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Định dạng file</h4>
                                <select id="exportFormat" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="xlsx">Excel (.xlsx)</option>
                                    <option value="csv">CSV (.csv)</option>
                                    <option value="pdf">PDF (.pdf)</option>
                                </select>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Tên file</h4>
                                <input type="text" id="exportFileName" value="danh-sach-khach-hang" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <p class="text-xs text-gray-500 mt-1">Tên file sẽ được thêm ngày tháng tự động</p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Lọc theo trạng thái</h4>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="exportStatus" value="active" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Hoạt động</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="exportStatus" value="inactive" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Không hoạt động</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="exportStatus" value="blocked" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Bị khóa</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Column Selection -->
                        <div class="space-y-6">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Chọn cột xuất</h4>
                                <div class="space-y-2 max-h-64 overflow-y-auto border border-gray-200 rounded-md p-3">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="exportColumns" value="id" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">ID</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="exportColumns" value="name" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Họ và tên</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="exportColumns" value="email" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Email</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="exportColumns" value="phone" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Số điện thoại</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="exportColumns" value="address" class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Địa chỉ</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="exportColumns" value="type" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Loại khách hàng</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="exportColumns" value="orders" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Số đơn hàng</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="exportColumns" value="totalSpent" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Tổng chi tiêu</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="exportColumns" value="status" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Trạng thái</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="exportColumns" value="joinDate" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Ngày tham gia</span>
                                    </label>
                                </div>
                                
                                <div class="flex gap-2 mt-3">
                                    <button id="selectAllColumnsBtn" class="text-xs px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition-colors">
                                        Chọn tất cả
                                    </button>
                                    <button id="deselectAllColumnsBtn" class="text-xs px-3 py-1 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition-colors">
                                        Bỏ chọn tất cả
                                    </button>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Tùy chọn bổ sung</h4>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" id="includeHeader" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Bao gồm tiêu đề cột</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" id="includeTimestamp" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Thêm thời gian xuất</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" id="includeSummary" class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Thêm thống kê tổng quan</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Preview Section -->
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-900 mb-2">Xem trước</h4>
                        <div class="text-sm text-gray-600">
                            <p>Sẽ xuất: <span class="font-medium" id="previewCount">0</span> khách hàng</p>
                            <p>Định dạng: <span class="font-medium" id="previewFormat">Excel (.xlsx)</span></p>
                            <p>Cột: <span class="font-medium" id="previewColumns">10 cột</span></p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        File sẽ được tải xuống tự động
                    </div>
                    <div class="flex gap-3">
                        <button id="cancelExportBtn" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            Hủy
                        </button>
                        <button id="processExportBtn" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3"></path>
                            </svg>
                            Xuất Excel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Customer Modal -->
    <div id="customerModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 modal-backdrop hidden z-50">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="customerForm" onsubmit="saveCustomer(event)">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modalTitle">Thêm khách hàng mới</h3>
                                
                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Họ và tên *</label>
                                        <input type="text" id="customerName" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                        <input type="email" id="customerEmail" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                                        <input type="tel" id="customerPhone" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ</label>
                                        <textarea id="customerAddress" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Loại khách hàng</label>
                                            <select id="customerType" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                <option value="new">Mới</option>
                                                <option value="regular">Thường</option>
                                                <option value="vip">VIP</option>
                                            </select>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Trạng thái</label>
                                            <select id="customerStatus" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                <option value="active">Hoạt động</option>
                                                <option value="inactive">Không hoạt động</option>
                                                <option value="blocked">Bị khóa</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Lưu
                        </button>
                        <button type="button" id="cancelCustomerBtn" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Hủy
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Sample customer data
        let customers = [
            {
                id: 1,
                name: "Nguyễn Văn An",
                email: "nguyenvanan@email.com",
                phone: "0901234567",
                address: "123 Đường ABC, Quận 1, TP.HCM",
                type: "vip",
                orders: 15,
                totalSpent: 25000000,
                status: "active",
                joinDate: "2023-01-15"
            },
            {
                id: 2,
                name: "Trần Thị Bình",
                email: "tranthibinh@email.com",
                phone: "0912345678",
                address: "456 Đường XYZ, Quận 3, TP.HCM",
                type: "regular",
                orders: 8,
                totalSpent: 12000000,
                status: "active",
                joinDate: "2023-03-22"
            },
            {
                id: 3,
                name: "Lê Minh Cường",
                email: "leminhcuong@email.com",
                phone: "0923456789",
                address: "789 Đường DEF, Quận 7, TP.HCM",
                type: "new",
                orders: 2,
                totalSpent: 3500000,
                status: "active",
                joinDate: "2024-01-10"
            },
            {
                id: 4,
                name: "Phạm Thị Dung",
                email: "phamthidung@email.com",
                phone: "0934567890",
                address: "321 Đường GHI, Quận 5, TP.HCM",
                type: "regular",
                orders: 12,
                totalSpent: 18000000,
                status: "inactive",
                joinDate: "2023-06-08"
            },
            {
                id: 5,
                name: "Hoàng Văn Em",
                email: "hoangvanem@email.com",
                phone: "0945678901",
                address: "654 Đường JKL, Quận 2, TP.HCM",
                type: "vip",
                orders: 25,
                totalSpent: 45000000,
                status: "active",
                joinDate: "2022-11-30"
            },
            {
                id: 6,
                name: "Võ Thị Hoa",
                email: "vothihoa@email.com",
                phone: "0956789012",
                address: "987 Đường MNO, Quận 4, TP.HCM",
                type: "regular",
                orders: 6,
                totalSpent: 8500000,
                status: "active",
                joinDate: "2023-08-14"
            },
            {
                id: 7,
                name: "Đặng Minh Tuấn",
                email: "dangminhtuan@email.com",
                phone: "0967890123",
                address: "246 Đường PQR, Quận 6, TP.HCM",
                type: "vip",
                orders: 32,
                totalSpent: 68000000,
                status: "active",
                joinDate: "2022-05-20"
            },
            {
                id: 8,
                name: "Bùi Thị Lan",
                email: "buithilan@email.com",
                phone: "0978901234",
                address: "135 Đường STU, Quận 8, TP.HCM",
                type: "new",
                orders: 1,
                totalSpent: 1200000,
                status: "active",
                joinDate: "2024-02-05"
            },
            {
                id: 9,
                name: "Ngô Văn Khoa",
                email: "ngovankho@email.com",
                phone: "0989012345",
                address: "468 Đường VWX, Quận 9, TP.HCM",
                type: "regular",
                orders: 14,
                totalSpent: 22000000,
                status: "blocked",
                joinDate: "2023-04-12"
            },
            {
                id: 10,
                name: "Lý Thị Mai",
                email: "lythimai@email.com",
                phone: "0990123456",
                address: "579 Đường YZ, Quận 10, TP.HCM",
                type: "regular",
                orders: 9,
                totalSpent: 15500000,
                status: "active",
                joinDate: "2023-07-28"
            },
            {
                id: 11,
                name: "Phan Văn Nam",
                email: "phanvannam@email.com",
                phone: "0901357924",
                address: "802 Đường ABC, Quận 11, TP.HCM",
                type: "vip",
                orders: 28,
                totalSpent: 52000000,
                status: "active",
                joinDate: "2022-09-15"
            },
            {
                id: 12,
                name: "Huỳnh Thị Oanh",
                email: "huynhthioanh@email.com",
                phone: "0912468135",
                address: "913 Đường DEF, Quận 12, TP.HCM",
                type: "new",
                orders: 3,
                totalSpent: 4200000,
                status: "active",
                joinDate: "2024-01-22"
            },
            {
                id: 13,
                name: "Trương Minh Phúc",
                email: "truongminhphuc@email.com",
                phone: "0923579146",
                address: "024 Đường GHI, Bình Thạnh, TP.HCM",
                type: "regular",
                orders: 11,
                totalSpent: 19800000,
                status: "inactive",
                joinDate: "2023-02-18"
            },
            {
                id: 14,
                name: "Đinh Thị Quỳnh",
                email: "dinhthiquynh@email.com",
                phone: "0934680257",
                address: "135 Đường JKL, Tân Bình, TP.HCM",
                type: "regular",
                orders: 7,
                totalSpent: 11200000,
                status: "active",
                joinDate: "2023-09-03"
            },
            {
                id: 15,
                name: "Cao Văn Sơn",
                email: "caovanson@email.com",
                phone: "0945791368",
                address: "246 Đường MNO, Gò Vấp, TP.HCM",
                type: "vip",
                orders: 41,
                totalSpent: 89000000,
                status: "active",
                joinDate: "2022-03-07"
            },
            {
                id: 16,
                name: "Lưu Thị Tâm",
                email: "luuthitam@email.com",
                phone: "0956802479",
                address: "357 Đường PQR, Phú Nhuận, TP.HCM",
                type: "new",
                orders: 2,
                totalSpent: 2800000,
                status: "active",
                joinDate: "2024-01-30"
            },
            {
                id: 17,
                name: "Vũ Minh Uy",
                email: "vuminhuy@email.com",
                phone: "0967913580",
                address: "468 Đường STU, Thủ Đức, TP.HCM",
                type: "regular",
                orders: 16,
                totalSpent: 28500000,
                status: "active",
                joinDate: "2023-05-25"
            },
            {
                id: 18,
                name: "Đỗ Thị Vân",
                email: "dothivan@email.com",
                phone: "0978024691",
                address: "579 Đường VWX, Quận 1, TP.HCM",
                type: "regular",
                orders: 5,
                totalSpent: 7300000,
                status: "blocked",
                joinDate: "2023-10-11"
            },
            {
                id: 19,
                name: "Hồ Văn Xuân",
                email: "hovanxuan@email.com",
                phone: "0989135802",
                address: "680 Đường YZ, Quận 3, TP.HCM",
                type: "vip",
                orders: 35,
                totalSpent: 72000000,
                status: "active",
                joinDate: "2022-07-19"
            },
            {
                id: 20,
                name: "Tôn Thị Yến",
                email: "tonthiyen@email.com",
                phone: "0990246913",
                address: "791 Đường ABC, Quận 7, TP.HCM",
                type: "new",
                orders: 1,
                totalSpent: 950000,
                status: "active",
                joinDate: "2024-02-12"
            }
        ];

        let editingCustomerId = null;
        let currentPage = 1;
        let itemsPerPage = 10;
        let filteredCustomers = customers;

        // Format currency
        function formatCurrency(amount) {
            return new Intl.NumberFormat(\'vi-VN\', {
                style: \'currency\',
                currency: \'VND\'
            }).format(amount);
        }

        // Format date
        function formatDate(dateString) {
            return new Date(dateString).toLocaleDateString(\'vi-VN\');
        }

        // Get status badge
        function getStatusBadge(status) {
            const badges = {
                active: \'<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Hoạt động</span>\',
                inactive: \'<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Không hoạt động</span>\',
                blocked: \'<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Bị khóa</span>\'
            };
            return badges[status] || badges.active;
        }

        // Get type badge
        function getTypeBadge(type) {
            const badges = {
                vip: \'<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">VIP</span>\',
                regular: \'<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Thường</span>\',
                new: \'<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Mới</span>\'
            };
            return badges[type] || badges.regular;
        }

        // Render customer table
        function renderCustomerTable(customersToRender = customers) {
            filteredCustomers = customersToRender;
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedCustomers = customersToRender.slice(startIndex, endIndex);
            
            const tbody = document.getElementById(\'customerTableBody\');
            tbody.innerHTML = \'\';

            paginatedCustomers.forEach(customer => {
                const row = document.createElement(\'tr\');
                row.className = \'hover:bg-gray-50 fade-in\';
                const isSelected = selectedCustomerIds.has(customer.id);
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="${customer.id}" ${isSelected ? \'checked\' : \'\'}>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center text-white font-semibold">
                                    ${customer.name.charAt(0)}
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">${customer.name}</div>
                                <div class="text-sm text-gray-500">ID: #${customer.id}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${customer.email}</div>
                        <div class="text-sm text-gray-500">${customer.phone}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        ${getTypeBadge(customer.type)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        ${customer.orders} đơn
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        ${formatCurrency(customer.totalSpent)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        ${getStatusBadge(customer.status)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        ${formatDate(customer.joinDate)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <button onclick="viewCustomer(${customer.id})" class="text-blue-600 hover:text-blue-900">Xem</button>
                            <button onclick="editCustomer(${customer.id})" class="text-indigo-600 hover:text-indigo-900">Sửa</button>
                            <button onclick="deleteCustomer(${customer.id})" class="text-red-600 hover:text-red-900">Xóa</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
            
            updatePaginationInfo();
            updateSelectAllCheckbox();
        }

        // Update select all checkbox state
        function updateSelectAllCheckbox() {
            const selectAllCheckbox = document.getElementById(\'selectAll\');
            const currentPageCheckboxes = document.querySelectorAll(\'tbody input[type="checkbox"]\');
            const checkedCount = Array.from(currentPageCheckboxes).filter(cb => cb.checked).length;
            
            if (checkedCount === 0) {
                selectAllCheckbox.checked = false;
                selectAllCheckbox.indeterminate = false;
            } else if (checkedCount === currentPageCheckboxes.length) {
                selectAllCheckbox.checked = true;
                selectAllCheckbox.indeterminate = false;
            } else {
                selectAllCheckbox.checked = false;
                selectAllCheckbox.indeterminate = true;
            }
        }

        // Update pagination information
        function updatePaginationInfo() {
            const totalItems = filteredCustomers.length;
            const startIndex = (currentPage - 1) * itemsPerPage + 1;
            const endIndex = Math.min(currentPage * itemsPerPage, totalItems);
            
            document.getElementById(\'showingFrom\').textContent = totalItems > 0 ? startIndex : 0;
            document.getElementById(\'showingTo\').textContent = endIndex;
            document.getElementById(\'totalResults\').textContent = totalItems;
        }

        // Pagination functions
        function goToPage(page) {
            const totalPages = Math.ceil(filteredCustomers.length / itemsPerPage);
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                renderCustomerTable(filteredCustomers);
                updatePaginationButtons();
            }
        }

        function previousPage() {
            if (currentPage > 1) {
                currentPage--;
                renderCustomerTable(filteredCustomers);
                updatePaginationButtons();
            }
        }

        function nextPage() {
            const totalPages = Math.ceil(filteredCustomers.length / itemsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderCustomerTable(filteredCustomers);
                updatePaginationButtons();
            }
        }

        function updatePaginationButtons() {
            const totalPages = Math.ceil(filteredCustomers.length / itemsPerPage);
            const paginationContainer = document.getElementById(\'paginationNav\');
            
            // Clear existing pagination buttons
            paginationContainer.innerHTML = \'\';
            
            // Add previous button
            const prevButton = document.createElement(\'button\');
            prevButton.addEventListener(\'click\', previousPage);
            prevButton.className = `relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors ${currentPage === 1 ? \'opacity-50 cursor-not-allowed\' : \'\'}`;
            prevButton.innerHTML = `
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            `;
            paginationContainer.appendChild(prevButton);
            
            // Add page number buttons
            for (let i = 1; i <= Math.min(totalPages, 5); i++) {
                const button = document.createElement(\'button\');
                button.addEventListener(\'click\', () => goToPage(i));
                button.className = `relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium transition-colors ${
                    i === currentPage 
                        ? \'bg-blue-50 text-blue-600 border-blue-300\' 
                        : \'bg-white text-gray-700 hover:bg-gray-50\'
                }`;
                button.textContent = i;
                paginationContainer.appendChild(button);
            }
            
            // Add next button
            const nextButton = document.createElement(\'button\');
            nextButton.addEventListener(\'click\', nextPage);
            nextButton.className = `relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors ${currentPage === totalPages ? \'opacity-50 cursor-not-allowed\' : \'\'}`;
            nextButton.innerHTML = `
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            `;
            paginationContainer.appendChild(nextButton);
        }

        // Search and filter functionality
        function filterCustomers() {
            const searchTerm = document.getElementById(\'searchInput\').value.toLowerCase();
            const statusFilter = document.getElementById(\'statusFilter\').value;
            const typeFilter = document.getElementById(\'typeFilter\').value;

            const filtered = customers.filter(customer => {
                const matchesSearch = customer.name.toLowerCase().includes(searchTerm) ||
                                    customer.email.toLowerCase().includes(searchTerm) ||
                                    customer.phone.includes(searchTerm);
                const matchesStatus = !statusFilter || customer.status === statusFilter;
                const matchesType = !typeFilter || customer.type === typeFilter;

                return matchesSearch && matchesStatus && matchesType;
            });

            currentPage = 1; // Reset to first page when filtering
            renderCustomerTable(filtered);
            updatePaginationButtons();
        }

        // Modal functions
        function openAddModal() {
            editingCustomerId = null;
            document.getElementById(\'modalTitle\').textContent = \'Thêm khách hàng mới\';
            document.getElementById(\'customerForm\').reset();
            document.getElementById(\'customerModal\').classList.remove(\'hidden\');
        }

        function editCustomer(id) {
            const customer = customers.find(c => c.id === id);
            if (!customer) return;

            editingCustomerId = id;
            document.getElementById(\'modalTitle\').textContent = \'Chỉnh sửa khách hàng\';
            document.getElementById(\'customerName\').value = customer.name;
            document.getElementById(\'customerEmail\').value = customer.email;
            document.getElementById(\'customerPhone\').value = customer.phone;
            document.getElementById(\'customerAddress\').value = customer.address;
            document.getElementById(\'customerType\').value = customer.type;
            document.getElementById(\'customerStatus\').value = customer.status;
            document.getElementById(\'customerModal\').classList.remove(\'hidden\');
        }

        function closeModal() {
            document.getElementById(\'customerModal\').classList.add(\'hidden\');
            editingCustomerId = null;
        }

        function saveCustomer(event) {
            event.preventDefault();
            
            const formData = {
                name: document.getElementById(\'customerName\').value,
                email: document.getElementById(\'customerEmail\').value,
                phone: document.getElementById(\'customerPhone\').value,
                address: document.getElementById(\'customerAddress\').value,
                type: document.getElementById(\'customerType\').value,
                status: document.getElementById(\'customerStatus\').value
            };

            if (editingCustomerId) {
                // Update existing customer
                const customerIndex = customers.findIndex(c => c.id === editingCustomerId);
                if (customerIndex !== -1) {
                    customers[customerIndex] = { ...customers[customerIndex], ...formData };
                }
            } else {
                // Add new customer
                const newCustomer = {
                    id: Math.max(...customers.map(c => c.id)) + 1,
                    ...formData,
                    orders: 0,
                    totalSpent: 0,
                    joinDate: new Date().toISOString().split(\'T\')[0]
                };
                customers.push(newCustomer);
            }

            // Re-apply current filters and re-render table
            filterCustomers();
            updatePaginationButtons();
            
            closeModal();
            
            // Show success message
            const notification = document.createElement(\'div\');
            notification.className = \'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 fade-in\';
            notification.textContent = editingCustomerId ? 
                `Đã cập nhật thông tin khách hàng "${formData.name}" thành công!` : 
                `Đã thêm khách hàng "${formData.name}" thành công!`;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        function viewCustomer(id) {
            const customer = customers.find(c => c.id === id);
            if (!customer) return;

            // Create modal for viewing customer details
            const modal = document.createElement(\'div\');
            modal.className = \'fixed inset-0 bg-gray-600 bg-opacity-50 modal-backdrop z-50\';
            modal.innerHTML = `
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                        <div class="bg-white px-6 pt-6 pb-4">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center">
                                    <div class="h-16 w-16 rounded-full bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center text-white text-2xl font-bold mr-4">
                                        ${customer.name.charAt(0)}
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold text-gray-900">${customer.name}</h3>
                                        <p class="text-sm text-gray-500">ID: #${customer.id}</p>
                                    </div>
                                </div>
                                <button onclick="this.closest(\'.modal-backdrop\').remove()" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                                        <p class="text-sm text-gray-900">${customer.email}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Số điện thoại</label>
                                        <p class="text-sm text-gray-900">${customer.phone}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Địa chỉ</label>
                                        <p class="text-sm text-gray-900">${customer.address}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Ngày tham gia</label>
                                        <p class="text-sm text-gray-900">${formatDate(customer.joinDate)}</p>
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Loại khách hàng</label>
                                        <div>${getTypeBadge(customer.type)}</div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Trạng thái</label>
                                        <div>${getStatusBadge(customer.status)}</div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Số đơn hàng</label>
                                        <p class="text-sm text-gray-900 font-semibold">${customer.orders} đơn</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Tổng chi tiêu</label>
                                        <p class="text-lg text-green-600 font-bold">${formatCurrency(customer.totalSpent)}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 px-6 py-4 flex justify-between">
                            <button onclick="this.closest(\'.modal-backdrop\').remove()" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                Đóng
                            </button>
                            <div class="flex gap-3">
                                <button onclick="this.closest(\'.modal-backdrop\').remove(); editCustomer(${customer.id})" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    Chỉnh sửa
                                </button>
                                <button onclick="this.closest(\'.modal-backdrop\').remove(); deleteCustomer(${customer.id})" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                    Xóa
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            
            // Close modal when clicking outside
            modal.addEventListener(\'click\', function(e) {
                if (e.target === this) {
                    this.remove();
                }
            });
        }

        function deleteCustomer(id) {
            const customer = customers.find(c => c.id === id);
            if (!customer) return;

            // Create confirmation modal
            const modal = document.createElement(\'div\');
            modal.className = \'fixed inset-0 bg-gray-600 bg-opacity-50 modal-backdrop z-50\';
            modal.innerHTML = `
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Xác nhận xóa khách hàng</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                            Bạn có chắc chắn muốn xóa khách hàng <strong>"${customer.name}"</strong> không?
                                        </p>
                                        <div class="mt-3 p-3 bg-yellow-50 rounded-md">
                                            <div class="flex">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm text-yellow-700">
                                                        <strong>Cảnh báo:</strong> Hành động này không thể hoàn tác. Tất cả dữ liệu liên quan đến khách hàng sẽ bị xóa vĩnh viễn.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3 text-sm text-gray-600">
                                            <p><strong>Thông tin khách hàng:</strong></p>
                                            <ul class="mt-1 list-disc list-inside">
                                                <li>Email: ${customer.email}</li>
                                                <li>Số đơn hàng: ${customer.orders}</li>
                                                <li>Tổng chi tiêu: ${formatCurrency(customer.totalSpent)}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button onclick="confirmDelete(${customer.id})" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Xóa khách hàng
                            </button>
                            <button onclick="this.closest(\'.modal-backdrop\').remove()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Hủy
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            
            // Close modal when clicking outside
            modal.addEventListener(\'click\', function(e) {
                if (e.target === this) {
                    this.remove();
                }
            });
        }

        function confirmDelete(id) {
            const customer = customers.find(c => c.id === id);
            if (!customer) return;

            const customerName = customer.name; // Store name before deletion

            // Remove the customer
            customers = customers.filter(c => c.id !== id);
            
            // Remove from selected set if it was selected
            selectedCustomerIds.delete(id);
            
            // If current page becomes empty, go to previous page
            const totalPages = Math.ceil(customers.length / itemsPerPage);
            if (currentPage > totalPages && totalPages > 0) {
                currentPage = totalPages;
            }
            
            // Close ALL modals by removing all modal backdrops
            const modals = document.querySelectorAll(\'.modal-backdrop\');
            modals.forEach(modal => modal.remove());
            
            // Re-apply current filters and re-render table
            filterCustomers();
            updatePaginationButtons();
            
            // Show success message
            const notification = document.createElement(\'div\');
            notification.className = \'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 fade-in\';
            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Đã xóa khách hàng "${customerName}" thành công!
                </div>
            `;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Store selected items across filter changes
        let selectedCustomerIds = new Set();

        // Export Modal Functions
        function openExportModal() {
            updateExportCounts();
            updateExportPreview();
            document.getElementById(\'exportModal\').classList.remove(\'hidden\');
        }

        function closeExportModal() {
            document.getElementById(\'exportModal\').classList.add(\'hidden\');
        }

        function updateExportCounts() {
            document.getElementById(\'totalCustomers\').textContent = customers.length;
            
            // Calculate current page customers
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const currentPageCount = Math.min(itemsPerPage, filteredCustomers.length - startIndex);
            document.getElementById(\'currentPageCustomers\').textContent = Math.max(0, currentPageCount);
            
            // Count selected customers from the stored set
            document.getElementById(\'selectedCustomers\').textContent = selectedCustomerIds.size;
        }

        function selectAllColumns() {
            const checkboxes = document.querySelectorAll(\'input[name="exportColumns"]\');
            checkboxes.forEach(checkbox => checkbox.checked = true);
            updateExportPreview();
        }

        function deselectAllColumns() {
            const checkboxes = document.querySelectorAll(\'input[name="exportColumns"]\');
            checkboxes.forEach(checkbox => checkbox.checked = false);
            updateExportPreview();
        }

        function updateExportPreview() {
            const rangeRadio = document.querySelector(\'input[name="exportRange"]:checked\');
            const formatSelect = document.getElementById(\'exportFormat\');
            const selectedColumns = document.querySelectorAll(\'input[name="exportColumns"]:checked\');
            
            let count = 0;
            switch(rangeRadio?.value) {
                case \'all\':
                    count = customers.length;
                    break;
                case \'currentPage\':
                    const startIndex = (currentPage - 1) * itemsPerPage;
                    const currentPageCount = Math.min(itemsPerPage, filteredCustomers.length - startIndex);
                    count = Math.max(0, currentPageCount);
                    break;
                case \'selected\':
                    count = selectedCustomerIds.size;
                    break;
            }
            
            document.getElementById(\'previewCount\').textContent = count;
            
            const formatText = formatSelect.options[formatSelect.selectedIndex].text;
            document.getElementById(\'previewFormat\').textContent = formatText;
            
            document.getElementById(\'previewColumns\').textContent = `${selectedColumns.length} cột`;
        }

        function getExportData() {
            const rangeRadio = document.querySelector(\'input[name="exportRange"]:checked\');
            const selectedStatuses = Array.from(document.querySelectorAll(\'input[name="exportStatus"]:checked\')).map(cb => cb.value);
            
            let dataToExport = [];
            
            switch(rangeRadio?.value) {
                case \'all\':
                    dataToExport = customers;
                    break;
                case \'currentPage\':
                    const startIndex = (currentPage - 1) * itemsPerPage;
                    const endIndex = startIndex + itemsPerPage;
                    dataToExport = filteredCustomers.slice(startIndex, endIndex);
                    break;
                case \'selected\':
                    const selectedIds = Array.from(selectedCustomerIds);
                    dataToExport = customers.filter(c => selectedIds.includes(c.id));
                    break;
            }
            
            // Filter by status
            if (selectedStatuses.length > 0) {
                dataToExport = dataToExport.filter(c => selectedStatuses.includes(c.status));
            }
            
            return dataToExport;
        }

        function processExport() {
            const selectedColumns = Array.from(document.querySelectorAll(\'input[name="exportColumns"]:checked\')).map(cb => cb.value);
            const format = document.getElementById(\'exportFormat\').value;
            const fileName = document.getElementById(\'exportFileName\').value || \'danh-sach-khach-hang\';
            const includeHeader = document.getElementById(\'includeHeader\').checked;
            const includeTimestamp = document.getElementById(\'includeTimestamp\').checked;
            const includeSummary = document.getElementById(\'includeSummary\').checked;
            
            if (selectedColumns.length === 0) {
                alert(\'Vui lòng chọn ít nhất một cột để xuất!\');
                return;
            }
            
            const dataToExport = getExportData();
            
            if (dataToExport.length === 0) {
                alert(\'Không có dữ liệu để xuất!\');
                return;
            }
            
            switch(format) {
                case \'xlsx\':
                    exportToExcel(dataToExport, selectedColumns, fileName, includeHeader, includeTimestamp, includeSummary);
                    break;
                case \'csv\':
                    exportToCSV(dataToExport, selectedColumns, fileName, includeHeader, includeTimestamp);
                    break;
                case \'pdf\':
                    exportToPDF(dataToExport, selectedColumns, fileName, includeHeader, includeTimestamp, includeSummary);
                    break;
            }
            
            closeExportModal();
        }

        function getColumnHeader(column) {
            const headers = {
                id: \'ID\',
                name: \'Họ và tên\',
                email: \'Email\',
                phone: \'Số điện thoại\',
                address: \'Địa chỉ\',
                type: \'Loại khách hàng\',
                orders: \'Số đơn hàng\',
                totalSpent: \'Tổng chi tiêu\',
                status: \'Trạng thái\',
                joinDate: \'Ngày tham gia\'
            };
            return headers[column] || column;
        }

        function getColumnValue(customer, column) {
            switch(column) {
                case \'totalSpent\':
                    return formatCurrency(customer.totalSpent);
                case \'joinDate\':
                    return formatDate(customer.joinDate);
                case \'type\':
                    const typeLabels = { vip: \'VIP\', regular: \'Thường\', new: \'Mới\' };
                    return typeLabels[customer.type] || customer.type;
                case \'status\':
                    const statusLabels = { active: \'Hoạt động\', inactive: \'Không hoạt động\', blocked: \'Bị khóa\' };
                    return statusLabels[customer.status] || customer.status;
                default:
                    return customer[column] || \'\';
            }
        }

        function exportToExcel(data, columns, fileName, includeHeader, includeTimestamp, includeSummary) {
            try {
                let csvContent = \'\';
                
                // Add timestamp if requested
                if (includeTimestamp) {
                    csvContent += `Xuất ngày: ${new Date().toLocaleString(\'vi-VN\')}\n\n`;
                }
                
                // Add summary if requested
                if (includeSummary) {
                    csvContent += `Tổng số khách hàng: ${data.length}\n`;
                    csvContent += `Hoạt động: ${data.filter(c => c.status === \'active\').length}\n`;
                    csvContent += `Không hoạt động: ${data.filter(c => c.status === \'inactive\').length}\n`;
                    csvContent += `Bị khóa: ${data.filter(c => c.status === \'blocked\').length}\n\n`;
                }
                
                // Add headers
                if (includeHeader) {
                    const headers = columns.map(col => getColumnHeader(col));
                    csvContent += headers.join(\',\') + \'\n\';
                }
                
                // Add data rows
                data.forEach(customer => {
                    const row = columns.map(col => {
                        const value = getColumnValue(customer, col);
                        // Escape quotes and wrap in quotes if contains comma or quote
                        if (typeof value === \'string\' && (value.includes(\',\') || value.includes(\'"\') || value.includes(\'\n\'))) {
                            return `"${value.replace(/"/g, \'""\')}"`;
                        }
                        return value;
                    });
                    csvContent += row.join(\',\') + \'\n\';
                });
                
                // Create and download file
                const blob = new Blob([\'\ufeff\' + csvContent], { 
                    type: \'text/csv;charset=utf-8;\' 
                });
                
                const url = URL.createObjectURL(blob);
                const link = document.createElement(\'a\');
                link.href = url;
                link.download = `${fileName}-${new Date().toISOString().split(\'T\')[0]}.csv`;
                
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                URL.revokeObjectURL(url);
                
                showExportSuccess(data.length, \'Excel\');
                
            } catch (error) {
                console.error(\'Lỗi khi xuất Excel:\', error);
                alert(\'Có lỗi xảy ra khi xuất file Excel. Vui lòng thử lại!\');
            }
        }

        function exportToCSV(data, columns, fileName, includeHeader, includeTimestamp) {
            exportToExcel(data, columns, fileName, includeHeader, includeTimestamp, false);
        }

        function exportToPDF(data, columns, fileName, includeHeader, includeTimestamp, includeSummary) {
            // For demo purposes, we\'ll create a simple HTML version that can be printed as PDF
            let htmlContent = `
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Danh sách khách hàng</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; font-weight: bold; }
                        .header { margin-bottom: 20px; }
                        .summary { margin-bottom: 20px; background-color: #f9f9f9; padding: 15px; border-radius: 5px; }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <h1>Danh sách khách hàng</h1>
            `;
            
            if (includeTimestamp) {
                htmlContent += `<p>Xuất ngày: ${new Date().toLocaleString(\'vi-VN\')}</p>`;
            }
            
            htmlContent += \'</div>\';
            
            if (includeSummary) {
                htmlContent += `
                    <div class="summary">
                        <h3>Thống kê tổng quan</h3>
                        <p>Tổng số khách hàng: ${data.length}</p>
                        <p>Hoạt động: ${data.filter(c => c.status === \'active\').length}</p>
                        <p>Không hoạt động: ${data.filter(c => c.status === \'inactive\').length}</p>
                        <p>Bị khóa: ${data.filter(c => c.status === \'blocked\').length}</p>
                    </div>
                ;
            }
            
            htmlContent += \'<table>\';
            
            if (includeHeader) {
                htmlContent += \'<thead><tr>\';
                columns.forEach(col => {
                    htmlContent += `<th>${getColumnHeader(col)}</th>`;
                });
                htmlContent += \'</tr></thead>\';
            }
            
            htmlContent += \'<tbody>\';
            data.forEach(customer => {
                htmlContent += \'<tr>\';
                columns.forEach(col => {
                    htmlContent += `<td>${getColumnValue(customer, col)}</td>`;
                });
                htmlContent += \'</tr>\';
            });
            htmlContent += \'</tbody></table></body></html>\';
            
            // Open in new window for printing
            const printWindow = window.open(\'\', \'_blank\');
            printWindow.document.write(htmlContent);
            printWindow.document.close();
            
            // Auto print after a short delay
            setTimeout(() => {
                printWindow.print();
            }, 500);
            
            showExportSuccess(data.length, \'PDF\');
        }

        function showExportSuccess(count, format) {
            const notification = document.createElement(\'div\');
            notification.className = \'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 fade-in\';
            notification.textContent = `Đã xuất ${count} khách hàng ra file ${format} thành công!`;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }



        // Event listeners
        document.addEventListener(\'DOMContentLoaded\', function() {
            // Search and filter listeners
            document.getElementById(\'searchInput\').addEventListener(\'input\', filterCustomers);
            document.getElementById(\'statusFilter\').addEventListener(\'change\', filterCustomers);
            document.getElementById(\'typeFilter\').addEventListener(\'change\', filterCustomers);

            // Main buttons
            document.getElementById(\'exportBtn\').addEventListener(\'click\', function(e) {
                e.preventDefault();
                openExportModal();
            });
            
            document.getElementById(\'addCustomerBtn\').addEventListener(\'click\', function(e) {
                e.preventDefault();
                openAddModal();
            });

            // Pagination buttons
            document.getElementById(\'prevPageMobile\').addEventListener(\'click\', previousPage);
            document.getElementById(\'nextPageMobile\').addEventListener(\'click\', nextPage);

            // Export modal buttons
            document.getElementById(\'closeExportModalBtn\').addEventListener(\'click\', closeExportModal);
            document.getElementById(\'cancelExportBtn\').addEventListener(\'click\', closeExportModal);
            document.getElementById(\'processExportBtn\').addEventListener(\'click\', processExport);
            document.getElementById(\'selectAllColumnsBtn\').addEventListener(\'click\', selectAllColumns);
            document.getElementById(\'deselectAllColumnsBtn\').addEventListener(\'click\', deselectAllColumns);

            // Customer modal buttons
            document.getElementById(\'cancelCustomerBtn\').addEventListener(\'click\', closeModal);

            // Select all functionality using event delegation
            document.addEventListener(\'change\', function(e) {
                // Select all checkbox
                if (e.target.id === \'selectAll\') {
                    const checkboxes = document.querySelectorAll(\'tbody input[type="checkbox"]\');
                    checkboxes.forEach(checkbox => {
                        const customerId = parseInt(checkbox.value);
                        checkbox.checked = e.target.checked;
                        
                        if (e.target.checked) {
                            selectedCustomerIds.add(customerId);
                        } else {
                            selectedCustomerIds.delete(customerId);
                        }
                    });
                    updateExportCounts();
                    updateSelectAllCheckbox();
                }
                
                // Individual checkboxes
                if (e.target.type === \'checkbox\' && e.target.closest(\'tbody\')) {
                    const customerId = parseInt(e.target.value);
                    
                    if (e.target.checked) {
                        selectedCustomerIds.add(customerId);
                    } else {
                        selectedCustomerIds.delete(customerId);
                    }
                    
                    updateExportCounts();
                    updateSelectAllCheckbox();
                }
                
                // Update export preview
                if (e.target.name === \'exportRange\' || 
                    e.target.name === \'exportColumns\' || 
                    e.target.id === \'exportFormat\') {
                    updateExportPreview();
                }
            });

            // Close modals when clicking outside
            document.getElementById(\'customerModal\').addEventListener(\'click\', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });

            document.getElementById(\'exportModal\').addEventListener(\'click\', function(e) {
                if (e.target === this) {
                    closeExportModal();
                }
            });

            // Initialize
            renderCustomerTable();
            updatePaginationButtons();
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement(\'script\');d.innerHTML="window.__CF$cv$params={r:\'98c8357931793ee9\',t:\'MTc2MDEyMTIzNi4wMDAwMDA=\'};var a=document.createElement(\'script\');a.nonce=\'\';a.src=\'/cdn-cgi/challenge-platform/scripts/jsd/main.js\';document.getElementsByTagName(\'head\')[0].appendChild(a);";b.getElementsByTagName(\'head\')[0].appendChild(d)}}if(document.body){var a=document.createElement(\'iframe\');a.height=1;a.width=1;a.style.position=\'absolute\';a.style.top=0;a.style.left=0;a.style.border=\'none\';a.style.visibility=\'hidden\';document.body.appendChild(a);if(\'loading\'!==document.readyState)c();else if(window.addEventListener)document.addEventListener(\'DOMContentLoaded\',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);\'loading\'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
@endsection