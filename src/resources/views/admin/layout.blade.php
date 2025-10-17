<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroStore Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans h-full flex">

    <!-- SIDEBAR -->
    <div class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg z-10 transition-transform duration-300 ease-in-out pt-10">
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

    <!-- MAIN CONTENT -->
    <main id="mainContent" class="ml-64 w-full min-h-screen p-8 transition-all">
        <div class="text-center py-20 text-gray-500">Đang tải Dashboard...</div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => updateMainContent('Dashboard'));

        async function updateMainContent(menuName) {
            const main = document.getElementById('mainContent');
            let url = '';

            switch (menuName) {
                case 'Dashboard': url = '/admin/dashboard'; break;
                case 'Quản lý người dùng': url = '/admin/customer'; break;
                case 'Quản lý kho': url = '/admin/inventory'; break;
                case 'Quản lý đơn hàng': url = '/admin/order'; break;
                case 'Đổi/Trả hàng': url = '/admin/return'; break;
                case 'Quản lý thanh toán': url = '/admin/payment'; break;
                case 'Quản lý nhà cung cấp': url = '/admin/supplier'; break;
                case 'Tin nhắn khách hàng': url = '/admin/chat'; break;
                case 'Báo cáo & thống kê': url = '/admin/report'; break;
                default:
                    main.innerHTML = '<div class="p-6 text-gray-500">Không tìm thấy nội dung.</div>';
                    return;
            }

            main.innerHTML = '<div class="text-center py-20 text-gray-500 animate-pulse">Đang tải...</div>';

            try {
                const response = await fetch(url);
                const html = await response.text();
                main.innerHTML = html;
            } catch {
                main.innerHTML = '<div class="p-6 text-red-500">Lỗi tải nội dung.</div>';
            }
        }

        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-item').forEach(i => {
                    i.classList.remove('text-blue-600', 'active');
                    i.classList.add('text-gray-700');
                });
                this.classList.add('text-blue-600', 'active');
                const menuText = this.querySelector('span').textContent.trim();
                updateMainContent(menuText);
            });
        });
    </script>
</body>
</html>
