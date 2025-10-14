<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống Quản lý Cửa hàng Điện tử</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">

</head>
<body class="bg-gray-50 font-sans">
    <header class="gradient-bg text-white shadow-lg z-50 fixed w-full top-0">
        <div class="flex items-center justify-between px-6 py-4">
            <div class="flex items-center space-x-4">
                <i class="fas fa-store text-2xl"></i>
                <h1 class="text-xl font-bold">Admin Dashboard</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <i class="fas fa-bell text-xl cursor-pointer hover:text-yellow-300 transition-colors"></i>
                    <span class="absolute -top-2 -right-2 bg-red-500 text-xs rounded-full h-5 w-5 flex items-center justify-center animate-pulse">3</span>
                </div>
                <div class="flex items-center space-x-2">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32'%3E%3Ccircle cx='16' cy='16' r='16' fill='%23ffffff'/%3E%3Ctext x='16' y='21' text-anchor='middle' fill='%23667eea' font-family='Arial' font-size='14' font-weight='bold'%3EA%3C/text%3E%3C/svg%3E" alt="Admin" class="w-8 h-8 rounded-full">
                    <span class="font-medium">Admin User</span>
                    <i class="fas fa-chevron-down cursor-pointer"></i>
                </div>
            </div>
        </div>
    </header>

    <div class="flex pt-16">
        <aside class="w-64 bg-white shadow-lg h-screen sticky top-16 overflow-y-auto z-40">
            <nav class="mt-6">
                <div class="px-4 mb-4">
                    <h2 class="text-gray-600 text-sm font-semibold uppercase tracking-wide">Quản lý chính</h2>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('dashboard')">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    <span>Dashboard</span>
                </a>

                <div class="px-4 mt-6 mb-2">
                    <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Quản lý người dùng</h3>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('customers')">
                    <i class="fas fa-users mr-3"></i>
                    <span>Danh sách khách hàng</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('staff')">
                    <i class="fas fa-user-tie mr-3"></i>
                    <span>Danh sách nhân viên</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('permissions')">
                    <i class="fas fa-key mr-3"></i>
                    <span>Phân quyền tài khoản</span>
                </a>

                <div class="px-4 mt-6 mb-2">
                    <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Quản lý sản phẩm</h3>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('products')">
                    <i class="fas fa-box mr-3"></i>
                    <span>Danh sách sản phẩm</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('categories')">
                    <i class="fas fa-tags mr-3"></i>
                    <span>Danh mục sản phẩm</span>
                </a>

                <div class="px-4 mt-6 mb-2">
                    <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Quản lý kho</h3>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('inventory')">
                    <i class="fas fa-warehouse mr-3"></i>
                    <span>Kiểm tra tồn kho</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('stock-alerts')">
                    <i class="fas fa-exclamation-triangle mr-3"></i>
                    <span>Cảnh báo hết hàng</span>
                </a>

                <div class="px-4 mt-6 mb-2">
                    <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Quản lý đơn hàng</h3>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('orders')">
                    <i class="fas fa-shopping-cart mr-3"></i>
                    <span>Danh sách đơn hàng</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('purchase-orders')">
                    <i class="fas fa-file-invoice mr-3"></i>
                    <span>Đơn hàng nhập hàng</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('deliveries')">
                    <i class="fas fa-truck mr-3"></i>
                    <span>Quản lý nhập hàng</span>
                </a>

                <div class="px-4 mt-6 mb-2">
                    <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Chăm sóc khách hàng</h3>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('chat')">
                    <i class="fas fa-headset mr-3"></i>
                    <span>Hỗ trợ trực tuyến</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('returns')">
                    <i class="fas fa-undo mr-3"></i>
                    <span>Yêu cầu trả hàng</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('warranties')">
                    <i class="fas fa-shield-alt mr-3"></i>
                    <span>Lịch hẹn bảo hành</span>
                </a>

                <div class="px-4 mt-6 mb-2">
                    <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Khuyến mãi</h3>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('promotions')">
                    <i class="fas fa-percentage mr-3"></i>
                    <span>Chương trình khuyến mãi</span>
                </a>

                <div class="px-4 mt-6 mb-2">
                    <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Báo cáo</h3>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('reports')">
                    <i class="fas fa-chart-bar mr-3"></i>
                    <span>Báo cáo & thống kê</span>
                </a>
            
                <div class="px-4 mt-6 mb-2">
                    <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Thanh toán</h3>
                </div>
                <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-white cursor-pointer" onclick="showSection('payment-gateway')">
                    <i class="fas fa-credit-card mr-3"></i>
                    <span>Cổng thanh toán</span>
                </a>
    
