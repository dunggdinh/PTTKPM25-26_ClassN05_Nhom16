<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo cáo & Thống kê - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">

</head>
<body class="bg-gray-50 min-h-full">
    <div class="p-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Báo cáo & Thống kê</h1>
            <p class="text-gray-600">Tổng quan hiệu suất cửa hàng điện tử</p>
        </div>

        <!-- Action Buttons -->
        <div class="mb-8 flex flex-wrap gap-4">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors" onclick="exportReport()">
                📄 Xuất báo cáo PDF
            </button>
            <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors" onclick="exportExcel()">
                📊 Xuất Excel
            </button>
            <button class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-medium transition-colors" onclick="scheduleReport()">
                ⏰ Lên lịch báo cáo
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stat-card rounded-xl p-6 text-white card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/80 text-sm">Tổng doanh thu</p>
                        <p class="text-2xl font-bold" id="totalRevenue">2,450,000,000₫</p>
                        <p class="text-white/80 text-xs mt-1">+12.5% so với tháng trước</p>
                    </div>
                    <div class="text-3xl">💰</div>
                </div>
            </div>

            <div class="stat-card-2 rounded-xl p-6 text-white card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/80 text-sm">Đơn hàng</p>
                        <p class="text-2xl font-bold" id="totalOrders">1,247</p>
                        <p class="text-white/80 text-xs mt-1">+8.3% so với tháng trước</p>
                    </div>
                    <div class="text-3xl">📦</div>
                </div>
            </div>

            <div class="stat-card-3 rounded-xl p-6 text-white card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/80 text-sm">Khách hàng mới</p>
                        <p class="text-2xl font-bold" id="newCustomers">342</p>
                        <p class="text-white/80 text-xs mt-1">+15.7% so với tháng trước</p>
                    </div>
                    <div class="text-3xl">👥</div>
                </div>
            </div>

            <div class="stat-card-4 rounded-xl p-6 text-white card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/80 text-sm">Sản phẩm bán chạy</p>
                        <p class="text-2xl font-bold" id="topProducts">89</p>
                        <p class="text-white/80 text-xs mt-1">+5.2% so với tháng trước</p>
                    </div>
                    <div class="text-3xl">🔥</div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Revenue Chart -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">📈 Doanh thu theo tháng</h3>
                    <select class="text-sm border border-gray-300 rounded-lg px-3 py-1" id="revenueFilter">
                        <option>6 tháng gần đây</option>
                        <option>12 tháng gần đây</option>
                        <option>Năm nay</option>
                    </select>
                </div>
                <div style="height: 300px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Orders Chart -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">📊 Phân tích đơn hàng</h3>
                    <select class="text-sm border border-gray-300 rounded-lg px-3 py-1" id="orderFilter">
                        <option>Tháng này</option>
                        <option>Quý này</option>
                        <option>Năm này</option>
                    </select>
                </div>
                <div style="height: 300px;">
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tables Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Top Products -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">🏆 Sản phẩm bán chạy nhất</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 text-sm font-medium text-gray-600">Sản phẩm</th>
                                <th class="text-right py-3 text-sm font-medium text-gray-600">Đã bán</th>
                                <th class="text-right py-3 text-sm font-medium text-gray-600">Doanh thu</th>
                            </tr>
                        </thead>
                        <tbody id="topProductsTable">
                            <tr class="border-b border-gray-100">
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">📱</div>
                                        <span class="text-sm font-medium">iPhone 15 Pro Max</span>
                                    </div>
                                </td>
                                <td class="text-right py-3 text-sm">156</td>
                                <td class="text-right py-3 text-sm font-medium text-green-600">468,000,000₫</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">💻</div>
                                        <span class="text-sm font-medium">MacBook Air M3</span>
                                    </div>
                                </td>
                                <td class="text-right py-3 text-sm">89</td>
                                <td class="text-right py-3 text-sm font-medium text-green-600">267,000,000₫</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">🎧</div>
                                        <span class="text-sm font-medium">AirPods Pro 2</span>
                                    </div>
                                </td>
                                <td class="text-right py-3 text-sm">234</td>
                                <td class="text-right py-3 text-sm font-medium text-green-600">140,400,000₫</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">⌚</div>
                                        <span class="text-sm font-medium">Apple Watch Series 9</span>
                                    </div>
                                </td>
                                <td class="text-right py-3 text-sm">127</td>
                                <td class="text-right py-3 text-sm font-medium text-green-600">101,600,000₫</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">🕒 Đơn hàng gần đây</h3>
                <div class="space-y-4" id="recentOrders">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                                NV
                            </div>
                            <div>
                                <p class="text-sm font-medium">Nguyễn Văn A</p>
                                <p class="text-xs text-gray-500">#ORD-2024-001</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-green-600">2,990,000₫</p>
                            <span class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Hoàn thành</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                                TT
                            </div>
                            <div>
                                <p class="text-sm font-medium">Trần Thị B</p>
                                <p class="text-xs text-gray-500">#ORD-2024-002</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-blue-600">1,250,000₫</p>
                            <span class="inline-block px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Đang xử lý</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                                LM
                            </div>
                            <div>
                                <p class="text-sm font-medium">Lê Minh C</p>
                                <p class="text-xs text-gray-500">#ORD-2024-003</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-orange-600">890,000₫</p>
                            <span class="inline-block px-2 py-1 text-xs bg-orange-100 text-orange-800 rounded-full">Đang giao</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                                PH
                            </div>
                            <div>
                                <p class="text-sm font-medium">Phạm Hùng D</p>
                                <p class="text-xs text-gray-500">#ORD-2024-004</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-green-600">3,450,000₫</p>
                            <span class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Hoàn thành</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script>
        // Revenue Chart
        const revenueCtx = document.getElementById(\'revenueChart\').getContext(\'2d\');
        const revenueChart = new Chart(revenueCtx, {
            type: \'line\',
            data: {
                labels: [\'T7\', \'T8\', \'T9\', \'T10\', \'T11\', \'T12\'],
                datasets: [{
                    label: \'Doanh thu (triệu VNĐ)\',
                    data: [1800, 2100, 1950, 2300, 2150, 2450],
                    borderColor: \'#667eea\',
                    backgroundColor: \'rgba(102, 126, 234, 0.1)\',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: \'rgba(0,0,0,0.1)\'
                        },
                        ticks: {
                            callback: function(value) {
                                return value + \'M\';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                elements: {
                    point: {
                        radius: 4,
                        hoverRadius: 6
                    }
                }
            }
        });

        // Orders Chart
        const ordersCtx = document.getElementById(\'ordersChart\').getContext(\'2d\');
        const ordersChart = new Chart(ordersCtx, {
            type: \'doughnut\',
            data: {
                labels: [\'Hoàn thành\', \'Đang xử lý\', \'Đang giao\', \'Đã hủy\'],
                datasets: [{
                    data: [756, 234, 189, 68],
                    backgroundColor: [
                        \'#10B981\',
                        \'#3B82F6\',
                        \'#F59E0B\',
                        \'#EF4444\'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: \'bottom\',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });

        // Interactive functions
        function exportReport() {
            showPreviewModal(\'pdf\');
        }

        function exportExcel() {
            showPreviewModal(\'excel\');
        }

        function showPreviewModal(type) {
            // Remove existing modal if any
            const existingModal = document.querySelector(\'.preview-modal\');
            if (existingModal) {
                existingModal.remove();
            }

            const reportData = {
                title: \'Báo cáo Doanh thu Cửa hàng Điện tử\',
                date: new Date().toLocaleDateString(\'vi-VN\'),
                revenue: document.getElementById(\'totalRevenue\').textContent,
                orders: document.getElementById(\'totalOrders\').textContent,
                customers: document.getElementById(\'newCustomers\').textContent,
                topProducts: document.getElementById(\'topProducts\').textContent
            };

            const modal = document.createElement(\'div\');
            modal.className = \'preview-modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4\';
            
            const previewContent = type === \'pdf\' ? generatePDFPreview(reportData) : generateExcelPreview(reportData);
            
            modal.innerHTML = `
                <div class="bg-white rounded-xl w-full max-w-4xl max-h-90vh overflow-hidden flex flex-col">
                    <div class="flex items-center justify-between p-6 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800">
                            ${type === \'pdf\' ? \'📄 Xem trước báo cáo PDF\' : \'📊 Xem trước báo cáo Excel\'}
                        </h3>
                        <div class="flex items-center gap-3">
                            <button onclick="exportOtherFormat(\'${type === \'pdf\' ? \'excel\' : \'pdf\'}\')" 
                                    class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg font-medium transition-colors">
                                ${type === \'pdf\' ? \'📊 Xuất Excel\' : \'📄 Xuất PDF\'}
                            </button>
                            <button onclick="closePreviewModal()" class="text-gray-400 hover:text-gray-600 text-2xl">×</button>
                        </div>
                    </div>
                    
                    <div class="flex-1 overflow-y-auto p-6">
                        ${previewContent}
                    </div>
                    
                    <div class="flex gap-3 p-6 border-t border-gray-200 bg-gray-50">
                        <button onclick="downloadReport(\'${type}\')" 
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-medium transition-colors">
                            ${type === \'pdf\' ? \'📄 Tải xuống PDF\' : \'📊 Tải xuống Excel\'}
                        </button>
                        <button onclick="closePreviewModal()" 
                                class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 py-3 px-6 rounded-lg font-medium transition-colors">
                            Đóng
                        </button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            
            // Close modal when clicking outside
            modal.addEventListener(\'click\', function(e) {
                if (e.target === modal) {
                    closePreviewModal();
                }
            });
        }

        function generatePDFPreview(data) {
            return `
                <div class="bg-white border border-gray-300 rounded-lg p-8 shadow-sm" style="font-family: \'Times New Roman\', serif;">
                    <div class="text-center mb-8">
                        <h1 class="text-2xl font-bold text-gray-800 mb-2">${data.title}</h1>
                        <p class="text-gray-600">Ngày tạo: ${data.date}</p>
                        <hr class="mt-4 border-gray-300">
                    </div>
                    
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">📊 TỔNG QUAN</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex justify-between">
                                <span>Tổng doanh thu:</span>
                                <strong>${data.revenue}</strong>
                            </div>
                            <div class="flex justify-between">
                                <span>Tổng đơn hàng:</span>
                                <strong>${data.orders}</strong>
                            </div>
                            <div class="flex justify-between">
                                <span>Khách hàng mới:</span>
                                <strong>${data.customers}</strong>
                            </div>
                            <div class="flex justify-between">
                                <span>Sản phẩm bán chạy:</span>
                                <strong>${data.topProducts}</strong>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">🏆 SẢN PHẨM BÁN CHẠY NHẤT</h2>
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="border border-gray-300 px-4 py-2 text-left">Sản phẩm</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">Số lượng</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">Doanh thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">iPhone 15 Pro Max</td>
                                    <td class="border border-gray-300 px-4 py-2 text-right">156</td>
                                    <td class="border border-gray-300 px-4 py-2 text-right">468,000,000₫</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">MacBook Air M3</td>
                                    <td class="border border-gray-300 px-4 py-2 text-right">89</td>
                                    <td class="border border-gray-300 px-4 py-2 text-right">267,000,000₫</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">AirPods Pro 2</td>
                                    <td class="border border-gray-300 px-4 py-2 text-right">234</td>
                                    <td class="border border-gray-300 px-4 py-2 text-right">140,400,000₫</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">Apple Watch Series 9</td>
                                    <td class="border border-gray-300 px-4 py-2 text-right">127</td>
                                    <td class="border border-gray-300 px-4 py-2 text-right">101,600,000₫</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">🕒 ĐƠN HÀNG GẦN ĐÂY</h2>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span>Nguyễn Văn A (#ORD-2024-001)</span>
                                <span class="font-medium">2,990,000₫ - Hoàn thành</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span>Trần Thị B (#ORD-2024-002)</span>
                                <span class="font-medium">1,250,000₫ - Đang xử lý</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span>Lê Minh C (#ORD-2024-003)</span>
                                <span class="font-medium">890,000₫ - Đang giao</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span>Phạm Hùng D (#ORD-2024-004)</span>
                                <span class="font-medium">3,450,000₫ - Hoàn thành</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center text-sm text-gray-500 mt-8 pt-4 border-t border-gray-200">
                        Báo cáo được tạo tự động từ hệ thống quản lý cửa hàng điện tử
                    </div>
                </div>
            `;
        }

        function generateExcelPreview(data) {
            return `
                <div class="bg-white border border-gray-300 rounded-lg overflow-hidden">
                    <div class="bg-green-600 text-white p-4">
                        <h2 class="text-lg font-semibold">📊 Báo cáo Excel - Cửa hàng Điện tử</h2>
                        <p class="text-green-100">Ngày tạo: ${data.date}</p>
                    </div>
                    
                    <div class="p-6">
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-800 mb-3 bg-gray-100 p-2 rounded">Sheet 1: Tổng quan</h3>
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-green-50">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Chỉ số</th>
                                        <th class="border border-gray-300 px-4 py-2 text-right">Giá trị</th>
                                        <th class="border border-gray-300 px-4 py-2 text-right">Thay đổi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Tổng doanh thu</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">${data.revenue}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right text-green-600">+12.5%</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Tổng đơn hàng</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">${data.orders}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right text-green-600">+8.3%</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Khách hàng mới</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">${data.customers}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right text-green-600">+15.7%</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Sản phẩm bán chạy</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">${data.topProducts}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right text-green-600">+5.2%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-800 mb-3 bg-gray-100 p-2 rounded">Sheet 2: Sản phẩm bán chạy</h3>
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-blue-50">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Sản phẩm</th>
                                        <th class="border border-gray-300 px-4 py-2 text-right">Số lượng đã bán</th>
                                        <th class="border border-gray-300 px-4 py-2 text-right">Doanh thu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">iPhone 15 Pro Max</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">156</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">468,000,000</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">MacBook Air M3</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">89</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">267,000,000</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">AirPods Pro 2</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">234</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">140,400,000</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">Apple Watch Series 9</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">127</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">101,600,000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-3 bg-gray-100 p-2 rounded">Sheet 3: Đơn hàng gần đây</h3>
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-purple-50">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Mã đơn hàng</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Khách hàng</th>
                                        <th class="border border-gray-300 px-4 py-2 text-right">Giá trị</th>
                                        <th class="border border-gray-300 px-4 py-2 text-center">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">#ORD-2024-001</td>
                                        <td class="border border-gray-300 px-4 py-2">Nguyễn Văn A</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">2,990,000</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Hoàn thành</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">#ORD-2024-002</td>
                                        <td class="border border-gray-300 px-4 py-2">Trần Thị B</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">1,250,000</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Đang xử lý</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">#ORD-2024-003</td>
                                        <td class="border border-gray-300 px-4 py-2">Lê Minh C</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">890,000</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Đang giao</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">#ORD-2024-004</td>
                                        <td class="border border-gray-300 px-4 py-2">Phạm Hùng D</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">3,450,000</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">Hoàn thành</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            `;
        }

        function downloadReport(type) {
            try {
                const reportData = {
                    title: \'Báo cáo Doanh thu Cửa hàng Điện tử\',
                    date: new Date().toLocaleDateString(\'vi-VN\'),
                    revenue: document.getElementById(\'totalRevenue\').textContent,
                    orders: document.getElementById(\'totalOrders\').textContent,
                    customers: document.getElementById(\'newCustomers\').textContent,
                    topProducts: document.getElementById(\'topProducts\').textContent
                };

                if (type === \'pdf\') {
                    const pdfContent = `BÁOÁO DOANH THU CỬA HÀNG ĐIỆN TỬ
Ngày tạo: ${reportData.date}

=== TỔNG QUAN ===
Tổng doanh thu: ${reportData.revenue}
Tổng đơn hàng: ${reportData.orders}
Khách hàng mới: ${reportData.customers}
Sản phẩm bán chạy: ${reportData.topProducts}

=== SẢN PHẨM BÁN CHẠY ===
1. iPhone 15 Pro Max - 156 sản phẩm - 468,000,000₫
2. MacBook Air M3 - 89 sản phẩm - 267,000,000₫
3. AirPods Pro 2 - 234 sản phẩm - 140,400,000₫
4. Apple Watch Series 9 - 127 sản phẩm - 101,600,000₫

=== ĐƠN HÀNG GẦN ĐÂY ===
- Nguyễn Văn A: 2,990,000₫ (Hoàn thành)
- Trần Thị B: 1,250,000₫ (Đang xử lý)
- Lê Minh C: 890,000₫ (Đang giao)
- Phạm Hùng D: 3,450,000₫ (Hoàn thành)

Báo cáo được tạo tự động từ hệ thống quản lý.`;
                    
                    const blob = new Blob([pdfContent], { type: \'text/plain;charset=utf-8\' });
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement(\'a\');
                    a.style.display = \'none\';
                    a.href = url;
                    a.download = \'bao-cao-doanh-thu-\' + new Date().toISOString().split(\'T\')[0] + \'.txt\';
                    document.body.appendChild(a);
                    a.click();
                    
                    setTimeout(() => {
                        document.body.removeChild(a);
                        URL.revokeObjectURL(url);
                    }, 100);
                } else {
                    const csvContent = \'\uFEFF\' + `Báo cáo Doanh thu Cửa hàng Điện tử
Ngày tạo,${reportData.date}

Chỉ số,Giá trị,Thay đổi
Tổng doanh thu,${reportData.revenue},+12.5%
Tổng đơn hàng,${reportData.orders},+8.3%
Khách hàng mới,${reportData.customers},+15.7%
Sản phẩm bán chạy,${reportData.topProducts},+5.2%

Sản phẩm bán chạy nhất,Số lượng đã bán,Doanh thu
iPhone 15 Pro Max,156,468000000
MacBook Air M3,89,267000000
AirPods Pro 2,234,140400000
Apple Watch Series 9,127,101600000

Đơn hàng gần đây,Khách hàng,Giá trị,Trạng thái
#ORD-2024-001,Nguyễn Văn A,2990000,Hoàn thành
#ORD-2024-002,Trần Thị B,1250000,Đang xử lý
#ORD-2024-003,Lê Minh C,890000,Đang giao
#ORD-2024-004,Phạm Hùng D,3450000,Hoàn thành`;
                    
                    const blob = new Blob([csvContent], { type: \'text/csv;charset=utf-8\' });
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement(\'a\');
                    a.style.display = \'none\';
                    a.href = url;
                    a.download = \'bao-cao-excel-\' + new Date().toISOString().split(\'T\')[0] + \'.csv\';
                    document.body.appendChild(a);
                    a.click();
                    
                    setTimeout(() => {
                        document.body.removeChild(a);
                        URL.revokeObjectURL(url);
                    }, 100);
                }
                
                closePreviewModal();
                alert(`${type === \'pdf\' ? \'📄 Báo cáo PDF\' : \'📊 File Excel\'} đã được tải xuống thành công!`);
            } catch (error) {
                console.error(\'Lỗi tải xuống:\', error);
                alert(\'❌ Có lỗi xảy ra khi tải xuống. Vui lòng thử lại!\');
            }
        }

        function exportOtherFormat(type) {
            closePreviewModal();
            setTimeout(() => {
                showPreviewModal(type);
            }, 100);
        }

        function closePreviewModal() {
            const modal = document.querySelector(\'.preview-modal\');
            if (modal) {
                modal.remove();
            }
        }

        function scheduleReport() {
            try {
                // Remove existing modal if any
                const existingModal = document.querySelector(\'.schedule-modal\');
                if (existingModal) {
                    existingModal.remove();
                }
                
                // Create schedule modal
                const modal = document.createElement(\'div\');
                modal.className = \'schedule-modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50\';
                modal.innerHTML = `
                    <div class="bg-white rounded-xl p-6 w-96 max-w-90vw">
                        <h3 class="text-lg font-semibold mb-4">⏰ Lên lịch báo cáo tự động</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tần suất gửi báo cáo:</label>
                                <select id="scheduleFrequency" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                                    <option value="daily">Hàng ngày</option>
                                    <option value="weekly">Hàng tuần</option>
                                    <option value="monthly">Hàng tháng</option>
                                    <option value="quarterly">Hàng quý</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email nhận báo cáo:</label>
                                <input type="email" id="scheduleEmail" placeholder="admin@cuahang.com" 
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Thời gian gửi:</label>
                                <input type="time" id="scheduleTime" value="09:00" 
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            </div>
                            <div class="flex gap-3 mt-6">
                                <button onclick="confirmSchedule()" 
                                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium">
                                    Xác nhận
                                </button>
                                <button onclick="closeScheduleModal()" 
                                        class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded-lg font-medium">
                                    Hủy
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
                
                // Close modal when clicking outside
                modal.addEventListener(\'click\', function(e) {
                    if (e.target === modal) {
                        closeScheduleModal();
                    }
                });
            } catch (error) {
                console.error(\'Lỗi mở lịch báo cáo:\', error);
                alert(\'❌ Có lỗi xảy ra khi mở lịch báo cáo. Vui lòng thử lại!\');
            }
        }

        function confirmSchedule() {
            try {
                const frequency = document.getElementById(\'scheduleFrequency\').value;
                const email = document.getElementById(\'scheduleEmail\').value;
                const time = document.getElementById(\'scheduleTime\').value;
                
                if (!email) {
                    alert(\'Vui lòng nhập email nhận báo cáo!\');
                    return;
                }
                
                if (!email.includes(\'@\')) {
                    alert(\'Vui lòng nhập email hợp lệ!\');
                    return;
                }
                
                // Save schedule to localStorage
                const schedule = {
                    frequency: frequency,
                    email: email,
                    time: time,
                    created: new Date().toISOString()
                };
                localStorage.setItem(\'reportSchedule\', JSON.stringify(schedule));
                
                closeScheduleModal();
                alert(`✅ Đã lên lịch gửi báo cáo ${getFrequencyText(frequency)} lúc ${time} đến ${email}`);
            } catch (error) {
                console.error(\'Lỗi xác nhận lịch:\', error);
                alert(\'❌ Có lỗi xảy ra khi lưu lịch báo cáo. Vui lòng thử lại!\');
            }
        }

        function closeScheduleModal() {
            const modal = document.querySelector(\'.schedule-modal\');
            if (modal) {
                modal.remove();
            }
        }

        function getFrequencyText(frequency) {
            const texts = {
                \'daily\': \'hàng ngày\',
                \'weekly\': \'hàng tuần\', 
                \'monthly\': \'hàng tháng\',
                \'quarterly\': \'hàng quý\'
            };
            return texts[frequency] || frequency;
        }

        // Filter change handlers
        document.getElementById(\'revenueFilter\').addEventListener(\'change\', function() {
            // Update revenue chart based on filter
            const filter = this.value;
            let newData, newLabels;
            
            if (filter === \'12 tháng gần đây\') {
                newLabels = [\'T1\', \'T2\', \'T3\', \'T4\', \'T5\', \'T6\', \'T7\', \'T8\', \'T9\', \'T10\', \'T11\', \'T12\'];
                newData = [1200, 1400, 1600, 1800, 1900, 2100, 1800, 2100, 1950, 2300, 2150, 2450];
            } else if (filter === \'Năm nay\') {
                newLabels = [\'Q1\', \'Q2\', \'Q3\', \'Q4\'];
                newData = [4200, 5800, 6050, 7200];
            } else {
                newLabels = [\'T7\', \'T8\', \'T9\', \'T10\', \'T11\', \'T12\'];
                newData = [1800, 2100, 1950, 2300, 2150, 2450];
            }
            
            revenueChart.data.labels = newLabels;
            revenueChart.data.datasets[0].data = newData;
            revenueChart.update();
        });

        document.getElementById(\'orderFilter\').addEventListener(\'change\', function() {
            // Update orders chart based on filter
            const filter = this.value;
            let newData;
            
            if (filter === \'Quý này\') {
                newData = [2268, 702, 567, 204];
            } else if (filter === \'Năm này\') {
                newData = [9072, 2808, 2268, 816];
            } else {
                newData = [756, 234, 189, 68];
            }
            
            ordersChart.data.datasets[0].data = newData;
            ordersChart.update();
        });

        // Auto-refresh data every 30 seconds
        setInterval(function() {
            // Simulate real-time data updates
            const revenue = document.getElementById(\'totalRevenue\');
            const orders = document.getElementById(\'totalOrders\');
            const customers = document.getElementById(\'newCustomers\');
            
            // Add small random variations
            const currentRevenue = parseInt(revenue.textContent.replace(/[^\d]/g, \'\'));
            const newRevenue = currentRevenue + Math.floor(Math.random() * 1000000);
            revenue.textContent = newRevenue.toLocaleString(\'vi-VN\') + \'₫\';
            
            const currentOrders = parseInt(orders.textContent);
            orders.textContent = currentOrders + Math.floor(Math.random() * 5);
            
            const currentCustomers = parseInt(customers.textContent);
            customers.textContent = currentCustomers + Math.floor(Math.random() * 3);
        }, 30000);
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement(\'script\');d.innerHTML="window.__CF$cv$params={r:\'98cc935113d3ddc3\',t:\'MTc2MDE2NzAyMi4wMDAwMDA=\'};var a=document.createElement(\'script\');a.nonce=\'\';a.src=\'/cdn-cgi/challenge-platform/scripts/jsd/main.js\';document.getElementsByTagName(\'head\')[0].appendChild(a);";b.getElementsByTagName(\'head\')[0].appendChild(d)}}if(document.body){var a=document.createElement(\'iframe\');a.height=1;a.width=1;a.style.position=\'absolute\';a.style.top=0;a.style.left=0;a.style.border=\'none\';a.style.visibility=\'hidden\';document.body.appendChild(a);if(\'loading\'!==document.readyState)c();else if(window.addEventListener)document.addEventListener(\'DOMContentLoaded\',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);\'loading\'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
