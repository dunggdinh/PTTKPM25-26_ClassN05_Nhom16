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
    @php
        // Lấy user từ guard mặc định (nếu bạn chưa tạo guard 'admin')
        $authUser = Auth::user();

        // Tên hiển thị
        $displayName = $authUser->name
            ?? $authUser->full_name
            ?? $authUser->username
            ?? 'Admin';

        $initial = strtoupper(mb_substr($displayName, 0, 1, 'UTF-8'));

        // ===== Map vai trò (ưu tiên cột `role`) =====
        $rawRole = $authUser?->role ?? $authUser?->role_name ?? null;
        $displayRole = 'User';

        if ($rawRole) {
            $val = strtolower((string)$rawRole);
            if (in_array($val, ['admin','administrator','superadmin','root'])) {
                $displayRole = 'Admin';
            }
        } elseif (isset($authUser->role_id) && (int)$authUser->role_id === 1) {
            $displayRole = 'Admin';
        } elseif (isset($authUser->is_admin) && (int)$authUser->is_admin === 1) {
            $displayRole = 'Admin';
        }
    @endphp



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
                    <div id="notificationsDropdown"
                            class="dropdown absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 py-2 hidden z-50">
                        <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between">
                            <h3 class="font-semibold text-gray-800">Thông báo</h3>
                            <button onclick="markAllRead()" class="text-xs text-blue-600 hover:underline">Đánh dấu tất cả đã đọc</button>
                        </div>
                        <div class="max-h-96 overflow-y-auto"></div>
                    </div>
                </div>
                
                <!-- User Account Dropdown -->
                <div class="relative">
                    <div class="flex items-center space-x-3 cursor-pointer p-2 hover:bg-gray-50 rounded-lg transition-colors" onclick="toggleDropdown()">
                        <!-- Avatar -->
                        <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg">
                            {{ $initial }}
                        </div>
                        <!-- User Name -->
                        <div class="text-right">
                            <p class="text-xl font-bold text-gray-900">
                                {{ $displayName }}
                            </p>
                            <p class="text-sm font-semibold text-gray-600">
                                {{ $displayRole }}
                            </p>
                        </div>
                        <!-- Dropdown Arrow -->
                        <svg class="w-4 h-4 text-gray-600 transition-transform" id="dropdownArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>

                    
                    <!-- Dropdown Menu -->
                    <div class="dropdown absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2" id="userDropdown">
                        <a href="#" class="flex items-center px-4 py-2 text-gray-700 transition-colors">
                            <span class="mr-3">👤</span>
                            <span>Hồ sơ của tôi</span>
                        </a>
                        <hr class="my-1 border-gray-100">
                        <form action="{{ route('auth.logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" 
                                class="flex items-center w-full px-4 py-2 font-medium text-red-600 hover:text-red-700 hover:bg-red-50 transition-colors">
                                <span class="mr-3">🚪</span>
                                <span>Đăng xuất</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <div class="sidebar fixed top-16 left-0 w-64 h-[calc(100vh-4rem)] bg-white border-r border-gray-200 transition-transform duration-300 ease-in-out overflow-y-auto">

        <!-- Menu Navigation -->
        <nav class="py-10">
            <a href="/admin/dashboard" class="menu-item flex items-center px-6 py-4 text-gray-800 hover:bg-gray-100 active">
                <span class="mr-4 text-lg">📊</span>
                <span class="text-base">Dashboard</span>
            </a>
            <div class="menu-divider"></div>

            <a href="/admin/user" class="menu-item flex items-center px-6 py-4 text-gray-600 hover:bg-gray-100">
                <span class="mr-4 text-lg">👥</span>
                <span class="text-base">Quản lý người dùng</span>
            </a>
            <div class="menu-divider"></div>

            <a href="/admin/inventory" class="menu-item flex items-center px-6 py-4 text-gray-600 hover:bg-gray-100">
                <span class="mr-4 text-lg">🏬</span>
                <span class="text-base">Quản lý kho</span>
            </a>
            <div class="menu-divider"></div>

            <a href="/admin/order" class="menu-item flex items-center px-6 py-4 text-gray-600 hover:bg-gray-100">
                <span class="mr-4 text-lg">📦</span>
                <span class="text-base">Quản lý đơn hàng</span>
            </a>
            <div class="menu-divider"></div>

            <a href="/admin/promotion" class="menu-item flex items-center px-6 py-4 text-gray-600 hover:bg-gray-100">
                <span class="mr-4 text-lg">🏷️</span>
                <span class="text-base">Quản lý khuyến mãi</span>
            </a>
            <div class="menu-divider"></div>

            <a href="/admin/return" class="menu-item flex items-center px-6 py-4 text-gray-600 hover:bg-gray-100">
                <span class="mr-4 text-lg">🔁</span>
                <span class="text-base">Đổi/Trả hàng</span>
            </a>
            <div class="menu-divider"></div>

            <a href="/admin/payments_gateway" class="menu-item flex items-center px-6 py-4 text-gray-600 hover:bg-gray-100">
                <span class="mr-4 text-lg">💳</span>
                <span class="text-base">Quản lý thanh toán</span>
            </a>
            <div class="menu-divider"></div>

            <a href="/admin/deliveries" class="menu-item flex items-center px-6 py-4 text-gray-600 hover:bg-gray-100">
                <span class="mr-4 text-lg">🚚</span>
                <span class="text-base">Quản lý nhập hàng</span>
            </a>
            <div class="menu-divider"></div>

            <a href="/admin/support" class="menu-item flex items-center px-6 py-4 text-gray-600 hover:bg-gray-100">
                <span class="mr-4 text-lg">💬</span>
                <span class="text-base">Hỗ trợ khách hàng</span>
            </a>
            <div class="menu-divider"></div>

            <a href="/admin/report" class="menu-item flex items-center px-6 py-4 text-gray-600 hover:bg-gray-100">
                <span class="mr-4 text-lg">📈</span>
                <span class="text-base">Báo cáo & thống kê</span>
            </a>
            <div class="menu-divider"></div>

            <a href="/admin/warranties" class="menu-item flex items-center px-6 py-4 text-gray-600 hover:bg-gray-100">
                <span class="mr-4 text-lg">🛠️</span>
                <span class="text-base">Bảo hành sản phẩm</span>
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
            'Dashboard': '/admin/dashboard',
            'Quản lý người dùng': '/admin/user',
            'Quản lý kho': '/admin/inventory',
            'Quản lý đơn hàng': '/admin/order',
            'Đổi/Trả hàng': '/admin/return',
            'Quản lý thanh toán': '/admin/payments_gateway',
            'Quản lý khuyến mãi': '/admin/promotion', // 👈 thêm dòng này
            'Quản lý lô hàng nhập': '/admin/deliveries',
            'Hỗ trợ khách hàng': '/admin/support',
            'Báo cáo & thống kê': '/admin/report'
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
    <script>
    const dropdown = document.getElementById('notificationsDropdown');
    const badge = document.querySelector('.notification-badge');

    async function loadNotifications() {
        try {
            const res = await fetch(`{{ route('admin.notifications') }}`, { headers:{'X-Requested-With':'XMLHttpRequest'} });
            const data = await res.json();
            renderNotifications(data.items);
            renderBadge(data.unread);
        } catch (e) {
            console.error('Load notifications error', e);
        }
    }

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
                <p class="text-xs ${n.read_at ? 'text-gray-400' : 'text-blue-600'}">${n.time ?? ''}</p>
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

    function renderNotifications(items) {
        const container = dropdown.querySelector('.max-h-96');
        if (!container) return;
        if (!items || items.length === 0) {
            container.innerHTML = `<div class="px-4 py-6 text-center text-gray-500">Không có thông báo nào</div>`;
            return;
        }
        container.innerHTML = items.map(itemTemplate).join('');

        container.querySelectorAll('.mark-read').forEach(btn => {
            btn.addEventListener('click', async (e) => {
            const id = e.currentTarget.dataset.id;
            await fetch(`{{ url('/admin/notifications') }}/${id}/read`, {
                method: 'POST',
                headers: {
                'X-CSRF-TOKEN': `{{ csrf_token() }}`,
                'X-Requested-With':'XMLHttpRequest'
                }
            });
            await loadNotifications();
            });
        });

        container.querySelectorAll('.remove').forEach(btn => {
            btn.addEventListener('click', async (e) => {
            const id = e.currentTarget.dataset.id;
            await fetch(`{{ url('/admin/notifications') }}/${id}`, {
                method: 'DELETE',
                headers: {
                'X-CSRF-TOKEN': `{{ csrf_token() }}`,
                'X-Requested-With':'XMLHttpRequest'
                }
            });
            await loadNotifications();
            });
        });
    }

    async function markAllRead() {
        await fetch(`{{ route('admin.notifications.read_all') }}`, {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': `{{ csrf_token() }}`, 'X-Requested-With':'XMLHttpRequest'}
        });
        await loadNotifications();
    }

    function toggleNotifications() {
        const dd = document.getElementById('notificationsDropdown');
        dd.classList.toggle('hidden');
        if (!dd.classList.contains('hidden')) {
            dd.querySelector('.max-h-96').innerHTML = `<div class="px-4 py-6 text-center text-gray-500">Đang tải...</div>`;
            loadNotifications();
        }

    }

    // tự load khi trang mở & refresh định kỳ
    document.addEventListener('DOMContentLoaded', () => {
        loadNotifications();
        setInterval(loadNotifications, 30000);
    });
    </script>

<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement(\'script\');d.innerHTML="window.__CF$cv$params={r:\'98f4561c8249f995\',t:\'MTc2MDU4Mzk0NS4wMDAwMDA=\'};var a=document.createElement(\'script\');a.nonce=\'\';a.src=\'/cdn-cgi/challenge-platform/scripts/jsd/main.js\';document.getElementsByTagName(\'head\')[0].appendChild(a);";b.getElementsByTagName(\'head\')[0].appendChild(d)}}if(document.body){var a=document.createElement(\'iframe\');a.height=1;a.width=1;a.style.position=\'absolute\';a.style.top=0;a.style.left=0;a.style.border=\'none\';a.style.visibility=\'hidden\';document.body.appendChild(a);if(\'loading\'!==document.readyState)c();else if(window.addEventListener)document.addEventListener(\'DOMContentLoaded\',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);\'loading\'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
