@extends('admin.layout')
@section('title', 'Quản lý Thanh toán')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Title Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-4">
            <div class="text-left">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Quản Lý Thanh Toán</h1>
                <p class="text-lg text-gray-600">
                    Quản trị thanh toán, theo dõi giao dịch và xử lý hoàn tiền.
                </p>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <button onclick="showTab(\'verification\')" id="tab-verification" class="tab-button border-b-2 border-blue-500 text-blue-600 py-2 px-1 text-sm font-medium">
                        🔍 Xác Thực Thanh Toán
                    </button>
                    <button onclick="showTab(\'transactions\')" id="tab-transactions" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-2 px-1 text-sm font-medium">
                        📊 Danh Sách Giao Dịch
                    </button>
                    <button onclick="showTab(\'refunds\')" id="tab-refunds" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-2 px-1 text-sm font-medium">
                        💰 Hoàn Tiền
                    </button>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Verification Tab -->
            <div id="verification-tab" class="tab-content fade-in">
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Xác Thực Thanh Toán Chờ Duyệt</h2>
                        <p class="text-sm text-gray-600 mt-1">Kiểm tra và xác thực các giao dịch thanh toán</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="border border-yellow-200 rounded-lg p-4 bg-yellow-50">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3">
                                            <span class="text-lg">🏪</span>
                                            <div>
                                                <h3 class="font-medium text-gray-900">Đơn hàng #DH001234</h3>
                                                <p class="text-sm text-gray-600">Khách hàng: Nguyễn Văn An</p>
                                                <p class="text-sm text-gray-600">Số tiền: 2,450,000 VNĐ</p>
                                                <p class="text-sm text-gray-600">Phương thức: Chuyển khoản ngân hàng</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button onclick="verifyPayment(\'DH001234\', \'approved\')" class="bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-green-700">
                                            ✅ Xác Nhận
                                        </button>
                                        <button onclick="verifyPayment(\'DH001234\', \'rejected\')" class="bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-700">
                                            ❌ Từ Chối
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="border border-yellow-200 rounded-lg p-4 bg-yellow-50">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3">
                                            <span class="text-lg">🏪</span>
                                            <div>
                                                <h3 class="font-medium text-gray-900">Đơn hàng #DH001235</h3>
                                                <p class="text-sm text-gray-600">Khách hàng: Trần Thị Bình</p>
                                                <p class="text-sm text-gray-600">Số tiền: 1,200,000 VNĐ</p>
                                                <p class="text-sm text-gray-600">Phương thức: Ví điện tử MoMo</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button onclick="verifyPayment(\'DH001235\', \'approved\')" class="bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-green-700">
                                            ✅ Xác Nhận
                                        </button>
                                        <button onclick="verifyPayment(\'DH001235\', \'rejected\')" class="bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-700">
                                            ❌ Từ Chối
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transactions Tab -->
            <div id="transactions-tab" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Danh Sách Giao Dịch</h2>
                                <p class="text-sm text-gray-600 mt-1">Tất cả giao dịch thanh toán trong hệ thống</p>
                            </div>
                            <div class="flex space-x-3">
                                <div class="relative">
                                    <button id="statusFilterBtn" onclick="toggleDropdown(\'statusDropdown\')" class="border border-gray-300 rounded-md px-3 py-2 text-sm bg-white hover:bg-gray-50 flex items-center justify-between min-w-[150px]">
                                        <span id="statusFilterText">Tất cả trạng thái</span>
                                        <svg class="w-4 h-4 ml-2 transition-transform duration-200" id="statusArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div id="statusDropdown" class="absolute top-full left-0 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg z-10 hidden">
                                        <div class="py-1">
                                            <button onclick="selectStatus(\'Tất cả trạng thái\')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100">Tất cả trạng thái</button>
                                            <button onclick="selectStatus(\'Hoàn thành\')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 flex items-center">
                                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>Hoàn thành
                                            </button>
                                            <button onclick="selectStatus(\'Chờ xử lý\')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 flex items-center">
                                                <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>Chờ xử lý
                                            </button>
                                            <button onclick="selectStatus(\'Thất bại\')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 flex items-center">
                                                <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>Thất bại
                                            </button>
                                            <button onclick="selectStatus(\'Đã hoàn tiền\')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 flex items-center">
                                                <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>Đã hoàn tiền
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative">
                                    <button id="providerFilterBtn" onclick="toggleDropdown(\'providerDropdown\')" class="border border-gray-300 rounded-md px-3 py-2 text-sm bg-white hover:bg-gray-50 flex items-center justify-between min-w-[170px]">
                                        <span id="providerFilterText">Tất cả nhà cung cấp</span>
                                        <svg class="w-4 h-4 ml-2 transition-transform duration-200" id="providerArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div id="providerDropdown" class="absolute top-full left-0 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg z-10 hidden">
                                        <div class="py-1">
                                            <button onclick="selectProvider(\'Tất cả nhà cung cấp\')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100">Tất cả nhà cung cấp</button>
                                            <button onclick="selectProvider(\'Vietcombank\')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 flex items-center">
                                                <span class="text-green-600 mr-2">🏦</span>Vietcombank
                                            </button>
                                            <button onclick="selectProvider(\'MoMo\')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 flex items-center">
                                                <span class="text-pink-600 mr-2">📱</span>MoMo
                                            </button>
                                            <button onclick="selectProvider(\'ZaloPay\')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 flex items-center">
                                                <span class="text-blue-600 mr-2">💳</span>ZaloPay
                                            </button>
                                            <button onclick="selectProvider(\'Sacombank\')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 flex items-center">
                                                <span class="text-blue-800 mr-2">🏦</span>Sacombank
                                            </button>
                                            <button onclick="selectProvider(\'BIDV\')" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 flex items-center">
                                                <span class="text-green-700 mr-2">🏦</span>BIDV
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <input type="date" class="border border-gray-300 rounded-md px-3 py-2 text-sm">
                                <button onclick="showExportModal()" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-200 flex items-center space-x-2">
                                    <span>⬇</span>
                                    <span>Xuất Excel</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <input type="checkbox" id="selectAll" onchange="toggleSelectAll()" class="text-blue-600 focus:ring-blue-500">
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã GD</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách hàng</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số tiền</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phương thức</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thời gian</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="transaction-checkbox text-blue-600 focus:ring-blue-500" data-transaction-id="TXN001" onchange="updateSelectedCount()">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#TXN001</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Nguyễn Văn An</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2,450,000 VNĐ</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Chuyển khoản</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select onchange="changeTransactionStatus(\'TXN001\', this.value)" class="px-2 py-1 text-xs font-medium rounded-full border-0 bg-green-100 text-green-800 cursor-pointer hover:bg-green-200 focus:ring-2 focus:ring-green-500">
                                            <option value="completed" selected class="bg-white text-gray-900">Hoàn thành</option>
                                            <option value="pending" class="bg-white text-gray-900">Chờ xử lý</option>
                                            <option value="failed" class="bg-white text-gray-900">Thất bại</option>
                                            <option value="refunded" class="bg-white text-gray-900">Đã hoàn tiền</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">15/12/2024 14:30</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <button onclick="viewTransaction(\'TXN001\')" class="text-blue-600 hover:text-blue-800">Xem chi tiết</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="transaction-checkbox text-blue-600 focus:ring-blue-500" data-transaction-id="TXN002" onchange="updateSelectedCount()">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#TXN002</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Trần Thị Bình</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1,200,000 VNĐ</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">MoMo</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select onchange="changeTransactionStatus(\'TXN002\', this.value)" class="px-2 py-1 text-xs font-medium rounded-full border-0 bg-yellow-100 text-yellow-800 cursor-pointer hover:bg-yellow-200 focus:ring-2 focus:ring-yellow-500">
                                            <option value="completed" class="bg-white text-gray-900">Hoàn thành</option>
                                            <option value="pending" selected class="bg-white text-gray-900">Chờ xử lý</option>
                                            <option value="failed" class="bg-white text-gray-900">Thất bại</option>
                                            <option value="refunded" class="bg-white text-gray-900">Đã hoàn tiền</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">15/12/2024 13:45</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <button onclick="viewTransaction(\'TXN002\')" class="text-blue-600 hover:text-blue-800">Xem chi tiết</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="transaction-checkbox text-blue-600 focus:ring-blue-500" data-transaction-id="TXN003" onchange="updateSelectedCount()">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#TXN003</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Lê Văn Cường</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">850,000 VNĐ</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Thẻ tín dụng</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select onchange="changeTransactionStatus(\'TXN003\', this.value)" class="px-2 py-1 text-xs font-medium rounded-full border-0 bg-blue-100 text-blue-800 cursor-pointer hover:bg-blue-200 focus:ring-2 focus:ring-blue-500">
                                            <option value="completed" class="bg-white text-gray-900">Hoàn thành</option>
                                            <option value="pending" class="bg-white text-gray-900">Chờ xử lý</option>
                                            <option value="failed" class="bg-white text-gray-900">Thất bại</option>
                                            <option value="refunded" selected class="bg-white text-gray-900">Đã hoàn tiền</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">14/12/2024 16:20</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <button onclick="viewTransaction(\'TXN003\')" class="text-blue-600 hover:text-blue-800">Xem chi tiết</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Refunds Tab -->
            <div id="refunds-tab" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Quản Lý Hoàn Tiền</h2>
                        <p class="text-sm text-gray-600 mt-1">Xử lý các yêu cầu hoàn tiền từ khách hàng</p>
                    </div>
                    <div class="p-6">
                        <!-- Refund Request Form -->
                        <div class="mb-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h3 class="text-md font-medium text-gray-900 mb-4">🔄 Tạo Yêu Cầu Hoàn Tiền Mới</h3>
                            <form onsubmit="processRefund(event)" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Mã giao dịch</label>
                                    <input type="text" placeholder="Nhập mã giao dịch" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Số tiền hoàn</label>
                                    <input type="text" placeholder="VD: 1,000,000" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                                </div>
                                <div class="flex items-end">
                                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">
                                        Tạo Hoàn Tiền
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Refund Requests List -->
                        <div class="space-y-4">
                            <h3 class="text-md font-medium text-gray-900">Danh Sách Yêu Cầu Hoàn Tiền</h3>
                            
                            <div class="border border-orange-200 rounded-lg p-4 bg-orange-50">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3">
                                            <span class="text-lg">💸</span>
                                            <div>
                                                <h4 class="font-medium text-gray-900">Yêu cầu hoàn tiền #RF001</h4>
                                                <p class="text-sm text-gray-600">Giao dịch: #TXN003 - Lê Văn Cường</p>
                                                <p class="text-sm text-gray-600">Số tiền: 850,000 VNĐ</p>
                                                <p class="text-sm text-gray-600">Lý do: Sản phẩm lỗi</p>
                                                <p class="text-sm text-gray-600">Ngày yêu cầu: 14/12/2024</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button onclick="approveRefund(\'RF001\')" class="bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-green-700">
                                            ✅ Duyệt
                                        </button>
                                        <button onclick="rejectRefund(\'RF001\')" class="bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-700">
                                            ❌ Từ Chối
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="border border-green-200 rounded-lg p-4 bg-green-50">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3">
                                            <span class="text-lg">✅</span>
                                            <div>
                                                <h4 class="font-medium text-gray-900">Hoàn tiền #RF002 - Đã hoàn thành</h4>
                                                <p class="text-sm text-gray-600">Giao dịch: #TXN005 - Phạm Thị Dung</p>
                                                <p class="text-sm text-gray-600">Số tiền: 1,500,000 VNĐ</p>
                                                <p class="text-sm text-gray-600">Hoàn thành: 13/12/2024</p>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        Đã hoàn tiền
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Export Excel Modal -->
    <div id="exportModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg max-w-4xl mx-4 w-full max-h-[90vh] overflow-y-auto">
            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <span class="text-xl">📊</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Xuất dữ liệu Excel</h3>
                        <p class="text-sm text-gray-600">Tùy chỉnh dữ liệu xuất theo nhu cầu</p>
                    </div>
                </div>
                <button onclick="closeExportModal()" class="text-gray-400 hover:text-gray-600">
                    <span class="text-2xl">×</span>
                </button>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Phạm vi xuất -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Phạm vi xuất</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="exportRange" value="all" checked class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Tất cả giao dịch (20 giao dịch)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="exportRange" value="current" class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Trang hiện tại (3 giao dịch)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="exportRange" value="selected" class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Giao dịch đã chọn (<span id="selectedCount">0</span> giao dịch)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Định dạng file -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Định dạng file</label>
                            <select class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                                <option>Excel (.xlsx)</option>
                                <option>CSV (.csv)</option>
                            </select>
                        </div>

                        <!-- Tên file -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tên file</label>
                            <input type="text" value="danh-sach-giao-dich" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                            <p class="text-xs text-gray-500 mt-1">Tên file sẽ được thêm ngày tháng tự động</p>
                        </div>

                        <!-- Lọc theo trạng thái -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Lọc theo trạng thái</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Hoàn thành</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Chờ xử lý</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Đã hoàn tiền</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Chọn cột xuất -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Chọn cột xuất</h4>
                            <div class="border border-gray-200 rounded-md p-3 max-h-48 overflow-y-auto">
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Mã GD</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Khách hàng</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Số tiền</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Phương thức</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Địa chỉ</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Trạng thái</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Thời gian</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Mã tham chiếu</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Phí giao dịch</span>
                                    </label>
                                </div>
                            </div>
                            <div class="flex space-x-2 mt-3">
                                <button onclick="selectAllColumns()" class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-md hover:bg-blue-200">
                                    Chọn tất cả
                                </button>
                                <button onclick="deselectAllColumns()" class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-md hover:bg-gray-200">
                                    Bỏ chọn tất cả
                                </button>
                            </div>
                        </div>

                        <!-- Tùy chọn bổ sung -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Tùy chọn bổ sung</h4>
                            <div class="space-y-2">
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

                        <!-- Xem trước -->
                        <div class="bg-gray-50 rounded-md p-4">
                            <h4 class="text-sm font-medium text-gray-900 mb-2">Xem trước thông tin xuất</h4>
                            <div class="text-xs text-gray-600 space-y-1">
                                <p>Sẽ xuất: <span class="font-medium">20 giao dịch</span></p>
                                <p>Định dạng: <span class="font-medium">Excel (.xlsx)</span></p>
                                <p>Cột: <span class="font-medium">8 cột</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <p class="text-xs text-gray-500 flex items-center">
                        <span class="mr-1">📎</span>
                        File sẽ được tải xuống tự động
                    </p>
                    <div class="flex space-x-3">
                        <button onclick="closeExportModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            Hủy
                        </button>
                        <button onclick="exportToExcel()" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 flex items-center space-x-2">
                            <span>🟩 Xuất Excel</span>
                            <span class="text-xs">↓</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction Detail Modal -->
    <div id="transactionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg max-w-2xl mx-4 w-full max-h-[90vh] overflow-y-auto">
            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <span class="text-xl">📋</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Chi Tiết Giao Dịch</h3>
                        <p class="text-sm text-gray-600">Thông tin đầy đủ về giao dịch</p>
                    </div>
                </div>
                <button onclick="closeTransactionModal()" class="text-gray-400 hover:text-gray-600">
                    <span class="text-2xl">×</span>
                </button>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Thông Tin Giao Dịch</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Mã giao dịch:</span>
                                    <span class="text-sm font-medium text-gray-900" id="detail-transaction-id">#TXN001</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Số tiền:</span>
                                    <span class="text-sm font-medium text-gray-900" id="detail-amount">2,450,000 VNĐ</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Phí giao dịch:</span>
                                    <span class="text-sm font-medium text-gray-900" id="detail-fee">12,250 VNĐ</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Tổng cộng:</span>
                                    <span class="text-sm font-bold text-blue-600" id="detail-total">2,462,250 VNĐ</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Trạng thái:</span>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full status-completed" id="detail-status">Hoàn thành</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Thông Tin Khách Hàng</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Họ tên:</span>
                                    <span class="text-sm font-medium text-gray-900" id="detail-customer-name">Nguyễn Văn An</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Email:</span>
                                    <span class="text-sm font-medium text-gray-900" id="detail-customer-email">nguyenvanan@email.com</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Số điện thoại:</span>
                                    <span class="text-sm font-medium text-gray-900" id="detail-customer-phone">0901234567</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Địa chỉ:</span>
                                    <span class="text-sm font-medium text-gray-900" id="detail-customer-address">123 Đường ABC, Q.1, TP.HCM</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Phương Thức Thanh Toán</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Loại:</span>
                                    <span class="text-sm font-medium text-gray-900" id="detail-payment-method">Chuyển khoản ngân hàng</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Ngân hàng:</span>
                                    <span class="text-sm font-medium text-gray-900" id="detail-bank">Vietcombank</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Số tài khoản:</span>
                                    <span class="text-sm font-medium text-gray-900" id="detail-account">****1234</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Mã tham chiếu:</span>
                                    <span class="text-sm font-medium text-gray-900" id="detail-reference">REF123456789</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Thời Gian</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Tạo giao dịch:</span>
                                    <span class="text-sm font-medium text-gray-900" id="detail-created-time">15/12/2024 14:25</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Hoàn thành:</span>
                                    <span class="text-sm font-medium text-gray-900" id="detail-completed-time">15/12/2024 14:30</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Thời gian xử lý:</span>
                                    <span class="text-sm font-medium text-gray-900" id="detail-processing-time">5 phút</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Ghi Chú</h4>
                            <p class="text-sm text-gray-700" id="detail-notes">Thanh toán đơn hàng #DH001234. Khách hàng đã xác nhận nhận được sản phẩm.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="flex space-x-3">
                        <button onclick="printTransaction()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 flex items-center space-x-2">
                            <span>🖨️</span>
                            <span>In hóa đơn</span>
                        </button>
                        <button onclick="exportTransactionDetail()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 flex items-center space-x-2">
                            <span>⬇</span>
                            <span>Xuất PDF</span>
                        </button>
                    </div>
                    <button onclick="closeTransactionModal()" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Đóng
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md mx-4">
            <div class="text-center">
                <div class="text-4xl mb-4">✅</div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Thành Công!</h3>
                <p id="successMessage" class="text-gray-600 mb-4"></p>
                <button onclick="closeModal()" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">
                    Đóng
                </button>
            </div>
        </div>
    </div>

    <script>
        // Global variables for filter state
        let selectedTransactions = new Set();
        let filterState = {
            status: \'Tất cả trạng thái\',
            provider: \'Tất cả nhà cung cấp\'
        };

        // Tab switching functionality
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll(\'.tab-content\').forEach(tab => {
                tab.classList.add(\'hidden\');
            });
            
            // Remove active state from all tab buttons
            document.querySelectorAll(\'.tab-button\').forEach(button => {
                button.classList.remove(\'border-blue-500\', \'text-blue-600\');
                button.classList.add(\'border-transparent\', \'text-gray-500\');
            });
            
            // Show selected tab
            document.getElementById(tabName + \'-tab\').classList.remove(\'hidden\');
            
            // Add active state to selected tab button
            const activeButton = document.getElementById(\'tab-\' + tabName);
            activeButton.classList.remove(\'border-transparent\', \'text-gray-500\');
            activeButton.classList.add(\'border-blue-500\', \'text-blue-600\');

            // Restore filter state and selections when switching to transactions tab
            if (tabName === \'transactions\') {
                restoreFilterState();
                restoreSelections();
            }
        }

        // Save filter state
        function saveFilterState() {
            const statusFilter = document.getElementById(\'statusFilter\');
            const providerFilter = document.getElementById(\'providerFilter\');
            
            if (statusFilter) filterState.status = statusFilter.value;
            if (providerFilter) filterState.provider = providerFilter.value;
        }

        // Restore filter state
        function restoreFilterState() {
            const statusFilter = document.getElementById(\'statusFilter\');
            const providerFilter = document.getElementById(\'providerFilter\');
            
            if (statusFilter) statusFilter.value = filterState.status;
            if (providerFilter) providerFilter.value = filterState.provider;
        }

        // Toggle select all checkbox
        function toggleSelectAll() {
            const selectAllCheckbox = document.getElementById(\'selectAll\');
            const transactionCheckboxes = document.querySelectorAll(\'.transaction-checkbox\');
            
            transactionCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
                const transactionId = checkbox.getAttribute(\'data-transaction-id\');
                
                if (selectAllCheckbox.checked) {
                    selectedTransactions.add(transactionId);
                } else {
                    selectedTransactions.delete(transactionId);
                }
            });
            
            updateSelectedCount();
        }

        // Update selected count
        function updateSelectedCount() {
            const checkedBoxes = document.querySelectorAll(\'.transaction-checkbox:checked\');
            const selectedCountElement = document.getElementById(\'selectedCount\');
            
            // Update selected transactions set
            selectedTransactions.clear();
            checkedBoxes.forEach(checkbox => {
                selectedTransactions.add(checkbox.getAttribute(\'data-transaction-id\'));
            });
            
            if (selectedCountElement) {
                selectedCountElement.textContent = selectedTransactions.size;
            }

            // Update select all checkbox state
            const selectAllCheckbox = document.getElementById(\'selectAll\');
            const allCheckboxes = document.querySelectorAll(\'.transaction-checkbox\');
            
            if (selectAllCheckbox && allCheckboxes.length > 0) {
                selectAllCheckbox.checked = checkedBoxes.length === allCheckboxes.length;
                selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < allCheckboxes.length;
            }
        }

        // Restore selections after tab switch or filter change
        function restoreSelections() {
            const transactionCheckboxes = document.querySelectorAll(\'.transaction-checkbox\');
            
            transactionCheckboxes.forEach(checkbox => {
                const transactionId = checkbox.getAttribute(\'data-transaction-id\');
                checkbox.checked = selectedTransactions.has(transactionId);
            });
            
            updateSelectedCount();
        }

        // Pending verification data
        const pendingVerifications = {
            \'DH001234\': {
                orderId: \'DH001234\',
                transactionId: \'TXN004\',
                customerName: \'Nguyễn Văn An\',
                amount: \'2,450,000 VNĐ\',
                method: \'Chuyển khoản ngân hàng\',
                email: \'nguyenvanan@email.com\',
                phone: \'0901234567\',
                address: \'123 Đường ABC, Q.1, TP.HCM\'
            },
            \'DH001235\': {
                orderId: \'DH001235\',
                transactionId: \'TXN005\',
                customerName: \'Trần Thị Bình\',
                amount: \'1,200,000 VNĐ\',
                method: \'Ví điện tử MoMo\',
                email: \'tranthibinh@email.com\',
                phone: \'0912345678\',
                address: \'456 Đường XYZ, Q.3, TP.HCM\'
            }
        };

        // Payment verification
        function verifyPayment(orderId, action) {
            const actionText = action === \'approved\' ? \'xác nhận\' : \'từ chối\';
            const pendingData = pendingVerifications[orderId];
            
            if (action === \'approved\' && pendingData) {
                // Add to transaction list
                addToTransactionList(pendingData);
                
                // Add to transaction data for detail view
                transactionData[pendingData.transactionId] = {
                    id: \'#\' + pendingData.transactionId,
                    amount: pendingData.amount,
                    fee: calculateFee(pendingData.amount),
                    total: calculateTotal(pendingData.amount),
                    status: \'Hoàn thành\',
                    statusClass: \'status-completed\',
                    customerName: pendingData.customerName,
                    customerEmail: pendingData.email,
                    customerPhone: pendingData.phone,
                    customerAddress: pendingData.address,
                    paymentMethod: pendingData.method,
                    bank: pendingData.method.includes(\'MoMo\') ? \'MoMo\' : \'Vietcombank\',
                    account: \'****\' + Math.floor(Math.random() * 9000 + 1000),
                    reference: \'REF\' + Math.floor(Math.random() * 900000000 + 100000000),
                    createdTime: new Date().toLocaleString(\'vi-VN\', {
                        day: \'2-digit\',
                        month: \'2-digit\',
                        year: \'numeric\',
                        hour: \'2-digit\',
                        minute: \'2-digit\'
                    }),
                    completedTime: new Date().toLocaleString(\'vi-VN\', {
                        day: \'2-digit\',
                        month: \'2-digit\',
                        year: \'numeric\',
                        hour: \'2-digit\',
                        minute: \'2-digit\'
                    }),
                    processingTime: \'2 phút\',
                    notes: `Thanh toán đơn hàng ${orderId}. Đã được xác thực và hoàn thành.`
                };
            }
            
            showSuccess(`Đã ${actionText} thanh toán cho đơn hàng ${orderId}`);
            
            // Remove the verification item from the list
            setTimeout(() => {
                const verificationItems = document.querySelectorAll(\'#verification-tab .border-yellow-200\');
                if (verificationItems.length > 0) {
                    verificationItems[0].style.opacity = \'0\';
                    setTimeout(() => {
                        verificationItems[0].remove();
                    }, 300);
                }
            }, 1000);
        }

        // Calculate fee (0.5% of amount)
        function calculateFee(amountStr) {
            const amount = parseInt(amountStr.replace(/[^\d]/g, \'\'));
            const fee = Math.round(amount * 0.005);
            return fee.toLocaleString(\'vi-VN\') + \' VNĐ\';
        }

        // Calculate total (amount + fee)
        function calculateTotal(amountStr) {
            const amount = parseInt(amountStr.replace(/[^\d]/g, \'\'));
            const fee = Math.round(amount * 0.005);
            const total = amount + fee;
            return total.toLocaleString(\'vi-VN\') + \' VNĐ\';
        }

        // Add transaction to the list
        function addToTransactionList(data) {
            const tbody = document.querySelector(\'#transactions-tab tbody\');
            const currentTime = new Date().toLocaleString(\'vi-VN\', {
                day: \'2-digit\',
                month: \'2-digit\',
                year: \'numeric\',
                hour: \'2-digit\',
                minute: \'2-digit\'
            });

            const newRow = document.createElement(\'tr\');
            newRow.className = \'fade-in\';
            newRow.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">
                    <input type="checkbox" class="transaction-checkbox text-blue-600 focus:ring-blue-500" data-transaction-id="${data.transactionId}" onchange="updateSelectedCount()">
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#${data.transactionId}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${data.customerName}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${data.amount}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${data.method.includes(\'MoMo\') ? \'MoMo\' : \'Chuyển khoản\'}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs font-medium rounded-full status-completed">Hoàn thành</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${currentTime}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <button onclick="viewTransaction(\'${data.transactionId}\')" class="text-blue-600 hover:text-blue-800">Xem chi tiết</button>
                </td>
            `;

            // Insert at the top of the table
            tbody.insertBefore(newRow, tbody.firstChild);

            // Add a subtle highlight animation
            setTimeout(() => {
                newRow.style.backgroundColor = \'#dbeafe\';
                setTimeout(() => {
                    newRow.style.backgroundColor = \'\';
                    newRow.style.transition = \'background-color 1s ease\';
                }, 2000);
            }, 100);
        }

        // Transaction data
        const transactionData = {
            \'TXN001\': {
                id: \'#TXN001\',
                amount: \'2,450,000 VNĐ\',
                fee: \'12,250 VNĐ\',
                total: \'2,462,250 VNĐ\',
                status: \'Hoàn thành\',
                statusClass: \'status-completed\',
                customerName: \'Nguyễn Văn An\',
                customerEmail: \'nguyenvanan@email.com\',
                customerPhone: \'0901234567\',
                customerAddress: \'123 Đường ABC, Q.1, TP.HCM\',
                paymentMethod: \'Chuyển khoản ngân hàng\',
                bank: \'Vietcombank\',
                account: \'****1234\',
                reference: \'REF123456789\',
                createdTime: \'15/12/2024 14:25\',
                completedTime: \'15/12/2024 14:30\',
                processingTime: \'5 phút\',
                notes: \'Thanh toán đơn hàng #DH001234. Khách hàng đã xác nhận nhận được sản phẩm.\'
            },
            \'TXN002\': {
                id: \'#TXN002\',
                amount: \'1,200,000 VNĐ\',
                fee: \'6,000 VNĐ\',
                total: \'1,206,000 VNĐ\',
                status: \'Chờ xử lý\',
                statusClass: \'status-pending\',
                customerName: \'Trần Thị Bình\',
                customerEmail: \'tranthibinh@email.com\',
                customerPhone: \'0912345678\',
                customerAddress: \'456 Đường XYZ, Q.3, TP.HCM\',
                paymentMethod: \'Ví điện tử MoMo\',
                bank: \'MoMo\',
                account: \'****5678\',
                reference: \'MOMO987654321\',
                createdTime: \'15/12/2024 13:40\',
                completedTime: \'Đang xử lý...\',
                processingTime: \'Đang xử lý...\',
                notes: \'Thanh toán đơn hàng #DH001235. Đang chờ xác nhận từ MoMo.\'
            },
            \'TXN003\': {
                id: \'#TXN003\',
                amount: \'850,000 VNĐ\',
                fee: \'4,250 VNĐ\',
                total: \'854,250 VNĐ\',
                status: \'Đã hoàn tiền\',
                statusClass: \'status-refunded\',
                customerName: \'Lê Văn Cường\',
                customerEmail: \'levancuong@email.com\',
                customerPhone: \'0923456789\',
                customerAddress: \'789 Đường DEF, Q.7, TP.HCM\',
                paymentMethod: \'Thẻ tín dụng\',
                bank: \'Sacombank\',
                account: \'****9012\',
                reference: \'VISA456789123\',
                createdTime: \'14/12/2024 16:15\',
                completedTime: \'14/12/2024 16:20\',
                processingTime: \'5 phút\',
                notes: \'Đã hoàn tiền do sản phẩm lỗi. Khách hàng yêu cầu hoàn tiền toàn bộ.\'
            }
        };

        // View transaction details
        function viewTransaction(transactionId) {
            const data = transactionData[transactionId];
            if (!data) {
                showSuccess(\'Không tìm thấy thông tin giao dịch!\');
                return;
            }

            // Update modal content
            document.getElementById(\'detail-transaction-id\').textContent = data.id;
            document.getElementById(\'detail-amount\').textContent = data.amount;
            document.getElementById(\'detail-fee\').textContent = data.fee;
            document.getElementById(\'detail-total\').textContent = data.total;
            
            const statusElement = document.getElementById(\'detail-status\');
            statusElement.textContent = data.status;
            statusElement.className = `px-2 py-1 text-xs font-medium rounded-full ${data.statusClass}`;
            
            document.getElementById(\'detail-customer-name\').textContent = data.customerName;
            document.getElementById(\'detail-customer-email\').textContent = data.customerEmail;
            document.getElementById(\'detail-customer-phone\').textContent = data.customerPhone;
            document.getElementById(\'detail-customer-address\').textContent = data.customerAddress;
            
            document.getElementById(\'detail-payment-method\').textContent = data.paymentMethod;
            document.getElementById(\'detail-bank\').textContent = data.bank;
            document.getElementById(\'detail-account\').textContent = data.account;
            document.getElementById(\'detail-reference\').textContent = data.reference;
            
            document.getElementById(\'detail-created-time\').textContent = data.createdTime;
            document.getElementById(\'detail-completed-time\').textContent = data.completedTime;
            document.getElementById(\'detail-processing-time\').textContent = data.processingTime;
            document.getElementById(\'detail-notes\').textContent = data.notes;

            // Show modal
            document.getElementById(\'transactionModal\').classList.remove(\'hidden\');
            document.getElementById(\'transactionModal\').classList.add(\'flex\');
        }

        // Close transaction modal
        function closeTransactionModal() {
            document.getElementById(\'transactionModal\').classList.add(\'hidden\');
            document.getElementById(\'transactionModal\').classList.remove(\'flex\');
        }

        // Print transaction
        function printTransaction() {
            showSuccess(\'Đang chuẩn bị in hóa đơn...\');
        }

        // Export transaction detail
        function exportTransactionDetail() {
            showSuccess(\'Đang xuất file PDF chi tiết giao dịch...\');
        }

        // Process refund form
        function processRefund(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            showSuccess(\'Đã tạo yêu cầu hoàn tiền thành công!\');
            event.target.reset();
        }

        // Approve refund
        function approveRefund(refundId) {
            showSuccess(`Đã duyệt yêu cầu hoàn tiền ${refundId}`);
            
            // Update the refund item status
            setTimeout(() => {
                const refundItems = document.querySelectorAll(\'#refunds-tab .border-orange-200\');
                if (refundItems.length > 0) {
                    const item = refundItems[0];
                    item.classList.remove(\'border-orange-200\', \'bg-orange-50\');
                    item.classList.add(\'border-green-200\', \'bg-green-50\');
                    
                    const buttons = item.querySelector(\'.flex.space-x-2\');
                    buttons.innerHTML = \'<span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Đã hoàn tiền</span>\';
                }
            }, 1000);
        }

        // Reject refund
        function rejectRefund(refundId) {
            showSuccess(`Đã từ chối yêu cầu hoàn tiền ${refundId}`);
            
            setTimeout(() => {
                const refundItems = document.querySelectorAll(\'#refunds-tab .border-orange-200\');
                if (refundItems.length > 0) {
                    refundItems[0].style.opacity = \'0\';
                    setTimeout(() => {
                        refundItems[0].remove();
                    }, 300);
                }
            }, 1000);
        }

        // Show success modal
        function showSuccess(message) {
            document.getElementById(\'successMessage\').textContent = message;
            document.getElementById(\'successModal\').classList.remove(\'hidden\');
            document.getElementById(\'successModal\').classList.add(\'flex\');
        }

        // Close modal
        function closeModal() {
            document.getElementById(\'successModal\').classList.add(\'hidden\');
            document.getElementById(\'successModal\').classList.remove(\'flex\');
        }

        // Show export modal
        function showExportModal() {
            document.getElementById(\'exportModal\').classList.remove(\'hidden\');
            document.getElementById(\'exportModal\').classList.add(\'flex\');
        }

        // Close export modal
        function closeExportModal() {
            document.getElementById(\'exportModal\').classList.add(\'hidden\');
            document.getElementById(\'exportModal\').classList.remove(\'flex\');
        }

        // Select all columns
        function selectAllColumns() {
            const checkboxes = document.querySelectorAll(\'#exportModal input[type="checkbox"]\');
            checkboxes.forEach(checkbox => {
                if (checkbox.closest(\'.space-y-2\').previousElementSibling?.textContent?.includes(\'Chọn cột xuất\')) {
                    checkbox.checked = true;
                }
            });
        }

        // Deselect all columns
        function deselectAllColumns() {
            const checkboxes = document.querySelectorAll(\'#exportModal input[type="checkbox"]\');
            checkboxes.forEach(checkbox => {
                if (checkbox.closest(\'.space-y-2\').previousElementSibling?.textContent?.includes(\'Chọn cột xuất\')) {
                    checkbox.checked = false;
                }
            });
        }

        // Export to Excel
        function exportToExcel() {
            // Get export range
            const exportRange = document.querySelector(\'input[name="exportRange"]:checked\').value;
            
            // All transaction data
            const allTransactions = [
                [\'Mã GD\', \'Khách hàng\', \'Số tiền\', \'Phương thức\', \'Trạng thái\', \'Thời gian\'],
                [\'#TXN001\', \'Nguyễn Văn An\', \'2,450,000 VNĐ\', \'Chuyển khoản\', \'Hoàn thành\', \'15/12/2024 14:30\'],
                [\'#TXN002\', \'Trần Thị Bình\', \'1,200,000 VNĐ\', \'MoMo\', \'Chờ xử lý\', \'15/12/2024 13:45\'],
                [\'#TXN003\', \'Lê Văn Cường\', \'850,000 VNĐ\', \'Thẻ tín dụng\', \'Đã hoàn tiền\', \'14/12/2024 16:20\'],
                [\'#TXN004\', \'Phạm Thị Dung\', \'1,500,000 VNĐ\', \'Chuyển khoản\', \'Hoàn thành\', \'13/12/2024 10:15\'],
                [\'#TXN005\', \'Hoàng Văn Em\', \'750,000 VNĐ\', \'ZaloPay\', \'Hoàn thành\', \'12/12/2024 16:45\']
            ];

            let transactions = [];

            if (exportRange === \'all\') {
                transactions = allTransactions;
            } else if (exportRange === \'current\') {
                // Current page transactions (first 3 from the table)
                transactions = [
                    allTransactions[0], // Header
                    allTransactions[1], // TXN001
                    allTransactions[2], // TXN002
                    allTransactions[3]  // TXN003
                ];
            } else if (exportRange === \'selected\') {
                // Selected transactions only
                transactions = [allTransactions[0]]; // Header
                
                selectedTransactions.forEach(transactionId => {
                    const transactionRow = allTransactions.find(row => 
                        row[0] && row[0].includes(transactionId)
                    );
                    if (transactionRow) {
                        transactions.push(transactionRow);
                    }
                });

                if (transactions.length === 1) {
                    showSuccess(\'Vui lòng chọn ít nhất một giao dịch để xuất!\');
                    return;
                }
            }

            // Convert to CSV format
            let csvContent = \'\';
            transactions.forEach(row => {
                csvContent += row.join(\',\') + \'\n\';
            });

            // Add BOM for UTF-8 encoding (to display Vietnamese characters correctly in Excel)
            const BOM = \'\uFEFF\';
            csvContent = BOM + csvContent;

            // Create and download file
            const blob = new Blob([csvContent], { type: \'text/csv;charset=utf-8;\' });
            const link = document.createElement(\'a\');
            const url = URL.createObjectURL(blob);
            link.setAttribute(\'href\', url);
            link.setAttribute(\'download\', `danh-sach-giao-dich-${new Date().toISOString().split(\'T\')[0]}.csv`);
            link.style.visibility = \'hidden\';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            closeExportModal();
            
            const exportedCount = transactions.length - 1; // Subtract header row
            showSuccess(`Đã xuất ${exportedCount} giao dịch thành công! File sẽ được tải về máy của bạn.`);
        }

        // Change transaction status
        function changeTransactionStatus(transactionId, newStatus) {
            const statusMap = {
                \'completed\': { text: \'Hoàn thành\', class: \'bg-green-100 text-green-800\', hover: \'hover:bg-green-200\', ring: \'focus:ring-green-500\' },
                \'pending\': { text: \'Chờ xử lý\', class: \'bg-yellow-100 text-yellow-800\', hover: \'hover:bg-yellow-200\', ring: \'focus:ring-yellow-500\' },
                \'failed\': { text: \'Thất bại\', class: \'bg-red-100 text-red-800\', hover: \'hover:bg-red-200\', ring: \'focus:ring-red-500\' },
                \'refunded\': { text: \'Đã hoàn tiền\', class: \'bg-blue-100 text-blue-800\', hover: \'hover:bg-blue-200\', ring: \'focus:ring-blue-500\' }
            };

            const status = statusMap[newStatus];
            if (!status) return;

            // Find the select element and update its classes
            const selectElement = event.target;
            selectElement.className = `px-2 py-1 text-xs font-medium rounded-full border-0 ${status.class} cursor-pointer ${status.hover} ${status.ring}`;

            // Update transaction data
            if (transactionData[transactionId]) {
                transactionData[transactionId].status = status.text;
                transactionData[transactionId].statusClass = `status-${newStatus}`;
            }

            // Show success message
            showSuccess(`Đã cập nhật trạng thái giao dịch ${transactionId} thành "${status.text}"`);

            // Add visual feedback
            selectElement.style.transform = \'scale(1.05)\';
            setTimeout(() => {
                selectElement.style.transform = \'scale(1)\';
                selectElement.style.transition = \'transform 0.2s ease\';
            }, 200);
        }

        // Toggle dropdown visibility
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const arrow = document.getElementById(dropdownId.replace(\'Dropdown\', \'Arrow\'));
            
            // Close all other dropdowns first
            document.querySelectorAll(\'[id$="Dropdown"]\').forEach(dd => {
                if (dd.id !== dropdownId) {
                    dd.classList.add(\'hidden\');
                    const otherArrow = document.getElementById(dd.id.replace(\'Dropdown\', \'Arrow\'));
                    if (otherArrow) {
                        otherArrow.style.transform = \'rotate(0deg)\';
                    }
                }
            });
            
            // Toggle current dropdown
            dropdown.classList.toggle(\'hidden\');
            
            // Rotate arrow
            if (dropdown.classList.contains(\'hidden\')) {
                arrow.style.transform = \'rotate(0deg)\';
            } else {
                arrow.style.transform = \'rotate(180deg)\';
            }
        }

        // Select status filter
        function selectStatus(status) {
            document.getElementById(\'statusFilterText\').textContent = status;
            document.getElementById(\'statusDropdown\').classList.add(\'hidden\');
            document.getElementById(\'statusArrow\').style.transform = \'rotate(0deg)\';
            
            filterState.status = status;
            
            // Apply filter to table (visual feedback)
            filterTransactions();
        }

        // Select provider filter
        function selectProvider(provider) {
            document.getElementById(\'providerFilterText\').textContent = provider;
            document.getElementById(\'providerDropdown\').classList.add(\'hidden\');
            document.getElementById(\'providerArrow\').style.transform = \'rotate(0deg)\';
            
            filterState.provider = provider;
            
            // Apply filter to table (visual feedback)
            filterTransactions();
        }

        // Filter transactions based on selected criteria
        function filterTransactions() {
            const rows = document.querySelectorAll(\'#transactions-tab tbody tr\');
            let visibleCount = 0;
            
            rows.forEach(row => {
                const statusCell = row.querySelector(\'td:nth-child(6)\');
                const methodCell = row.querySelector(\'td:nth-child(5)\');
                
                if (!statusCell || !methodCell) return;
                
                const status = statusCell.textContent.trim();
                const method = methodCell.textContent.trim();
                
                let showRow = true;
                
                // Filter by status
                if (filterState.status !== \'Tất cả trạng thái\') {
                    if (!status.includes(filterState.status)) {
                        showRow = false;
                    }
                }
                
                // Filter by provider
                if (filterState.provider !== \'Tất cả nhà cung cấp\') {
                    const providerMatch = {
                        \'Vietcombank\': [\'Chuyển khoản\'],
                        \'MoMo\': [\'MoMo\'],
                        \'ZaloPay\': [\'ZaloPay\'],
                        \'Sacombank\': [\'Thẻ tín dụng\'],
                        \'BIDV\': [\'BIDV\']
                    };
                    
                    const allowedMethods = providerMatch[filterState.provider] || [];
                    if (!allowedMethods.some(allowedMethod => method.includes(allowedMethod))) {
                        showRow = false;
                    }
                }
                
                if (showRow) {
                    row.style.display = \'\';
                    visibleCount++;
                } else {
                    row.style.display = \'none\';
                }
            });
            
            // Update visible count in export modal if it\'s open
            const exportModal = document.getElementById(\'exportModal\');
            if (!exportModal.classList.contains(\'hidden\')) {
                updateExportPreview(visibleCount);
            }
        }

        // Update export preview with filtered count
        function updateExportPreview(visibleCount) {
            const previewText = document.querySelector(\'.bg-gray-50.rounded-md.p-4 p\');
            if (previewText) {
                previewText.innerHTML = `Sẽ xuất: <span class="font-medium">${visibleCount} giao dịch</span>`;
            }
        }

        // Close dropdowns when clicking outside
        document.addEventListener(\'click\', function(event) {
            const dropdowns = document.querySelectorAll(\'[id$="Dropdown"]\');
            const buttons = document.querySelectorAll(\'[id$="FilterBtn"]\');
            
            let clickedOnDropdown = false;
            
            // Check if click was on a dropdown or button
            buttons.forEach(button => {
                if (button.contains(event.target)) {
                    clickedOnDropdown = true;
                }
            });
            
            dropdowns.forEach(dropdown => {
                if (dropdown.contains(event.target)) {
                    clickedOnDropdown = true;
                }
            });
            
            // Close all dropdowns if click was outside
            if (!clickedOnDropdown) {
                dropdowns.forEach(dropdown => {
                    dropdown.classList.add(\'hidden\');
                });
                
                // Reset arrows
                document.querySelectorAll(\'[id$="Arrow"]\').forEach(arrow => {
                    arrow.style.transform = \'rotate(0deg)\';
                });
            }
        });

        // Initialize the page
        document.addEventListener(\'DOMContentLoaded\', function() {
            showTab(\'verification\');
            
            // Initialize selected count
            updateSelectedCount();
        });
    </script>
</div>
</html>
@endsection