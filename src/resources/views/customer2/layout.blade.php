<?php
echo '
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroStore - Khách hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            box-sizing: border-box;
        }
        
        .dropdown {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }
        
        .dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .menu-item {
            transition: all 0.2s ease;
        }
        
        .menu-item:hover {
            background-color: #e0f2fe;
            transform: translateX(4px);
        }
        
        .menu-item.active {
            background-color: #e1f5fe;
            border-right: 3px solid #0284c7;
        }
        
        .notification-badge {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header Bar -->
    <header class="fixed top-0 left-0 right-0 bg-white shadow-sm border-b border-gray-200 px-6 py-4 z-20">
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
                    <h2 class="text-xl font-semibold text-blue-600">ElectroStore</h2>
                    <p class="text-sm text-gray-500">Trang chủ</p>
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
                            <p class="font-medium text-gray-800">Nguyễn Văn Nam</p>
                            <p class="text-xs text-gray-500">Khách hàng</p>
                        </div>
                        <!-- Dropdown Arrow -->
                        <svg class="w-4 h-4 text-gray-400 transition-transform" id="dropdownArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    <div class="fixed left-0 top-16 h-full w-64 bg-white shadow-lg z-10 transition-transform duration-300 ease-in-out" style="height: calc(100% - 4rem);">

        
        <!-- Menu Navigation -->
        <nav class="pt-6">
            <div class="menu-item active flex items-center px-6 py-4 text-blue-700 cursor-pointer">
                <span class="mr-4 text-lg">🏠</span>
                <span class="font-medium text-base">Trang chủ</span>
                <div class="ml-auto w-2 h-2 bg-blue-600 rounded-full"></div>
            </div>
            
            <div class="menu-item flex items-center px-6 py-4 text-gray-700 cursor-pointer">
                <span class="mr-4 text-lg">🎯</span>
                <span class="text-base">Khuyến mãi</span>
            </div>
            
            <div class="menu-item flex items-center px-6 py-4 text-gray-700 cursor-pointer">
                <span class="mr-4 text-lg">📦</span>
                <span class="text-base">Sản phẩm</span>
            </div>
            
            <div class="menu-item flex items-center px-6 py-4 text-gray-700 cursor-pointer">
                <span class="mr-4 text-lg">🛒</span>
                <span class="text-base">Giỏ hàng</span>
            </div>
            
            <div class="menu-item flex items-center px-6 py-4 text-gray-700 cursor-pointer">
                <span class="mr-4 text-lg">📋</span>
                <span class="text-base">Đơn hàng</span>
            </div>
            
            <div class="menu-item flex items-center px-6 py-4 text-gray-700 cursor-pointer">
                <span class="mr-4 text-lg">⭐</span>
                <span class="text-base">Đánh giá sản phẩm</span>
            </div>
            
            <div class="menu-item flex items-center px-6 py-4 text-gray-700 cursor-pointer">
                <span class="mr-4 text-lg">💬</span>
                <span class="text-base">Hỗ trợ khách hàng</span>
            </div>
        </nav>
    </div>
    
    <!-- Main Content Area -->
    <div class="ml-64 min-h-full transition-all duration-300 ease-in-out pt-16">
        
        <!-- Main Content -->
        <main class="p-6">
            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                <div class="text-6xl mb-4">🛍️</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Chào mừng đến với ElectroStore!</h3>
                <p class="text-gray-600 mb-6">Khám phá những sản phẩm điện tử tuyệt vời nhất với giá cả hợp lý</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <div class="text-3xl mb-3">📱</div>
                        <h4 class="font-semibold text-gray-800 mb-2">Điện thoại</h4>
                        <p class="text-sm text-gray-600">Smartphone mới nhất</p>
                    </div>
                    <div class="bg-green-50 p-6 rounded-lg">
                        <div class="text-3xl mb-3">💻</div>
                        <h4 class="font-semibold text-gray-800 mb-2">Laptop</h4>
                        <p class="text-sm text-gray-600">Máy tính xách tay</p>
                    </div>
                    <div class="bg-purple-50 p-6 rounded-lg">
                        <div class="text-3xl mb-3">🎧</div>
                        <h4 class="font-semibold text-gray-800 mb-2">Phụ kiện</h4>
                        <p class="text-sm text-gray-600">Tai nghe, sạc, ốp lưng</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById(\'userDropdown\');
            const arrow = document.getElementById(\'dropdownArrow\');
            
            dropdown.classList.toggle(\'show\');
            arrow.style.transform = dropdown.classList.contains(\'show\') ? \'rotate(180deg)\' : \'rotate(0deg)\';
        }
        
        function toggleNotifications() {
            const dropdown = document.getElementById(\'notificationsDropdown\');
            dropdown.classList.toggle(\'show\');
        }
        
        function toggleSidebar() {
            const sidebar = document.querySelector(\'.fixed.left-0.top-16\');
            const mainContent = document.querySelector(\'.ml-64\');
            
            if (sidebar.style.transform === \'translateX(-100%)\') {
                sidebar.style.transform = \'translateX(0)\';
                mainContent.style.marginLeft = \'16rem\';
            } else {
                sidebar.style.transform = \'translateX(-100%)\';
                mainContent.style.marginLeft = \'0\';
            }
        }
        
        // Close dropdown when clicking outside
        document.addEventListener(\'click\', function(event) {
            const userDropdown = document.getElementById(\'userDropdown\');
            const notificationsDropdown = document.getElementById(\'notificationsDropdown\');
            const userAccount = event.target.closest(\'.relative\');
            
            // Close user dropdown
            if (!userAccount || !userAccount.contains(event.target)) {
                userDropdown.classList.remove(\'show\');
                document.getElementById(\'dropdownArrow\').style.transform = \'rotate(0deg)\';
            }
            
            // Close notifications dropdown
            const notificationBell = event.target.closest(\'.relative.cursor-pointer\');
            if (!notificationBell || !notificationBell.contains(event.target)) {
                notificationsDropdown.classList.remove(\'show\');
            }
        });
        
        // Menu item click handlers
        document.querySelectorAll(\'.menu-item\').forEach(item => {
            item.addEventListener(\'click\', function() {
                // Remove active class from all items
                document.querySelectorAll(\'.menu-item\').forEach(i => i.classList.remove(\'active\'));
                // Add active class to clicked item
                this.classList.add(\'active\');
                
                // Update header subtitle based on selected menu
                const menuText = this.querySelector(\'span:last-child\').textContent;
                document.querySelector(\'header p\').textContent = menuText;
                
                // Auto hide sidebar when menu item is clicked
                const sidebar = document.querySelector(\'.fixed.left-0.top-16\');
                const mainContent = document.querySelector(\'.ml-64\');
                
                sidebar.style.transform = \'translateX(-100%)\';
                mainContent.style.marginLeft = \'0\';
            });
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement(\'script\');d.innerHTML="window.__CF$cv$params={r:\'98f4561c8249f995\',t:\'MTc2MDU4Mzk0NS4wMDAwMDA=\'};var a=document.createElement(\'script\');a.nonce=\'\';a.src=\'/cdn-cgi/challenge-platform/scripts/jsd/main.js\';document.getElementsByTagName(\'head\')[0].appendChild(a);";b.getElementsByTagName(\'head\')[0].appendChild(d)}}if(document.body){var a=document.createElement(\'iframe\');a.height=1;a.width=1;a.style.position=\'absolute\';a.style.top=0;a.style.left=0;a.style.border=\'none\';a.style.visibility=\'hidden\';document.body.appendChild(a);if(\'loading\'!==document.readyState)c();else if(window.addEventListener)document.addEventListener(\'DOMContentLoaded\',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);\'loading\'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>

';
?>