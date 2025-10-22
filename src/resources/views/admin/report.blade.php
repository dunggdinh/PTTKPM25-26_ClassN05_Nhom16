@extends('admin.layout')
@section('title', 'Thống kê')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
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
            <!-- Tổng doanh thu -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-3">
                    <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Tổng Doanh Thu</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</p>
                        <p class="text-green-600 text-xs mt-1">{{ $revenueDiff }} so với tháng trước</p>
                    </div>
                </div>
            </div>

            <!-- Đơn hàng -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-3">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Đơn Hàng</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</p>
                        <p class="text-blue-600 text-xs mt-1">{{ $ordersDiff }} so với tuần trước</p>
                    </div>
                </div>
            </div>

            <!-- Khách hàng mới -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-3">
                    <div class="w-14 h-14 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Khách Hàng Mới</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $newCustomers }}</p>
                        <p class="text-purple-600 text-xs mt-1">{{ $customersDiff }} so với tháng trước</p>
                    </div>
                </div>
            </div>

            <!-- Sản phẩm bán chạy -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-3">
                    <div class="w-14 h-14 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Sản Phẩm Bán Chạy</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $topProducts->count() }}</p>
                        <p class="text-orange-600 text-xs mt-1">{{ $topProductsDiff }} so với tuần trước</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Revenue Chart -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">📈 Doanh thu theo tháng</h3>
                    <select class="text-sm border border-gray-300 rounded-lg px-3 py-1" id="revenueFilter" onchange="updateRevenueChart(this.value)">
                        <option value="6">6 tháng gần đây</option>
                        <option value="12" selected>12 tháng gần đây</option>
                        <option value="year">Năm nay</option>
                    </select>
                </div>
                <div class="relative h-72">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Orders Chart -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">📊 Phân tích đơn hàng</h3>
                    <select class="text-sm border border-gray-300 rounded-lg px-3 py-1" id="orderFilter" onchange="updateOrdersChart(this.value)">
                        <option value="month">Tháng này</option>
                        <option value="quarter">Quý này</option>
                        <option value="year" selected>Năm này</option>
                    </select>
                </div>
                <div class="relative h-72">
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
                            @foreach($topProducts as $product)
                                <tr class="border-b border-gray-100">
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">📦</div>
                                            <span class="text-sm font-medium">{{ $product->product->name ?? 'N/A' }}</span>
                                        </div>
                                    </td>
                                    <td class="text-right py-3 text-sm">{{ $product->total_sold }}</td>
                                    <td class="text-right py-3 text-sm font-medium text-green-600">
                                        {{ number_format($product->total_revenue, 0, ',', '.') }}₫
                                    </td>
                                </tr>
                            @endforeach
                            @if($topProducts->isEmpty())
                                <tr>
                                    <td colspan="3" class="py-3 text-center text-gray-500">Chưa có dữ liệu</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">🕒 Đơn hàng gần đây</h3>
                <div class="space-y-4" id="recentOrders">
                    @foreach($recentOrders as $order)
                        @php
                            $statusColors = [
                                'completed' => 'green',
                                'pending' => 'blue',
                                'processing' => 'orange',
                                'cancelled' => 'red'
                            ];
                            $color = $statusColors[$order->status] ?? 'gray';
                        @endphp
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-{{ $color }}-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                                    {{ strtoupper(substr($order->User->name ?? 'KH', 0, 2)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium">{{ $order->User->name ?? 'Khách hàng' }}</p>
                                    <p class="text-xs text-gray-500">#{{ $order->order_id }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-{{ $color }}-600">{{ number_format($order->total_amount, 0, ',', '.') }}₫</p>
                                <span class="inline-block px-2 py-1 text-xs bg-{{ $color }}-100 text-{{ $color }}-800 rounded-full">{{ ucfirst($order->status) }}</span>
                            </div>
                        </div>
                    @endforeach
                    @if($recentOrders->isEmpty())
                        <p class="text-gray-500 text-center">Chưa có đơn hàng gần đây</p>
                    @endif
                </div>
            </div>
        </div>



    </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const revenueData = @json($monthlyRevenue);
const orderData = @json($orderAnalysis);

let revenueChartCtx = document.getElementById('revenueChart').getContext('2d');
let revenueChart = new Chart(revenueChartCtx, {
    type: 'line',
    data: {
        labels: Object.keys(revenueData).map(m => 'Tháng ' + m),
        datasets: [{
            label: 'Doanh thu',
            data: Object.values(revenueData),
            backgroundColor: 'rgba(59,130,246,0.2)',
            borderColor: 'rgba(59,130,246,1)',
            borderWidth: 2,
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: true } },
        scales: { y: { beginAtZero: true } }
    }
});

let ordersChartCtx = document.getElementById('ordersChart').getContext('2d');
let ordersChart = new Chart(ordersChartCtx, {
    type: 'doughnut',
    data: {
        labels: Object.keys(orderData),
        datasets: [{
            label: 'Đơn hàng',
            data: Object.values(orderData),
            backgroundColor: [
                'rgba(34,197,94,0.7)',
                'rgba(59,130,246,0.7)',
                'rgba(251,191,36,0.7)',
                'rgba(239,68,68,0.7)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom' } }
    }
});

// Placeholder functions for dynamic filter (optional)
function updateRevenueChart(value) {
    // Gửi request AJAX hoặc lọc dữ liệu trên client nếu đã có sẵn
    console.log('Lọc doanh thu:', value);
}

function updateOrdersChart(value) {
    console.log('Lọc đơn hàng:', value);
}
</script>
</div>
</html>
@endsection