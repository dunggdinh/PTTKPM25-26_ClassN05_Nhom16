@extends('customer.layout')
@section('title', 'Hồ sơ cá nhân')

@section('content')
<body class="ml-64 w-[calc(100%-16rem)] min-h-screen p-8 pt-24 transition-all bg-gray-50">
    <main class="max-w-6xl mx-auto p-6">
        <!-- Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Tài Khoản Của Tôi</h1>
            <p class="text-gray-600">Quản lý thông tin cá nhân và cài đặt tài khoản</p>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Sidebar Navigation -->
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white text-xl font-bold">
                            NV
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800">Nguyễn Văn A</h3>
                            <p class="text-sm text-gray-600">Khách hàng VIP</p>
                        </div>
                    </div>
                    
                    <nav class="space-y-2">
                        <button onclick="showTab(\'profile\')" class="tab-button active w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Hồ Sơ Cá Nhân
                        </button>
                        <button onclick="showTab(\'password\')" class="tab-button w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Đổi Mật Khẩu
                        </button>
                        <button onclick="showTab(\'orders\')" class="tab-button w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Đơn Hàng
                        </button>
                        <button onclick="showTab(\'addresses\')" class="tab-button w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Địa Chỉ
                        </button>
                    </nav>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Profile Tab -->
                <div id="profile" class="tab-content active">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Thông Tin Cá Nhân</h2>
                        
                        <form onsubmit="updateProfile(event)" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="firstName" class="block text-sm font-medium text-gray-700 mb-2">Họ</label>
                                    <input type="text" id="firstName" value="Nguyễn Văn" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="lastName" class="block text-sm font-medium text-gray-700 mb-2">Tên</label>
                                    <input type="text" id="lastName" value="A" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" value="nguyenvana@email.com" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Số Điện Thoại</label>
                                <input type="tel" id="phone" value="0123456789" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="birthdate" class="block text-sm font-medium text-gray-700 mb-2">Ngày Sinh</label>
                                <input type="date" id="birthdate" value="1990-01-01" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Giới Tính</label>
                                <select id="gender" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="male">Nam</option>
                                    <option value="female">Nữ</option>
                                    <option value="other">Khác</option>
                                </select>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                                    Cập Nhật Thông Tin
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Password Tab -->
                <div id="password" class="tab-content">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Đổi Mật Khẩu</h2>
                        
                        <form onsubmit="changePassword(event)" class="space-y-6">
                            <div>
                                <label for="currentPassword" class="block text-sm font-medium text-gray-700 mb-2">Mật Khẩu Hiện Tại</label>
                                <input type="password" id="currentPassword" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            </div>
                            
                            <div>
                                <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-2">Mật Khẩu Mới</label>
                                <input type="password" id="newPassword" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                <p class="text-sm text-gray-600 mt-2">Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường và số</p>
                            </div>
                            
                            <div>
                                <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-2">Xác Nhận Mật Khẩu Mới</label>
                                <input type="password" id="confirmPassword" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            </div>
                            
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-yellow-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <div>
                                        <h3 class="text-sm font-medium text-yellow-800">Lưu ý bảo mật</h3>
                                        <p class="text-sm text-yellow-700 mt-1">Sau khi đổi mật khẩu, bạn sẽ cần đăng nhập lại trên tất cả thiết bị.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                                    Đổi Mật Khẩu
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Orders Tab -->
                <div id="orders" class="tab-content">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Đơn Hàng Của Tôi</h2>
                        
                        <div class="space-y-4">
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h3 class="font-semibold text-gray-800">#DH001234</h3>
                                        <p class="text-sm text-gray-600">Đặt ngày: 15/12/2023</p>
                                    </div>
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Đã giao</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-700">iPhone 15 Pro Max, AirPods Pro</p>
                                    <p class="font-semibold text-lg">35.990.000₫</p>
                                </div>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h3 class="font-semibold text-gray-800">#DH001235</h3>
                                        <p class="text-sm text-gray-600">Đặt ngày: 20/12/2023</p>
                                    </div>
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Đang giao</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-700">MacBook Air M2, Magic Mouse</p>
                                    <p class="font-semibold text-lg">28.990.000₫</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Addresses Tab -->
                <div id="addresses" class="tab-content">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">Địa Chỉ Giao Hàng</h2>
                            <button onclick="showAddAddressForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                + Thêm Địa Chỉ
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-semibold text-gray-800 mb-1">Địa chỉ nhà</h3>
                                        <p class="text-gray-600">123 Đường ABC, Phường XYZ</p>
                                        <p class="text-gray-600">Quận 1, TP. Hồ Chí Minh</p>
                                        <p class="text-gray-600">SĐT: 0123456789</p>
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium mt-2 inline-block">Mặc định</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800 text-sm">Sửa</button>
                                        <button class="text-red-600 hover:text-red-800 text-sm">Xóa</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-semibold text-gray-800 mb-1">Địa chỉ công ty</h3>
                                        <p class="text-gray-600">456 Đường DEF, Phường UVW</p>
                                        <p class="text-gray-600">Quận 3, TP. Hồ Chí Minh</p>
                                        <p class="text-gray-600">SĐT: 0987654321</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800 text-sm">Sửa</button>
                                        <button class="text-red-600 hover:text-red-800 text-sm">Xóa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function showTab(tabName) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll(\'.tab-content\');
            tabContents.forEach(content => content.classList.remove(\'active\'));
            
            // Remove active class from all tab buttons
            const tabButtons = document.querySelectorAll(\'.tab-button\');
            tabButtons.forEach(button => button.classList.remove(\'active\'));
            
            // Show selected tab content
            document.getElementById(tabName).classList.add(\'active\');
            
            // Add active class to clicked button
            event.target.classList.add(\'active\');
        }

        function updateProfile(event) {
            event.preventDefault();
            
            // Show success message
            showNotification(\'Thông tin cá nhân đã được cập nhật thành công!\', \'success\');
        }

        function changePassword(event) {
            event.preventDefault();
            
            const newPassword = document.getElementById(\'newPassword\').value;
            const confirmPassword = document.getElementById(\'confirmPassword\').value;
            
            if (newPassword !== confirmPassword) {
                showNotification(\'Mật khẩu xác nhận không khớp!\', \'error\');
                return;
            }
            
            if (newPassword.length < 8) {
                showNotification(\'Mật khẩu phải có ít nhất 8 ký tự!\', \'error\');
                return;
            }
            
            // Clear form
            document.getElementById(\'currentPassword\').value = \'\';
            document.getElementById(\'newPassword\').value = \'\';
            document.getElementById(\'confirmPassword\').value = \'\';
            
            showNotification(\'Mật khẩu đã được thay đổi thành công!\', \'success\');
        }

        function showAddAddressForm() {
            showNotification(\'Chức năng thêm địa chỉ sẽ được triển khai!\', \'info\');
        }

        function showNotification(message, type) {
            const notification = document.createElement(\'div\');
            notification.className = `fixed top-4 right-4 px-6 py-4 rounded-lg shadow-lg z-50 ${
                type === \'success\' ? \'bg-green-500 text-white\' :
                type === \'error\' ? \'bg-red-500 text-white\' :
                \'bg-blue-500 text-white\'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement(\'script\');d.innerHTML="window.__CF$cv$params={r:\'98f5dfeab2b50eeb\',t:\'MTc2MDYwMDA3Ni4wMDAwMDA=\'};var a=document.createElement(\'script\');a.nonce=\'\';a.src=\'/cdn-cgi/challenge-platform/scripts/jsd/main.js\';document.getElementsByTagName(\'head\')[0].appendChild(a);";b.getElementsByTagName(\'head\')[0].appendChild(d)}}if(document.body){var a=document.createElement(\'iframe\');a.height=1;a.width=1;a.style.position=\'absolute\';a.style.top=0;a.style.left=0;a.style.border=\'none\';a.style.visibility=\'hidden\';document.body.appendChild(a);if(\'loading\'!==document.readyState)c();else if(window.addEventListener)document.addEventListener(\'DOMContentLoaded\',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);\'loading\'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
@endsection