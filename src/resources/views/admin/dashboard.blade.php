@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Dashboard Title -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Admin</h1>
            <p class="text-gray-600">Tổng quan quản lý cửa hàng điện tử</p>
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
                        <p class="text-2xl font-bold text-gray-900">
                            {{ number_format($totalRevenue, 0, ',', '.') }} VNĐ
                        </p>
                    </div>
                </div>
            </div>

            <!-- Đơn hàng -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Đơn Hàng</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</p>
                        <p class="text-blue-600 text-sm">+8.2% so với tuần trước</p>
                    </div>
                </div>
            </div>

            <!-- Khách hàng -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Khách Hàng</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalCustomers }}</p>
                        <p class="text-purple-600 text-sm">+156 khách hàng mới</p>
                    </div>
                </div>
            </div>

            <!-- Sản phẩm -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Sản Phẩm</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalProducts }}</p>
                        <p class="text-orange-600 text-sm">{{ $lowStockProducts }} sản phẩm sắp hết</p>
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
            <div class="space-y-4">
                @foreach($topProducts as $product)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                            <span class="text-white text-sm">📦</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $product->product->name ?? 'Không xác định' }}</p>
                            <p class="text-sm text-gray-600">{{ $product->total_sold }} đã bán</p>
                        </div>
                    </div>
                    <span class="text-green-600 font-semibold">+{{ rand(5,20) }}%</span>
                </div>
                @endforeach
            </div>

        </div>
    </main>

    <canvas id="revenueChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const ctx = document.getElementById('revenueChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach(range(1,12) as $m)
                    "{{ $m }}",
                @endforeach
            ],
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: [
                    @foreach(range(1,12) as $m)
                        {{ $monthlyRevenue[$m] ?? 0 }},
                    @endforeach
                ],
                borderWidth: 1,
                backgroundColor: '#3B82F6'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>

</div>
</html>
@endsection