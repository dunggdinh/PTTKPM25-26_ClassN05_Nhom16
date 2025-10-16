<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroStore Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
    
</head>
<body class="bg-gray-50 font-sans h-full">
    <!-- Sidebar -->
    <div class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg z-10 transition-transform duration-300 ease-in-out pt-20">

        
        <!-- Menu Navigation -->
        <nav class="mt-6">
            <div class="menu-item active flex items-center px-6 py-3 text-blue-600 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" fill="currentColor" viewBox="0 0 16 16">
                    <rect x="1" y="1" width="6" height="6" stroke="currentColor" fill="none"/>
                    <rect x="9" y="1" width="6" height="6" stroke="currentColor" fill="none"/>
                    <rect x="1" y="9" width="6" height="6" stroke="currentColor" fill="none"/>
                    <rect x="9" y="9" width="6" height="6" stroke="currentColor" fill="none"/>
                </svg>
                <span class="font-medium">Dashboard</span>
                <div class="ml-auto w-2 h-2 bg-blue-600 rounded-full"></div>
            </div>
            
            <div class="menu-item flex items-center px-6 py-3 text-gray-700 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" fill="currentColor" viewBox="0 0 16 16">
                    <circle cx="8" cy="4" r="2" stroke="currentColor" fill="none"/>
                    <path d="M4 14v-2c0-2 2-4 4-4s4 2 4 4v2" stroke="currentColor" fill="none"/>
                </svg>
                <span class="font-medium">Quản lý người dùng</span>
            </div>
            
            <div class="menu-item flex items-center px-6 py-3 text-gray-700 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" fill="currentColor" viewBox="0 0 16 16">
                    <rect x="2" y="6" width="12" height="8" stroke="currentColor" fill="none"/>
                    <polygon points="2,6 8,2 14,6" stroke="currentColor" fill="none"/>
                    <rect x="6" y="10" width="4" height="4" stroke="currentColor" fill="none"/>
                </svg>
                <span class="font-medium">Quản lý kho</span>
            </div>
            
            <div class="menu-item flex items-center px-6 py-3 text-gray-700 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" fill="currentColor" viewBox="0 0 16 16">
                    <rect x="2" y="4" width="12" height="10" stroke="currentColor" fill="none"/>
                    <line x1="2" y1="7" x2="14" y2="7" stroke="currentColor"/>
                    <line x1="5" y1="4" x2="5" y2="14" stroke="currentColor"/>
                    <circle cx="3.5" cy="5.5" r="0.5" fill="currentColor"/>
                    <circle cx="3.5" cy="8.5" r="0.5" fill="currentColor"/>
                    <circle cx="3.5" cy="11.5" r="0.5" fill="currentColor"/>
                </svg>
                <span class="font-medium">Quản lý đơn hàng</span>
            </div>
            
            <div class="menu-item flex items-center px-6 py-3 text-gray-700 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 2l-1 1-3 3h2v6h4V6h2l-3-3-1-1z" stroke="currentColor" fill="none"/>
                    <path d="M2 12h4v2H2v-2z" fill="currentColor"/>
                    <path d="M10 12h4v2h-4v-2z" fill="currentColor"/>
                </svg>
                <span class="font-medium">Đổi/Trả hàng</span>
            </div>
            
            <div class="menu-item flex items-center px-6 py-3 text-gray-700 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" fill="currentColor" viewBox="0 0 16 16">
                    <rect x="2" y="4" width="12" height="8" rx="2" stroke="currentColor" fill="none"/>
                    <line x1="2" y1="7" x2="14" y2="7" stroke="currentColor"/>
                    <circle cx="5" cy="9" r="1" fill="currentColor"/>
                    <circle cx="8" cy="9" r="1" fill="currentColor"/>
                    <circle cx="11" cy="9" r="1" fill="currentColor"/>
                </svg>
                <span class="font-medium">Quản lý thanh toán</span>
            </div>
            
            <div class="menu-item flex items-center px-6 py-3 text-gray-700 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" fill="currentColor" viewBox="0 0 16 16">
                    <rect x="1" y="8" width="14" height="6" stroke="currentColor" fill="none"/>
                    <rect x="3" y="4" width="10" height="4" stroke="currentColor" fill="none"/>
                    <rect x="5" y="2" width="6" height="2" stroke="currentColor" fill="none"/>
                    <circle cx="4" cy="11" r="1" stroke="currentColor" fill="none"/>
                    <circle cx="12" cy="11" r="1" stroke="currentColor" fill="none"/>
                </svg>
                <span class="font-medium">Quản lý nhà cung cấp</span>
            </div>
            
            <div class="menu-item flex items-center px-6 py-3 text-gray-700 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" fill="currentColor" viewBox="0 0 16 16">
                    <rect x="1" y="3" width="14" height="10" rx="2" stroke="currentColor" fill="none"/>
                    <path d="M1 5l7 4 7-4" stroke="currentColor" fill="none"/>
                    <circle cx="12" cy="4" r="2" fill="red"/>
                    <text x="12" y="5.5" text-anchor="middle" fill="white" font-size="2" font-weight="bold">5</text>
                </svg>
                <span class="font-medium">Tin nhắn khách hàng</span>
                <div class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">
                    5
                </div>
            </div>
            
            <div class="menu-item flex items-center px-6 py-3 text-gray-700 cursor-pointer">
                <svg class="w-5 h-5 mr-3 text-black" fill="currentColor" viewBox="0 0 16 16">
                    <rect x="2" y="2" width="12" height="12" stroke="currentColor" fill="none"/>
                    <line x1="2" y1="12" x2="6" y2="8" stroke="currentColor"/>
                    <line x1="6" y1="8" x2="10" y2="10" stroke="currentColor"/>
                    <line x1="10" y1="10" x2="14" y2="6" stroke="currentColor"/>
                    <circle cx="6" cy="8" r="1" fill="currentColor"/>
                    <circle cx="10" cy="10" r="1" fill="currentColor"/>
                    <circle cx="14" cy="6" r="1" fill="currentColor"/>
                </svg>
                <span class="font-medium">Báo cáo & thống kê</span>
            </div>
        </nav>
    </div>
    
    <!-- Main Content Area -->
    <div class="ml-64 h-full transition-all duration-300 ease-in-out">
        <!-- Header Bar -->
        <header class="bg-white shadow-sm border-b border-gray-200 px-6 py-4 fixed top-0 left-0 right-0 z-20">
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
        
        <!-- Main Content -->
        <main class="p-6 h-full pt-24">
            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                <div class="text-6xl mb-4">📊</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Chào mừng đến với Dashboard</h3>
                <p class="text-gray-600">Nội dung chính sẽ được hiển thị ở đây khi bạn chọn các menu khác nhau.</p>
            </div>
        </main>
    </div>
    
    <script>
        // Handle menu toggle
        document.getElementById(\'menuToggle\').addEventListener(\'click\', function() {
            const sidebar = document.querySelector(\'.fixed.left-0\');
            const mainContent = document.querySelector(\'.ml-64\');
            
            if (sidebar.style.transform === \'translateX(-100%)\') {
                // Show sidebar
                sidebar.style.transform = \'translateX(0)\';
                mainContent.classList.remove(\'ml-0\');
                mainContent.classList.add(\'ml-64\');
            } else {
                // Hide sidebar
                sidebar.style.transform = \'translateX(-100%)\';
                mainContent.classList.remove(\'ml-64\');
                mainContent.classList.add(\'ml-0\');
            }
        });

        // Handle menu item clicks
        document.querySelectorAll(\'.menu-item\').forEach(item => {
            item.addEventListener(\'click\', function() {
                // Remove active class and styling from all items
                document.querySelectorAll(\'.menu-item\').forEach(i => {
                    i.classList.remove(\'active\');
                    i.classList.remove(\'text-blue-600\');
                    i.classList.add(\'text-gray-700\');
                    // Hide all blue dots
                    const dot = i.querySelector(\'.ml-auto\');
                    if (dot) dot.style.display = \'none\';
                });
                
                // Add active class and styling to clicked item
                this.classList.add(\'active\');
                this.classList.remove(\'text-gray-700\');
                this.classList.add(\'text-blue-600\');
                
                // Show blue dot for active item
                let dot = this.querySelector(\'.ml-auto\');
                if (!dot) {
                    dot = document.createElement(\'div\');
                    dot.className = \'ml-auto w-2 h-2 bg-blue-600 rounded-full\';
                    this.appendChild(dot);
                }
                dot.style.display = \'block\';
                
                // Get menu text and update content
                const menuText = this.querySelector(\'span\').textContent;
                updateMainContent(menuText);
                
                // Auto hide sidebar when menu item is clicked
                const sidebar = document.querySelector(\'.fixed.left-0\');
                const mainContent = document.querySelector(\'.ml-64\');
                
                sidebar.style.transform = \'translateX(-100%)\';
                mainContent.classList.remove(\'ml-64\');
                mainContent.classList.add(\'ml-0\');
            });
        });
        
        // Function to update main content based on selected menu
        function updateMainContent(menuName) {
            const mainContent = document.querySelector(\'main\');
            
            let content = \'\';
            let icon = \'\';
            
            switch(menuName) {
                case \'Dashboard\':
                    icon = \'📊\';
                    content = `
                        <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                            <div class="text-6xl mb-4">${icon}</div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Chào mừng đến với Dashboard</h3>
                            <p class="text-gray-600">Nội dung chính sẽ được hiển thị ở đây khi bạn chọn các menu khác nhau.</p>
                        </div>
                    `;
                    break;
                case \'Quản lý người dùng\':
                    icon = \'👥\';
                    content = `
                        <div class="bg-white rounded-lg shadow-sm p-8">
                            <div class="text-center mb-6">
                                <div class="text-6xl mb-4">${icon}</div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">Quản lý người dùng</h3>
                                <p class="text-gray-600">Quản lý thông tin người dùng, phân quyền và tài khoản</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-blue-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-blue-600">150</div>
                                    <div class="text-gray-600">Tổng người dùng</div>
                                </div>
                                <div class="bg-green-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-green-600">12</div>
                                    <div class="text-gray-600">Người dùng mới</div>
                                </div>
                                <div class="bg-yellow-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-yellow-600">5</div>
                                    <div class="text-gray-600">Tài khoản bị khóa</div>
                                </div>
                            </div>
                        </div>
                    `;
                    break;
                case \'Đổi/Trả hàng\':
                    icon = \'🔄\';
                    content = `
                        <div class="bg-white rounded-lg shadow-sm p-8">
                            <div class="text-center mb-6">
                                <div class="text-6xl mb-4">${icon}</div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">Đổi/Trả hàng</h3>
                                <p class="text-gray-600">Xử lý yêu cầu đổi trả, hoàn tiền và bảo hành</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="bg-orange-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-orange-600">23</div>
                                    <div class="text-gray-600">Yêu cầu đổi hàng</div>
                                </div>
                                <div class="bg-red-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-red-600">15</div>
                                    <div class="text-gray-600">Yêu cầu trả hàng</div>
                                </div>
                                <div class="bg-green-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-green-600">89</div>
                                    <div class="text-gray-600">Đã xử lý</div>
                                </div>
                                <div class="bg-blue-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-blue-600">7</div>
                                    <div class="text-gray-600">Đang xử lý</div>
                                </div>
                            </div>
                        </div>
                    `;
                    break;
                case \'Quản lý kho\':
                    icon = \'🏪\';
                    content = `
                        <div class="bg-white rounded-lg shadow-sm p-8">
                            <div class="text-center mb-6">
                                <div class="text-6xl mb-4">${icon}</div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">Quản lý kho</h3>
                                <p class="text-gray-600">Theo dõi tồn kho, nhập xuất hàng và kiểm kê</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-indigo-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-indigo-600">3</div>
                                    <div class="text-gray-600">Kho hàng</div>
                                </div>
                                <div class="bg-orange-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-orange-600">25,000</div>
                                    <div class="text-gray-600">Tổng tồn kho</div>
                                </div>
                                <div class="bg-pink-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-pink-600">150</div>
                                    <div class="text-gray-600">Sản phẩm sắp hết</div>
                                </div>
                            </div>
                        </div>
                    `;
                    break;
                case \'Quản lý đơn hàng\':
                    icon = \'📋\';
                    content = `
                        <div class="bg-white rounded-lg shadow-sm p-8">
                            <div class="text-center mb-6">
                                <div class="text-6xl mb-4">${icon}</div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">Quản lý đơn hàng</h3>
                                <p class="text-gray-600">Xử lý đơn hàng, theo dõi giao hàng và thanh toán</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="bg-blue-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-blue-600">89</div>
                                    <div class="text-gray-600">Đơn hàng mới</div>
                                </div>
                                <div class="bg-yellow-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-yellow-600">156</div>
                                    <div class="text-gray-600">Đang xử lý</div>
                                </div>
                                <div class="bg-green-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-green-600">234</div>
                                    <div class="text-gray-600">Đã giao</div>
                                </div>
                                <div class="bg-red-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-red-600">12</div>
                                    <div class="text-gray-600">Đã hủy</div>
                                </div>
                            </div>
                        </div>
                    `;
                    break;
                case \'Quản lý nhà cung cấp\':
                    icon = \'🚚\';
                    content = `
                        <div class="bg-white rounded-lg shadow-sm p-8">
                            <div class="text-center mb-6">
                                <div class="text-6xl mb-4">${icon}</div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">Quản lý nhà cung cấp</h3>
                                <p class="text-gray-600">Quản lý thông tin nhà cung cấp và hợp đồng</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-teal-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-teal-600">45</div>
                                    <div class="text-gray-600">Nhà cung cấp</div>
                                </div>
                                <div class="bg-cyan-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-cyan-600">12</div>
                                    <div class="text-gray-600">Hợp đồng mới</div>
                                </div>
                                <div class="bg-emerald-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-emerald-600">8</div>
                                    <div class="text-gray-600">Đối tác chiến lược</div>
                                </div>
                            </div>
                        </div>
                    `;
                    break;
                case \'Quản lý thanh toán\':
                    icon = \'💳\';
                    content = `
                        <div class="bg-white rounded-lg shadow-sm p-8">
                            <div class="text-center mb-6">
                                <div class="text-6xl mb-4">${icon}</div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">Quản lý thanh toán</h3>
                                <p class="text-gray-600">Theo dõi giao dịch, phương thức thanh toán và hoàn tiền</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="bg-green-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-green-600">1,234</div>
                                    <div class="text-gray-600">Giao dịch thành công</div>
                                </div>
                                <div class="bg-red-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-red-600">23</div>
                                    <div class="text-gray-600">Giao dịch thất bại</div>
                                </div>
                                <div class="bg-yellow-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-yellow-600">45</div>
                                    <div class="text-gray-600">Đang xử lý</div>
                                </div>
                                <div class="bg-blue-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-blue-600">12</div>
                                    <div class="text-gray-600">Hoàn tiền</div>
                                </div>
                            </div>
                        </div>
                    `;
                    break;
                case \'Tin nhắn khách hàng\':
                    icon = \'💬\';
                    content = `
                        <div class="bg-white rounded-lg shadow-sm h-full flex">
                            <!-- Danh sách cuộc trò chuyện -->
                            <div class="w-1/3 border-r border-gray-200">
                                <div class="p-4 border-b border-gray-200">
                                    <h3 class="text-lg font-bold text-gray-800">Tin nhắn khách hàng</h3>
                                    <p class="text-sm text-gray-600">5 tin nhắn chưa đọc</p>
                                </div>
                                <div class="overflow-y-auto h-96">
                                    <div class="p-4 hover:bg-gray-50 cursor-pointer border-b border-gray-100 bg-blue-50">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                                                N
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex justify-between items-center">
                                                    <h4 class="font-semibold text-gray-900">Nguyễn Văn A</h4>
                                                    <span class="text-xs text-gray-500">10:30</span>
                                                </div>
                                                <p class="text-sm text-gray-600 truncate">Sản phẩm iPhone 15 còn hàng không ạ?</p>
                                                <div class="w-2 h-2 bg-red-500 rounded-full mt-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4 hover:bg-gray-50 cursor-pointer border-b border-gray-100">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold">
                                                T
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex justify-between items-center">
                                                    <h4 class="font-semibold text-gray-900">Trần Thị B</h4>
                                                    <span class="text-xs text-gray-500">09:15</span>
                                                </div>
                                                <p class="text-sm text-gray-600 truncate">Cảm ơn shop, sản phẩm rất tốt!</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4 hover:bg-gray-50 cursor-pointer border-b border-gray-100">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                                L
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex justify-between items-center">
                                                    <h4 class="font-semibold text-gray-900">Lê Minh C</h4>
                                                    <span class="text-xs text-gray-500">08:45</span>
                                                </div>
                                                <p class="text-sm text-gray-600 truncate">Khi nào có hàng MacBook Air M3?</p>
                                                <div class="w-2 h-2 bg-red-500 rounded-full mt-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Khung chat -->
                            <div class="flex-1 flex flex-col">
                                <div class="p-4 border-b border-gray-200 bg-gray-50">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                                            N
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">Nguyễn Văn A</h4>
                                            <p class="text-sm text-green-600">● Đang online</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex-1 p-4 overflow-y-auto bg-gray-50">
                                    <div class="space-y-4">
                                        <div class="flex justify-start">
                                            <div class="bg-white p-3 rounded-lg shadow-sm max-w-xs">
                                                <p class="text-gray-800">Chào shop! Em muốn hỏi sản phẩm iPhone 15 Pro Max 256GB còn hàng không ạ?</p>
                                                <span class="text-xs text-gray-500 mt-1 block">10:25</span>
                                            </div>
                                        </div>
                                        
                                        <div class="flex justify-end">
                                            <div class="bg-blue-600 text-white p-3 rounded-lg shadow-sm max-w-xs">
                                                <p>Chào bạn! iPhone 15 Pro Max 256GB hiện tại shop còn hàng. Giá là 29.990.000đ. Bạn có muốn đặt hàng không?</p>
                                                <span class="text-xs text-blue-200 mt-1 block">10:26</span>
                                            </div>
                                        </div>
                                        
                                        <div class="flex justify-start">
                                            <div class="bg-white p-3 rounded-lg shadow-sm max-w-xs">
                                                <p class="text-gray-800">Vậy còn màu nào ạ? Em thích màu Titan tự nhiên.</p>
                                                <span class="text-xs text-gray-500 mt-1 block">10:30</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="p-4 border-t border-gray-200 bg-white">
                                    <div class="flex space-x-2">
                                        <input type="text" placeholder="Nhập tin nhắn..." class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                                            Gửi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    break;
                case \'Báo cáo & thống kê\':
                    icon = \'📈\';
                    content = `
                        <div class="bg-white rounded-lg shadow-sm p-8">
                            <div class="text-center mb-6">
                                <div class="text-6xl mb-4">${icon}</div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">Báo cáo & thống kê</h3>
                                <p class="text-gray-600">Xem báo cáo doanh thu, thống kê bán hàng và phân tích</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="bg-green-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-green-600">2.5M</div>
                                    <div class="text-gray-600">Doanh thu tháng</div>
                                </div>
                                <div class="bg-blue-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-blue-600">1,234</div>
                                    <div class="text-gray-600">Đơn hàng</div>
                                </div>
                                <div class="bg-purple-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-purple-600">567</div>
                                    <div class="text-gray-600">Khách hàng mới</div>
                                </div>
                                <div class="bg-orange-50 p-4 rounded-lg text-center">
                                    <div class="text-2xl font-bold text-orange-600">15%</div>
                                    <div class="text-gray-600">Tăng trưởng</div>
                                </div>
                            </div>
                        </div>
                    `;
                    break;
                default:
                    icon = \'📊\';
                    content = `
                        <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                            <div class="text-6xl mb-4">${icon}</div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Chào mừng đến với Dashboard</h3>
                            <p class="text-gray-600">Nội dung chính sẽ được hiển thị ở đây khi bạn chọn các menu khác nhau.</p>
                        </div>
                    `;
            }
            
            mainContent.innerHTML = `<div class="p-6 h-full pt-24">${content}</div>`;
        }
        
        // Handle logout button
        document.getElementById(\'logoutBtn\').addEventListener(\'click\', function(e) {
            e.preventDefault();
            
            // Tạo popup xác nhận đăng xuất đẹp hơn
            const confirmHTML = `
                <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
                    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
                        <div class="p-6">
                            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full">
                                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Xác nhận đăng xuất</h3>
                            <p class="text-gray-600 text-center mb-6">Bạn có chắc chắn muốn đăng xuất khỏi hệ thống?</p>
                            <div class="flex space-x-3">
                                <button id="cancelLogout" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-4 rounded-lg font-medium transition-colors">
                                    Hủy
                                </button>
                                <button id="confirmLogout" class="flex-1 bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg font-medium transition-colors">
                                    Đăng xuất
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Thêm popup vào body
            document.body.insertAdjacentHTML(\'beforeend\', confirmHTML);
            
            // Xử lý nút hủy
            document.getElementById(\'cancelLogout\').addEventListener(\'click\', function() {
                this.closest(\'.fixed\').remove();
            });
            
            // Xử lý nút xác nhận đăng xuất
            document.getElementById(\'confirmLogout\').addEventListener(\'click\', function() {
                // Hiển thị thông báo đăng xuất thành công
                this.closest(\'.fixed\').remove();
                
                const successHTML = `
                    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
                        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
                            <div class="p-6 text-center">
                                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Đăng xuất thành công!</h3>
                                <p class="text-gray-600 mb-6">Bạn sẽ được chuyển về trang đăng nhập...</p>
                                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                                    <div class="bg-blue-600 h-2 rounded-full transition-all duration-3000" style="width: 0%" id="progressBar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                document.body.insertAdjacentHTML(\'beforeend\', successHTML);
                
                // Animate progress bar
                const progressBar = document.getElementById(\'progressBar\');
                let width = 0;
                const interval = setInterval(() => {
                    width += 2;
                    progressBar.style.width = width + \'%\';
                    if (width >= 100) {
                        clearInterval(interval);
                        setTimeout(() => {
                            document.querySelector(\'.fixed:last-child\').remove();
                            // Ở đây có thể thêm logic chuyển hướng thực tế
                            // window.location.href = \'/login\';
                            alert(\'Demo: Trong ứng dụng thực tế, bạn sẽ được chuyển về trang đăng nhập\');
                        }, 500);
                    }
                }, 30);
            });
        });
        
        // Handle notification click
        document.getElementById(\'notificationBtn\').addEventListener(\'click\', function() {
            // Tạo popup thông báo đẹp hơn
            const notifications = [
                { id: 1, title: \'Đơn hàng mới\', message: \'Đơn hàng #1234 cần xử lý ngay. Khách hàng đã thanh toán và chờ xác nhận.\', time: \'5 phút trước\', type: \'order\' },
                { id: 2, title: \'Cảnh báo tồn kho\', message: \'Sản phẩm iPhone 15 Pro Max chỉ còn 5 chiếc trong kho. Cần nhập hàng gấp.\', time: \'1 giờ trước\', type: \'warning\' },
                { id: 3, title: \'Khuyến mãi sắp hết hạn\', message: \'Chương trình Black Friday sẽ kết thúc trong 2 giờ nữa. Hãy kiểm tra các đơn hàng cuối cùng.\', time: \'2 giờ trước\', type: \'promo\' },
                { id: 4, title: \'Báo cáo doanh thu\', message: \'Doanh thu hôm nay đã đạt 15.5 triệu VNĐ, tăng 25% so với hôm qua.\', time: \'3 giờ trước\', type: \'report\' },
                { id: 5, title: \'Khách hàng mới\', message: \'12 khách hàng mới đã đăng ký tài khoản trong 24h qua.\', time: \'4 giờ trước\', type: \'user\' }
            ];
            
            let notificationHTML = `
                <div class="fixed inset-0 bg-black bg-opacity-60 z-50 flex items-center justify-center p-4">
                    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[80vh] overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6 text-white">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold">Thông báo</h3>
                                        <p class="text-blue-100 text-sm">Bạn có ${notifications.length} thông báo mới</p>
                                    </div>
                                </div>
                                <button onclick="this.closest(\'.fixed\').remove()" class="text-white hover:bg-white hover:bg-opacity-20 p-2 rounded-lg transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
            `;
            
            notifications.forEach((notif, index) => {
                const bgColor = notif.type === \'order\' ? \'bg-blue-50 border-l-blue-500\' : 
                               notif.type === \'warning\' ? \'bg-yellow-50 border-l-yellow-500\' : 
                               notif.type === \'promo\' ? \'bg-green-50 border-l-green-500\' :
                               notif.type === \'report\' ? \'bg-purple-50 border-l-purple-500\' : \'bg-gray-50 border-l-gray-500\';
                
                const iconBg = notif.type === \'order\' ? \'bg-blue-100 text-blue-600\' : 
                              notif.type === \'warning\' ? \'bg-yellow-100 text-yellow-600\' : 
                              notif.type === \'promo\' ? \'bg-green-100 text-green-600\' :
                              notif.type === \'report\' ? \'bg-purple-100 text-purple-600\' : \'bg-gray-100 text-gray-600\';
                
                const icon = notif.type === \'order\' ? \'📋\' : 
                           notif.type === \'warning\' ? \'⚠️\' : 
                           notif.type === \'promo\' ? \'🎯\' :
                           notif.type === \'report\' ? \'📊\' : \'👤\';
                
                notificationHTML += `
                    <div class="p-6 hover:bg-gray-50 cursor-pointer transition-colors border-l-4 ${bgColor} ${index < notifications.length - 1 ? \'border-b border-gray-100\' : \'\'}">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 ${iconBg} rounded-full flex items-center justify-center text-xl">
                                ${icon}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="text-lg font-semibold text-gray-900">${notif.title}</h4>
                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">${notif.time}</span>
                                </div>
                                <p class="text-gray-700 leading-relaxed">${notif.message}</p>
                                <div class="mt-3 flex space-x-2">
                                    <button class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full hover:bg-blue-200 transition-colors">
                                        Xem chi tiết
                                    </button>
                                    <button class="text-xs bg-gray-100 text-gray-600 px-3 py-1 rounded-full hover:bg-gray-200 transition-colors">
                                        Đánh dấu đã đọc
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            notificationHTML += `
                        </div>
                        <div class="bg-gray-50 p-6 border-t border-gray-200">
                            <div class="flex space-x-3">
                                <button onclick="this.closest(\'.fixed\').remove()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-medium transition-colors">
                                    Xem tất cả thông báo
                                </button>
                                <button onclick="this.closest(\'.fixed\').remove()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-4 rounded-lg font-medium transition-colors">
                                    Đóng
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Thêm popup vào body
            document.body.insertAdjacentHTML(\'beforeend\', notificationHTML);
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement(\'script\');d.innerHTML="window.__CF$cv$params={r:\'98ccb16cf2210988\',t:\'MTc2MDE2ODI1NS4wMDAwMDA=\'};var a=document.createElement(\'script\');a.nonce=\'\';a.src=\'/cdn-cgi/challenge-platform/scripts/jsd/main.js\';document.getElementsByTagName(\'head\')[0].appendChild(a);";b.getElementsByTagName(\'head\')[0].appendChild(d)}}if(document.body){var a=document.createElement(\'iframe\');a.height=1;a.width=1;a.style.position=\'absolute\';a.style.top=0;a.style.left=0;a.style.border=\'none\';a.style.visibility=\'hidden\';document.body.appendChild(a);if(\'loading\'!==document.readyState)c();else if(window.addEventListener)document.addEventListener(\'DOMContentLoaded\',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);\'loading\'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
