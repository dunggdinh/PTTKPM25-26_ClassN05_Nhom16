<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroStore - Amin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
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
                            <p class="font-medium text-gray-800">Nguyễn Văn Thăng</p>
                            <p class="text-xs text-gray-500">Admin</p>
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
            <!-- Dashboard -->
            <div class="menu-item active flex items-center px-6 py-4 text-blue-700 cursor-pointer">
                <span class="mr-4 text-lg">📊</span>
                <span class="font-medium text-base">Dashboard</span>
                <div class="ml-auto w-2 h-2 bg-blue-600 rounded-full"></div>
            </div>

            <!-- Quản lý người dùng -->
            <div class="menu-item flex items-center px-6 py-4 text-gray-700 cursor-pointer">
                <span class="mr-4 text-lg">👥</span>
                <span class="text-base">Quản lý người dùng</span>
            </div>

            <!-- Quản lý kho -->
            <div class="menu-item flex items-center px-6 py-4 text-gray-700 cursor-pointer">
                <span class="mr-4 text-lg">🏬</span>
                <span class="text-base">Quản lý kho</span>
            </div>

            <!-- Quản lý đơn hàng -->
            <div class="menu-item flex items-center px-6 py-4 text-gray-700 cursor-pointer">
                <span class="mr-4 text-lg">📦</span>
                <span class="text-base">Quản lý đơn hàng</span>
            </div>

            <!-- Đổi/Trả hàng -->
            <div class="menu-item flex items-center px-6 py-4 text-gray-700 cursor-pointer">
                <span class="mr-4 text-lg">🔁</span>
                <span class="text-base">Đổi/Trả hàng</span>
            </div>

            <!-- Quản lý thanh toán -->
            <div class="menu-item flex items-center px-6 py-4 text-gray-700 cursor-pointer">
                <span class="mr-4 text-lg">💳</span>
                <span class="text-base">Quản lý thanh toán</span>
            </div>

            <!-- Tin nhắn khách hàng -->
            <div class="menu-item flex items-center px-6 py-4 text-gray-700 cursor-pointer">
                <span class="mr-4 text-lg">💬</span>
                <span class="text-base">Hỗ trợ khách hàng</span>
                <div class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">
                    5
                </div>
            </div>

            <!-- Báo cáo & thống kê -->
            <div class="menu-item flex items-center px-6 py-4 text-gray-700 cursor-pointer">
                <span class="mr-4 text-lg">📈</span>
                <span class="text-base">Báo cáo & thống kê</span>
            </div>
        </nav>
    </div>
    
    <!-- Main Content Area -->
        
    <main id="mainContent" class="ml-64 w-[calc(100%-16rem)] min-h-screen p-8 pt-24 transition-all bg-gray-50">

        <div class="text-center py-20 text-gray-500">Đang tải ...</div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const currentPath = window.location.pathname;
            const menuMap = {
                '/admin/dashboard': 'Dashboard',
                '/admin/customer': 'Quản lý người dùng',
                '/admin/inventory': 'Quản lý kho',
                '/admin/order': 'Quản lý đơn hàng',
                '/admin/return': 'Đổi/Trả hàng',
                '/admin/payments_gateway': 'Quản lý thanh toán', // ✅ sửa lại
                '/admin/chat': 'Hỗ trợ khách hàng',
                '/admin/report': 'Báo cáo & thống kê',
            };


            const menuName = menuMap[currentPath] || 'Trang chủ';
            updateMainContent(menuName, false);
        });

        async function updateMainContent(menuName, pushState = true) {
            const main = document.getElementById('mainContent');
            const routes = {
                'Dashboard': '/admin/dashboard',
                'Quản lý người dùng': '/admin/customer',
                'Quản lý kho': '/admin/inventory',
                'Quản lý đơn hàng': '/admin/order',
                'Đổi/Trả hàng': '/admin/return',
                'Quản lý thanh toán': '/admin/payments_gateway', // ✅ sửa ở đây
                'Hỗ trợ khách hàng': '/admin/chat',
                'Báo cáo & thống kê': '/admin/report'
            };


            const url = routes[menuName];
            if (!url) {
                main.innerHTML = '<div class="p-6 text-gray-500">Không tìm thấy nội dung.</div>';
                return;
            }

            main.innerHTML = '<div class="text-center py-20 text-gray-500 animate-pulse">Đang tải...</div>';

            try {
                const response = await fetch(url);
                const html = await response.text();
                main.innerHTML = html;
                if (pushState) history.pushState({ menuName }, '', url);
            } catch {
                main.innerHTML = '<div class="p-6 text-red-500">Lỗi tải nội dung.</div>';
            }
        }

        // Xử lý khi click menu
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function () {
                document.querySelectorAll('.menu-item').forEach(i => {
                    i.classList.remove('text-blue-600', 'active');
                    i.classList.add('text-gray-700');
                });
                this.classList.add('text-blue-600', 'active');
                const menuText = this.querySelector('span:last-child').textContent.trim();
                updateMainContent(menuText, true);
            });
        });

        window.addEventListener('popstate', event => {
            const menuName = event.state?.menuName || 'Trang chủ';
            updateMainContent(menuName, false);
        });
    </script>


</body>
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
