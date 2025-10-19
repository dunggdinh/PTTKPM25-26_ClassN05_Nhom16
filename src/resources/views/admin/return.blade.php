@extends('admin.layout')
@section('title', 'Quản lý hàng lỗi')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-4xl font-bold text-gray-900">Quản lý Đổi/Trả hàng</h1>
            <p class="text-gray-600 mt-1">Xử lý các yêu cầu đổi trả từ khách hàng</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-yellow-100">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Chờ xử lý</p>
                        <!-- <p class="text-2xl font-semibold text-gray-900" id="pendingCount">12</p> -->
                        <!-- data that -->
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['pending'] }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Đang xử lý</p>
                        <!-- <p class="text-2xl font-semibold text-gray-900" id="processingCount">8</p> -->
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['processing'] }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-100">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Hoàn thành</p>
                        <!-- <p class="text-2xl font-semibold text-gray-900" id="completedCount">45</p> -->
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['completed'] }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-red-100">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Từ chối</p>
                        <!-- <p class="text-2xl font-semibold text-gray-900" id="rejectedCount">3</p> -->
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['rejected'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Phân trang -->
        <div class="p-4">
            {{ $returns->links('pagination::tailwind') }}
        </div>
        <!-- Filters and Search -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tìm kiếm</label>
                    <input type="text" id="searchInput" placeholder="Mã đơn hàng, tên khách hàng..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                    <select id="statusFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending">Chờ xử lý</option>
                        <option value="processing">Đang xử lý</option>
                        <option value="approved">Đã duyệt</option>
                        <option value="rejected">Từ chối</option>
                        <option value="completed">Hoàn thành</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Loại yêu cầu</label>
                    <select id="typeFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Tất cả</option>
                        <option value="return">Trả hàng</option>
                        <option value="exchange">Đổi hàng</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ngày tạo</label>
                    <input type="date" id="dateFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
            <div class="mt-4 flex justify-between items-center">
                <div>
                    <button onclick="openExportModal()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Xuất báo cáo
                    </button>
                </div>
                <div class="flex space-x-3">
                    <button onclick="clearFilters()" class="px-4 py-2 text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg">
                        Xóa bộ lọc
                    </button>
                    <button onclick="applyFilters()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                        Áp dụng
                    </button>
                </div>
            </div>
        </div>

        <!-- Returns/Exchanges Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Danh sách yêu cầu đổi/trả</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="selectAll" onchange="toggleSelectAll()" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã yêu cầu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loại</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lý do</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tạo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                        </tr>
                    </thead>
                    <!-- <tbody id="returnsTableBody" class="bg-white divide-y divide-gray-200">
                        Table rows will be populated by JavaScript -->
                    <!-- </tbody> -->
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($returns as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $item->return_id }}</td>
                        <td class="px-6 py-4">{{ $item->order_item_id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $item->reason }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 text-xs rounded-full
                                @if($item->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($item->status == 'processing') bg-blue-100 text-blue-800
                                @elseif($item->status == 'approved') bg-green-100 text-green-800
                                @elseif($item->status == 'completed') bg-green-200 text-green-900
                                @elseif($item->status == 'rejected') bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($item->requested_at)->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $item->processed_at ? \Carbon\Carbon::parse($item->processed_at)->format('d/m/Y H:i') : '—' }}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-6 py-3 flex items-center justify-between border-t border-gray-200 mt-6 rounded-lg shadow-sm">
            <div class="flex-1 flex justify-between sm:hidden">
                <button onclick="previousPage()" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Trước
                </button>
                <button onclick="nextPage()" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Sau
                </button>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Hiển thị <span class="font-medium" id="showingFrom">1</span> đến <span class="font-medium" id="showingTo">10</span> trong tổng số <span class="font-medium" id="totalRecords">68</span> kết quả
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                        <button onclick="previousPage()" id="prevBtn" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span class="sr-only">Trước</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="pageNumbers" class="relative inline-flex items-center">
                            <!-- Page numbers will be generated here -->
                        </div>
                        <button onclick="nextPage()" id="nextBtn" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span class="sr-only">Sau</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Excel Modal -->
    <div id="exportModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-10 mx-auto p-6 border w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 shadow-lg rounded-lg bg-white">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Xuất dữ liệu Excel</h3>
                        <p class="text-sm text-gray-600">Tùy chỉnh dữ liệu xuất theo nhu cầu</p>
                    </div>
                </div>
                <button onclick="closeExportModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Phạm vi xuất -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-3">Phạm vi xuất</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="exportScope" value="all" checked class="text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Tất cả yêu cầu (<span id="totalCount">5</span> yêu cầu)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="exportScope" value="current" class="text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Trang hiện tại (<span id="currentCount">5</span> yêu cầu)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="exportScope" value="selected" class="text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Yêu cầu đã chọn (<span id="selectedCount">0</span> yêu cầu)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Định dạng file -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Định dạng file</label>
                        <select id="fileFormat" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="xlsx">Excel (.xlsx)</option>
                            <option value="csv">CSV (.csv)</option>
                        </select>
                    </div>

                    <!-- Tên file -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tên file</label>
                        <input type="text" id="fileName" value="danh-sach-doi-tra-hang" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Tên file sẽ được thêm ngày tháng tự động</p>
                    </div>

                    <!-- Lọc theo trạng thái -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-3">Lọc theo trạng thái</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" id="statusPending" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Chờ xử lý</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="statusProcessing" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Đang xử lý</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="statusApproved" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Đã duyệt</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="statusRejected" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Từ chối</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="statusCompleted" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Hoàn thành</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Chọn cột xuất -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-3">Chọn cột xuất</h4>
                        <div class="max-h-48 overflow-y-auto space-y-2 mb-3">
                            <label class="flex items-center">
                                <input type="checkbox" id="colId" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Mã yêu cầu</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="colCustomer" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Khách hàng</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="colEmail" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Email</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="colPhone" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Số điện thoại</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="colProduct" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Sản phẩm</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="colOrderId" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Mã đơn hàng</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="colType" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Loại yêu cầu</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="colReason" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Lý do</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="colAmount" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Giá trị</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="colStatus" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Trạng thái</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="colDate" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Ngày tạo</span>
                            </label>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="selectAllColumns()" class="text-xs px-3 py-1 bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200">
                                Chọn tất cả
                            </button>
                            <button onclick="deselectAllColumns()" class="text-xs px-3 py-1 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">
                                Bỏ chọn tất cả
                            </button>
                        </div>
                    </div>

                    <!-- Tùy chọn bổ sung -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-3">Tùy chọn bổ sung</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" id="includeHeaders" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Bao gồm tiêu đề cột</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="includeTimestamp" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Thêm thời gian xuất</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="includeSummary" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Thêm thống kê tổng quan</span>
                            </label>
                        </div>
                    </div>

                    <!-- Xem trước -->
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-2">Xem trước thông tin xuất</h4>
                        <div class="text-sm text-gray-700 space-y-1">
                            <p>Sẽ xuất: <span id="previewCount" class="font-medium">5 yêu cầu</span></p>
                            <p>Định dạng: <span id="previewFormat" class="font-medium">Excel (.xlsx)</span></p>
                            <p>Cột: <span id="previewColumns" class="font-medium">9 cột</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="mt-6 pt-4 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <p class="text-sm text-gray-500 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                        File sẽ được tải xuống tự động
                    </p>
                    <div class="flex space-x-3">
                        <button onclick="closeExportModal()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg">
                            Hủy
                        </button>
                        <button onclick="executeExport()" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg flex items-center">
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

    <!-- Detail Modal -->
    <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Chi tiết yêu cầu đổi/trả</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="modalContent" class="space-y-4">
                    <!-- Modal content will be populated by JavaScript -->
                </div>
                <div class="flex justify-end space-x-3 mt-6 pt-4 border-t">
                    <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg">
                        Đóng
                    </button>
                    <button id="approveBtn" onclick="approveRequest()" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                        Duyệt yêu cầu
                    </button>
                    <button id="rejectBtn" onclick="rejectRequest()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                        Từ chối
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample data
        let returnsData = [
            {
                id: \'RT001\',
                customer: \'Nguyễn Văn An\',
                email: \'an.nguyen@email.com\',
                phone: \'0901234567\',
                product: \'iPhone 14 Pro Max 256GB\',
                orderId: \'ORD001\',
                type: \'return\',
                reason: \'Sản phẩm bị lỗi màn hình\',
                status: \'pending\',
                createdDate: \'2024-01-15\',
                amount: 29990000,
                description: \'Màn hình bị vỡ góc, không thể sử dụng bình thường\'
            },
            {
                id: \'RT002\',
                customer: \'Trần Thị Bình\',
                email: \'binh.tran@email.com\',
                phone: \'0912345678\',
                product: \'Samsung Galaxy S23 Ultra\',
                orderId: \'ORD002\',
                type: \'exchange\',
                reason: \'Muốn đổi màu khác\',
                status: \'processing\',
                createdDate: \'2024-01-14\',
                amount: 26990000,
                description: \'Khách hàng muốn đổi từ màu đen sang màu trắng\'
            },
            {
                id: \'RT003\',
                customer: \'Lê Văn Cường\',
                email: \'cuong.le@email.com\',
                phone: \'0923456789\',
                product: \'MacBook Air M2 13inch\',
                orderId: \'ORD003\',
                type: \'return\',
                reason: \'Không đúng như mô tả\',
                status: \'approved\',
                createdDate: \'2024-01-13\',
                amount: 28990000,
                description: \'Sản phẩm không có đầy đủ phụ kiện như quảng cáo\'
            },
            {
                id: \'RT004\',
                customer: \'Phạm Thị Dung\',
                email: \'dung.pham@email.com\',
                phone: \'0934567890\',
                product: \'iPad Pro 11inch 128GB\',
                orderId: \'ORD004\',
                type: \'exchange\',
                reason: \'Muốn nâng cấp dung lượng\',
                status: \'completed\',
                createdDate: \'2024-01-12\',
                amount: 22990000,
                description: \'Khách hàng muốn đổi từ 128GB lên 256GB\'
            },
            {
                id: \'RT005\',
                customer: \'Hoàng Văn Em\',
                email: \'em.hoang@email.com\',
                phone: \'0945678901\',
                product: \'AirPods Pro 2nd Gen\',
                orderId: \'ORD005\',
                type: \'return\',
                reason: \'Không vừa tai\',
                status: \'rejected\',
                createdDate: \'2024-01-11\',
                amount: 6490000,
                description: \'Khách hàng cho rằng tai nghe không vừa với tai\'
            },
            {
                id: \'RT006\',
                customer: \'Vũ Thị Giang\',
                email: \'giang.vu@email.com\',
                phone: \'0956789012\',
                product: \'Apple Watch Series 9\',
                orderId: \'ORD006\',
                type: \'exchange\',
                reason: \'Muốn đổi size dây\',
                status: \'pending\',
                createdDate: \'2024-01-10\',
                amount: 9990000,
                description: \'Dây đeo quá lớn, muốn đổi size nhỏ hơn\'
            },
            {
                id: \'RT007\',
                customer: \'Đặng Văn Hùng\',
                email: \'hung.dang@email.com\',
                phone: \'0967890123\',
                product: \'Sony WH-1000XM5\',
                orderId: \'ORD007\',
                type: \'return\',
                reason: \'Không ưng ý\',
                status: \'processing\',
                createdDate: \'2024-01-09\',
                amount: 8990000,
                description: \'Chất lượng âm thanh không như mong đợi\'
            },
            {
                id: \'RT008\',
                customer: \'Bùi Thị Lan\',
                email: \'lan.bui@email.com\',
                phone: \'0978901234\',
                product: \'Dell XPS 13\',
                orderId: \'ORD008\',
                type: \'return\',
                reason: \'Lỗi phần cứng\',
                status: \'approved\',
                createdDate: \'2024-01-08\',
                amount: 32990000,
                description: \'Máy tính bị lỗi bàn phím, một số phím không hoạt động\'
            },
            {
                id: \'RT009\',
                customer: \'Ngô Văn Minh\',
                email: \'minh.ngo@email.com\',
                phone: \'0989012345\',
                product: \'Canon EOS R6\',
                orderId: \'ORD009\',
                type: \'exchange\',
                reason: \'Muốn nâng cấp model\',
                status: \'completed\',
                createdDate: \'2024-01-07\',
                amount: 45990000,
                description: \'Khách hàng muốn đổi lên Canon EOS R6 Mark II\'
            },
            {
                id: \'RT010\',
                customer: \'Lý Thị Nga\',
                email: \'nga.ly@email.com\',
                phone: \'0990123456\',
                product: \'Nintendo Switch OLED\',
                orderId: \'ORD010\',
                type: \'return\',
                reason: \'Con không thích\',
                status: \'rejected\',
                createdDate: \'2024-01-06\',
                amount: 8990000,
                description: \'Mua cho con nhưng con không chơi\'
            },
            {
                id: \'RT011\',
                customer: \'Trịnh Văn Phúc\',
                email: \'phuc.trinh@email.com\',
                phone: \'0901234568\',
                product: \'Samsung Galaxy Tab S9\',
                orderId: \'ORD011\',
                type: \'exchange\',
                reason: \'Muốn đổi màu\',
                status: \'pending\',
                createdDate: \'2024-01-05\',
                amount: 18990000,
                description: \'Đổi từ màu xám sang màu hồng\'
            },
            {
                id: \'RT012\',
                customer: \'Hoàng Thị Quỳnh\',
                email: \'quynh.hoang@email.com\',
                phone: \'0912345679\',
                product: \'Dyson V15 Detect\',
                orderId: \'ORD012\',
                type: \'return\',
                reason: \'Quá nặng\',
                status: \'processing\',
                createdDate: \'2024-01-04\',
                amount: 19990000,
                description: \'Máy hút bụi quá nặng, không phù hợp với người già\'
            }
        ];

        let currentPage = 1;
        let itemsPerPage = 5; // Giảm xuống 5 để dễ test phân trang
        let filteredData = [...returnsData];
        let currentRequestId = null;
        let selectedItems = new Set(); // Lưu trữ các item được chọn

        // Initialize the page
        function init() {
            renderTable();
            updateStatistics();
            setupEventListeners();
        }

        // Setup event listeners
        function setupEventListeners() {
            document.getElementById(\'searchInput\').addEventListener(\'input\', debounce(applyFilters, 300));
            document.getElementById(\'statusFilter\').addEventListener(\'change\', applyFilters);
            document.getElementById(\'typeFilter\').addEventListener(\'change\', applyFilters);
            document.getElementById(\'dateFilter\').addEventListener(\'change\', applyFilters);
            
            // Export modal event listeners
            document.addEventListener(\'change\', function(e) {
                if (e.target.name === \'exportScope\' || 
                    e.target.id === \'fileFormat\' || 
                    e.target.id.startsWith(\'col\') ||
                    e.target.id.startsWith(\'status\')) {
                    updatePreview();
                }
            });
        }

        // Debounce function for search
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Render table
        function renderTable() {
            const tbody = document.getElementById(\'returnsTableBody\');
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const pageData = filteredData.slice(startIndex, endIndex);

            tbody.innerHTML = pageData.map(item => `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" ${selectedItems.has(item.id) ? \'checked\' : \'\'} onchange="toggleSelectItem(\'${item.id}\')" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${item.id}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${item.customer}</div>
                        <div class="text-sm text-gray-500">${item.email}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">${item.product}</div>
                        <div class="text-sm text-gray-500">Đơn hàng: ${item.orderId}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium rounded-full ${item.type === \'return\' ? \'bg-red-100 text-red-800\' : \'bg-blue-100 text-blue-800\'}">
                            ${item.type === \'return\' ? \'Trả hàng\' : \'Đổi hàng\'}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">${item.reason}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium rounded-full status-${item.status}">
                            ${getStatusText(item.status)}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formatDate(item.createdDate)}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button onclick="viewDetail(\'${item.id}\')" class="text-blue-600 hover:text-blue-900 mr-3">Xem</button>
                        ${item.status === \'pending\' ? `
                            <button onclick="quickApprove(\'${item.id}\')" class="text-green-600 hover:text-green-900 mr-3">Duyệt</button>
                            <button onclick="quickReject(\'${item.id}\')" class="text-red-600 hover:text-red-900">Từ chối</button>
                        ` : \'\'}
                    </td>
                </tr>
            `).join(\'\');

            updatePagination();
            updateSelectAllCheckbox();
        }

        // Get status text in Vietnamese
        function getStatusText(status) {
            const statusMap = {
                \'pending\': \'Chờ xử lý\',
                \'processing\': \'Đang xử lý\',
                \'approved\': \'Đã duyệt\',
                \'rejected\': \'Từ chối\',
                \'completed\': \'Hoàn thành\'
            };
            return statusMap[status] || status;
        }

        // Format date
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString(\'vi-VN\');
        }

        // Update pagination
        function updatePagination() {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            const startIndex = (currentPage - 1) * itemsPerPage + 1;
            const endIndex = Math.min(currentPage * itemsPerPage, filteredData.length);

            document.getElementById(\'showingFrom\').textContent = filteredData.length > 0 ? startIndex : 0;
            document.getElementById(\'showingTo\').textContent = endIndex;
            document.getElementById(\'totalRecords\').textContent = filteredData.length;
            
            // Update pagination buttons
            const prevBtn = document.getElementById(\'prevBtn\');
            const nextBtn = document.getElementById(\'nextBtn\');
            const pageNumbers = document.getElementById(\'pageNumbers\');
            
            // Disable/enable buttons
            prevBtn.disabled = currentPage <= 1;
            nextBtn.disabled = currentPage >= totalPages;
            
            // Generate page numbers
            let paginationHTML = \'\';
            
            if (totalPages <= 7) {
                // Show all pages if 7 or fewer
                for (let i = 1; i <= totalPages; i++) {
                    paginationHTML += `
                        <button onclick="goToPage(${i})" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium ${
                            i === currentPage ? \'text-blue-600 bg-blue-50 border-blue-500\' : \'text-gray-700 hover:bg-gray-50\'
                        }">
                            ${i}
                        </button>
                    `;
                }
            } else {
                // Show abbreviated pagination
                if (currentPage <= 4) {
                    // Show first 5 pages + ... + last page
                    for (let i = 1; i <= 5; i++) {
                        paginationHTML += `
                            <button onclick="goToPage(${i})" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium ${
                                i === currentPage ? \'text-blue-600 bg-blue-50 border-blue-500\' : \'text-gray-700 hover:bg-gray-50\'
                            }">
                                ${i}
                            </button>
                        `;
                    }
                    paginationHTML += `
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                            ...
                        </span>
                        <button onclick="goToPage(${totalPages})" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            ${totalPages}
                        </button>
                    `;
                } else if (currentPage >= totalPages - 3) {
                    // Show first page + ... + last 5 pages
                    paginationHTML += `
                        <button onclick="goToPage(1)" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            1
                        </button>
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                            ...
                        </span>
                    `;
                    for (let i = totalPages - 4; i <= totalPages; i++) {
                        paginationHTML += `
                            <button onclick="goToPage(${i})" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium ${
                                i === currentPage ? \'text-blue-600 bg-blue-50 border-blue-500\' : \'text-gray-700 hover:bg-gray-50\'
                            }">
                                ${i}
                            </button>
                        `;
                    }
                } else {
                    // Show first page + ... + current-1, current, current+1 + ... + last page
                    paginationHTML += `
                        <button onclick="goToPage(1)" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            1
                        </button>
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                            ...
                        </span>
                    `;
                    for (let i = currentPage - 1; i <= currentPage + 1; i++) {
                        paginationHTML += `
                            <button onclick="goToPage(${i})" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium ${
                                i === currentPage ? \'text-blue-600 bg-blue-50 border-blue-500\' : \'text-gray-700 hover:bg-gray-50\'
                            }">
                                ${i}
                            </button>
                        `;
                    }
                    paginationHTML += `
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                            ...
                        </span>
                        <button onclick="goToPage(${totalPages})" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            ${totalPages}
                        </button>
                    `;
                }
            }
            
            pageNumbers.innerHTML = paginationHTML;
        }

        // Update statistics
        function updateStatistics() {
            // Tính thống kê dựa trên dữ liệu đã lọc thay vì toàn bộ dữ liệu
            const stats = filteredData.reduce((acc, item) => {
                acc[item.status] = (acc[item.status] || 0) + 1;
                return acc;
            }, {});

            document.getElementById(\'pendingCount\').textContent = stats.pending || 0;
            document.getElementById(\'processingCount\').textContent = stats.processing || 0;
            document.getElementById(\'completedCount\').textContent = (stats.completed || 0) + (stats.approved || 0);
            document.getElementById(\'rejectedCount\').textContent = stats.rejected || 0;
        }

        // Apply filters
        function applyFilters() {
            const searchTerm = document.getElementById(\'searchInput\').value.toLowerCase();
            const statusFilter = document.getElementById(\'statusFilter\').value;
            const typeFilter = document.getElementById(\'typeFilter\').value;
            const dateFilter = document.getElementById(\'dateFilter\').value;

            filteredData = returnsData.filter(item => {
                const matchesSearch = !searchTerm || 
                    item.id.toLowerCase().includes(searchTerm) ||
                    item.customer.toLowerCase().includes(searchTerm) ||
                    item.product.toLowerCase().includes(searchTerm);
                
                const matchesStatus = !statusFilter || item.status === statusFilter;
                const matchesType = !typeFilter || item.type === typeFilter;
                const matchesDate = !dateFilter || item.createdDate === dateFilter;

                return matchesSearch && matchesStatus && matchesType && matchesDate;
            });

            currentPage = 1;
            renderTable();
            updateStatistics(); // Cập nhật thống kê sau khi lọc
        }

        // Clear filters
        function clearFilters() {
            document.getElementById(\'searchInput\').value = \'\';
            document.getElementById(\'statusFilter\').value = \'\';
            document.getElementById(\'typeFilter\').value = \'\';
            document.getElementById(\'dateFilter\').value = \'\';
            filteredData = [...returnsData];
            currentPage = 1;
            renderTable();
            updateStatistics(); // Cập nhật thống kê sau khi xóa bộ lọc
        }

        // Pagination functions
        function previousPage() {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
                updateExportCounts(); // Update counts when page changes
            }
        }

        function nextPage() {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
                updateExportCounts(); // Update counts when page changes
            }
        }

        function goToPage(page) {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                renderTable();
                updateExportCounts();
            }
        }

        // View detail modal
        function viewDetail(id) {
            const item = returnsData.find(r => r.id === id);
            if (!item) return;

            currentRequestId = id;
            
            document.getElementById(\'modalTitle\').textContent = `Chi tiết yêu cầu ${item.type === \'return\' ? \'trả hàng\' : \'đổi hàng\'} - ${item.id}`;
            
            document.getElementById(\'modalContent\').innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h4 class="font-medium text-gray-900 mb-2">Thông tin khách hàng</h4>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-medium">Tên:</span> ${item.customer}</p>
                            <p><span class="font-medium">Email:</span> ${item.email}</p>
                            <p><span class="font-medium">Điện thoại:</span> ${item.phone}</p>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900 mb-2">Thông tin đơn hàng</h4>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-medium">Mã đơn hàng:</span> ${item.orderId}</p>
                            <p><span class="font-medium">Sản phẩm:</span> ${item.product}</p>
                            <p><span class="font-medium">Giá trị:</span> ${item.amount.toLocaleString(\'vi-VN\')} ₫</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h4 class="font-medium text-gray-900 mb-2">Chi tiết yêu cầu</h4>
                    <div class="space-y-2 text-sm">
                        <p><span class="font-medium">Loại:</span> ${item.type === \'return\' ? \'Trả hàng\' : \'Đổi hàng\'}</p>
                        <p><span class="font-medium">Lý do:</span> ${item.reason}</p>
                        <p><span class="font-medium">Mô tả:</span> ${item.description}</p>
                        <p><span class="font-medium">Trạng thái:</span> 
                            <span class="px-2 py-1 text-xs font-medium rounded-full status-${item.status}">
                                ${getStatusText(item.status)}
                            </span>
                        </p>
                        <p><span class="font-medium">Ngày tạo:</span> ${formatDate(item.createdDate)}</p>
                    </div>
                </div>
            `;

            // Show/hide action buttons based on status
            const approveBtn = document.getElementById(\'approveBtn\');
            const rejectBtn = document.getElementById(\'rejectBtn\');
            
            if (item.status === \'pending\') {
                approveBtn.style.display = \'block\';
                rejectBtn.style.display = \'block\';
            } else {
                approveBtn.style.display = \'none\';
                rejectBtn.style.display = \'none\';
            }

            document.getElementById(\'detailModal\').classList.remove(\'hidden\');
        }

        // Close modal
        function closeModal() {
            document.getElementById(\'detailModal\').classList.add(\'hidden\');
            currentRequestId = null;
        }

        // Quick approve
        function quickApprove(id) {
            if (confirm(\'Bạn có chắc chắn muốn duyệt yêu cầu này?\')) {
                updateRequestStatus(id, \'approved\');
            }
        }

        // Quick reject
        function quickReject(id) {
            const reason = prompt(\'Nhập lý do từ chối:\');
            if (reason && reason.trim()) {
                updateRequestStatus(id, \'rejected\');
            }
        }

        // Approve request from modal
        function approveRequest() {
            if (currentRequestId && confirm(\'Bạn có chắc chắn muốn duyệt yêu cầu này?\')) {
                updateRequestStatus(currentRequestId, \'approved\');
                closeModal();
            }
        }

        // Reject request from modal
        function rejectRequest() {
            if (currentRequestId) {
                const reason = prompt(\'Nhập lý do từ chối:\');
                if (reason && reason.trim()) {
                    updateRequestStatus(currentRequestId, \'rejected\');
                    closeModal();
                }
            }
        }

        // Update request status
        function updateRequestStatus(id, newStatus) {
            // Find and update in main data array
            const itemIndex = returnsData.findIndex(item => item.id === id);
            if (itemIndex !== -1) {
                returnsData[itemIndex].status = newStatus;
                
                // Add timestamp for status change
                returnsData[itemIndex].lastUpdated = new Date().toISOString();
                
                // If the item is currently in filtered data, update it there too
                const filteredIndex = filteredData.findIndex(item => item.id === id);
                if (filteredIndex !== -1) {
                    filteredData[filteredIndex].status = newStatus;
                    filteredData[filteredIndex].lastUpdated = returnsData[itemIndex].lastUpdated;
                }
                
                // Re-render table and update statistics
                renderTable();
                updateStatistics();
                
                // Show success message with animation
                const statusText = newStatus === \'approved\' ? \'duyệt\' : \'từ chối\';
                showNotification(`✅ Yêu cầu ${id} đã được ${statusText} thành công!`, \'success\');
                
                // Log the action for debugging
                console.log(`Status updated: ${id} -> ${newStatus}`);
            } else {
                showNotification(\'❌ Không tìm thấy yêu cầu để cập nhật!\', \'error\');
                console.error(`Item not found: ${id}`);
            }
        }

        // Show notification
        function showNotification(message, type = \'info\') {
            const notification = document.createElement(\'div\');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 fade-in ${
                type === \'success\' ? \'bg-green-500 text-white\' : 
                type === \'error\' ? \'bg-red-500 text-white\' : 
                \'bg-blue-500 text-white\'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Open export modal
        function openExportModal() {
            updateExportCounts();
            updatePreview();
            document.getElementById(\'exportModal\').classList.remove(\'hidden\');
        }

        // Close export modal
        function closeExportModal() {
            document.getElementById(\'exportModal\').classList.add(\'hidden\');
        }

        // Update export counts
        function updateExportCounts() {
            document.getElementById(\'totalCount\').textContent = returnsData.length;
            // Current page count
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const currentPageCount = filteredData.slice(startIndex, endIndex).length;
            document.getElementById(\'currentCount\').textContent = currentPageCount;
            document.getElementById(\'selectedCount\').textContent = selectedItems.size;
        }

        // Select all columns
        function selectAllColumns() {
            const columnCheckboxes = document.querySelectorAll(\'[id^="col"]\');
            columnCheckboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            updatePreview();
        }

        // Deselect all columns
        function deselectAllColumns() {
            const columnCheckboxes = document.querySelectorAll(\'[id^="col"]\');
            columnCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updatePreview();
        }

        // Update preview information
        function updatePreview() {
            const scope = document.querySelector(\'input[name="exportScope"]:checked\').value;
            const format = document.getElementById(\'fileFormat\').value;
            const selectedColumns = document.querySelectorAll(\'[id^="col"]:checked\').length;
            
            let count = 0;
            if (scope === \'all\') {
                count = returnsData.length;
            } else if (scope === \'current\') {
                // Current page count
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                count = filteredData.slice(startIndex, endIndex).length;
            } else if (scope === \'selected\') {
                count = selectedItems.size;
            }

            document.getElementById(\'previewCount\').textContent = `${count} yêu cầu`;
            document.getElementById(\'previewFormat\').textContent = format === \'xlsx\' ? \'Excel (.xlsx)\' : \'CSV (.csv)\';
            document.getElementById(\'previewColumns\').textContent = `${selectedColumns} cột`;
        }

        // Execute export
        function executeExport() {
            const scope = document.querySelector(\'input[name="exportScope"]:checked\').value;
            const format = document.getElementById(\'fileFormat\').value;
            const fileName = document.getElementById(\'fileName\').value;
            
            // Get selected statuses
            const selectedStatuses = [];
            if (document.getElementById(\'statusPending\').checked) selectedStatuses.push(\'pending\');
            if (document.getElementById(\'statusProcessing\').checked) selectedStatuses.push(\'processing\');
            if (document.getElementById(\'statusApproved\').checked) selectedStatuses.push(\'approved\');
            if (document.getElementById(\'statusRejected\').checked) selectedStatuses.push(\'rejected\');
            if (document.getElementById(\'statusCompleted\').checked) selectedStatuses.push(\'completed\');

            // Get data to export
            let dataToExport = [];
            if (scope === \'all\') {
                dataToExport = returnsData.filter(item => selectedStatuses.includes(item.status));
            } else if (scope === \'current\') {
                // Get current page data only
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const currentPageData = filteredData.slice(startIndex, endIndex);
                dataToExport = currentPageData.filter(item => selectedStatuses.includes(item.status));
            } else if (scope === \'selected\') {
                dataToExport = returnsData.filter(item => selectedItems.has(item.id) && selectedStatuses.includes(item.status));
            }

            // Get selected columns
            const columns = [];
            const headers = [];
            
            if (document.getElementById(\'colId\').checked) {
                columns.push(\'id\');
                headers.push(\'Mã yêu cầu\');
            }
            if (document.getElementById(\'colCustomer\').checked) {
                columns.push(\'customer\');
                headers.push(\'Khách hàng\');
            }
            if (document.getElementById(\'colEmail\').checked) {
                columns.push(\'email\');
                headers.push(\'Email\');
            }
            if (document.getElementById(\'colPhone\').checked) {
                columns.push(\'phone\');
                headers.push(\'Số điện thoại\');
            }
            if (document.getElementById(\'colProduct\').checked) {
                columns.push(\'product\');
                headers.push(\'Sản phẩm\');
            }
            if (document.getElementById(\'colOrderId\').checked) {
                columns.push(\'orderId\');
                headers.push(\'Mã đơn hàng\');
            }
            if (document.getElementById(\'colType\').checked) {
                columns.push(\'type\');
                headers.push(\'Loại yêu cầu\');
            }
            if (document.getElementById(\'colReason\').checked) {
                columns.push(\'reason\');
                headers.push(\'Lý do\');
            }
            if (document.getElementById(\'colAmount\').checked) {
                columns.push(\'amount\');
                headers.push(\'Giá trị\');
            }
            if (document.getElementById(\'colStatus\').checked) {
                columns.push(\'status\');
                headers.push(\'Trạng thái\');
            }
            if (document.getElementById(\'colDate\').checked) {
                columns.push(\'createdDate\');
                headers.push(\'Ngày tạo\');
            }

            // Build CSV content
            let csvContent = "data:text/csv;charset=utf-8,";
            
            // Add timestamp if selected
            if (document.getElementById(\'includeTimestamp\').checked) {
                csvContent += `Xuất lúc: ${new Date().toLocaleString(\'vi-VN\')}\n\n`;
            }
            
            // Add headers if selected
            if (document.getElementById(\'includeHeaders\').checked) {
                csvContent += headers.join(\',\') + \'\n\';
            }
            
            // Add data rows
            csvContent += dataToExport.map(item => {
                return columns.map(col => {
                    let value = item[col];
                    if (col === \'type\') {
                        value = value === \'return\' ? \'Trả hàng\' : \'Đổi hàng\';
                    } else if (col === \'status\') {
                        value = getStatusText(value);
                    } else if (col === \'amount\') {
                        value = value.toLocaleString(\'vi-VN\');
                    }
                    return value;
                }).join(\',\');
            }).join(\'\n\');
            
            // Add summary if selected
            if (document.getElementById(\'includeSummary\').checked) {
                csvContent += \'\n\nThống kê tổng quan:\n\';
                csvContent += `Tổng số yêu cầu: ${dataToExport.length}\n`;
                const statusStats = dataToExport.reduce((acc, item) => {
                    acc[item.status] = (acc[item.status] || 0) + 1;
                    return acc;
                }, {});
                Object.entries(statusStats).forEach(([status, count]) => {
                    csvContent += `${getStatusText(status)}: ${count}\n`;
                });
            }

            // Download file
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            const timestamp = new Date().toISOString().split(\'T\')[0];
            const extension = format === \'xlsx\' ? \'csv\' : format; // Note: We\'re still generating CSV for simplicity
            link.setAttribute("download", `${fileName}-${timestamp}.${extension}`);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            closeExportModal();
            showNotification(\'Đã xuất báo cáo thành công!\', \'success\');
        }

        // Export data (legacy function for compatibility)
        function exportData() {
            openExportModal();
        }

        // Toggle select all checkbox
        function toggleSelectAll() {
            const selectAllCheckbox = document.getElementById(\'selectAll\');
            const currentPageItems = filteredData.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage);
            
            if (selectAllCheckbox.checked) {
                currentPageItems.forEach(item => selectedItems.add(item.id));
            } else {
                currentPageItems.forEach(item => selectedItems.delete(item.id));
            }
            
            renderTable();
            updateSelectAllCheckbox();
        }

        // Toggle individual item selection
        function toggleSelectItem(itemId) {
            if (selectedItems.has(itemId)) {
                selectedItems.delete(itemId);
            } else {
                selectedItems.add(itemId);
            }
            updateSelectAllCheckbox();
        }

        // Update select all checkbox state
        function updateSelectAllCheckbox() {
            const selectAllCheckbox = document.getElementById(\'selectAll\');
            const currentPageItems = filteredData.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage);
            const selectedCurrentPageItems = currentPageItems.filter(item => selectedItems.has(item.id));
            
            if (selectedCurrentPageItems.length === 0) {
                selectAllCheckbox.checked = false;
                selectAllCheckbox.indeterminate = false;
            } else if (selectedCurrentPageItems.length === currentPageItems.length) {
                selectAllCheckbox.checked = true;
                selectAllCheckbox.indeterminate = false;
            } else {
                selectAllCheckbox.checked = false;
                selectAllCheckbox.indeterminate = true;
            }
        }

        // Initialize the application
        init();
    </script>
</div>
</html>
@endsection