<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Quản lý</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="{{ url('/css/app.css') }}">
</head>
<body class="bg-gray-100">

<div id="dashboard" class="section p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Dashboard Tổng quan</h2>
        <p class="text-gray-600">Chào mừng bạn đến với hệ thống quản lý</p>
    </div>

    <!-- Thống kê tổng quan -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="stats-card text-white p-6 rounded-lg card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">Tổng đơn hàng</p>
                    <p class="text-2xl font-bold">1,234</p>
                </div>
                <i class="fas fa-shopping-cart text-3xl opacity-80"></i>
            </div>
        </div>
        <div class="stats-card-2 text-white p-6 rounded-lg card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">Doanh thu</p>
                    <p class="text-2xl font-bold">₫45.2M</p>
                </div>
                <i class="fas fa-dollar-sign text-3xl opacity-80"></i>
            </div>
        </div>
        <div class="stats-card-3 text-white p-6 rounded-lg card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">Khách hàng</p>
                    <p class="text-2xl font-bold">892</p>
                </div>
                <i class="fas fa-users text-3xl opacity-80"></i>
            </div>
        </div>
        <div class="stats-card-4 text-white p-6 rounded-lg card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">Sản phẩm</p>
                    <p class="text-2xl font-bold">156</p>
                </div>
                <i class="fas fa-box text-3xl opacity-80"></i>
            </div>
        </div>
    </div>

    <!-- Đơn hàng gần đây & Cảnh báo tồn kho -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Đơn hàng gần đây -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-4">Đơn hàng gần đây</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                    <div>
                        <p class="font-medium">#DH001</p>
                        <p class="text-sm text-gray-600">Nguyễn Văn A</p>
                    </div>
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Hoàn thành</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                    <div>
                        <p class="font-medium">#DH002</p>
                        <p class="text-sm text-gray-600">Trần Thị B</p>
                    </div>
                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm">Đang xử lý</span>
                </div>
            </div>
        </div>

        <!-- Cảnh báo tồn kho -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-4">Cảnh báo tồn kho</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-red-50 rounded">
                    <div>
                        <p class="font-medium">iPhone 14</p>
                        <p class="text-sm text-gray-600">Còn lại: 5 sản phẩm</p>
                    </div>
                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm">Sắp hết</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-orange-50 rounded">
                    <div>
                        <p class="font-medium">Samsung Galaxy S23</p>
                        <p class="text-sm text-gray-600">Còn lại: 12 sản phẩm</p>
                    </div>
                    <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded text-sm">Thấp</span>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
