<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống Quản lý Cửa hàng Điện tử</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
        body {
            font-family: 'Roboto', sans-serif;
        }
        .sidebar-item {
            position: relative;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .sidebar-item:hover, .sidebar-item.active {
            color: white;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: translateX(4px);
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .stats-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .stats-card-2 {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .stats-card-3 {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
        .stats-card-4 {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }
        .message-bubble {
            max-width: 70%;
            word-wrap: break-word;
        }
        .truncate-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .modal-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            transition: opacity 0.3s ease-in-out;
            opacity: 0;
            pointer-events: none;
        }
        .modal-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }
        .modal-content {
            transform: translateY(-20px);
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
            opacity: 0;
        }
        .modal-overlay.open .modal-content {
            transform: translateY(0);
            opacity: 1;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <header class="gradient-bg text-white shadow-lg z-50 fixed w-full top-0">
        <div class="flex items-center justify-between px-6 py-4">
            <div class="flex items-center space-x-4">
                <i class="fas fa-store text-2xl"></i>
                <h1 class="text-xl font-bold">Admin Dashboard</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <i class="fas fa-bell text-xl cursor-pointer hover:text-yellow-300 transition-colors"></i>
                    <span class="absolute -top-2 -right-2 bg-red-500 text-xs rounded-full h-5 w-5 flex items-center justify-center animate-pulse">3</span>
                </div>
                <div class="flex items-center space-x-2">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32'%3E%3Ccircle cx='16' cy='16' r='16' fill='%23ffffff'/%3E%3Ctext x='16' y='21' text-anchor='middle' fill='%23667eea' font-family='Arial' font-size='14' font-weight='bold'%3EA%3C/text%3E%3C/svg%3E" alt="Admin" class="w-8 h-8 rounded-full">
                    <span class="font-medium">Admin User</span>
                    <i class="fas fa-chevron-down cursor-pointer"></i>
                </div>
            </div>
        </div>
    </header>

    <div class="flex pt-16">
        <aside class="w-64 bg-white shadow-lg h-screen sticky top-16 overflow-y-auto z-40">
            <nav class="mt-6">
                <div class="px-4 mb-4">
                    <h2 class="text-gray-600 text-sm font-semibold uppercase tracking-wide">Quản lý chính</h2>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('dashboard')">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    <span>Dashboard</span>
                </a>

                <div class="px-4 mt-6 mb-2">
                    <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Quản lý người dùng</h3>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('customers')">
                    <i class="fas fa-users mr-3"></i>
                    <span>Danh sách khách hàng</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('staff')">
                    <i class="fas fa-user-tie mr-3"></i>
                    <span>Danh sách nhân viên</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('permissions')">
                    <i class="fas fa-key mr-3"></i>
                    <span>Phân quyền tài khoản</span>
                </a>

                <div class="px-4 mt-6 mb-2">
                    <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Quản lý sản phẩm</h3>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('products')">
                    <i class="fas fa-box mr-3"></i>
                    <span>Danh sách sản phẩm</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('categories')">
                    <i class="fas fa-tags mr-3"></i>
                    <span>Danh mục sản phẩm</span>
                </a>

                <div class="px-4 mt-6 mb-2">
                    <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Quản lý kho</h3>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('inventory')">
                    <i class="fas fa-warehouse mr-3"></i>
                    <span>Kiểm tra tồn kho</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('stock-alerts')">
                    <i class="fas fa-exclamation-triangle mr-3"></i>
                    <span>Cảnh báo hết hàng</span>
                </a>

                <div class="px-4 mt-6 mb-2">
                    <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Quản lý đơn hàng</h3>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('orders')">
                    <i class="fas fa-shopping-cart mr-3"></i>
                    <span>Danh sách đơn hàng</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('purchase-orders')">
                    <i class="fas fa-file-invoice mr-3"></i>
                    <span>Đơn hàng nhập hàng</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('deliveries')">
                    <i class="fas fa-truck mr-3"></i>
                    <span>Quản lý nhập hàng</span>
                </a>

                <div class="px-4 mt-6 mb-2">
                    <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Chăm sóc khách hàng</h3>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('chat')">
                    <i class="fas fa-headset mr-3"></i>
                    <span>Hỗ trợ trực tuyến</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('returns')">
                    <i class="fas fa-undo mr-3"></i>
                    <span>Yêu cầu trả hàng</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('warranties')">
                    <i class="fas fa-shield-alt mr-3"></i>
                    <span>Lịch hẹn bảo hành</span>
                </a>

                <div class="px-4 mt-6 mb-2">
                    <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Khuyến mãi</h3>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('promotions')">
                    <i class="fas fa-percentage mr-3"></i>
                    <span>Chương trình khuyến mãi</span>
                </a>

                <div class="px-4 mt-6 mb-2">
                    <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Báo cáo</h3>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('reports')">
                    <i class="fas fa-chart-bar mr-3"></i>
                    <span>Báo cáo & thống kê</span>
                </a>
            
                <div class="px-4 mt-6 mb-2">
                    <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Thanh toán</h3>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('payment-gateway')">
                    <i class="fas fa-credit-card mr-3"></i>
                    <span>Cổng thanh toán</span>
                </a>
    
</nav>
        </aside>

        <main class="flex-1 p-6 animate-fade-in">
            <div id="dashboard" class="section">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Dashboard Tổng quan</h2>
                    <p class="text-gray-600">Chào mừng bạn đến với hệ thống quản lý</p>
                </div>

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

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
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

            <div id="customers" class="section hidden">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Danh sách khách hàng</h2>
                        <p class="text-gray-600 mt-1">Khách hàng tự đăng ký tài khoản trên website</p>
                    </div>
                    <div class="flex space-x-2">
                        <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                            <i class="fas fa-download mr-2"></i>Xuất Excel
                        </button>
                        <button class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-200 transition-colors">
                            <i class="fas fa-filter mr-2"></i>Bộ lọc
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6 border-b">
                        <div class="flex space-x-4">
                            <input type="text" placeholder="Tìm kiếm khách hàng..." class="flex-1 border rounded-lg px-4 py-2">
                            <select class="border rounded-lg px-4 py-2">
                                <option>Tất cả trạng thái</option>
                                <option>Hoạt động</option>
                                <option>Không hoạt động</option>
                            </select>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tên khách hàng</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Số điện thoại</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#001</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Nguyễn Văn A</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">nguyenvana@email.com</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">0123456789</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Hoạt động</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-blue-600 hover:text-blue-900 mr-3">Sửa</button>
                                        <button class="text-red-600 hover:text-red-900">Xóa</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#002</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Trần Thị B</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">tranthib@email.com</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">0987654321</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Hoạt động</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-blue-600 hover:text-blue-900 mr-3">Sửa</button>
                                        <button class="text-red-600 hover:text-red-900">Xóa</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="staff" class="section hidden">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Danh sách nhân viên</h2>
                        <p class="text-gray-600 mt-1">Quản lý thông tin và quyền hạn nhân viên</p>
                    </div>
                    <button class="gradient-bg text-white px-4 py-2 rounded-lg hover:opacity-90 transition-all duration-200" onclick="openAddStaffModal()">
                        <i class="fas fa-plus mr-2"></i>Thêm nhân viên
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-purple-500">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-crown text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-800">2</p>
                                <p class="text-sm text-gray-600">Admin</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-shopping-cart text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-800">5</p>
                                <p class="text-sm text-gray-600">Order Manager</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-green-500">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-warehouse text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-800">3</p>
                                <p class="text-sm text-gray-600">Storekeeper</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-yellow-500">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-headset text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-800">8</p>
                                <p class="text-sm text-gray-600">Support Staff</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6 border-b">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                            <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4">
                                <div class="relative">
                                    <input type="text" placeholder="Tìm kiếm nhân viên..." class="pl-10 pr-4 py-2 border rounded-lg w-full md:w-64" id="staffSearch">
                                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                </div>
                                <select class="border rounded-lg px-4 py-2" id="roleFilter">
                                    <option value="">Tất cả chức vụ</option>
                                    <option value="admin">Admin</option>
                                    <option value="order-manager">Order Manager</option>
                                    <option value="storekeeper">Storekeeper</option>
                                    <option value="support">Support Staff</option>
                                </select>
                                <select class="border rounded-lg px-4 py-2" id="statusFilter">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="active">Hoạt động</option>
                                    <option value="inactive">Không hoạt động</option>
                                    <option value="suspended">Tạm khóa</option>
                                </select>
                            </div>
                            <div class="flex space-x-2">
                                <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-download mr-2"></i>Xuất Excel
                                </button>
                                <button class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-200 transition-colors">
                                    <i class="fas fa-filter mr-2"></i>Bộ lọc
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full" id="staffTable">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        <input type="checkbox" class="rounded" id="selectAll">
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nhân viên</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Chức vụ</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Liên hệ</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><input type="checkbox" class="rounded"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img class="h-8 w-8 rounded-full" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32'%3E%3Ccircle cx='16' cy='16' r='16' fill='%23e0e0e0'/%3E%3Ctext x='16' y='21' text-anchor='middle' fill='%23616161' font-family='Arial' font-size='14' font-weight='bold'%3EA%3C/text%3E%3C/svg%3E" alt="">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Nguyễn Văn A</div>
                                                <div class="text-sm text-gray-500">ID: #NV001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Admin</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> Hoạt động </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-envelope text-gray-400"></i>
                                            <span class="text-gray-600">a.nguyen@email.com</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-indigo-600 hover:text-indigo-900">Sửa</button>
                                        <button class="text-red-600 hover:text-red-900 ml-4">Xóa</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="products" class="section hidden">
                <div id="product-list-view">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Danh sách sản phẩm</h2>
                            <p class="text-gray-600 mt-1">Quản lý và cập nhật thông tin sản phẩm</p>
                        </div>
                        <button class="gradient-bg text-white px-4 py-2 rounded-lg hover:opacity-90 transition-all duration-200" onclick="openProductModal()">
                            <i class="fas fa-plus mr-2"></i>Thêm sản phẩm
                        </button>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex flex-col md:flex-row md:items-center justify-between space-y-4 md:space-y-0 mb-6">
                            <div class="flex flex-col md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-4">
                                <div class="relative w-full md:w-64">
                                    <input type="text" placeholder="Tìm kiếm sản phẩm..." class="pl-10 pr-4 py-2 border rounded-lg w-full" id="product-search-input">
                                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                </div>
                                <select id="product-category-filter" class="border rounded-lg px-4 py-2 w-full md:w-auto">
                                    <option value="all">Tất cả danh mục</option>
                                    <option value="laptop">Laptop</option>
                                    <option value="phone">Điện thoại</option>
                                </select>
                            </div>
                            <div class="flex space-x-2">
                                <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-download mr-2"></i>Xuất Excel
                                </button>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left" id="products-table">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Tên sản phẩm</th>
                                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">SKU</th>
                                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Danh mục</th>
                                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Tồn kho</th>
                                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Giá bán</th>
                                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" id="product-table-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="inventory" class="section hidden">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Kiểm tra tồn kho</h2>
                        <p class="text-gray-600 mt-1">Quản lý số lượng tồn kho sản phẩm</p>
                    </div>
                    <button class="gradient-bg text-white px-4 py-2 rounded-lg hover:opacity-90 transition-all duration-200" onclick="showSection('deliveries')">
                        <i class="fas fa-truck-loading mr-2"></i>Quản lý nhập hàng
                    </button>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex flex-col md:flex-row md:items-center justify-between space-y-4 md:space-y-0 mb-6">
                        <div class="flex flex-col md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-4">
                            <div class="relative w-full md:w-64">
                                <input type="text" placeholder="Tìm kiếm sản phẩm..." class="pl-10 pr-4 py-2 border rounded-lg w-full" id="inventory-search">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                            <select id="inventory-category-filter" class="border rounded-lg px-4 py-2 w-full md:w-auto">
                                <option value="all">Tất cả danh mục</option>
                                <option value="laptop">Laptop</option>
                                <option value="phone">Điện thoại</option>
                            </select>
                            <select id="inventory-status-filter" class="border rounded-lg px-4 py-2 w-full md:w-auto">
                                <option value="all">Tất cả trạng thái</option>
                                <option value="instock">Còn hàng</option>
                                <option value="lowstock">Sắp hết</option>
                                <option value="outofstock">Hết hàng</option>
                            </select>
                        </div>
                        <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                            <i class="fas fa-download mr-2"></i>Xuất Excel
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left" id="inventory-table">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Tên sản phẩm</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">SKU</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Danh mục</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Tồn kho hiện tại</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Tồn kho tối thiểu</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="inventory-table-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="deliveries" class="section hidden">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Quản lý nhập hàng</h2>
                        <p class="text-gray-600 mt-1">Theo dõi các lô hàng đang chờ nhập kho</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left" id="deliveries-table">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Mã đơn hàng</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Nhà cung cấp</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Sản phẩm</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Số lượng</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Ngày dự kiến nhận</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="deliveries-table-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="chat" class="section hidden">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Hỗ trợ trực tuyến</h2>
                        <p class="text-gray-600 mt-1">Quản lý các cuộc trò chuyện với khách hàng</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md flex h-[700px]">
                    <div id="chat-list" class="w-1/3 border-r overflow-y-auto p-4">
                    </div>
                    <div id="chat-window" class="w-2/3 flex flex-col p-4 bg-gray-50">
                        <div id="chat-placeholder" class="text-center text-gray-400 mt-20">
                            <i class="fas fa-comments text-6xl mb-4"></i>
                            <p class="text-lg">Chọn một cuộc trò chuyện để bắt đầu</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="returns" class="section hidden">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Yêu cầu trả hàng</h2>
                        <p class="text-gray-600 mt-1">Quản lý các yêu cầu trả hàng từ khách hàng</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mã đơn hàng</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tên khách hàng</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sản phẩm</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lý do</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ngày yêu cầu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="returns-table-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="warranties" class="section hidden">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Lịch hẹn bảo hành</h2>
                        <p class="text-gray-600 mt-1">Quản lý lịch hẹn bảo hành và sửa chữa sản phẩm</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tên khách hàng</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sản phẩm</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vấn đề</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ngày hẹn</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kỹ thuật viên</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="warranties-table-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="stock-alerts" class="section hidden">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Cảnh báo hết hàng</h2>
                        <p class="text-gray-600 mt-1">Danh sách các sản phẩm cần nhập thêm vào kho</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left" id="stock-alerts-table">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Tên sản phẩm</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">SKU</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Tồn kho hiện tại</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Tồn kho tối thiểu</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                                    <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="stock-alerts-table-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
<!-- Cổng thanh toán (nhúng từ Payments_gate1.html) -->
<div id="payment-gateway" class="section hidden">

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

</main>
    </div>

    <div id="product-modal" class="modal-overlay fixed inset-0 z-50 flex items-center justify-center p-4 transition-opacity duration-300">
        <div class="modal-content bg-white rounded-lg shadow-xl max-w-lg w-full p-6">
            <h2 id="modal-title" class="text-2xl font-bold text-gray-800 mb-4"></h2>
            <form id="product-form" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tên sản phẩm</label>
                    <input type="text" id="product-name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Danh mục</label>
                    <select id="product-category" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="laptop">Laptop</option>
                        <option value="phone">Điện thoại</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">SKU</label>
                    <input type="text" id="product-sku" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tồn kho hiện tại</label>
                        <input type="number" id="product-stock" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tồn kho tối thiểu</label>
                        <input type="number" id="product-min-stock" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Giá bán (VND)</label>
                    <input type="number" id="product-price" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" id="cancel-modal" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Hủy
                    </button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <div id="confirm-modal" class="modal-overlay fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="modal-content bg-white rounded-lg shadow-xl max-w-sm w-full p-6 text-center">
            <i class="fas fa-question-circle text-6xl text-blue-500 mb-4 animate-bounce"></i>
            <h3 class="text-xl font-bold text-gray-800 mb-2" id="confirm-modal-title">Xác nhận</h3>
            <p class="text-sm text-gray-600 mb-4" id="confirm-modal-message"></p>
            <div class="flex justify-center space-x-4">
                <button id="cancel-confirm" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">Hủy</button>
                <button id="confirm-action" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">Xác nhận</button>
            </div>
        </div>
    </div>
    <div id="toast-notification" class="fixed bottom-5 left-1/2 -translate-x-1/2 bg-gray-900 text-white px-6 py-3 rounded-full shadow-lg opacity-0 transition-opacity duration-300">
        <span id="toast-message"></span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let currentSection = 'dashboard';
            let selectedChat = null;
            let editingProductId = null;

            const inventory = [
                { id: 1, name: 'MacBook Pro M3 14"', category: 'laptop', sku: 'MBP14-001', currentStock: 15, minStock: 5, price: 52000000, supplier: 'Apple Authorized', lastUpdated: '2025-01-08' },
                { id: 2, name: 'iPhone 15 Pro Max 256GB', category: 'phone', sku: 'IP15PM-256', currentStock: 3, minStock: 10, price: 34000000, supplier: 'Apple Authorized', lastUpdated: '2025-01-07' },
                { id: 3, name: 'Dell XPS 13 Plus', category: 'laptop', sku: 'DL-XPS13P', currentStock: 8, minStock: 5, price: 28000000, supplier: 'Dell Vietnam', lastUpdated: '2025-01-06' },
                { id: 4, name: 'Samsung Galaxy S24 Ultra', category: 'phone', sku: 'SGS24U-512', currentStock: 2, minStock: 8, price: 31000000, supplier: 'Samsung Electronics', lastUpdated: '2025-01-05' },
                { id: 5, name: 'ASUS ROG Strix G16', category: 'laptop', sku: 'ASUS-ROG-G16', currentStock: 12, minStock: 6, price: 35000000, supplier: 'ASUS Vietnam', lastUpdated: '2025-01-08' }
            ];

            const pendingDeliveries = [
                { id: 1, orderId: 'PO-2025-0108-001', supplier: 'Dell Vietnam', product: 'Dell XPS 13 Plus', quantity: 10, arrivalDate: '2025-01-15', status: 'pending' },
                { id: 2, orderId: 'PO-2025-0107-002', supplier: 'Xiaomi Store', product: 'Xiaomi 13 Pro', quantity: 50, arrivalDate: '2025-01-14', status: 'pending' }
            ];

            const activeChats = [
                { id: 1, customerName: 'Nguyễn Văn Minh', status: 'active', lastMessage: 'Cho em hỏi sản phẩm này có bảo hành bao lâu ạ?', timestamp: '14:30', unread: 2, phone: '0901234567', email: 'minh.nv@email.com', messages: [
                    { id: 1, sender: 'customer', message: 'Chào anh/chị!', time: '14:25' },
                    { id: 2, sender: 'support', message: 'Chào bạn! Tôi có thể hỗ trợ gì cho bạn?', time: '14:26' },
                    { id: 3, sender: 'customer', message: 'Em muốn hỏi về MacBook Pro M3 14" có sẵn không ạ?', time: '14:28' },
                    { id: 4, sender: 'support', message: 'Dạ hiện tại chúng tôi có sẵn 15 máy trong kho. Bạn có muốn đặt hàng không?', time: '14:29' },
                    { id: 5, sender: 'customer', message: 'Cho em hỏi sản phẩm này có bảo hành bao lâu ạ?', time: '14:30' }
                ]},
                { id: 2, customerName: 'Trần Thị Lan', status: 'waiting', lastMessage: 'Em cần hỗ trợ về việc trả hàng', timestamp: '14:15', unread: 1, phone: '0912345678', email: 'lan.tt@email.com', messages: [
                    { id: 1, sender: 'customer', message: 'Chào shop!', time: '14:15' },
                    { id: 2, sender: 'customer', message: 'Em cần hỗ trợ về việc trả hàng', time: '14:15' }
                ]},
                { id: 3, customerName: 'Lê Hoàng Nam', status: 'resolved', lastMessage: 'Cảm ơn anh đã hỗ trợ!', timestamp: '13:45', unread: 0, phone: '0923456789', email: 'nam.lh@email.com', messages: [
                    { id: 1, sender: 'customer', message: 'Máy em mua hôm qua bị lỗi màn hình', time: '13:30' },
                    { id: 2, sender: 'support', message: 'Bạn có thể mang máy đến cửa hàng để kiểm tra không?', time: '13:32' },
                    { id: 3, sender: 'customer', message: 'Cảm ơn anh đã hỗ trợ!', time: '13:45' }
                ]}
            ];

            const returnRequests = [
                { id: 1, orderId: 'ORD-2025-0108-001', customerName: 'Phạm Văn Đức', phone: '0934567890', product: 'iPhone 15 Pro Max 256GB', reason: 'Sản phẩm bị lỗi màn hình', requestDate: '2025-01-08', status: 'pending', description: 'Màn hình bị nứt góc trái, không thể sử dụng bình thường', refundAmount: 34000000 },
                { id: 2, orderId: 'ORD-2025-0107-003', customerName: 'Nguyễn Thị Mai', phone: '0945678901', product: 'Dell XPS 13 Plus', reason: 'Không đúng mô tả', requestDate: '2025-01-07', status: 'approved', description: 'Máy có cấu hình khác với mô tả trên website', refundAmount: 28000000 },
                { id: 3, orderId: 'ORD-2025-0106-005', customerName: 'Hoàng Văn Tùng', phone: '0956789012', product: 'Samsung Galaxy S24 Ultra', reason: 'Đổi ý không muốn mua', requestDate: '2025-01-06', status: 'rejected', description: 'Khách hàng đổi ý, sản phẩm đã qua 7 ngày', refundAmount: 0 }
            ];

            const warrantySchedule = [
                { id: 1, customerName: 'Võ Thành Long', phone: '0967890123', product: 'MacBook Pro M3 14"', issue: 'Máy chạy chậm, quạt kêu to', appointmentDate: '2025-01-10', appointmentTime: '09:00', status: 'scheduled', technician: 'Nguyễn Văn Khoa' },
                { id: 2, customerName: 'Đặng Thị Hương', phone: '0978901234', product: 'iPhone 15 Pro Max', issue: 'Màn hình bị sọc', appointmentDate: '2025-01-12', appointmentTime: '14:00', status: 'completed', technician: 'Trần Văn Kiên' }
            ];

            const showToast = (message, duration = 3000) => {
                const toast = document.getElementById('toast-notification');
                document.getElementById('toast-message').textContent = message;
                toast.classList.add('open');
                setTimeout(() => {
                    toast.classList.remove('open');
                }, duration);
            };

            const hideAllSections = () => {
                document.querySelectorAll('.section').forEach(section => {
                    section.classList.add('hidden');
                });
            };

            const updateSidebarActiveState = (sectionId) => {
                document.querySelectorAll('.sidebar-item').forEach(item => item.classList.remove('active'));
                const activeItem = document.querySelector(`[onclick="showSection('${sectionId}')"]`);
                if (activeItem) {
                    activeItem.classList.add('active');
                }
            };

            window.showSection = (sectionId) => {
                hideAllSections();
                const section = document.getElementById(sectionId);
                if (section) {
                    section.classList.remove('hidden');
                    section.classList.add('animate-fade-in');
                    currentSection = sectionId;
                    updateSidebarActiveState(sectionId);
                    updateView();
                }
            };
            
            const updateView = () => {
                switch (currentSection) {
                    case 'products':
                        renderProducts();
                        break;
                    case 'inventory':
                        renderInventory();
                        break;
                    case 'deliveries':
                        renderDeliveries();
                        break;
                    case 'chat':
                        renderChatList();
                        renderChatWindow(selectedChat);
                        break;
                    case 'returns':
                        renderReturns();
                        break;
                    case 'warranties':
                        renderWarranties();
                        break;
                    case 'stock-alerts':
                        renderStockAlerts();
                        break;
                }
            };

            const renderProducts = () => {
                const tableBody = document.getElementById('product-table-body');
                const productSearch = document.getElementById('product-search-input').value.toLowerCase();
                const productCategoryFilter = document.getElementById('product-category-filter').value;
                
                const filteredProducts = inventory.filter(p => 
                    (p.name.toLowerCase().includes(productSearch) || p.sku.toLowerCase().includes(productSearch)) &&
                    (productCategoryFilter === 'all' || p.category === productCategoryFilter)
                );

                tableBody.innerHTML = filteredProducts.map(p => `
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">${p.name}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">${p.sku}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">${p.category === 'laptop' ? 'Laptop' : 'Điện thoại'}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${p.currentStock}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${p.price.toLocaleString('vi-VN')} VND</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                            <button class="text-blue-600 hover:text-blue-900 mr-3 edit-product-btn" data-id="${p.id}">Sửa</button>
                            <button class="text-red-600 hover:text-red-900 delete-product-btn" data-id="${p.id}">Xóa</button>
                        </td>
                    </tr>
                `).join('');

                bindProductTableEvents();
            };

            const bindProductTableEvents = () => {
                document.querySelectorAll('.edit-product-btn').forEach(button => {
                    button.addEventListener('click', (e) => openProductModal(parseInt(e.currentTarget.dataset.id)));
                });
                document.querySelectorAll('.delete-product-btn').forEach(button => {
                    button.addEventListener('click', (e) => showConfirmModal(
                        'Xác nhận xóa sản phẩm',
                        'Bạn có chắc chắn muốn xóa sản phẩm này khỏi hệ thống không?',
                        () => handleDeleteProduct(parseInt(e.currentTarget.dataset.id))
                    ));
                });
            };
            
            const handleDeleteProduct = (id) => {
                const index = inventory.findIndex(p => p.id === id);
                if (index !== -1) {
                    inventory.splice(index, 1);
                    updateView();
                    showToast('Sản phẩm đã được xóa thành công.');
                }
            };

            const renderInventory = () => {
                const tableBody = document.getElementById('inventory-table-body');
                const inventorySearch = document.getElementById('inventory-search').value.toLowerCase();
                const categoryFilter = document.getElementById('inventory-category-filter').value;
                const statusFilter = document.getElementById('inventory-status-filter').value;

                const filteredInventory = inventory.filter(p => {
                    const matchesSearch = p.name.toLowerCase().includes(inventorySearch) || p.sku.toLowerCase().includes(inventorySearch);
                    const matchesCategory = categoryFilter === 'all' || p.category === categoryFilter;
                    
                    let matchesStatus = false;
                    if (statusFilter === 'all') matchesStatus = true;
                    else if (statusFilter === 'instock' && p.currentStock > p.minStock) matchesStatus = true;
                    else if (statusFilter === 'lowstock' && p.currentStock <= p.minStock && p.currentStock > 0) matchesStatus = true;
                    else if (statusFilter === 'outofstock' && p.currentStock === 0) matchesStatus = true;
                    
                    return matchesSearch && matchesCategory && matchesStatus;
                });

                tableBody.innerHTML = filteredInventory.map(p => {
                    let statusClass = 'bg-green-100 text-green-800';
                    let statusText = 'Còn hàng';
                    if (p.currentStock <= p.minStock && p.currentStock > 0) {
                        statusClass = 'bg-yellow-100 text-yellow-800';
                        statusText = 'Sắp hết';
                    } else if (p.currentStock === 0) {
                        statusClass = 'bg-red-100 text-red-800';
                        statusText = 'Hết hàng';
                    }

                    return `
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">${p.name}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">${p.sku}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">${p.category === 'laptop' ? 'Laptop' : 'Điện thoại'}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${p.currentStock}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${p.minStock}</td>
                            <td class="px-4 py-3 whitespace-nowrap"><span class="px-2 py-1 rounded text-sm font-semibold ${statusClass}">${statusText}</span></td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-product-btn" data-id="${p.id}">Sửa</button>
                                <button class="text-red-600 hover:text-red-900 delete-product-btn" data-id="${p.id}">Xóa</button>
                            </td>
                        </tr>
                    `;
                }).join('');

                bindProductTableEvents();
            };

            const renderDeliveries = () => {
                const tableBody = document.getElementById('deliveries-table-body');
                tableBody.innerHTML = pendingDeliveries.map(d => `
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${d.orderId}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${d.supplier}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${d.product}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${d.quantity}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${d.arrivalDate}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2 py-1 rounded text-xs font-semibold ${d.status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800'}">
                                ${d.status === 'pending' ? 'Đang chờ' : 'Đã nhận'}
                            </span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs confirm-delivery" data-delivery-id="${d.id}">Nhận hàng</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs reject-delivery ml-2" data-delivery-id="${d.id}">Từ chối</button>
                        </td>
                    </tr>
                `).join('');

                document.querySelectorAll('.confirm-delivery').forEach(button => {
                    button.addEventListener('click', (e) => handleConfirmDelivery(parseInt(e.currentTarget.dataset.deliveryId)));
                });
                document.querySelectorAll('.reject-delivery').forEach(button => {
                    button.addEventListener('click', (e) => handleRejectDelivery(parseInt(e.currentTarget.dataset.deliveryId)));
                });
            };

            const renderChatList = () => {
                const chatList = document.getElementById('chat-list');
                chatList.innerHTML = activeChats.map(chat => `
                    <div class="flex items-center p-3 my-2 cursor-pointer rounded-lg hover:bg-gray-200 transition-colors ${selectedChat && selectedChat.id === chat.id ? 'bg-gray-200' : ''}" onclick="selectChat(${chat.id})">
                        <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-gray-700 font-bold text-lg mr-3">
                            ${chat.customerName.charAt(0)}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold truncate-text">${chat.customerName}</h4>
                                <span class="text-xs text-gray-500">${chat.timestamp}</span>
                            </div>
                            <p class="text-sm text-gray-600 truncate-text">${chat.lastMessage}</p>
                        </div>
                        ${chat.unread > 0 ? `<span class="bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center ml-2">${chat.unread}</span>` : ''}
                    </div>
                `).join('');
            };

            const renderChatWindow = (chat) => {
                const chatWindow = document.getElementById('chat-window');
                if (!chat) {
                    chatWindow.innerHTML = `
                        <div id="chat-placeholder" class="text-center text-gray-400 mt-20">
                            <i class="fas fa-comments text-6xl mb-4"></i>
                            <p class="text-lg">Chọn một cuộc trò chuyện để bắt đầu</p>
                        </div>
                    `;
                    return;
                }

                chatWindow.innerHTML = `
                    <div class="flex-shrink-0 border-b pb-4 mb-4">
                        <h3 class="text-xl font-bold">${chat.customerName}</h3>
                        <p class="text-sm text-gray-600">
                            <span class="mr-4"><i class="fas fa-phone mr-1"></i> ${chat.phone}</span>
                            <span><i class="fas fa-envelope mr-1"></i> ${chat.email}</span>
                        </p>
                    </div>
                    <div id="messages-container" class="flex-1 overflow-y-auto space-y-4">
                        ${chat.messages.map(msg => `
                            <div class="flex ${msg.sender === 'support' ? 'justify-end' : 'justify-start'}">
                                <div class="message-bubble px-4 py-2 rounded-lg ${msg.sender === 'support' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800'}">
                                    ${msg.message}
                                    <div class="text-right text-xs mt-1 opacity-70">${msg.time}</div>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                    <div class="flex-shrink-0 mt-4">
                        <div class="flex items-center space-x-2">
                            <input type="text" id="chat-input" placeholder="Nhập tin nhắn..." class="flex-1 border rounded-full px-4 py-2">
                            <button class="bg-blue-600 text-white rounded-full h-10 w-10 flex items-center justify-center hover:bg-blue-700">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                `;
                document.getElementById('messages-container').scrollTop = document.getElementById('messages-container').scrollHeight;
            };

            const renderReturns = () => {
                const tableBody = document.getElementById('returns-table-body');
                tableBody.innerHTML = returnRequests.map(req => {
                    let statusClass = '';
                    if (req.status === 'pending') {
                        statusClass = 'bg-yellow-100 text-yellow-800';
                    } else if (req.status === 'approved') {
                        statusClass = 'bg-green-100 text-green-800';
                    } else if (req.status === 'rejected') {
                        statusClass = 'bg-red-100 text-red-800';
                    }

                    return `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.orderId}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.customerName}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.product}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.reason}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.requestDate}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold ${statusClass}">${req.status === 'pending' ? 'Đang chờ' : req.status === 'approved' ? 'Đã duyệt' : 'Từ chối'}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-2 action-btn" data-request-id="${req.id}" data-action="approved">Duyệt</button>
                                <button class="text-red-600 hover:text-red-900 action-btn" data-request-id="${req.id}" data-action="rejected">Từ chối</button>
                            </td>
                        </tr>
                    `;
                }).join('');

                document.querySelectorAll('.action-btn').forEach(button => {
                    button.addEventListener('click', (e) => {
                        const id = parseInt(e.currentTarget.dataset.requestId);
                        const action = e.currentTarget.dataset.action;
                        const item = returnRequests.find(r => r.id === id);
                        if (item) {
                            item.status = action;
                            showToast(`Yêu cầu đã được ${action === 'approved' ? 'chấp nhận' : 'từ chối'}!`);
                            renderReturns();
                        }
                    });
                });
            };

            const renderWarranties = () => {
                const tableBody = document.getElementById('warranties-table-body');
                tableBody.innerHTML = warrantySchedule.map(req => {
                    const statusClass = req.status === 'scheduled' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800';
                    const statusText = req.status === 'scheduled' ? 'Đã lên lịch' : 'Đã hoàn thành';
                    return `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.customerName}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.product}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.issue}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.appointmentDate} ${req.appointmentTime}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.technician}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold ${statusClass}">${statusText}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900">Chi tiết</button>
                            </td>
                        </tr>
                    `;
                }).join('');
            };
            
            const renderStockAlerts = () => {
                const tableBody = document.getElementById('stock-alerts-table-body');
                const lowStockProducts = inventory.filter(p => p.currentStock <= p.minStock);

                tableBody.innerHTML = lowStockProducts.map(p => {
                    const statusClass = p.currentStock === 0 ? 'bg-red-100 text-red-800' : 'bg-orange-100 text-orange-800';
                    const statusText = p.currentStock === 0 ? 'Hết hàng' : 'Sắp hết';
                    return `
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">${p.name}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">${p.sku}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${p.currentStock}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${p.minStock}</td>
                            <td class="px-4 py-3 whitespace-nowrap"><span class="px-2 py-1 rounded text-sm font-semibold ${statusClass}">${statusText}</span></td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-product-btn" data-id="${p.id}">Nhập thêm</button>
                            </td>
                        </tr>
                    `;
                }).join('');
                bindProductTableEvents();
            };

            const productModal = document.getElementById('product-modal');
            const productForm = document.getElementById('product-form');

            window.openProductModal = (id = null) => {
                editingProductId = id;
                const product = id ? inventory.find(p => p.id === id) : null;
                document.getElementById('modal-title').innerText = id ? 'Chỉnh sửa sản phẩm' : 'Thêm sản phẩm mới';
                if (product) {
                    document.getElementById('product-name').value = product.name;
                    document.getElementById('product-category').value = product.category;
                    document.getElementById('product-sku').value = product.sku;
                    document.getElementById('product-stock').value = product.currentStock;
                    document.getElementById('product-min-stock').value = product.minStock;
                    document.getElementById('product-price').value = product.price;
                } else {
                    productForm.reset();
                }
                productModal.classList.add('open');
            };
            const closeProductModal = () => {
                productModal.classList.remove('open');
                editingProductId = null;
            };
            productForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const newProduct = {
                    name: document.getElementById('product-name').value,
                    category: document.getElementById('product-category').value,
                    sku: document.getElementById('product-sku').value,
                    currentStock: parseInt(document.getElementById('product-stock').value),
                    minStock: parseInt(document.getElementById('product-min-stock').value),
                    price: parseInt(document.getElementById('product-price').value),
                    lastUpdated: new Date().toISOString().split('T')[0]
                };
                if (editingProductId !== null) {
                    const index = inventory.findIndex(p => p.id === editingProductId);
                    if (index !== -1) {
                        inventory[index] = { ...inventory[index], ...newProduct };
                        showToast('Sản phẩm đã được cập nhật thành công!');
                    }
                } else {
                    newProduct.id = inventory.length > 0 ? Math.max(...inventory.map(p => p.id)) + 1 : 1;
                    inventory.push(newProduct);
                    showToast('Sản phẩm mới đã được thêm thành công!');
                }
                closeProductModal();
                updateView();
            });
            document.getElementById('cancel-modal').addEventListener('click', closeProductModal);
            productModal.addEventListener('click', (e) => {
                if (e.target === productModal) {
                    closeProductModal();
                }
            });

            const confirmModal = document.getElementById('confirm-modal');
            let confirmCallback = null;

            const showConfirmModal = (title, message, callback) => {
                document.getElementById('confirm-modal-title').innerText = title;
                document.getElementById('confirm-modal-message').innerText = message;
                confirmModal.classList.add('open');
                confirmCallback = callback;
            };

            const closeConfirmModal = () => {
                confirmModal.classList.remove('open');
            };

            document.getElementById('confirm-action').addEventListener('click', () => {
                if (confirmCallback) {
                    confirmCallback();
                }
                closeConfirmModal();
            });

            document.getElementById('cancel-confirm').addEventListener('click', closeConfirmModal);

            window.selectChat = (chatId) => {
                selectedChat = activeChats.find(chat => chat.id === chatId);
                if (selectedChat) {
                    selectedChat.unread = 0;
                }
                renderChatList();
                renderChatWindow(selectedChat);
            };

            const handleConfirmDelivery = (id) => {
                showConfirmModal(
                    'Xác nhận nhận hàng',
                    'Bạn có chắc chắn muốn xác nhận lô hàng này đã được nhập kho?',
                    () => {
                        const deliveryIndex = pendingDeliveries.findIndex(d => d.id === id);
                        if (deliveryIndex !== -1) {
                            const delivery = pendingDeliveries[deliveryIndex];
                            const product = inventory.find(p => p.name === delivery.product);
                            if (product) {
                                product.currentStock += delivery.quantity;
                                pendingDeliveries.splice(deliveryIndex, 1);
                                showToast(`Đã nhập thành công ${delivery.quantity} sản phẩm ${delivery.product} vào kho.`);
                                updateView();
                            } else {
                                showToast('Lỗi: Sản phẩm không tồn tại trong kho.');
                            }
                        }
                    }
                );
            };

            const handleRejectDelivery = (id) => {
                showConfirmModal(
                    'Từ chối lô hàng',
                    'Bạn có chắc chắn muốn từ chối lô hàng này? Thao tác này không thể hoàn tác.',
                    () => {
                        const deliveryIndex = pendingDeliveries.findIndex(d => d.id === id);
                        if (deliveryIndex !== -1) {
                            pendingDeliveries.splice(deliveryIndex, 1);
                            showToast('Đã từ chối lô hàng thành công.');
                            updateView();
                        }
                    }
                );
            };

            document.getElementById('product-search-input').addEventListener('input', renderProducts);
            document.getElementById('product-category-filter').addEventListener('change', renderProducts);
            document.getElementById('inventory-search').addEventListener('input', renderInventory);
            document.getElementById('inventory-category-filter').addEventListener('change', renderInventory);
            document.getElementById('inventory-status-filter').addEventListener('change', renderInventory);

            showSection('dashboard');
        });
    </script>

<script>
window.currentSection = window.currentSection || 'dashboard';
window.showSection = function(id){
  document.querySelectorAll('.section').forEach(s => s.classList.add('hidden'));
  const t = document.getElementById(id); if (t) t.classList.remove('hidden');
  window.currentSection = id;
};
</script>

</body>
</html>