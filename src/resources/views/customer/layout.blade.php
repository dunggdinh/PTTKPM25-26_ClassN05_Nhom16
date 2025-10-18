<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cửa Hàng Điện Tử')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header Bar -->
    <header class="fixed top-0 left-0 right-0 shadow-sm border-b border-gray-200 px-6 py-4 z-20 gradient-header">

        <div class="flex items-center justify-between">
            <!-- Left side - Menu toggle and App title -->
            <div class="flex items-center space-x-4">
                <!-- Menu Toggle Button -->
                <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors" onclick="toggleSidebar()">
                    <div class="space-y-1">
                        <div class="w-5 h-0.5 bg-gray-600"></div>
                        <div class="w-5 h-0.5 bg-gray-600"></div>
                        <div class="w-5 h-0.5 bg-gray-600"></div>
                    </div>
                </button>
                
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">ElectroStore</h2>
                    <p class="text-base font-medium text-gray-700" id="pageSubtitle">Trang chủ</p>
                </div>
            </div>
            
            <!-- Right side - Notifications and User -->
            <div class="flex items-center space-x-4">
                <!-- Notification Bell -->
                <div class="relative cursor-pointer">
                    <div class="p-2 hover:bg-gray-100 rounded-full transition-colors" onclick="toggleNotifications()">
                        <span class="text-xl">🔔</span>
                    </div>
                    <div class="notification-badge absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">
                        3
                    </div>
                    
                    <!-- Notifications Dropdown -->
                    <div class="dropdown absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 py-2" id="notificationsDropdown">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <h3 class="font-semibold text-gray-800">Thông báo</h3>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            <!-- New notifications -->
                            <div class="px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-50">
                                <div class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                                    <div class="flex-1">
                                        <p class="font-bold text-gray-800 text-sm">Đơn hàng #DH001 đã được xác nhận</p>
                                        <p class="text-xs text-gray-500 mt-1">Đơn hàng iPhone 15 Pro của bạn đã được xác nhận và đang chuẩn bị</p>
                                        <p class="text-xs text-blue-600 mt-1">5 phút trước</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-50">
                                <div class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mt-2 flex-shrink-0"></div>
                                    <div class="flex-1">
                                        <p class="font-bold text-gray-800 text-sm">Khuyến mãi đặc biệt 50% OFF</p>
                                        <p class="text-xs text-gray-500 mt-1">Giảm giá lên đến 50% cho tất cả laptop gaming</p>
                                        <p class="text-xs text-blue-600 mt-1">15 phút trước</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-50">
                                <div class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-red-500 rounded-full mt-2 flex-shrink-0"></div>
                                    <div class="flex-1">
                                        <p class="font-bold text-gray-800 text-sm">Sản phẩm trong giỏ hàng sắp hết</p>
                                        <p class="text-xs text-gray-500 mt-1">AirPods Pro chỉ còn 2 sản phẩm cuối cùng</p>
                                        <p class="text-xs text-blue-600 mt-1">30 phút trước</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Old notifications -->
                            <div class="px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-50">
                                <div class="flex items-start space-x-3">
                                    <div class="w-2 h-2 flex-shrink-0 mt-2"></div>
                                    <div class="flex-1">
                                        <p class="text-gray-600 text-sm">Đánh giá sản phẩm Samsung Galaxy S24</p>
                                        <p class="text-xs text-gray-400 mt-1">Cảm ơn bạn đã mua hàng, hãy để lại đánh giá nhé</p>
                                        <p class="text-xs text-gray-400 mt-1">2 giờ trước</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-50">
                                <div class="flex items-start space-x-3">
                                    <div class="w-2 h-2 flex-shrink-0 mt-2"></div>
                                    <div class="flex-1">
                                        <p class="text-gray-600 text-sm">Chương trình tích điểm thành viên</p>
                                        <p class="text-xs text-gray-400 mt-1">Bạn đã tích được 150 điểm từ đơn hàng gần đây</p>
                                        <p class="text-xs text-gray-400 mt-1">1 ngày trước</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="px-4 py-3 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start space-x-3">
                                    <div class="w-2 h-2 flex-shrink-0 mt-2"></div>
                                    <div class="flex-1">
                                        <p class="text-gray-600 text-sm">Chào mừng bạn đến với ElectroStore</p>
                                        <p class="text-xs text-gray-400 mt-1">Cảm ơn bạn đã đăng ký tài khoản thành công</p>
                                        <p class="text-xs text-gray-400 mt-1">3 ngày trước</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                    </div>
                </div>
                
                <!-- User Account Dropdown -->
                <div class="relative">
                    <div class="flex items-center space-x-3 cursor-pointer p-2 hover:bg-gray-50 rounded-lg transition-colors" onclick="toggleDropdown()">
                        <!-- Avatar -->
                        <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg">
                            N
                        </div>
                        <!-- User Name -->
                        <div class="text-right">
                            <p class="text-xl font-bold text-gray-900">Nguyễn Văn Nam</p>
                            <p class="text-sm font-semibold text-gray-600">Khách hàng</p>
                        </div>
                        <!-- Dropdown Arrow -->
                        <svg class="w-4 h-4 text-gray-600 transition-transform" id="dropdownArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    
                    <!-- Dropdown Menu -->
                    <div class="dropdown absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2" id="userDropdown">
                        <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 transition-colors">
                            <span class="mr-3">👤</span>
                            <span>Hồ sơ của tôi</span>
                        </a>
                        <hr class="my-1 border-gray-100">
                        <a href="#" class="flex items-center px-4 py-2 text-red-600 hover:bg-red-50 transition-colors">
                            <span class="mr-3">🚪</span>
                            <span>Đăng xuất</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <div class="sidebar transition-transform duration-300 ease-in-out">

        
        <!-- Menu Navigation -->
        <nav class="pt-6">
            <a href="/customer/home" class="menu-item flex items-center px-6 py-4 text-gray-700 hover:bg-gray-100">
                <span class="mr-4 text-lg">🏠</span>
                <span class="text-base">Trang chủ</span>
            </a>
            <div class="menu-divider"></div>
            <a href="/customer/promotion" class="menu-item flex items-center px-6 py-4 text-gray-700 hover:bg-gray-100">
                <span class="mr-4 text-lg">🎯</span>
                <span class="text-base">Khuyến mãi</span>
            </a>
            <div class="menu-divider"></div>
            <a href="/customer/product" class="menu-item flex items-center px-6 py-4 text-gray-700 hover:bg-gray-100">
                <span class="mr-4 text-lg">📦</span>
                <span class="text-base">Sản phẩm</span>
            </a>
            <div class="menu-divider"></div>
            <a href="/customer/cart" class="menu-item flex items-center px-6 py-4 text-gray-700 hover:bg-gray-100">
                <span class="mr-4 text-lg">🛒</span>
                <span class="text-base">Giỏ hàng</span>
            </a>
            <div class="menu-divider"></div>
            <a href="/customer/order" class="menu-item flex items-center px-6 py-4 text-gray-700 hover:bg-gray-100">
                <span class="mr-4 text-lg">📋</span>
                <span class="text-base">Đơn hàng</span>
            </a>
            <div class="menu-divider"></div>
            <a href="/customer/review" class="menu-item flex items-center px-6 py-4 text-gray-700 hover:bg-gray-100">
                <span class="mr-4 text-lg">⭐</span>
                <span class="text-base">Đánh giá sản phẩm</span>
            </a>
            <div class="menu-divider"></div>
            <a href="/customer/support" class="menu-item flex items-center px-6 py-4 text-gray-700 hover:bg-gray-100">
                <span class="mr-4 text-lg">💬</span>
                <span class="text-base">Hỗ trợ khách hàng</span>
            </a>
            <div class="menu-divider"></div>
            <a href="/customer/profile" class="menu-item flex items-center px-6 py-4 text-gray-700 hover:bg-gray-100">
                <span class="mr-4 text-lg">👤</span>
                <span class="text-base">Hồ sơ của tôi</span>
            </a>
            <div class="menu-divider"></div>
        </nav>
    </div>
    
        <!-- Main Content Area -->
    <main id="mainContent" class="ml-64 w-[calc(100%-16rem)] min-h-screen p-8 pt-24 transition-all bg-gray-50">
        @yield('content')
    </main>    
    <script>
        const routes = {
            'Trang chủ': '/customer/home',
            'Khuyến mãi': '/customer/promotion',
            'Sản phẩm': '/customer/product',
            'Giỏ hàng': '/customer/cart',
            'Đơn hàng': '/customer/order',
            'Đánh giá sản phẩm': '/customer/review',
            'Hỗ trợ khách hàng': '/customer/support',
            'Hồ sơ của tôi': '/customer/profile'
        };

        // Add ripple effect to menu items
        function createRipple(event) {
            const button = event.currentTarget;
            const ripple = button.querySelector('.ripple');
            
            // Remove existing animation
            ripple.classList.remove('animate-ripple');
            
            // Get click coordinates
            const rect = button.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const y = event.clientY - rect.top;
            
            // Set ripple position and start animation
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('animate-ripple');
        }

        // Set active menu based on current URL
        function setActiveMenu() {
            const currentPath = window.location.pathname;
            const pageSubtitle = document.getElementById('pageSubtitle');
            
            // Remove active state from all menu items first
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('font-bold', 'bg-gray-100');
            });
            
            // Find and activate current menu item
            document.querySelectorAll('.menu-item').forEach(item => {
                const menuText = item.querySelector('span:last-child').textContent.trim();
                const url = routes[menuText];
                
                if (currentPath.includes(url)) {
                    // Add active styling with softer background
                    item.classList.add('font-bold', 'bg-gray-100');
                    
                    // Update subtitle text
                    pageSubtitle.textContent = menuText;
                }
            });
        }

        // Call setActiveMenu on page load
        document.addEventListener('DOMContentLoaded', setActiveMenu);

        // Click menu
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', () => {
                const menuText = item.querySelector('span:last-child').textContent.trim();
                const url = routes[menuText];
                if (url) {
                    window.location.href = url;
                }
            });
        });

        // Toggle UI
        function toggleDropdown() {
            document.getElementById('userDropdown').classList.toggle('hidden');
            document.getElementById('dropdownArrow').classList.toggle('rotate-180');
        }
        function toggleNotifications() {
            document.getElementById('notificationsDropdown').classList.toggle('hidden');
        }
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const main = document.querySelector('#mainContent');
            const hidden = sidebar.style.transform === 'translateX(-100%)';
            sidebar.style.transform = hidden ? 'translateX(0)' : 'translateX(-100%)';
            main.style.marginLeft = hidden ? '16rem' : '0';
        }
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement(\'script\');d.innerHTML="window.__CF$cv$params={r:\'98f4561c8249f995\',t:\'MTc2MDU4Mzk0NS4wMDAwMDA=\'};var a=document.createElement(\'script\');a.nonce=\'\';a.src=\'/cdn-cgi/challenge-platform/scripts/jsd/main.js\';document.getElementsByTagName(\'head\')[0].appendChild(a);";b.getElementsByTagName(\'head\')[0].appendChild(d)}}if(document.body){var a=document.createElement(\'iframe\');a.height=1;a.width=1;a.style.position=\'absolute\';a.style.top=0;a.style.left=0;a.style.border=\'none\';a.style.visibility=\'hidden\';document.body.appendChild(a);if(\'loading\'!==document.readyState)c();else if(window.addEventListener)document.addEventListener(\'DOMContentLoaded\',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);\'loading\'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
