<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce - Khách hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            box-sizing: border-box;
        }
        .gradient-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar-transition {
            transition: all 0.3s ease;
        }
        .nav-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateX(5px);
        }
        .nav-item:hover i {
            color: white;
        }
        .nav-item {
            transition: all 0.3s ease;
        }
        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .product-image {
            background: linear-gradient(45deg, #f0f0f0, #e0e0e0);
        }
        .star-rating {
            color: #fbbf24;
        }
        .modal {
            backdrop-filter: blur(5px);
        }
        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        .notification {
            animation: slideIn 0.3s ease;
        }
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .loading {
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
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
        .logo-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .countdown {
            color: #667eea;
            font-weight: 600;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="gradient-header text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <i class="fas fa-store text-purple-600 text-lg"></i>
                    </div>
                    <h1 class="text-xl font-bold text-white">ShopVN</h1>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32'%3E%3Ccircle cx='16' cy='16' r='16' fill='%23f0f0f0'/%3E%3Ctext x='16' y='20' text-anchor='middle' font-size='14' fill='%23666'%3E👤%3C/text%3E%3C/svg%3E" alt="Avatar" class="w-8 h-8 rounded-full">
                        <span class="text-sm">Xin chào, <span id="userName">Khách hàng</span></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg sidebar-transition">
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <button onclick="showSection('home')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-home text-gray-500"></i>
                            <span>Trang chủ</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('products')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-box text-gray-500"></i>
                            <span>Sản phẩm</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('cart')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-shopping-cart text-gray-500"></i>
                            <span>Giỏ hàng</span>
                            <span id="cartCount" class="bg-red-500 text-white text-xs rounded-full px-2 py-1 ml-auto">3</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('orders')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-clipboard-list text-gray-500"></i>
                            <span>Đơn hàng của tôi</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('account')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-user text-gray-500"></i>
                            <span>Tài khoản</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('support')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-headset text-gray-500"></i>
                            <span>Hỗ trợ</span>
                        </button>
                    </li>
                    <li class="pt-4 border-t">
                        <button onclick="showAuthModal('login')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-sign-in-alt text-gray-500"></i>
                            <span>Đăng nhập</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showAuthModal('register')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-user-plus text-gray-500"></i>
                            <span>Đăng ký</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="logout()" class="nav-item w-full flex items-center space-x-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                            <i class="fas fa-sign-out-alt text-red-500"></i>
                            <span>Đăng xuất</span>
                        </button>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Trang chủ -->
            <div id="home" class="section animate-fade-in">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Trang chủ</h2>
                    
                    <!-- Banner -->
                    <div class="bg-gradient-to-r from-purple-400 to-pink-400 rounded-xl p-8 text-white mb-8 card-hover">
                        <h3 class="text-2xl font-bold mb-2">Khuyến mãi đặc biệt!</h3>
                        <p class="text-lg mb-4">Giảm giá lên đến 50% cho tất cả sản phẩm</p>
                        <button onclick="showSection('promotions')" class="bg-white text-purple-600 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            Xem ngay
                        </button>
                    </div>

                    <!-- Sản phẩm nổi bật -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                            <div class="product-image w-full h-32 rounded-lg mb-4 flex items-center justify-center">
                                <i class="fas fa-laptop text-4xl text-gray-400"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800 mb-2">Laptop Gaming</h4>
                            <p class="text-purple-600 font-bold text-lg">25.990.000₫</p>
                            <button onclick="addToCart('laptop-gaming')" class="w-full mt-3 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors">
                                Thêm vào giỏ
                            </button>
                        </div>
                        
                        <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                            <div class="product-image w-full h-32 rounded-lg mb-4 flex items-center justify-center">
                                <i class="fas fa-mobile-alt text-4xl text-gray-400"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800 mb-2">Smartphone Pro</h4>
                            <p class="text-purple-600 font-bold text-lg">15.990.000₫</p>
                            <button onclick="addToCart('smartphone-pro')" class="w-full mt-3 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors">
                                Thêm vào giỏ
                            </button>
                        </div>
                        
                        <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                            <div class="product-image w-full h-32 rounded-lg mb-4 flex items-center justify-center">
                                <i class="fas fa-headphones text-4xl text-gray-400"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800 mb-2">Tai nghe Bluetooth</h4>
                            <p class="text-purple-600 font-bold text-lg">2.990.000₫</p>
                            <button onclick="addToCart('headphones')" class="w-full mt-3 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors">
                                Thêm vào giỏ
                            </button>
                        </div>
                        
                        <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                            <div class="product-image w-full h-32 rounded-lg mb-4 flex items-center justify-center">
                                <i class="fas fa-tablet-alt text-4xl text-gray-400"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800 mb-2">Tablet Pro</h4>
                            <p class="text-purple-600 font-bold text-lg">12.990.000₫</p>
                            <button onclick="addToCart('tablet-pro')" class="w-full mt-3 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors">
                                Thêm vào giỏ
                            </button>
                        </div>
                    </div>

                    <!-- Khuyến mãi -->
                    <div class="bg-gradient-to-r from-green-400 to-blue-400 rounded-xl p-6 text-white">
                        <h3 class="text-xl font-bold mb-4">🎉 Khuyến mãi hôm nay</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-white/20 rounded-lg p-4">
                                <h4 class="font-semibold mb-2">Miễn phí vận chuyển</h4>
                                <p class="text-sm">Cho đơn hàng từ 500.000₫</p>
                            </div>
                            <div class="bg-white/20 rounded-lg p-4">
                                <h4 class="font-semibold mb-2">Giảm 20%</h4>
                                <p class="text-sm">Cho khách hàng mới</p>
                            </div>
                            <div class="bg-white/20 rounded-lg p-4">
                                <h4 class="font-semibold mb-2">Tích điểm x2</h4>
                                <p class="text-sm">Cuối tuần này</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sản phẩm -->
            <div id="products" class="section hidden">
                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Sản phẩm</h2>
                    
                    <!-- Thanh tìm kiếm -->
                    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <input type="text" id="searchInput" placeholder="Tìm kiếm sản phẩm..." class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input">
                            </div>
                            <button onclick="searchProducts()" class="btn-primary text-white px-6 py-3 rounded-lg">
                                <i class="fas fa-search mr-2"></i>Tìm kiếm
                            </button>
                        </div>
                    </div>

                    <!-- Bộ lọc -->
                    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Bộ lọc</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Danh mục</label>
                                <select id="categoryFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                                    <option value="">Tất cả</option>
                                    <option value="laptop">Laptop</option>
                                    <option value="phone">Điện thoại</option>
                                    <option value="tablet">Tablet</option>
                                    <option value="accessories">Phụ kiện</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Thương hiệu</label>
                                <select id="brandFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                                    <option value="">Tất cả</option>
                                    <option value="apple">Apple</option>
                                    <option value="samsung">Samsung</option>
                                    <option value="dell">Dell</option>
                                    <option value="hp">HP</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Giá từ</label>
                                <input type="number" id="minPrice" placeholder="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Giá đến</label>
                                <input type="number" id="maxPrice" placeholder="100000000" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                        </div>
                        <button onclick="applyFilters()" class="mt-4 btn-primary text-white px-6 py-2 rounded-lg">
                            Áp dụng bộ lọc
                        </button>
                    </div>

                    <!-- Danh sách sản phẩm -->
                    <div id="productList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <!-- Sản phẩm sẽ được load động -->
                    </div>
                </div>
            </div>

            <!-- Giỏ hàng -->
            <div id="cart" class="section hidden">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Giỏ hàng</h2>
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div id="cartItems" class="space-y-4 mb-6">
                        <!-- Items sẽ được load động -->
                    </div>
                    
                    <div class="border-t pt-4">
                        <div class="flex justify-between items-center text-xl font-bold text-gray-800 mb-4">
                            <span>Tổng cộng:</span>
                            <span id="cartTotal">0₫</span>
                        </div>
                        <button onclick="proceedToCheckout()" class="w-full btn-primary text-white py-3 rounded-lg text-lg font-semibold">
                            Tiến hành thanh toán
                        </button>
                    </div>
                </div>
            </div>

            <!-- Đơn hàng -->
            <div id="orders" class="section hidden">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Đơn hàng của tôi</h2>
                
                <div class="space-y-4">
                    <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-semibold text-lg">#DH001</h3>
                                <p class="text-gray-600">Ngày đặt: 15/12/2024</p>
                            </div>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                Đã giao
                            </span>
                        </div>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span>Laptop Gaming x1</span>
                                <span>25.990.000₫</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Phí vận chuyển</span>
                                <span>0₫</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center border-t pt-4">
                            <span class="font-bold text-lg">Tổng: 25.990.000₫</span>
                            <div class="space-x-2">
                                <button onclick="viewOrderDetail('DH001')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                    Chi tiết
                                </button>
                                <button onclick="trackOrder('DH001')" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                                    Theo dõi
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-semibold text-lg">#DH002</h3>
                                <p class="text-gray-600">Ngày đặt: 18/12/2024</p>
                            </div>
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                Đang giao
                            </span>
                        </div>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span>Smartphone Pro x1</span>
                                <span>15.990.000₫</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Tai nghe Bluetooth x1</span>
                                <span>2.990.000₫</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center border-t pt-4">
                            <span class="font-bold text-lg">Tổng: 18.980.000₫</span>
                            <div class="space-x-2">
                                <button onclick="viewOrderDetail('DH002')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                    Chi tiết
                                </button>
                                <button onclick="trackOrder('DH002')" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                                    Theo dõi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tài khoản -->
            <div id="account" class="section hidden">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Tài khoản của tôi</h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Thông tin cá nhân -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Thông tin cá nhân</h3>
                        <form onsubmit="updateProfile(event)" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Họ và tên</label>
                                <input type="text" id="fullName" value="Nguyễn Văn A" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" value="nguyenvana@email.com" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại</label>
                                <input type="tel" id="phone" value="0123456789" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Địa chỉ</label>
                                <textarea id="address" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">123 Đường ABC, Quận 1, TP.HCM</textarea>
                            </div>
                            <div class="flex space-x-3">
                                <button type="submit" class="btn-primary text-white px-6 py-2 rounded-lg flex-1">
                                    <i class="fas fa-check mr-2"></i>Xác nhận cập nhật
                                </button>
                                <button type="button" onclick="cancelProfileUpdate()" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                    <i class="fas fa-times mr-2"></i>Hủy
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Đổi mật khẩu -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Đổi mật khẩu</h3>
                        <form onsubmit="changePassword(event)" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu hiện tại</label>
                                <input type="password" id="currentPassword" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu mới</label>
                                <input type="password" id="newPassword" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Xác nhận mật khẩu mới</label>
                                <input type="password" id="confirmPassword" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                            <div class="flex space-x-3">
                                <button type="submit" class="btn-primary text-white px-6 py-2 rounded-lg flex-1">
                                    <i class="fas fa-key mr-2"></i>Xác nhận đổi mật khẩu
                                </button>
                                <button type="button" onclick="cancelPasswordChange()" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                    <i class="fas fa-times mr-2"></i>Hủy
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hỗ trợ -->
            <div id="support" class="section hidden">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Hỗ trợ khách hàng</h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Live Chat -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">💬 Live Chat</h3>
                        <div id="chatMessages" class="h-64 bg-gray-50 rounded-lg p-4 mb-4 overflow-y-auto">
                            <div class="mb-3">
                                <div class="bg-blue-100 text-blue-800 p-3 rounded-lg inline-block">
                                    Xin chào! Tôi có thể giúp gì cho bạn?
                                </div>
                                <div class="text-xs text-gray-500 mt-1">Hỗ trợ viên - 10:30</div>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <input type="text" id="chatInput" placeholder="Nhập tin nhắn..." class="flex-1 px-3 py-2 border border-gray-300 rounded-lg form-input">
                            <button onclick="sendMessage()" class="btn-primary text-white px-4 py-2 rounded-lg">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Gửi yêu cầu hỗ trợ -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">📧 Gửi yêu cầu hỗ trợ</h3>
                        <form onsubmit="submitSupportRequest(event)" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Loại vấn đề</label>
                                <select id="issueType" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                                    <option value="">Chọn loại vấn đề</option>
                                    <option value="order">Vấn đề đơn hàng</option>
                                    <option value="payment">Vấn đề thanh toán</option>
                                    <option value="product">Vấn đề sản phẩm</option>
                                    <option value="account">Vấn đề tài khoản</option>
                                    <option value="other">Khác</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tiêu đề</label>
                                <input type="text" id="issueTitle" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Mô tả chi tiết</label>
                                <textarea id="issueDescription" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input"></textarea>
                            </div>
                            <div class="flex space-x-3">
                                <button type="submit" class="btn-primary text-white px-6 py-2 rounded-lg flex-1">
                                    <i class="fas fa-paper-plane mr-2"></i>Xác nhận gửi yêu cầu
                                </button>
                                <button type="button" onclick="clearSupportForm()" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                    <i class="fas fa-eraser mr-2"></i>Xóa form
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- FAQ -->
                <div class="mt-6 bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">❓ Câu hỏi thường gặp</h3>
                    <div class="space-y-4">
                        <div class="border-b pb-4">
                            <button onclick="toggleFAQ(1)" class="flex justify-between items-center w-full text-left">
                                <span class="font-medium">Làm thế nào để theo dõi đơn hàng?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div id="faq1" class="hidden mt-2 text-gray-600">
                                Bạn có thể theo dõi đơn hàng trong mục "Đơn hàng của tôi" hoặc sử dụng mã đơn hàng để tra cứu.
                            </div>
                        </div>
                        <div class="border-b pb-4">
                            <button onclick="toggleFAQ(2)" class="flex justify-between items-center w-full text-left">
                                <span class="font-medium">Chính sách đổi trả như thế nào?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div id="faq2" class="hidden mt-2 text-gray-600">
                                Chúng tôi hỗ trợ đổi trả trong vòng 7 ngày với điều kiện sản phẩm còn nguyên vẹn.
                            </div>
                        </div>
                        <div class="border-b pb-4">
                            <button onclick="toggleFAQ(3)" class="flex justify-between items-center w-full text-left">
                                <span class="font-medium">Các phương thức thanh toán được hỗ trợ?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div id="faq3" class="hidden mt-2 text-gray-600">
                                Chúng tôi hỗ trợ thanh toán qua thẻ tín dụng, chuyển khoản ngân hàng và COD.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Khuyến mãi -->
            <div id="promotions" class="section hidden">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">🎉 Khuyến mãi</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-r from-red-400 to-pink-400 rounded-xl p-6 text-white card-hover">
                        <h3 class="text-xl font-bold mb-2">Flash Sale</h3>
                        <p class="mb-4">Giảm giá 50% cho 100 sản phẩm đầu tiên</p>
                        <div class="text-2xl font-bold mb-2 countdown">23:45:12</div>
                        <button class="bg-white text-red-500 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            Mua ngay
                        </button>
                    </div>

                    <div class="bg-gradient-to-r from-green-400 to-blue-400 rounded-xl p-6 text-white card-hover">
                        <h3 class="text-xl font-bold mb-2">Miễn phí vận chuyển</h3>
                        <p class="mb-4">Cho đơn hàng từ 500.000₫</p>
                        <div class="text-sm mb-2">Áp dụng toàn quốc</div>
                        <button class="bg-white text-green-500 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            Áp dụng ngay
                        </button>
                    </div>

                    <div class="bg-gradient-to-r from-purple-400 to-indigo-400 rounded-xl p-6 text-white card-hover">
                        <h3 class="text-xl font-bold mb-2">Tích điểm x2</h3>
                        <p class="mb-4">Cuối tuần này (Thứ 7 - Chủ nhật)</p>
                        <div class="text-sm mb-2">Tất cả sản phẩm</div>
                        <button class="bg-white text-purple-500 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            Tham gia
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal đăng nhập/đăng ký -->
    <div id="authModal" class="fixed inset-0 bg-black bg-opacity-50 modal-overlay hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-8 w-full max-w-md mx-4 modal-content">
            <div class="flex justify-between items-center mb-6">
                <h3 id="authTitle" class="text-2xl font-bold text-gray-800">Đăng nhập</h3>
                <button onclick="closeAuthModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Form đăng nhập -->
            <form id="loginForm" onsubmit="handleLogin(event)" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="loginEmail" required class="w-full px-3 py-2 border border-gray-300 rounded-lg input-field">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu</label>
                    <input type="password" id="loginPassword" required class="w-full px-3 py-2 border border-gray-300 rounded-lg input-field">
                </div>
                <div class="flex space-x-3">
                    <button type="submit" class="btn-primary text-white py-3 rounded-lg font-semibold flex-1">
                        <i class="fas fa-sign-in-alt mr-2"></i>Xác nhận đăng nhập
                    </button>
                    <button type="button" onclick="clearLoginForm()" class="bg-gray-500 hover:bg-gray-600 text-white py-3 px-4 rounded-lg">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="text-center space-y-2">
                    <button type="button" onclick="showForgotPassword()" class="text-purple-600 hover:text-purple-700 text-sm">
                        Quên mật khẩu?
                    </button>
                    <div class="text-sm text-gray-600">
                        Chưa có tài khoản? 
                        <button type="button" onclick="showAuthModal('register')" class="text-purple-600 hover:text-purple-700 font-medium">
                            Đăng ký ngay
                        </button>
                    </div>
                </div>
            </form>

            <!-- Form đăng ký -->
            <form id="registerForm" onsubmit="handleRegister(event)" class="space-y-4 hidden">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Họ và tên</label>
                    <input type="text" id="registerName" required class="w-full px-3 py-2 border border-gray-300 rounded-lg input-field">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="registerEmail" required class="w-full px-3 py-2 border border-gray-300 rounded-lg input-field">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại</label>
                    <input type="tel" id="registerPhone" required class="w-full px-3 py-2 border border-gray-300 rounded-lg input-field">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu</label>
                    <input type="password" id="registerPassword" required class="w-full px-3 py-2 border border-gray-300 rounded-lg input-field">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Xác nhận mật khẩu</label>
                    <input type="password" id="registerConfirmPassword" required class="w-full px-3 py-2 border border-gray-300 rounded-lg input-field">
                </div>
                <div class="flex space-x-3">
                    <button type="submit" class="btn-primary text-white py-3 rounded-lg font-semibold flex-1">
                        <i class="fas fa-user-plus mr-2"></i>Xác nhận đăng ký
                    </button>
                    <button type="button" onclick="clearRegisterForm()" class="bg-gray-500 hover:bg-gray-600 text-white py-3 px-4 rounded-lg">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="text-center text-sm text-gray-600">
                    Đã có tài khoản? 
                    <button type="button" onclick="showAuthModal('login')" class="text-purple-600 hover:text-purple-700 font-medium">
                        Đăng nhập ngay
                    </button>
                </div>
            </form>

            <!-- Form quên mật khẩu -->
            <form id="forgotForm" onsubmit="handleForgotPassword(event)" class="space-y-4 hidden">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="forgotEmail" required class="w-full px-3 py-2 border border-gray-300 rounded-lg input-field">
                </div>
                <div class="flex space-x-3">
                    <button type="submit" class="btn-primary text-white py-3 rounded-lg font-semibold flex-1">
                        <i class="fas fa-paper-plane mr-2"></i>Xác nhận gửi link
                    </button>
                    <button type="button" onclick="clearForgotForm()" class="bg-gray-500 hover:bg-gray-600 text-white py-3 px-4 rounded-lg">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="text-center text-sm text-gray-600">
                    <button type="button" onclick="showAuthModal('login')" class="text-purple-600 hover:text-purple-700 font-medium">
                        Quay lại đăng nhập
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal chi tiết sản phẩm -->
    <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 modal-overlay hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-8 w-full max-w-4xl mx-4 max-h-[90vh] overflow-y-auto modal-content">
            <div class="flex justify-between items-center mb-6">
                <h3 id="productTitle" class="text-2xl font-bold text-gray-800"></h3>
                <button onclick="closeProductModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div>
                    <div id="productImage" class="w-full h-64 bg-gray-200 rounded-lg mb-4 flex items-center justify-center">
                        <i class="fas fa-image text-4xl text-gray-400"></i>
                    </div>
                    <div class="grid grid-cols-4 gap-2">
                        <div class="w-full h-16 bg-gray-200 rounded flex items-center justify-center">
                            <i class="fas fa-image text-gray-400"></i>
                        </div>
                        <div class="w-full h-16 bg-gray-200 rounded flex items-center justify-center">
                            <i class="fas fa-image text-gray-400"></i>
                        </div>
                        <div class="w-full h-16 bg-gray-200 rounded flex items-center justify-center">
                            <i class="fas fa-image text-gray-400"></i>
                        </div>
                        <div class="w-full h-16 bg-gray-200 rounded flex items-center justify-center">
                            <i class="fas fa-image text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div id="productPrice" class="text-3xl font-bold text-purple-600 mb-4"></div>
                    <div id="productDescription" class="text-gray-600 mb-6"></div>
                    
                    <div class="mb-6">
                        <h4 class="font-semibold mb-2">Đánh giá:</h4>
                        <div class="flex items-center space-x-2">
                            <div class="star-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-gray-600">(4.5/5 - 128 đánh giá)</span>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Số lượng:</label>
                        <div class="flex items-center space-x-3">
                            <button onclick="decreaseQuantity()" class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center hover:bg-gray-300">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" id="productQuantity" value="1" min="1" class="w-20 text-center border border-gray-300 rounded-lg py-2">
                            <button onclick="increaseQuantity()" class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center hover:bg-gray-300">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <button onclick="addToCartFromModal()" class="w-full btn-primary text-white py-3 rounded-lg font-semibold">
                            <i class="fas fa-cart-plus mr-2"></i>Thêm vào giỏ hàng
                        </button>
                        <button onclick="buyNow()" class="w-full bg-orange-600 hover:bg-orange-700 text-white py-3 rounded-lg font-semibold transition-colors">
                            <i class="fas fa-bolt mr-2"></i>Mua ngay
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Đánh giá sản phẩm -->
            <div class="mt-8 border-t pt-8">
                <h4 class="text-xl font-semibold mb-4">Đánh giá sản phẩm</h4>
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-2">
                                <span class="font-medium">Nguyễn Văn B</span>
                                <div class="star-rating text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <span class="text-sm text-gray-500">2 ngày trước</span>
                        </div>
                        <p class="text-gray-600">Sản phẩm rất tốt, chất lượng như mô tả. Giao hàng nhanh!</p>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-2">
                                <span class="font-medium">Trần Thị C</span>
                                <div class="star-rating text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <span class="text-sm text-gray-500">1 tuần trước</span>
                        </div>
                        <p class="text-gray-600">Sản phẩm ổn, đóng gói cẩn thận. Sẽ mua lại!</p>
                    </div>
                </div>
                
                <button onclick="showReviewForm()" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                    Viết đánh giá
                </button>
            </div>
        </div>
    </div>

    <!-- Modal thanh toán -->
    <div id="checkoutModal" class="fixed inset-0 bg-black bg-opacity-50 modal-overlay hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-8 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto modal-content">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Thanh toán</h3>
                <button onclick="closeCheckoutModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form onsubmit="processCheckout(event)" class="space-y-6">
                <div>
                    <h4 class="font-semibold text-lg mb-4">Thông tin giao hàng</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Họ và tên</label>
                            <input type="text" required class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại</label>
                            <input type="tel" required class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Địa chỉ giao hàng</label>
                        <textarea required rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input"></textarea>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-semibold text-lg mb-4">Phương thức thanh toán</h4>
                    <div class="space-y-3">
                        <label class="flex items-center space-x-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="paymentMethod" value="cod" checked class="text-purple-600">
                            <i class="fas fa-money-bill-wave text-green-600"></i>
                            <span>Thanh toán khi nhận hàng (COD)</span>
                        </label>
                        <label class="flex items-center space-x-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="paymentMethod" value="bank" class="text-purple-600">
                            <i class="fas fa-university text-blue-600"></i>
                            <span>Chuyển khoản ngân hàng</span>
                        </label>
                        <label class="flex items-center space-x-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="paymentMethod" value="card" class="text-purple-600">
                            <i class="fas fa-credit-card text-purple-600"></i>
                            <span>Thẻ tín dụng/ghi nợ</span>
                        </label>
                    </div>
                </div>
                
                <div class="border-t pt-4">
                    <div class="flex justify-between items-center text-xl font-bold text-gray-800 mb-4">
                        <span>Tổng thanh toán:</span>
                        <span id="checkoutTotal">0₫</span>
                    </div>
                    <button type="submit" class="w-full btn-primary text-white py-3 rounded-lg text-lg font-semibold">
                        Đặt hàng
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notification -->
    <div id="notification" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg notification hidden z-50">
        <div class="flex items-center space-x-2">
            <i class="fas fa-check-circle"></i>
            <span id="notificationText"></span>
        </div>
    </div>

    <script>
        // Dữ liệu mẫu
        let products = [
            {
                id: 'laptop-gaming',
                name: 'Laptop Gaming Pro',
                price: 25990000,
                category: 'laptop',
                brand: 'dell',
                description: 'Laptop gaming cao cấp với card đồ họa mạnh mẽ, phù hợp cho game thủ và designer.',
                image: 'fas fa-laptop',
                rating: 4.5,
                reviews: 128
            },
            {
                id: 'smartphone-pro',
                name: 'Smartphone Pro Max',
                price: 15990000,
                category: 'phone',
                brand: 'apple',
                description: 'Điện thoại thông minh cao cấp với camera chuyên nghiệp và hiệu năng vượt trội.',
                image: 'fas fa-mobile-alt',
                rating: 4.7,
                reviews: 256
            },
            {
                id: 'headphones',
                name: 'Tai nghe Bluetooth Premium',
                price: 2990000,
                category: 'accessories',
                brand: 'samsung',
                description: 'Tai nghe không dây chất lượng cao với công nghệ chống ồn.',
                image: 'fas fa-headphones',
                rating: 4.3,
                reviews: 89
            },
            {
                id: 'tablet-pro',
                name: 'Tablet Pro 12.9"',
                price: 12990000,
                category: 'tablet',
                brand: 'apple',
                description: 'Máy tính bảng cao cấp với màn hình lớn, phù hợp cho công việc và giải trí.',
                image: 'fas fa-tablet-alt',
                rating: 4.6,
                reviews: 167
            },
            {
                id: 'laptop-ultrabook',
                name: 'Ultrabook Business',
                price: 18990000,
                category: 'laptop',
                brand: 'hp',
                description: 'Laptop mỏng nhẹ cho doanh nhân, pin trâu và hiệu năng ổn định.',
                image: 'fas fa-laptop',
                rating: 4.4,
                reviews: 95
            },
            {
                id: 'smartphone-mid',
                name: 'Smartphone Galaxy A54',
                price: 8990000,
                category: 'phone',
                brand: 'samsung',
                description: 'Điện thoại tầm trung với camera chất lượng và pin lâu.',
                image: 'fas fa-mobile-alt',
                rating: 4.2,
                reviews: 342
            },
            {
                id: 'smartwatch',
                name: 'Đồng hồ thông minh Apple Watch',
                price: 7990000,
                category: 'accessories',
                brand: 'apple',
                description: 'Đồng hồ thông minh theo dõi sức khỏe và thể thao.',
                image: 'fas fa-clock',
                rating: 4.6,
                reviews: 189
            },
            {
                id: 'keyboard-gaming',
                name: 'Bàn phím cơ Gaming RGB',
                price: 1590000,
                category: 'accessories',
                brand: 'dell',
                description: 'Bàn phím cơ với đèn LED RGB, phù hợp cho game thủ.',
                image: 'fas fa-keyboard',
                rating: 4.1,
                reviews: 76
            },
            {
                id: 'mouse-wireless',
                name: 'Chuột không dây Logitech',
                price: 890000,
                category: 'accessories',
                brand: 'hp',
                description: 'Chuột không dây ergonomic, pin lâu và độ chính xác cao.',
                image: 'fas fa-mouse',
                rating: 4.3,
                reviews: 124
            },
            {
                id: 'monitor-4k',
                name: 'Màn hình 4K 27 inch',
                price: 6990000,
                category: 'accessories',
                brand: 'dell',
                description: 'Màn hình 4K IPS với màu sắc chính xác cho designer.',
                image: 'fas fa-desktop',
                rating: 4.5,
                reviews: 67
            },
            {
                id: 'speaker-bluetooth',
                name: 'Loa Bluetooth JBL',
                price: 1290000,
                category: 'accessories',
                brand: 'samsung',
                description: 'Loa bluetooth chống nước với âm thanh mạnh mẽ.',
                image: 'fas fa-volume-up',
                rating: 4.4,
                reviews: 203
            },
            {
                id: 'tablet-budget',
                name: 'Tablet Samsung Galaxy Tab A8',
                price: 4990000,
                category: 'tablet',
                brand: 'samsung',
                description: 'Tablet giá rẻ phù hợp cho học tập và giải trí cơ bản.',
                image: 'fas fa-tablet-alt',
                rating: 4.0,
                reviews: 156
            },
            {
                id: 'laptop-student',
                name: 'Laptop Sinh viên HP Pavilion',
                price: 12990000,
                category: 'laptop',
                brand: 'hp',
                description: 'Laptop phù hợp cho sinh viên với giá cả hợp lý.',
                image: 'fas fa-laptop',
                rating: 4.2,
                reviews: 234
            },
            {
                id: 'phone-budget',
                name: 'Điện thoại Xiaomi Redmi',
                price: 3990000,
                category: 'phone',
                brand: 'samsung',
                description: 'Điện thoại giá rẻ với cấu hình ổn định.',
                image: 'fas fa-mobile-alt',
                rating: 3.9,
                reviews: 445
            },
            {
                id: 'webcam-hd',
                name: 'Webcam HD 1080p',
                price: 790000,
                category: 'accessories',
                brand: 'hp',
                description: 'Webcam chất lượng cao cho họp online và livestream.',
                image: 'fas fa-video',
                rating: 4.1,
                reviews: 89
            },
            {
                id: 'powerbank',
                name: 'Pin sạc dự phòng 20000mAh',
                price: 590000,
                category: 'accessories',
                brand: 'samsung',
                description: 'Pin sạc dự phòng dung lượng lớn, sạc nhanh.',
                image: 'fas fa-battery-full',
                rating: 4.3,
                reviews: 312
            }
        ];

        let cart = [
            { id: 'laptop-gaming', name: 'Laptop Gaming Pro', price: 25990000, quantity: 1 },
            { id: 'smartphone-pro', name: 'Smartphone Pro Max', price: 15990000, quantity: 1 },
            { id: 'headphones', name: 'Tai nghe Bluetooth Premium', price: 2990000, quantity: 1 }
        ];

        let currentUser = null;

        // Navigation
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.section').forEach(section => {
                section.classList.add('hidden');
            });
            
            // Show selected section
            document.getElementById(sectionId).classList.remove('hidden');
            
            // Update active nav item
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.classList.remove('active');
            });
            event.target.closest('.sidebar-item').classList.add('active');

            // Load section-specific data
            if (sectionId === 'products') {
                loadProducts();
            } else if (sectionId === 'cart') {
                loadCart();
            }
        }

        // Authentication
        function showAuthModal(type) {
            const modal = document.getElementById('authModal');
            const title = document.getElementById('authTitle');
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const forgotForm = document.getElementById('forgotForm');

            // Hide all forms
            loginForm.classList.add('hidden');
            registerForm.classList.add('hidden');
            forgotForm.classList.add('hidden');

            if (type === 'login') {
                title.textContent = 'Đăng nhập';
                loginForm.classList.remove('hidden');
            } else if (type === 'register') {
                title.textContent = 'Đăng ký';
                registerForm.classList.remove('hidden');
            }

            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.add('open'), 10);
        }

        function closeAuthModal() {
            const modal = document.getElementById('authModal');
            modal.classList.remove('open');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        function showForgotPassword() {
            const title = document.getElementById('authTitle');
            const loginForm = document.getElementById('loginForm');
            const forgotForm = document.getElementById('forgotForm');

            title.textContent = 'Quên mật khẩu';
            loginForm.classList.add('hidden');
            forgotForm.classList.remove('hidden');
        }

        function handleLogin(event) {
            event.preventDefault();
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;

            // Simulate login
            currentUser = { name: 'Nguyễn Văn A', email: email };
            document.getElementById('userName').textContent = currentUser.name;
            
            showNotification('Đăng nhập thành công!');
            closeAuthModal();
        }

        function handleRegister(event) {
            event.preventDefault();
            const name = document.getElementById('registerName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = document.getElementById('registerConfirmPassword').value;

            if (password !== confirmPassword) {
                showNotification('Mật khẩu xác nhận không khớp!', 'error');
                return;
            }

            // Simulate registration
            currentUser = { name: name, email: email };
            document.getElementById('userName').textContent = currentUser.name;
            
            showNotification('Đăng ký thành công!');
            closeAuthModal();
        }

        function handleForgotPassword(event) {
            event.preventDefault();
            showNotification('Link đặt lại mật khẩu đã được gửi đến email của bạn!');
            closeAuthModal();
        }

        function logout() {
            currentUser = null;
            document.getElementById('userName').textContent = 'Khách hàng';
            showNotification('Đã đăng xuất!');
        }

        function clearLoginForm() {
            document.getElementById('loginEmail').value = '';
            document.getElementById('loginPassword').value = '';
            showNotification('Đã xóa thông tin đăng nhập!');
        }

        function clearRegisterForm() {
            document.getElementById('registerName').value = '';
            document.getElementById('registerEmail').value = '';
            document.getElementById('registerPhone').value = '';
            document.getElementById('registerPassword').value = '';
            document.getElementById('registerConfirmPassword').value = '';
            showNotification('Đã xóa thông tin đăng ký!');
        }

        function clearForgotForm() {
            document.getElementById('forgotEmail').value = '';
            showNotification('Đã xóa email!');
        }

        // Products
        function loadProducts() {
            const productList = document.getElementById('productList');
            productList.innerHTML = '';

            products.forEach(product => {
                const productCard = document.createElement('div');
                productCard.className = 'bg-white rounded-xl shadow-md p-6 card-hover';
                productCard.innerHTML = `
                    <div class="product-image w-full h-32 rounded-lg mb-4 flex items-center justify-center">
                        <i class="${product.image} text-4xl text-gray-400"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">${product.name}</h4>
                    <div class="flex items-center mb-2">
                        <div class="star-rating text-sm mr-2">
                            ${generateStars(product.rating)}
                        </div>
                        <span class="text-gray-500 text-sm">(${product.reviews})</span>
                    </div>
                    <p class="text-purple-600 font-bold text-lg mb-3">${formatPrice(product.price)}</p>
                    <div class="space-y-2">
                        <button onclick="viewProduct('${product.id}')" class="w-full bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 transition-colors">
                            Xem chi tiết
                        </button>
                        <button onclick="addToCart('${product.id}')" class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors">
                            Thêm vào giỏ
                        </button>
                    </div>
                `;
                productList.appendChild(productCard);
            });
        }

        function searchProducts() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const filteredProducts = products.filter(product => 
                product.name.toLowerCase().includes(searchTerm) ||
                product.description.toLowerCase().includes(searchTerm)
            );
            displayFilteredProducts(filteredProducts);
        }

        function applyFilters() {
            const category = document.getElementById('categoryFilter').value;
            const brand = document.getElementById('brandFilter').value;
            const minPrice = parseInt(document.getElementById('minPrice').value) || 0;
            const maxPrice = parseInt(document.getElementById('maxPrice').value) || Infinity;

            const filteredProducts = products.filter(product => {
                return (!category || product.category === category) &&
                       (!brand || product.brand === brand) &&
                       (product.price >= minPrice && product.price <= maxPrice);
            });

            displayFilteredProducts(filteredProducts);
        }

        function displayFilteredProducts(filteredProducts) {
            const productList = document.getElementById('productList');
            productList.innerHTML = '';

            if (filteredProducts.length === 0) {
                productList.innerHTML = '<div class="col-span-full text-center text-gray-500 py-8">Không tìm thấy sản phẩm nào</div>';
                return;
            }

            filteredProducts.forEach(product => {
                const productCard = document.createElement('div');
                productCard.className = 'bg-white rounded-xl shadow-md p-6 card-hover';
                productCard.innerHTML = `
                    <div class="product-image w-full h-32 rounded-lg mb-4 flex items-center justify-center">
                        <i class="${product.image} text-4xl text-gray-400"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">${product.name}</h4>
                    <div class="flex items-center mb-2">
                        <div class="star-rating text-sm mr-2">
                            ${generateStars(product.rating)}
                        </div>
                        <span class="text-gray-500 text-sm">(${product.reviews})</span>
                    </div>
                    <p class="text-purple-600 font-bold text-lg mb-3">${formatPrice(product.price)}</p>
                    <div class="space-y-2">
                        <button onclick="viewProduct('${product.id}')" class="w-full bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 transition-colors">
                            Xem chi tiết
                        </button>
                        <button onclick="addToCart('${product.id}')" class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors">
                            Thêm vào giỏ
                        </button>
                    </div>
                `;
                productList.appendChild(productCard);
            });
        }

        function viewProduct(productId) {
            const product = products.find(p => p.id === productId);
            if (!product) return;

            document.getElementById('productTitle').textContent = product.name;
            document.getElementById('productPrice').textContent = formatPrice(product.price);
            document.getElementById('productDescription').textContent = product.description;
            document.getElementById('productImage').innerHTML = `<i class="${product.image} text-6xl text-gray-400"></i>`;
            document.getElementById('productQuantity').value = 1;

            const modal = document.getElementById('productModal');
            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.add('open'), 10);
        }

        function closeProductModal() {
            const modal = document.getElementById('productModal');
            modal.classList.remove('open');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        function increaseQuantity() {
            const input = document.getElementById('productQuantity');
            input.value = parseInt(input.value) + 1;
        }

        function decreaseQuantity() {
            const input = document.getElementById('productQuantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        function addToCartFromModal() {
            const title = document.getElementById('productTitle').textContent;
            const quantity = parseInt(document.getElementById('productQuantity').value);
            
            // Find product by title (simplified)
            const product = products.find(p => p.name === title);
            if (product) {
                addToCart(product.id, quantity);
                closeProductModal();
            }
        }

        function buyNow() {
            addToCartFromModal();
            showSection('cart');
        }

        // Cart
        function addToCart(productId, quantity = 1) {
            const product = products.find(p => p.id === productId);
            if (!product) return;

            const existingItem = cart.find(item => item.id === productId);
            if (existingItem) {
                existingItem.quantity += quantity;
            } else {
                cart.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    quantity: quantity
                });
            }

            updateCartCount();
            showNotification(`Đã thêm ${product.name} vào giỏ hàng!`);
        }

        function loadCart() {
            const cartItems = document.getElementById('cartItems');
            const cartTotal = document.getElementById('cartTotal');

            if (cart.length === 0) {
                cartItems.innerHTML = '<div class="text-center text-gray-500 py-8">Giỏ hàng trống</div>';
                cartTotal.textContent = '0₫';
                return;
            }

            cartItems.innerHTML = '';
            let total = 0;

            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;

                const cartItem = document.createElement('div');
                cartItem.className = 'flex items-center justify-between p-4 border rounded-lg';
                cartItem.innerHTML = `
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                            <i class="fas fa-box text-gray-400"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">${item.name}</h4>
                            <p class="text-gray-600">${formatPrice(item.price)}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button onclick="updateCartQuantity('${item.id}', ${item.quantity - 1})" class="w-8 h-8 bg-gray-200 rounded flex items-center justify-center hover:bg-gray-300">
                            <i class="fas fa-minus text-sm"></i>
                        </button>
                        <span class="w-8 text-center">${item.quantity}</span>
                        <button onclick="updateCartQuantity('${item.id}', ${item.quantity + 1})" class="w-8 h-8 bg-gray-200 rounded flex items-center justify-center hover:bg-gray-300">
                            <i class="fas fa-plus text-sm"></i>
                        </button>
                        <button onclick="removeFromCart('${item.id}')" class="ml-4 text-red-600 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                cartItems.appendChild(cartItem);
            });

            cartTotal.textContent = formatPrice(total);
        }

        function updateCartQuantity(productId, newQuantity) {
            if (newQuantity <= 0) {
                removeFromCart(productId);
                return;
            }

            const item = cart.find(item => item.id === productId);
            if (item) {
                item.quantity = newQuantity;
                loadCart();
                updateCartCount();
            }
        }

        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            loadCart();
            updateCartCount();
            showNotification('Đã xóa sản phẩm khỏi giỏ hàng!');
        }

        function updateCartCount() {
            const count = cart.reduce((total, item) => total + item.quantity, 0);
            document.getElementById('cartCount').textContent = count;
        }

        function proceedToCheckout() {
            if (cart.length === 0) {
                showNotification('Giỏ hàng trống!', 'error');
                return;
            }

            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            document.getElementById('checkoutTotal').textContent = formatPrice(total);
            const modal = document.getElementById('checkoutModal');
            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.add('open'), 10);
        }

        function closeCheckoutModal() {
            const modal = document.getElementById('checkoutModal');
            modal.classList.remove('open');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        function processCheckout(event) {
            event.preventDefault();
            
            // Simulate order processing
            const orderId = 'DH' + Date.now().toString().slice(-6);
            
            showNotification(`Đặt hàng thành công! Mã đơn hàng: ${orderId}`);
            
            // Clear cart
            cart = [];
            updateCartCount();
            loadCart();
            
            closeCheckoutModal();
            showSection('orders');
        }

        // Orders
        function viewOrderDetail(orderId) {
            showNotification(`Xem chi tiết đơn hàng ${orderId}`);
        }

        function trackOrder(orderId) {
            showNotification(`Theo dõi đơn hàng ${orderId}: Đang giao hàng`);
        }

        // Account
        function updateProfile(event) {
            event.preventDefault();
            showNotification('Cập nhật thông tin thành công!');
        }

        function changePassword(event) {
            event.preventDefault();
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (newPassword !== confirmPassword) {
                showNotification('Mật khẩu xác nhận không khớp!', 'error');
                return;
            }

            showNotification('Đổi mật khẩu thành công!');
            
            // Clear form
            document.getElementById('currentPassword').value = '';
            document.getElementById('newPassword').value = '';
            document.getElementById('confirmPassword').value = '';
        }

        function cancelProfileUpdate() {
            // Reset form to original values
            document.getElementById('fullName').value = 'Nguyễn Văn A';
            document.getElementById('email').value = 'nguyenvana@email.com';
            document.getElementById('phone').value = '0123456789';
            document.getElementById('address').value = '123 Đường ABC, Quận 1, TP.HCM';
            showNotification('Đã hủy thay đổi thông tin!');
        }

        function cancelPasswordChange() {
            // Clear password form
            document.getElementById('currentPassword').value = '';
            document.getElementById('newPassword').value = '';
            document.getElementById('confirmPassword').value = '';
            showNotification('Đã hủy đổi mật khẩu!');
        }

        function clearSupportForm() {
            // Clear support form
            document.getElementById('issueType').value = '';
            document.getElementById('issueTitle').value = '';
            document.getElementById('issueDescription').value = '';
            showNotification('Đã xóa nội dung form!');
        }

        // Support
        function sendMessage() {
            const input = document.getElementById('chatInput');
            const message = input.value.trim();
            
            if (!message) return;

            const chatMessages = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'mb-3 text-right';
            messageDiv.innerHTML = `
                <div class="bg-purple-100 text-purple-800 p-3 rounded-lg inline-block">
                    ${message}
                </div>
                <div class="text-xs text-gray-500 mt-1">Bạn - ${new Date().toLocaleTimeString('vi-VN', {hour: '2-digit', minute: '2-digit'})}</div>
            `;
            chatMessages.appendChild(messageDiv);

            input.value = '';
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Simulate response
            setTimeout(() => {
                const responseDiv = document.createElement('div');
                responseDiv.className = 'mb-3';
                responseDiv.innerHTML = `
                    <div class="bg-blue-100 text-blue-800 p-3 rounded-lg inline-block">
                        Cảm ơn bạn đã liên hệ! Chúng tôi sẽ hỗ trợ bạn ngay.
                    </div>
                    <div class="text-xs text-gray-500 mt-1">Hỗ trợ viên - ${new Date().toLocaleTimeString('vi-VN', {hour: '2-digit', minute: '2-digit'})}</div>
                `;
                chatMessages.appendChild(responseDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 1000);
        }

        function submitSupportRequest(event) {
            event.preventDefault();
            showNotification('Yêu cầu hỗ trợ đã được gửi! Chúng tôi sẽ phản hồi trong 24h.');
            
            // Clear form
            document.getElementById('issueType').value = '';
            document.getElementById('issueTitle').value = '';
            document.getElementById('issueDescription').value = '';
        }

        function toggleFAQ(id) {
            const faq = document.getElementById(`faq${id}`);
            faq.classList.toggle('hidden');
        }

        function showReviewForm() {
            showNotification('Tính năng viết đánh giá đang được phát triển!');
        }

        // Utilities
        function formatPrice(price) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(price);
        }

        function generateStars(rating) {
            const fullStars = Math.floor(rating);
            const hasHalfStar = rating % 1 !== 0;
            let stars = '';

            for (let i = 0; i < fullStars; i++) {
                stars += '<i class="fas fa-star"></i>';
            }

            if (hasHalfStar) {
                stars += '<i class="fas fa-star-half-alt"></i>';
            }

            const emptyStars = 5 - Math.ceil(rating);
            for (let i = 0; i < emptyStars; i++) {
                stars += '<i class="far fa-star"></i>';
            }

            return stars;
        }

        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notificationText');
            
            notificationText.textContent = message;
            
            if (type === 'error') {
                notification.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg notification z-50';
            } else {
                notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg notification z-50';
            }
            
            notification.classList.remove('hidden');
            
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 3000);
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            showSection('home');
            updateCartCount();
            
            // Add enter key support for chat
            document.getElementById('chatInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'98937a68721f0452',t:'MTc1OTU2ODMxNC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
