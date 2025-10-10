<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments Gateway</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/payments_gateway.css') }}">
</head>
<body class="bg-gray-50 font-sans">

    <div id="payment-gateway" class="section">

    <!-- Header -->
    

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Navigation Tabs -->
        <div class="mb-8">
            <nav class="flex space-x-1 bg-white rounded-lg p-1 shadow-sm">
                <button id="authTab" class="tab-button flex-1 py-2 px-4 text-sm font-medium rounded-md transition-all duration-200 bg-blue-600 text-white">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    Xác thực giao dịch
                </button>
                <button id="transactionTab" class="tab-button flex-1 py-2 px-4 text-sm font-medium rounded-md transition-all duration-200 text-gray-600 hover:text-gray-900">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Danh sách giao dịch
                </button>
                <button id="refundTab" class="tab-button flex-1 py-2 px-4 text-sm font-medium rounded-md transition-all duration-200 text-gray-600 hover:text-gray-900">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                    </svg>
                    Hoàn tiền
                </button>
            </nav>
        </div>

        <!-- Authentication Interface -->
        <div id="authInterface" class="tab-content">
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Payment Authentication Form -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900">Xác thực thanh toán</h2>
                    </div>

                    <form id="authForm" class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mã giao dịch</label>
                            <input type="text" id="transactionId" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="TXN-2024-001234" value="TXN-2024-001234">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Số tiền (VNĐ)</label>
                            <input type="text" id="amount" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="1,500,000" value="1,500,000">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phương thức thanh toán</label>
                            <select id="paymentMethod" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="visa">Visa/Mastercard</option>
                                <option value="momo">Ví MoMo</option>
                                <option value="zalopay">ZaloPay</option>
                                <option value="banking">Internet Banking</option>
                            </select>
                        </div>



                        <div>
                            <button type="submit" id="authenticateBtn" class="w-full py-3 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                                Xác thực thanh toán
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Authentication Status -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900">Trạng thái xác thực</h2>
                    </div>

                    <div id="authStatus" class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-700">Trạng thái</span>
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Chờ xác thực</span>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-green-500 rounded-full mr-3"></div>
                                <span class="text-sm text-gray-600">Thông tin giao dịch hợp lệ</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-green-500 rounded-full mr-3"></div>
                                <span class="text-sm text-gray-600">Kết nối ngân hàng thành công</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-yellow-400 rounded-full mr-3 pulse-animation"></div>
                                <span class="text-sm text-gray-600">Đang chờ xác thực thanh toán</span>
                            </div>
                        </div>

                        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                            <h3 class="text-sm font-medium text-blue-900 mb-2">Thông tin giao dịch</h3>
                            <div class="space-y-1 text-sm text-blue-700">
                                <div class="flex justify-between">
                                    <span>Mã GD:</span>
                                    <span class="font-medium">TXN-2024-001234</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Số tiền:</span>
                                    <span class="font-medium">1,500,000 VNĐ</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Thời gian:</span>
                                    <span class="font-medium">14:30 - 15/12/2024</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Refund Interface -->
        <div id="refundInterface" class="tab-content hidden">
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Refund Request Form -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900">Yêu cầu hoàn tiền</h2>
                    </div>

                    <form id="refundForm" class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Chọn giao dịch cần hoàn tiền</label>
                            <select id="originalTransactionId" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Chọn giao dịch...</option>
                                <option value="TXN-2024-001234" data-amount="1,500,000" data-customer="Nguyễn Văn A">TXN-2024-001234 - Nguyễn Văn A (1,500,000 VNĐ)</option>
                                <option value="TXN-2024-001233" data-amount="750,000" data-customer="Trần Thị B">TXN-2024-001233 - Trần Thị B (750,000 VNĐ)</option>
                                <option value="TXN-2024-001231" data-amount="980,000" data-customer="Phạm Thị D">TXN-2024-001231 - Phạm Thị D (980,000 VNĐ)</option>
                                <option value="TXN-2024-001230" data-amount="1,800,000" data-customer="Hoàng Văn E">TXN-2024-001230 - Hoàng Văn E (1,800,000 VNĐ)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Số tiền hoàn (VNĐ)</label>
                            <input type="text" id="refundAmount" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Chọn giao dịch để tự động điền" readonly>
                            <div class="mt-2 flex space-x-2">
                                <button type="button" id="fullRefundBtn" class="px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition-colors">Hoàn toàn bộ</button>
                                <button type="button" id="partialRefundBtn" class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition-colors">Hoàn một phần</button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Lý do hoàn tiền</label>
                            <select id="refundReason" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Chọn lý do</option>
                                <option value="customer_request">Yêu cầu khách hàng</option>
                                <option value="duplicate_payment">Thanh toán trùng lặp</option>
                                <option value="service_not_provided">Không cung cấp dịch vụ</option>
                                <option value="technical_error">Lỗi kỹ thuật</option>
                                <option value="fraud">Gian lận</option>
                                <option value="other">Khác</option>
                            </select>
                            <div id="customReasonDiv" class="mt-3 hidden">
                                <input type="text" id="customReason" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Nhập lý do cụ thể...">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mô tả chi tiết</label>
                            <textarea id="refundDescription" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Nhập mô tả chi tiết về lý do hoàn tiền..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ưu tiên xử lý</label>
                            <div class="flex space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="priority" value="normal" class="mr-2" checked>
                                    <span class="text-sm">Bình thường</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="priority" value="high" class="mr-2">
                                    <span class="text-sm">Cao</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="priority" value="urgent" class="mr-2">
                                    <span class="text-sm">Khẩn cấp</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <button type="submit" id="submitRefundBtn" class="w-full py-3 px-4 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 font-medium">
                                Gửi yêu cầu hoàn tiền
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Refund Status -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900">Trạng thái hoàn tiền</h2>
                    </div>

                    <div id="refundStatus" class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-700">Trạng thái</span>
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">Chưa có yêu cầu</span>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-gray-300 rounded-full mr-3"></div>
                                <span class="text-sm text-gray-500">Kiểm tra thông tin giao dịch</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-gray-300 rounded-full mr-3"></div>
                                <span class="text-sm text-gray-500">Xác minh yêu cầu hoàn tiền</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-gray-300 rounded-full mr-3"></div>
                                <span class="text-sm text-gray-500">Xử lý hoàn tiền</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-gray-300 rounded-full mr-3"></div>
                                <span class="text-sm text-gray-500">Hoàn tất</span>
                            </div>
                        </div>

                        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                            <h3 class="text-sm font-medium text-blue-900 mb-2">Thông tin hướng dẫn</h3>
                            <div class="space-y-2 text-sm text-blue-700">
                                <p>• Thời gian xử lý: 3-5 ngày làm việc</p>
                                <p>• Hoàn tiền về tài khoản gốc</p>
                                <p>• Phí xử lý: Miễn phí</p>
                                <p>• Hỗ trợ: 1900-xxxx</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Refund Requests -->
            <div class="mt-8 bg-white rounded-xl shadow-lg">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Yêu cầu hoàn tiền gần đây</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã hoàn tiền</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giao dịch gốc</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số tiền</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lý do</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody id="refundTableBody" class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">REF-2024-001</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">TXN-2024-001232</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">2,200,000 VNĐ</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Yêu cầu khách hàng</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full border bg-green-100 text-green-800 border-green-200">
                                        Đã hoàn tiền
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    14/12/2024
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">REF-2024-002</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">TXN-2024-001225</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">850,000 VNĐ</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Lỗi kỹ thuật</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full border bg-yellow-100 text-yellow-800 border-yellow-200">
                                        Đang xử lý
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    15/12/2024
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Transaction List Interface -->
        <div id="transactionInterface" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-lg">
                <!-- Filters -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                        <h2 class="text-xl font-semibold text-gray-900">Danh sách giao dịch</h2>
                        <div class="flex space-x-3">
                            <select id="statusFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Tất cả trạng thái</option>
                                <option value="completed">Thành công</option>
                                <option value="pending">Đang xử lý</option>
                                <option value="failed">Thất bại</option>
                            </select>
                            <input type="date" id="dateFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <button id="refreshBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Transaction Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã giao dịch</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số tiền</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phương thức</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thời gian</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="transactionTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Transactions will be populated here -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Hiển thị <span class="font-medium">1-10</span> trong tổng số <span class="font-medium">47</span> giao dịch
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
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-md mx-4 fade-in">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Xác thực thành công!</h3>
                <p class="text-gray-600 mb-6">Giao dịch của bạn đã được xác thực và đang được xử lý.</p>
                <button id="closeModal" class="w-full py-2 px-4 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                    Đóng
                </button>
            </div>
        </div>
    </div>

    <script>
        // Sample transaction data
        const transactions = [
            { id: 'TXN-2024-001234', amount: '1,500,000', method: 'Visa', status: 'completed', time: '14:30 - 15/12/2024', customer: 'Nguyễn Văn A' },
            { id: 'TXN-2024-001233', amount: '750,000', method: 'MoMo', status: 'pending', time: '13:45 - 15/12/2024', customer: 'Trần Thị B' },
            { id: 'TXN-2024-001232', amount: '2,200,000', method: 'Banking', status: 'failed', time: '12:20 - 15/12/2024', customer: 'Lê Văn C' },
            { id: 'TXN-2024-001231', amount: '980,000', method: 'ZaloPay', status: 'completed', time: '11:15 - 15/12/2024', customer: 'Phạm Thị D' },
            { id: 'TXN-2024-001230', amount: '1,800,000', method: 'Visa', status: 'processing', time: '10:30 - 15/12/2024', customer: 'Hoàng Văn E' }
        ];

        // Tab switching
        document.getElementById('authTab').addEventListener('click', function() {
            switchTab('auth');
        });

        document.getElementById('transactionTab').addEventListener('click', function() {
            switchTab('transaction');
        });

        document.getElementById('refundTab').addEventListener('click', function() {
            switchTab('refund');
        });

        function switchTab(tab) {
            // Update tab buttons
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white');
                btn.classList.add('text-gray-600', 'hover:text-gray-900');
            });

            // Hide all content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            if (tab === 'auth') {
                document.getElementById('authTab').classList.add('bg-blue-600', 'text-white');
                document.getElementById('authTab').classList.remove('text-gray-600', 'hover:text-gray-900');
                document.getElementById('authInterface').classList.remove('hidden');
            } else if (tab === 'transaction') {
                document.getElementById('transactionTab').classList.add('bg-blue-600', 'text-white');
                document.getElementById('transactionTab').classList.remove('text-gray-600', 'hover:text-gray-900');
                document.getElementById('transactionInterface').classList.remove('hidden');
                renderTransactions();
            } else if (tab === 'refund') {
                document.getElementById('refundTab').classList.add('bg-blue-600', 'text-white');
                document.getElementById('refundTab').classList.remove('text-gray-600', 'hover:text-gray-900');
                document.getElementById('refundInterface').classList.remove('hidden');
            }
        }



        // Authentication form
        document.getElementById('authForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simulate authentication process
            const authBtn = document.getElementById('authenticateBtn');
            const originalText = authBtn.textContent;
            
            authBtn.textContent = 'Đang xác thực...';
            authBtn.disabled = true;
            
            setTimeout(() => {
                document.getElementById('successModal').classList.remove('hidden');
                document.getElementById('successModal').classList.add('flex');
                
                // Update auth status
                document.getElementById('authStatus').innerHTML = `
                    <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-700">Trạng thái</span>
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Xác thực thành công</span>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-sm text-gray-600">Thông tin giao dịch hợp lệ</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-sm text-gray-600">Kết nối ngân hàng thành công</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-sm text-gray-600">Xác thực thanh toán thành công</span>
                        </div>
                    </div>
                `;
                
                authBtn.textContent = originalText;
                authBtn.disabled = false;
            }, 2000);
        });

        // Close modal
        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('successModal').classList.add('hidden');
            document.getElementById('successModal').classList.remove('flex');
        });



        // Render transactions
        function renderTransactions(filter = '') {
            const tbody = document.getElementById('transactionTableBody');
            const filteredTransactions = filter ? transactions.filter(t => t.status === filter) : transactions;
            
            tbody.innerHTML = filteredTransactions.map(transaction => `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${transaction.id}</div>
                        <div class="text-sm text-gray-500">${transaction.customer}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${transaction.amount} VNĐ</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${transaction.method}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium rounded-full border status-${transaction.status}">
                            ${getStatusText(transaction.status)}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        ${transaction.time}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-blue-600 hover:text-blue-900 mr-3">Chi tiết</button>
                        <button class="text-gray-600 hover:text-gray-900">In</button>
                    </td>
                </tr>
            `).join('');
        }

        function getStatusText(status) {
            const statusMap = {
                'completed': 'Thành công',
                'pending': 'Chờ xử lý',
                'failed': 'Thất bại',
                'processing': 'Đang xử lý'
            };
            return statusMap[status] || status;
        }

        // Filter transactions
        document.getElementById('statusFilter').addEventListener('change', function() {
            renderTransactions(this.value);
        });

        // Refresh button
        document.getElementById('refreshBtn').addEventListener('click', function() {
            const btn = this;
            btn.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>';
            
            setTimeout(() => {
                btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>';
                renderTransactions();
            }, 1000);
        });

        // Transaction selection for refund
        document.getElementById('originalTransactionId').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const refundAmountInput = document.getElementById('refundAmount');
            
            if (selectedOption.value) {
                const amount = selectedOption.getAttribute('data-amount');
                refundAmountInput.value = amount;
                refundAmountInput.removeAttribute('readonly');
                refundAmountInput.placeholder = 'Nhập số tiền hoàn';
            } else {
                refundAmountInput.value = '';
                refundAmountInput.setAttribute('readonly', true);
                refundAmountInput.placeholder = 'Chọn giao dịch để tự động điền';
            }
        });

        // Full refund button
        document.getElementById('fullRefundBtn').addEventListener('click', function() {
            const transactionSelect = document.getElementById('originalTransactionId');
            const selectedOption = transactionSelect.options[transactionSelect.selectedIndex];
            const refundAmountInput = document.getElementById('refundAmount');
            
            if (selectedOption.value) {
                const amount = selectedOption.getAttribute('data-amount');
                refundAmountInput.value = amount;
            }
        });

        // Partial refund button
        document.getElementById('partialRefundBtn').addEventListener('click', function() {
            const refundAmountInput = document.getElementById('refundAmount');
            refundAmountInput.value = '';
            refundAmountInput.focus();
        });

        // Custom reason handling
        document.getElementById('refundReason').addEventListener('change', function() {
            const customReasonDiv = document.getElementById('customReasonDiv');
            const customReasonInput = document.getElementById('customReason');
            
            if (this.value === 'other') {
                customReasonDiv.classList.remove('hidden');
                customReasonInput.focus();
            } else {
                customReasonDiv.classList.add('hidden');
                customReasonInput.value = '';
            }
        });

        // Refund form handling
        document.getElementById('refundForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('submitRefundBtn');
            const originalText = submitBtn.textContent;
            
            submitBtn.textContent = 'Đang xử lý...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                // Update refund status
                document.getElementById('refundStatus').innerHTML = `
                    <div class="flex items-center justify-between p-4 bg-orange-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-700">Trạng thái</span>
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-800">Đang xử lý</span>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-sm text-gray-600">Kiểm tra thông tin giao dịch</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-orange-400 rounded-full mr-3 pulse-animation"></div>
                            <span class="text-sm text-gray-600">Xác minh yêu cầu hoàn tiền</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-gray-300 rounded-full mr-3"></div>
                            <span class="text-sm text-gray-500">Xử lý hoàn tiền</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-gray-300 rounded-full mr-3"></div>
                            <span class="text-sm text-gray-500">Hoàn tất</span>
                        </div>
                    </div>
                    <div class="mt-6 p-4 bg-green-50 rounded-lg">
                        <h3 class="text-sm font-medium text-green-900 mb-2">Yêu cầu đã được gửi</h3>
                        <div class="space-y-1 text-sm text-green-700">
                            <div class="flex justify-between">
                                <span>Mã yêu cầu:</span>
                                <span class="font-medium">REF-2024-003</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Thời gian xử lý dự kiến:</span>
                                <span class="font-medium">3-5 ngày</span>
                            </div>
                        </div>
                    </div>
                `;
                
                submitBtn.textContent = 'Yêu cầu đã được gửi';
                setTimeout(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            }, 2000);
        });

        // Initialize
        renderTransactions();
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'97c7bb2e925b5c88',t:'MTc1NzQzMTg3NC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script>
</div>
</body>
</html>
