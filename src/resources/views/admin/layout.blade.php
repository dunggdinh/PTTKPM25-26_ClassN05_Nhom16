<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroStore Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>

<body class="bg-gray-50 font-sans h-full flex">

    <!-- SIDEBAR -->
    <div class="fixed left-0 top-16 h-[calc(100%-4rem)] w-64 bg-white shadow-lg z-10 pt-6 overflow-y-auto">


        <nav class="mt-6">
            <div class="menu-item active flex items-center px-6 py-3 text-blue-600 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" viewBox="0 0 16 16">
                    <rect x="1" y="1" width="6" height="6" stroke="currentColor" fill="none"/>
                    <rect x="9" y="1" width="6" height="6" stroke="currentColor" fill="none"/>
                    <rect x="1" y="9" width="6" height="6" stroke="currentColor" fill="none"/>
                    <rect x="9" y="9" width="6" height="6" stroke="currentColor" fill="none"/>
                </svg>
                <span class="font-medium">Dashboard</span>
            </div>

            <div class="menu-item flex items-center px-6 py-3 text-gray-700 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" viewBox="0 0 16 16">
                    <circle cx="8" cy="4" r="2" stroke="currentColor" fill="none"/>
                    <path d="M4 14v-2c0-2 2-4 4-4s4 2 4 4v2" stroke="currentColor" fill="none"/>
                </svg>
                <span class="font-medium">Quản lý người dùng</span>
            </div>

            <div class="menu-item flex items-center px-6 py-3 text-gray-700 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" viewBox="0 0 16 16">
                    <rect x="2" y="6" width="12" height="8" stroke="currentColor" fill="none"/>
                    <polygon points="2,6 8,2 14,6" stroke="currentColor" fill="none"/>
                </svg>
                <span class="font-medium">Quản lý kho</span>
            </div>

            <div class="menu-item flex items-center px-6 py-3 text-gray-700 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" viewBox="0 0 16 16">
                    <rect x="2" y="4" width="12" height="10" stroke="currentColor" fill="none"/>
                    <line x1="2" y1="7" x2="14" y2="7" stroke="currentColor"/>
                    <line x1="5" y1="4" x2="5" y2="14" stroke="currentColor"/>
                </svg>
                <span class="font-medium">Quản lý đơn hàng</span>
            </div>

            <div class="menu-item flex items-center px-6 py-3 text-gray-700 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" viewBox="0 0 16 16">
                    <path d="M8 2l-1 1-3 3h2v6h4V6h2l-3-3-1-1z" stroke="currentColor" fill="none"/>
                </svg>
                <span class="font-medium">Đổi/Trả hàng</span>
            </div>

            <div class="menu-item flex items-center px-6 py-3 text-gray-700 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" viewBox="0 0 16 16">
                    <rect x="2" y="4" width="12" height="8" rx="2" stroke="currentColor" fill="none"/>
                </svg>
                <span class="font-medium">Quản lý thanh toán</span>
            </div>

            <div class="menu-item flex items-center px-6 py-3 text-gray-700 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" viewBox="0 0 16 16">
                    <rect x="1" y="8" width="14" height="6" stroke="currentColor" fill="none"/>
                </svg>
                <span class="font-medium">Quản lý nhà cung cấp</span>
            </div>

            <div class="menu-item flex items-center px-6 py-3 text-gray-700 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" viewBox="0 0 16 16">
                    <rect x="1" y="3" width="14" height="10" rx="2" stroke="currentColor" fill="none"/>
                </svg>
                <span class="font-medium">Tin nhắn khách hàng</span>
                <div class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">
                    5
                </div>
            </div>

            <div class="menu-item flex items-center px-6 py-3 text-gray-700 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" viewBox="0 0 16 16">
                    <rect x="2" y="2" width="12" height="12" stroke="currentColor" fill="none"/>
                </svg>
                <span class="font-medium">Báo cáo & thống kê</span>
            </div>
        </nav>
    </div>
    <div class="ml-64 h-full transition-all duration-300 ease-in-out">
            <!-- Header Bar -->
            <header class="fixed top-0 left-0 right-0 z-20 bg-white shadow-sm border-b border-gray-200 px-6 py-4">

                <div class="flex items-center justify-between">
                    <!-- Left side - Menu Toggle & Title -->
                    <div class="flex items-center space-x-4">
                        <!-- Menu Toggle Button with Store Name -->
                        <div class="flex items-center space-x-3">
                            <button id="menuToggle" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="space-y-1">
                                    <div class="w-5 h-0.5 bg-gray-600"></div>
                                    <div class="w-5 h-0.5 bg-gray-600"></div>
                                    <div class="w-5 h-0.5 bg-gray-600"></div>
                                </div>
                            </button>
                            <h1 class="text-xl font-bold text-blue-600">ElectroStore</h1>
                        </div>
                        

                    </div>
                    
                    <!-- Right side - Notifications & User -->
                    <div class="flex items-center space-x-4">
                        <!-- Notification Bell -->
                        <div id="notificationBtn" class="relative cursor-pointer p-2 rounded-lg hover:bg-gray-100 transition-all duration-200">
                            <svg class="w-6 h-6 text-gray-600 hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <div class="notification-badge absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold shadow-lg">
                                3
                            </div>
                        </div>
                        
                        <!-- User Info -->
                        <div class="flex items-center space-x-3">
                            <!-- Avatar -->
                            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                A
                            </div>
                            
                            <!-- User Name -->
                            <span class="text-gray-700 font-medium">Admin</span>
                            
                            <!-- Logout Button -->
                            <button id="logoutBtn" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                Đăng xuất
                            </button>
                        </div>
                    </div>
                </div>
            </header>
        </div>
    <!-- MAIN CONTENT -->
    <main id="mainContent" class="ml-64 w-[calc(100%-16rem)] min-h-screen p-8 pt-24 transition-all bg-gray-50">

        <div class="text-center py-20 text-gray-500">Đang tải Dashboard...</div>
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
                '/admin/payment': 'Quản lý thanh toán',
                '/admin/supplier': 'Quản lý nhà cung cấp',
                '/admin/chat': 'Tin nhắn khách hàng',
                '/admin/report': 'Báo cáo & thống kê',
            };
            const menuName = menuMap[currentPath] || 'Dashboard';
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
                'Quản lý thanh toán': '/admin/payment',
                'Quản lý nhà cung cấp': '/admin/supplier',
                'Tin nhắn khách hàng': '/admin/chat',
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

        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function () {
                document.querySelectorAll('.menu-item').forEach(i => {
                    i.classList.remove('text-blue-600', 'active');
                    i.classList.add('text-gray-700');
                });
                this.classList.add('text-blue-600', 'active');
                const menuText = this.querySelector('span').textContent.trim();
                updateMainContent(menuText, true);
            });
        });

        window.addEventListener('popstate', event => {
            const menuName = event.state?.menuName || 'Dashboard';
            updateMainContent(menuName, false);
        });
        </script>

</body>
</html>