</nav>
        </aside>

        <main class="flex-1 p-6 animate-fade-in">
            @include('dashboard')

            @include('staff')

            @include('customer')

            @include('products')

            @include('inventory')

            @include('deliveries')

            @include('chat')

            @include('returns')
            
            @include('warranties')

            @include('stock-alerts')

            @include('payments_gateway')

        </main>    

            
        


</main>
    </div>

    

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let currentSection = 'dashboard';
            let selectedChat = null;
            let editingProductId = null;

            const inventory = [
                { id: 1, name: 'MacBook Pro M3 14"', category: 'laptop', sku: 'MBP14-001', currentStock: 15, minStock: 5, price: 52000000, supplier: 'Apple Authorized', lastUpdated: '2025-01-08' },
                { id: 2, name: 'iPhone 15 Pro Max 256GB', category: 'phone', sku: 'IP15PM-256', currentStock: 3, minStock: 10, price: 34000000, supplier: 'Apple Authorized', lastUpdated: '2025-01-07' },
                { id: 3, name: 'Dell XPS 13 Plus', category: 'laptop', sku: 'DL-XPS13P', currentStock: 8, minStock: 5, price: 28000000, supplier: 'Dell Vietnam', lastUpdated: '2025-01-06' },
                { id: 4, name: 'Samsung Galaxy S24 Ultra', category: 'phone', sku: 'SGS24U-512', currentStock: 2, minStock: 8, price: 31000000, supplier: 'Samsung Electronics', lastUpdated: '2025-01-05' },
                { id: 5, name: 'ASUS ROG Strix G16', category: 'laptop', sku: 'ASUS-ROG-G16', currentStock: 12, minStock: 6, price: 35000000, supplier: 'ASUS Vietnam', lastUpdated: '2025-01-08' }
            ];

            const pendingDeliveries = [
                { id: 1, orderId: 'PO-2025-0108-001', supplier: 'Dell Vietnam', product: 'Dell XPS 13 Plus', quantity: 10, arrivalDate: '2025-01-15', status: 'pending' },
                { id: 2, orderId: 'PO-2025-0107-002', supplier: 'Xiaomi Store', product: 'Xiaomi 13 Pro', quantity: 50, arrivalDate: '2025-01-14', status: 'pending' }
            ];

            const activeChats = [
                { id: 1, customerName: 'Nguyễn Văn Minh', status: 'active', lastMessage: 'Cho em hỏi sản phẩm này có bảo hành bao lâu ạ?', timestamp: '14:30', unread: 2, phone: '0901234567', email: 'minh.nv@email.com', messages: [
                    { id: 1, sender: 'customer', message: 'Chào anh/chị!', time: '14:25' },
                    { id: 2, sender: 'support', message: 'Chào bạn! Tôi có thể hỗ trợ gì cho bạn?', time: '14:26' },
                    { id: 3, sender: 'customer', message: 'Em muốn hỏi về MacBook Pro M3 14" có sẵn không ạ?', time: '14:28' },
                    { id: 4, sender: 'support', message: 'Dạ hiện tại chúng tôi có sẵn 15 máy trong kho. Bạn có muốn đặt hàng không?', time: '14:29' },
                    { id: 5, sender: 'customer', message: 'Cho em hỏi sản phẩm này có bảo hành bao lâu ạ?', time: '14:30' }
                ]},
                { id: 2, customerName: 'Trần Thị Lan', status: 'waiting', lastMessage: 'Em cần hỗ trợ về việc trả hàng', timestamp: '14:15', unread: 1, phone: '0912345678', email: 'lan.tt@email.com', messages: [
                    { id: 1, sender: 'customer', message: 'Chào shop!', time: '14:15' },
                    { id: 2, sender: 'customer', message: 'Em cần hỗ trợ về việc trả hàng', time: '14:15' }
                ]},
                { id: 3, customerName: 'Lê Hoàng Nam', status: 'resolved', lastMessage: 'Cảm ơn anh đã hỗ trợ!', timestamp: '13:45', unread: 0, phone: '0923456789', email: 'nam.lh@email.com', messages: [
                    { id: 1, sender: 'customer', message: 'Máy em mua hôm qua bị lỗi màn hình', time: '13:30' },
                    { id: 2, sender: 'support', message: 'Bạn có thể mang máy đến cửa hàng để kiểm tra không?', time: '13:32' },
                    { id: 3, sender: 'customer', message: 'Cảm ơn anh đã hỗ trợ!', time: '13:45' }
                ]}
            ];

            const returnRequests = [
                { id: 1, orderId: 'ORD-2025-0108-001', customerName: 'Phạm Văn Đức', phone: '0934567890', product: 'iPhone 15 Pro Max 256GB', reason: 'Sản phẩm bị lỗi màn hình', requestDate: '2025-01-08', status: 'pending', description: 'Màn hình bị nứt góc trái, không thể sử dụng bình thường', refundAmount: 34000000 },
                { id: 2, orderId: 'ORD-2025-0107-003', customerName: 'Nguyễn Thị Mai', phone: '0945678901', product: 'Dell XPS 13 Plus', reason: 'Không đúng mô tả', requestDate: '2025-01-07', status: 'approved', description: 'Máy có cấu hình khác với mô tả trên website', refundAmount: 28000000 },
                { id: 3, orderId: 'ORD-2025-0106-005', customerName: 'Hoàng Văn Tùng', phone: '0956789012', product: 'Samsung Galaxy S24 Ultra', reason: 'Đổi ý không muốn mua', requestDate: '2025-01-06', status: 'rejected', description: 'Khách hàng đổi ý, sản phẩm đã qua 7 ngày', refundAmount: 0 }
            ];

            const warrantySchedule = [
                { id: 1, customerName: 'Võ Thành Long', phone: '0967890123', product: 'MacBook Pro M3 14"', issue: 'Máy chạy chậm, quạt kêu to', appointmentDate: '2025-01-10', appointmentTime: '09:00', status: 'scheduled', technician: 'Nguyễn Văn Khoa' },
                { id: 2, customerName: 'Đặng Thị Hương', phone: '0978901234', product: 'iPhone 15 Pro Max', issue: 'Màn hình bị sọc', appointmentDate: '2025-01-12', appointmentTime: '14:00', status: 'completed', technician: 'Trần Văn Kiên' }
            ];

            const showToast = (message, duration = 3000) => {
                const toast = document.getElementById('toast-notification');
                document.getElementById('toast-message').textContent = message;
                toast.classList.add('open');
                setTimeout(() => {
                    toast.classList.remove('open');
                }, duration);
            };

            const hideAllSections = () => {
                document.querySelectorAll('.section').forEach(section => {
                    section.classList.add('hidden');
                });
            };

            const updateSidebarActiveState = (sectionId) => {
                document.querySelectorAll('.sidebar-item').forEach(item => item.classList.remove('active'));
                const activeItem = document.querySelector(`[onclick="showSection('${sectionId}')"]`);
                if (activeItem) {
                    activeItem.classList.add('active');
                }
            };

            window.showSection = (sectionId) => {
                hideAllSections();
                const section = document.getElementById(sectionId);
                if (section) {
                    section.classList.remove('hidden');
                    section.classList.add('animate-fade-in');
                    currentSection = sectionId;
                    updateSidebarActiveState(sectionId);
                    updateView();
                }
            };
            
            const updateView = () => {
                switch (currentSection) {
                    case 'products':
                        renderProducts();
                        break;
                    case 'inventory':
                        renderInventory();
                        break;
                    case 'deliveries':
                        renderDeliveries();
                        break;
                    case 'chat':
                        renderChatList();
                        renderChatWindow(selectedChat);
                        break;
                    case 'returns':
                        renderReturns();
                        break;
                    case 'warranties':
                        renderWarranties();
                        break;
                    case 'stock-alerts':
                        renderStockAlerts();
                        break;
                }
            };

            const renderProducts = () => {
                const tableBody = document.getElementById('product-table-body');
                const productSearch = document.getElementById('product-search-input').value.toLowerCase();
                const productCategoryFilter = document.getElementById('product-category-filter').value;
                
                const filteredProducts = inventory.filter(p => 
                    (p.name.toLowerCase().includes(productSearch) || p.sku.toLowerCase().includes(productSearch)) &&
                    (productCategoryFilter === 'all' || p.category === productCategoryFilter)
                );

                tableBody.innerHTML = filteredProducts.map(p => `
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">${p.name}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">${p.sku}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">${p.category === 'laptop' ? 'Laptop' : 'Điện thoại'}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${p.currentStock}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${p.price.toLocaleString('vi-VN')} VND</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                            <button class="text-blue-600 hover:text-blue-900 mr-3 edit-product-btn" data-id="${p.id}">Sửa</button>
                            <button class="text-red-600 hover:text-red-900 delete-product-btn" data-id="${p.id}">Xóa</button>
                        </td>
                    </tr>
                `).join('');

                bindProductTableEvents();
            };

            const bindProductTableEvents = () => {
                document.querySelectorAll('.edit-product-btn').forEach(button => {
                    button.addEventListener('click', (e) => openProductModal(parseInt(e.currentTarget.dataset.id)));
                });
                document.querySelectorAll('.delete-product-btn').forEach(button => {
                    button.addEventListener('click', (e) => showConfirmModal(
                        'Xác nhận xóa sản phẩm',
                        'Bạn có chắc chắn muốn xóa sản phẩm này khỏi hệ thống không?',
                        () => handleDeleteProduct(parseInt(e.currentTarget.dataset.id))
                    ));
                });
            };
            
            const handleDeleteProduct = (id) => {
                const index = inventory.findIndex(p => p.id === id);
                if (index !== -1) {
                    inventory.splice(index, 1);
                    updateView();
                    showToast('Sản phẩm đã được xóa thành công.');
                }
            };

            const renderInventory = () => {
                const tableBody = document.getElementById('inventory-table-body');
                const inventorySearch = document.getElementById('inventory-search').value.toLowerCase();
                const categoryFilter = document.getElementById('inventory-category-filter').value;
                const statusFilter = document.getElementById('inventory-status-filter').value;

                const filteredInventory = inventory.filter(p => {
                    const matchesSearch = p.name.toLowerCase().includes(inventorySearch) || p.sku.toLowerCase().includes(inventorySearch);
                    const matchesCategory = categoryFilter === 'all' || p.category === categoryFilter;
                    
                    let matchesStatus = false;
                    if (statusFilter === 'all') matchesStatus = true;
                    else if (statusFilter === 'instock' && p.currentStock > p.minStock) matchesStatus = true;
                    else if (statusFilter === 'lowstock' && p.currentStock <= p.minStock && p.currentStock > 0) matchesStatus = true;
                    else if (statusFilter === 'outofstock' && p.currentStock === 0) matchesStatus = true;
                    
                    return matchesSearch && matchesCategory && matchesStatus;
                });

                tableBody.innerHTML = filteredInventory.map(p => {
                    let statusClass = 'bg-green-100 text-green-800';
                    let statusText = 'Còn hàng';
                    if (p.currentStock <= p.minStock && p.currentStock > 0) {
                        statusClass = 'bg-yellow-100 text-yellow-800';
                        statusText = 'Sắp hết';
                    } else if (p.currentStock === 0) {
                        statusClass = 'bg-red-100 text-red-800';
                        statusText = 'Hết hàng';
                    }

                    return `
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">${p.name}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">${p.sku}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">${p.category === 'laptop' ? 'Laptop' : 'Điện thoại'}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${p.currentStock}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${p.minStock}</td>
                            <td class="px-4 py-3 whitespace-nowrap"><span class="px-2 py-1 rounded text-sm font-semibold ${statusClass}">${statusText}</span></td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-product-btn" data-id="${p.id}">Sửa</button>
                                <button class="text-red-600 hover:text-red-900 delete-product-btn" data-id="${p.id}">Xóa</button>
                            </td>
                        </tr>
                    `;
                }).join('');

                bindProductTableEvents();
            };

            const renderDeliveries = () => {
                const tableBody = document.getElementById('deliveries-table-body');
                tableBody.innerHTML = pendingDeliveries.map(d => `
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${d.orderId}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${d.supplier}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${d.product}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${d.quantity}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${d.arrivalDate}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2 py-1 rounded text-xs font-semibold ${d.status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800'}">
                                ${d.status === 'pending' ? 'Đang chờ' : 'Đã nhận'}
                            </span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs confirm-delivery" data-delivery-id="${d.id}">Nhận hàng</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs reject-delivery ml-2" data-delivery-id="${d.id}">Từ chối</button>
                        </td>
                    </tr>
                `).join('');

                document.querySelectorAll('.confirm-delivery').forEach(button => {
                    button.addEventListener('click', (e) => handleConfirmDelivery(parseInt(e.currentTarget.dataset.deliveryId)));
                });
                document.querySelectorAll('.reject-delivery').forEach(button => {
                    button.addEventListener('click', (e) => handleRejectDelivery(parseInt(e.currentTarget.dataset.deliveryId)));
                });
            };

            const renderChatList = () => {
                const chatList = document.getElementById('chat-list');
                chatList.innerHTML = activeChats.map(chat => `
                    <div class="flex items-center p-3 my-2 cursor-pointer rounded-lg hover:bg-gray-200 transition-colors ${selectedChat && selectedChat.id === chat.id ? 'bg-gray-200' : ''}" onclick="selectChat(${chat.id})">
                        <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-gray-700 font-bold text-lg mr-3">
                            ${chat.customerName.charAt(0)}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold truncate-text">${chat.customerName}</h4>
                                <span class="text-xs text-gray-500">${chat.timestamp}</span>
                            </div>
                            <p class="text-sm text-gray-600 truncate-text">${chat.lastMessage}</p>
                        </div>
                        ${chat.unread > 0 ? `<span class="bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center ml-2">${chat.unread}</span>` : ''}
                    </div>
                `).join('');
            };

            const renderChatWindow = (chat) => {
                const chatWindow = document.getElementById('chat-window');
                if (!chat) {
                    chatWindow.innerHTML = `
                        <div id="chat-placeholder" class="text-center text-gray-400 mt-20">
                            <i class="fas fa-comments text-6xl mb-4"></i>
                            <p class="text-lg">Chọn một cuộc trò chuyện để bắt đầu</p>
                        </div>
                    `;
                    return;
                }

                chatWindow.innerHTML = `
                    <div class="flex-shrink-0 border-b pb-4 mb-4">
                        <h3 class="text-xl font-bold">${chat.customerName}</h3>
                        <p class="text-sm text-gray-600">
                            <span class="mr-4"><i class="fas fa-phone mr-1"></i> ${chat.phone}</span>
                            <span><i class="fas fa-envelope mr-1"></i> ${chat.email}</span>
                        </p>
                    </div>
                    <div id="messages-container" class="flex-1 overflow-y-auto space-y-4">
                        ${chat.messages.map(msg => `
                            <div class="flex ${msg.sender === 'support' ? 'justify-end' : 'justify-start'}">
                                <div class="message-bubble px-4 py-2 rounded-lg ${msg.sender === 'support' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800'}">
                                    ${msg.message}
                                    <div class="text-right text-xs mt-1 opacity-70">${msg.time}</div>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                    <div class="flex-shrink-0 mt-4">
                        <div class="flex items-center space-x-2">
                            <input type="text" id="chat-input" placeholder="Nhập tin nhắn..." class="flex-1 border rounded-full px-4 py-2">
                            <button class="bg-blue-600 text-white rounded-full h-10 w-10 flex items-center justify-center hover:bg-blue-700">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                `;
                document.getElementById('messages-container').scrollTop = document.getElementById('messages-container').scrollHeight;
            };

            const renderReturns = () => {
                const tableBody = document.getElementById('returns-table-body');
                tableBody.innerHTML = returnRequests.map(req => {
                    let statusClass = '';
                    if (req.status === 'pending') {
                        statusClass = 'bg-yellow-100 text-yellow-800';
                    } else if (req.status === 'approved') {
                        statusClass = 'bg-green-100 text-green-800';
                    } else if (req.status === 'rejected') {
                        statusClass = 'bg-red-100 text-red-800';
                    }

                    return `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.orderId}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.customerName}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.product}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.reason}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.requestDate}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold ${statusClass}">${req.status === 'pending' ? 'Đang chờ' : req.status === 'approved' ? 'Đã duyệt' : 'Từ chối'}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-2 action-btn" data-request-id="${req.id}" data-action="approved">Duyệt</button>
                                <button class="text-red-600 hover:text-red-900 action-btn" data-request-id="${req.id}" data-action="rejected">Từ chối</button>
                            </td>
                        </tr>
                    `;
                }).join('');

                document.querySelectorAll('.action-btn').forEach(button => {
                    button.addEventListener('click', (e) => {
                        const id = parseInt(e.currentTarget.dataset.requestId);
                        const action = e.currentTarget.dataset.action;
                        const item = returnRequests.find(r => r.id === id);
                        if (item) {
                            item.status = action;
                            showToast(`Yêu cầu đã được ${action === 'approved' ? 'chấp nhận' : 'từ chối'}!`);
                            renderReturns();
                        }
                    });
                });
            };

            const renderWarranties = () => {
                const tableBody = document.getElementById('warranties-table-body');
                tableBody.innerHTML = warrantySchedule.map(req => {
                    const statusClass = req.status === 'scheduled' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800';
                    const statusText = req.status === 'scheduled' ? 'Đã lên lịch' : 'Đã hoàn thành';
                    return `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.customerName}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.product}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.issue}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.appointmentDate} ${req.appointmentTime}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.technician}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold ${statusClass}">${statusText}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900">Chi tiết</button>
                            </td>
                        </tr>
                    `;
                }).join('');
            };
            
            const renderStockAlerts = () => {
                const tableBody = document.getElementById('stock-alerts-table-body');
                const lowStockProducts = inventory.filter(p => p.currentStock <= p.minStock);

                tableBody.innerHTML = lowStockProducts.map(p => {
                    const statusClass = p.currentStock === 0 ? 'bg-red-100 text-red-800' : 'bg-orange-100 text-orange-800';
                    const statusText = p.currentStock === 0 ? 'Hết hàng' : 'Sắp hết';
                    return `
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">${p.name}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">${p.sku}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${p.currentStock}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">${p.minStock}</td>
                            <td class="px-4 py-3 whitespace-nowrap"><span class="px-2 py-1 rounded text-sm font-semibold ${statusClass}">${statusText}</span></td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-product-btn" data-id="${p.id}">Nhập thêm</button>
                            </td>
                        </tr>
                    `;
                }).join('');
                bindProductTableEvents();
            };

            const productModal = document.getElementById('product-modal');
            const productForm = document.getElementById('product-form');

            window.openProductModal = (id = null) => {
                editingProductId = id;
                const product = id ? inventory.find(p => p.id === id) : null;
                document.getElementById('modal-title').innerText = id ? 'Chỉnh sửa sản phẩm' : 'Thêm sản phẩm mới';
                if (product) {
                    document.getElementById('product-name').value = product.name;
                    document.getElementById('product-category').value = product.category;
                    document.getElementById('product-sku').value = product.sku;
                    document.getElementById('product-stock').value = product.currentStock;
                    document.getElementById('product-min-stock').value = product.minStock;
                    document.getElementById('product-price').value = product.price;
                } else {
                    productForm.reset();
                }
                productModal.classList.add('open');
            };
            const closeProductModal = () => {
                productModal.classList.remove('open');
                editingProductId = null;
            };
            productForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const newProduct = {
                    name: document.getElementById('product-name').value,
                    category: document.getElementById('product-category').value,
                    sku: document.getElementById('product-sku').value,
                    currentStock: parseInt(document.getElementById('product-stock').value),
                    minStock: parseInt(document.getElementById('product-min-stock').value),
                    price: parseInt(document.getElementById('product-price').value),
                    lastUpdated: new Date().toISOString().split('T')[0]
                };
                if (editingProductId !== null) {
                    const index = inventory.findIndex(p => p.id === editingProductId);
                    if (index !== -1) {
                        inventory[index] = { ...inventory[index], ...newProduct };
                        showToast('Sản phẩm đã được cập nhật thành công!');
                    }
                } else {
                    newProduct.id = inventory.length > 0 ? Math.max(...inventory.map(p => p.id)) + 1 : 1;
                    inventory.push(newProduct);
                    showToast('Sản phẩm mới đã được thêm thành công!');
                }
                closeProductModal();
                updateView();
            });
            document.getElementById('cancel-modal').addEventListener('click', closeProductModal);
            productModal.addEventListener('click', (e) => {
                if (e.target === productModal) {
                    closeProductModal();
                }
            });

            const confirmModal = document.getElementById('confirm-modal');
            let confirmCallback = null;

            const showConfirmModal = (title, message, callback) => {
                document.getElementById('confirm-modal-title').innerText = title;
                document.getElementById('confirm-modal-message').innerText = message;
                confirmModal.classList.add('open');
                confirmCallback = callback;
            };

            const closeConfirmModal = () => {
                confirmModal.classList.remove('open');
            };

            document.getElementById('confirm-action').addEventListener('click', () => {
                if (confirmCallback) {
                    confirmCallback();
                }
                closeConfirmModal();
            });

            document.getElementById('cancel-confirm').addEventListener('click', closeConfirmModal);

            window.selectChat = (chatId) => {
                selectedChat = activeChats.find(chat => chat.id === chatId);
                if (selectedChat) {
                    selectedChat.unread = 0;
                }
                renderChatList();
                renderChatWindow(selectedChat);
            };

            const handleConfirmDelivery = (id) => {
                showConfirmModal(
                    'Xác nhận nhận hàng',
                    'Bạn có chắc chắn muốn xác nhận lô hàng này đã được nhập kho?',
                    () => {
                        const deliveryIndex = pendingDeliveries.findIndex(d => d.id === id);
                        if (deliveryIndex !== -1) {
                            const delivery = pendingDeliveries[deliveryIndex];
                            const product = inventory.find(p => p.name === delivery.product);
                            if (product) {
                                product.currentStock += delivery.quantity;
                                pendingDeliveries.splice(deliveryIndex, 1);
                                showToast(`Đã nhập thành công ${delivery.quantity} sản phẩm ${delivery.product} vào kho.`);
                                updateView();
                            } else {
                                showToast('Lỗi: Sản phẩm không tồn tại trong kho.');
                            }
                        }
                    }
                );
            };

            const handleRejectDelivery = (id) => {
                showConfirmModal(
                    'Từ chối lô hàng',
                    'Bạn có chắc chắn muốn từ chối lô hàng này? Thao tác này không thể hoàn tác.',
                    () => {
                        const deliveryIndex = pendingDeliveries.findIndex(d => d.id === id);
                        if (deliveryIndex !== -1) {
                            pendingDeliveries.splice(deliveryIndex, 1);
                            showToast('Đã từ chối lô hàng thành công.');
                            updateView();
                        }
                    }
                );
            };

            document.getElementById('product-search-input').addEventListener('input', renderProducts);
            document.getElementById('product-category-filter').addEventListener('change', renderProducts);
            document.getElementById('inventory-search').addEventListener('input', renderInventory);
            document.getElementById('inventory-category-filter').addEventListener('change', renderInventory);
            document.getElementById('inventory-status-filter').addEventListener('change', renderInventory);

            showSection('dashboard');
        });
    </script>

<script>
window.currentSection = window.currentSection || 'dashboard';
window.showSection = function(id){
  document.querySelectorAll('.section').forEach(s => s.classList.add('hidden'));
  const t = document.getElementById(id); if (t) t.classList.remove('hidden');
  window.currentSection = id;
};
</script>

</body>
</html>