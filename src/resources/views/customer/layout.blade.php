<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cửa Hàng Điện Tử')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <h2 class="text-3xl font-bold text-gray-900">LC Electronics</h2>
                    <p class="text-base font-medium text-gray-700" id="pageSubtitle">Trang chủ</p>
                </div>
            </div>
            
            <!-- Right side - User -->
            <div class="flex items-center space-x-4">
                <!-- User Account Dropdown -->
                <div class="relative">
                    <div class="flex items-center space-x-3 cursor-pointer p-2 hover:bg-gray-50 rounded-lg transition-colors" onclick="toggleDropdown()">
                        <!-- Avatar -->
                        <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg">
                            {{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 1) . (str_contains(Auth::user()->name, ' ') ? substr(Auth::user()->name, strrpos(Auth::user()->name, ' ') + 1, 1) : '')) : 'C' }}
                        </div>
                        <!-- User Name -->
                        <div class="text-right">
                            <p class="text-xl font-bold text-gray-900">
                                {{ Auth::user()->name ?? 'Người dùng' }}
                            </p>
                            <p class="text-sm font-semibold text-gray-600">
                                {{ Auth::user()->role ?? 'Khách hàng' }}
                            </p>
                        </div>

                        <!-- Dropdown Arrow -->
                        <svg class="w-4 h-4 text-gray-600 transition-transform" id="dropdownArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    
                    <!-- Dropdown Menu -->
                    <div class="dropdown absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2" id="userDropdown">
                        <a href="{{ url('/customer/profile') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 transition-colors">
                            <span class="mr-3">👤</span>
                            <span>Hồ sơ của tôi</span>
                        </a>
                        <hr class="my-1 border-gray-100">
                        <a href="#" id="logout-link" class="flex items-center w-full px-4 py-2 font-medium text-red-600 hover:text-red-700 hover:bg-red-50 transition-colors">
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
        <nav class="pt-10">
            <a href="/customer/home" class="menu-item flex items-center px-6 py-4 text-gray-600 hover:bg-gray-100">
                <span class="mr-4 text-lg">🏠</span>
                <span class="text-base">Trang chủ</span>
            </a>
            <div class="menu-divider"></div>
            <a href="/customer/promotion" class="menu-item flex items-center px-6 py-4 text-gray-600 hover:bg-gray-100">
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
                item.classList.remove('active');
            });
            
            // Find and activate current menu item
            document.querySelectorAll('.menu-item').forEach(item => {
                if (item.getAttribute('href') === currentPath) {
                    item.classList.add('active');
                    pageSubtitle.textContent = item.querySelector('span:last-child').textContent.trim();
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
            const dropdown = document.getElementById('userDropdown');
            const arrow = document.getElementById('dropdownArrow');
            dropdown.classList.toggle('show');
            arrow.style.transform = dropdown.classList.contains('show') ? 'rotate(180deg)' : '';
            
            // Close dropdown when clicking outside
            if (dropdown.classList.contains('show')) {
                document.addEventListener('click', function closeDropdown(e) {
                    if (!e.target.closest('.relative')) {
                        dropdown.classList.remove('show');
                        arrow.style.transform = '';
                        document.removeEventListener('click', closeDropdown);
                    }
                });
            }
        }
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const main = document.querySelector('#mainContent');
            const hidden = sidebar.style.transform === 'translateX(-100%)';
            sidebar.style.transform = hidden ? 'translateX(0)' : 'translateX(-100%)';
            main.style.marginLeft = hidden ? '16rem' : '0';
        }

    </script>
    <!-- FORM ĐĂNG XUẤT ẨN (luôn tồn tại trên mọi trang) -->
    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <script>
        function renderBadge(unread) {
            if (!badge) return;
            badge.textContent = unread > 99 ? '99+' : unread;
            badge.style.display = unread > 0 ? 'flex' : 'none';
        }

        function pillColor(icon) {
            switch(icon){
                case 'blue': return 'bg-blue-500';
                case 'green': return 'bg-green-500';
                case 'red': return 'bg-red-500';
                default: return 'bg-gray-300';
            }
        }

        function itemTemplate(n) {
            return `
            <div class="px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-50">
            <div class="flex items-start space-x-3">
                <div class="w-2 h-2 ${pillColor(n.icon)} rounded-full mt-2 flex-shrink-0"></div>
                <div class="flex-1">
                <p class="font-bold ${n.read_at ? 'text-gray-700' : 'text-gray-800'} text-sm">${n.title}</p>
                <p class="text-xs ${n.read_at ? 'text-gray-400' : 'text-gray-500'} mt-1">${n.message ?? ''}</p>
                <div class="flex items-center justify-between mt-1">
                    <p class="text-xs ${n.read_at ? 'text-gray-400' : 'text-blue-600'}">${n.time}</p>
                    <div class="flex items-center gap-2">
                    ${n.url ? `<a href="${n.url}" class="text-xs text-blue-600 hover:underline">Xem</a>` : ''}
                    ${!n.read_at ? `<button data-id="${n.id}" class="mark-read text-xs text-gray-600 hover:text-gray-800">Đã đọc</button>` : ''}
                    <button data-id="${n.id}" class="remove text-xs text-red-600 hover:text-red-700">Xóa</button>
                    </div>
                </div>
                </div>
            </div>
            </div>`;
        }
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoutLink = document.getElementById('logout-link');
        if (logoutLink) {
            logoutLink.addEventListener('click', function (e) {
                e.preventDefault();
                const form = document.getElementById('logout-form');
                if (form) form.submit();
            });
        }
    });
    </script>

<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement(\'script\');d.innerHTML="window.__CF$cv$params={r:\'98f4561c8249f995\',t:\'MTc2MDU4Mzk0NS4wMDAwMDA=\'};var a=document.createElement(\'script\');a.nonce=\'\';a.src=\'/cdn-cgi/challenge-platform/scripts/jsd/main.js\';document.getElementsByTagName(\'head\')[0].appendChild(a);";b.getElementsByTagName(\'head\')[0].appendChild(d)}}if(document.body){var a=document.createElement(\'iframe\');a.height=1;a.width=1;a.style.position=\'absolute\';a.style.top=0;a.style.left=0;a.style.border=\'none\';a.style.visibility=\'hidden\';document.body.appendChild(a);if(\'loading\'!==document.readyState)c();else if(window.addEventListener)document.addEventListener(\'DOMContentLoaded\',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);\'loading\'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
