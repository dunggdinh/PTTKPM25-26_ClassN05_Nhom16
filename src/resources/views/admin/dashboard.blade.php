<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">

</head>
<body class="bg-gray-50 font-sans">
    <!-- Main Content -->
    <main class="p-6">
        <!-- Dashboard Title -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Admin</h1>
            <p class="text-gray-600">Tổng quan quản lý cửa hàng điện tử</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-3">
                    <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-gray-600 text-sm">Tổng Doanh Thu</p>
                        <p class="text-2xl font-bold text-gray-900">2.4 tỷ VNĐ</p>
                        <p class="text-green-600 text-xs">+12.5% so với tháng trước</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Đơn Hàng</p>
                        <p class="text-2xl font-bold text-gray-900">1,247</p>
                        <p class="text-blue-600 text-sm">+8.2% so với tuần trước</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Khách Hàng</p>
                        <p class="text-2xl font-bold text-gray-900">8,432</p>
                        <p class="text-purple-600 text-sm">+156 khách hàng mới</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Sản Phẩm</p>
                        <p class="text-2xl font-bold text-gray-900">2,847</p>
                        <p class="text-orange-600 text-sm">47 sản phẩm sắp hết</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Tables Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Revenue Chart -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Doanh Thu Theo Tháng</h3>
                    <select class="text-sm border border-gray-300 rounded-md px-3 py-1">
                        <option>2024</option>
                        <option>2023</option>
                    </select>
                </div>
                <div style="height: 300px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Top Products -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Sản Phẩm Bán Chạy</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                <span class="text-white text-sm">📱</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">iPhone 15 Pro Max</p>
                                <p class="text-sm text-gray-600">847 đã bán</p>
                            </div>
                        </div>
                        <span class="text-green-600 font-semibold">+15%</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gray-500 rounded-lg flex items-center justify-center">
                                <span class="text-white text-sm">💻</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">MacBook Air M3</p>
                                <p class="text-sm text-gray-600">623 đã bán</p>
                            </div>
                        </div>
                        <span class="text-green-600 font-semibold">+8%</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center">
                                <span class="text-white text-sm">🎧</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">AirPods Pro</p>
                                <p class="text-sm text-gray-600">456 đã bán</p>
                            </div>
                        </div>
                        <span class="text-green-600 font-semibold">+12%</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                <span class="text-white text-sm">⌚</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Apple Watch Series 9</p>
                                <p class="text-sm text-gray-600">334 đã bán</p>
                            </div>
                        </div>
                        <span class="text-green-600 font-semibold">+6%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders and Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Orders -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Đơn Hàng Gần Đây</h3>
                    <button id="viewAllOrders" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Xem tất cả</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-medium text-gray-600">Mã ĐH</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-600">Khách Hàng</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-600">Sản Phẩm</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-600">Giá Trị</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-600">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100">
                                <td class="py-3 px-4 text-sm font-medium">#DH001</td>
                                <td class="py-3 px-4 text-sm">Nguyễn Văn A</td>
                                <td class="py-3 px-4 text-sm">iPhone 15 Pro</td>
                                <td class="py-3 px-4 text-sm font-medium">28.990.000đ</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Đã giao</span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-3 px-4 text-sm font-medium">#DH002</td>
                                <td class="py-3 px-4 text-sm">Trần Thị B</td>
                                <td class="py-3 px-4 text-sm">MacBook Air</td>
                                <td class="py-3 px-4 text-sm font-medium">32.990.000đ</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Đang giao</span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-3 px-4 text-sm font-medium">#DH003</td>
                                <td class="py-3 px-4 text-sm">Lê Văn C</td>
                                <td class="py-3 px-4 text-sm">AirPods Pro</td>
                                <td class="py-3 px-4 text-sm font-medium">6.990.000đ</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Đã xác nhận</span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-3 px-4 text-sm font-medium">#DH004</td>
                                <td class="py-3 px-4 text-sm">Phạm Minh D</td>
                                <td class="py-3 px-4 text-sm">Apple Watch</td>
                                <td class="py-3 px-4 text-sm font-medium">12.990.000đ</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs rounded-full">Chờ xử lý</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Thao Tác Nhanh</h3>
                <div class="space-y-3">
                    <button id="addProduct" class="w-full flex items-center space-x-3 p-3 text-left hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Thêm Sản Phẩm</p>
                            <p class="text-sm text-gray-600">Thêm sản phẩm mới</p>
                        </div>
                    </button>

                    <button id="manageOrders" class="w-full flex items-center space-x-3 p-3 text-left hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Quản Lý Đơn Hàng</p>
                            <p class="text-sm text-gray-600">Xem và xử lý đơn hàng</p>
                        </div>
                    </button>

                    <button id="manageCustomers" class="w-full flex items-center space-x-3 p-3 text-left hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Quản Lý Khách Hàng</p>
                            <p class="text-sm text-gray-600">Xem thông tin khách hàng</p>
                        </div>
                    </button>

                    <button id="viewReports" class="w-full flex items-center space-x-3 p-3 text-left hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 00-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Báo Cáo</p>
                            <p class="text-sm text-gray-600">Xem báo cáo chi tiết</p>
                        </div>
                    </button>

                    <button id="manageInventory" class="w-full flex items-center space-x-3 p-3 text-left hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Quản Lý Kho</p>
                            <p class="text-sm text-gray-600">Kiểm tra tồn kho</p>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Wait for DOM to load
        document.addEventListener(\'DOMContentLoaded\', function() {
            // Revenue Chart
            const ctx = document.getElementById(\'revenueChart\').getContext(\'2d\');
            new Chart(ctx, {
                type: \'line\',
                data: {
                    labels: [\'T1\', \'T2\', \'T3\', \'T4\', \'T5\', \'T6\', \'T7\', \'T8\', \'T9\', \'T10\', \'T11\', \'T12\'],
                    datasets: [{
                        label: \'Doanh thu (tỷ VNĐ)\',
                        data: [1.2, 1.5, 1.8, 2.1, 1.9, 2.3, 2.6, 2.4, 2.8, 2.5, 2.7, 2.4],
                        borderColor: \'#3B82F6\',
                        backgroundColor: \'rgba(59, 130, 246, 0.1)\',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: \'#3B82F6\',
                        pointBorderColor: \'#ffffff\',
                        pointBorderWidth: 2,
                        pointRadius: 5
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
                                color: \'#F3F4F6\'
                            },
                            ticks: {
                                callback: function(value) {
                                    return value + \' tỷ\';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: \'index\'
                    }
                }
            });

            // Add click handlers for quick actions
            document.getElementById(\'addProduct\').addEventListener(\'click\', function() {
                window.location.href = \'add-product.html\';
            });

            document.getElementById(\'manageOrders\').addEventListener(\'click\', function() {
                window.location.href = \'manage-orders.html\';
            });

            document.getElementById(\'manageCustomers\').addEventListener(\'click\', function() {
                window.location.href = \'manage-customers.html\';
            });

            document.getElementById(\'viewReports\').addEventListener(\'click\', function() {
                window.location.href = \'reports.html\';
            });

            document.getElementById(\'manageInventory\').addEventListener(\'click\', function() {
                window.location.href = \'manage-inventory.html\';
            });

            document.getElementById(\'viewAllOrders\').addEventListener(\'click\', function() {
                window.location.href = \'manage-orders.html\';
            });
        });
    </script>
