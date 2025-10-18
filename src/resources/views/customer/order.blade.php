@extends('customer.layout')
@section('title', 'Đơn hàng')

@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Đơn Hàng Của Tôi</h1>
            <p class="text-gray-600">Theo dõi và quản lý các đơn hàng của bạn</p>
        </header>

        <!-- Filter Tabs -->
        <div class="bg-white rounded-lg shadow-sm mb-6 p-1">
            <div class="flex flex-wrap gap-1">
                <button onclick="filterOrders('all')" class="filter-btn active px-4 py-2 rounded-md text-sm font-medium transition-colors bg-blue-500 text-white">
                    Tất cả (4)
                </button>
                <button onclick="filterOrders('processing')" class="filter-btn px-4 py-2 rounded-md text-sm font-medium transition-colors text-gray-600 hover:bg-gray-100">
                    Đang xử lý (1)
                </button>
                <button onclick="filterOrders('shipping')" class="filter-btn px-4 py-2 rounded-md text-sm font-medium transition-colors text-gray-600 hover:bg-gray-100">
                    Đang giao (2)
                </button>
                <button onclick="filterOrders('delivered')" class="filter-btn px-4 py-2 rounded-md text-sm font-medium transition-colors text-gray-600 hover:bg-gray-100">
                    Đã giao (1)
                </button>
            </div>
        </div>

        <!-- Orders List -->
        <div class="space-y-6" id="ordersList">
            <!-- Order 1 - Processing -->
            <div class="order-card bg-white rounded-xl shadow-sm border border-gray-200 p-6" data-status="processing">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-4">
                    <div class="flex items-center gap-4 mb-4 lg:mb-0">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Đơn hàng #DH001234</h3>
                            <p class="text-sm text-gray-500">Đặt ngày: 15/12/2024</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="status-badge bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                            🔄 Đang xử lý
                        </span>
                        <span class="text-lg font-bold text-gray-800">2.450.000₫</span>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4 mb-4">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60' viewBox='0 0 60 60'%3E%3Crect width='60' height='60' fill='%23e5e7eb'/%3E%3Crect x='15' y='15' width='30' height='30' fill='%23374151'/%3E%3Ctext x='30' y='35' text-anchor='middle' fill='white' font-size='12'%3EiPhone%3C/text%3E%3C/svg%3E" alt="iPhone 15 Pro" class="w-15 h-15 rounded-lg object-cover">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800">iPhone 15 Pro 256GB</h4>
                            <p class="text-sm text-gray-500">Màu: Titan Tự Nhiên</p>
                            <p class="text-sm text-gray-500">Số lượng: 1</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60' viewBox='0 0 60 60'%3E%3Crect width='60' height='60' fill='%23e5e7eb'/%3E%3Crect x='10' y='20' width='40' height='20' fill='%23374151'/%3E%3Ctext x='30' y='35' text-anchor='middle' fill='white' font-size='10'%3EAirPods%3C/text%3E%3C/svg%3E" alt="AirPods Pro" class="w-15 h-15 rounded-lg object-cover">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800">AirPods Pro (Gen 2)</h4>
                            <p class="text-sm text-gray-500">Màu: Trắng</p>
                            <p class="text-sm text-gray-500">Số lượng: 1</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button onclick="viewOrderDetails('DH001234')" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        Xem chi tiết
                    </button>
                    <button onclick="cancelOrder('DH001234')" class="flex-1 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        Hủy đơn hàng
                    </button>
                </div>
            </div>

            <!-- Order 2 - Shipping -->
            <div class="order-card bg-white rounded-xl shadow-sm border border-gray-200 p-6" data-status="shipping">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-4">
                    <div class="flex items-center gap-4 mb-4 lg:mb-0">
                        <div class="bg-green-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Đơn hàng #DH001235</h3>
                            <p class="text-sm text-gray-500">Đặt ngày: 12/12/2024</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="status-badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                            🚚 Đang giao hàng
                        </span>
                        <span class="text-lg font-bold text-gray-800">1.890.000₫</span>
                    </div>
                </div>

                <div class="grid md:grid-cols-1 gap-4 mb-4">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60' viewBox='0 0 60 60'%3E%3Crect width='60' height='60' fill='%23e5e7eb'/%3E%3Crect x='5' y='15' width='50' height='30' fill='%23374151'/%3E%3Ctext x='30' y='35' text-anchor='middle' fill='white' font-size='10'%3EMacBook%3C/text%3E%3C/svg%3E" alt="MacBook Air" class="w-15 h-15 rounded-lg object-cover">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800">MacBook Air M2 13" 256GB</h4>
                            <p class="text-sm text-gray-500">Màu: Xám Không Gian</p>
                            <p class="text-sm text-gray-500">Số lượng: 1</p>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium text-blue-800">Thông tin vận chuyển</span>
                    </div>
                    <p class="text-sm text-blue-700">Đơn hàng đang trên đường giao đến bạn. Dự kiến giao: 17/12/2024</p>
                    <p class="text-sm text-blue-600 font-medium">Mã vận đơn: VD123456789</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button onclick="trackOrder('VD123456789')" class="flex-1 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        Theo dõi đơn hàng
                    </button>
                    <button onclick="viewOrderDetails('DH001235')" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        Xem chi tiết
                    </button>
                </div>
            </div>

            <!-- Order 3 - Shipping -->
            <div class="order-card bg-white rounded-xl shadow-sm border border-gray-200 p-6" data-status="shipping">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-4">
                    <div class="flex items-center gap-4 mb-4 lg:mb-0">
                        <div class="bg-orange-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Đơn hàng #DH001236</h3>
                            <p class="text-sm text-gray-500">Đặt ngày: 10/12/2024</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="status-badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                            🚚 Đang giao hàng
                        </span>
                        <span class="text-lg font-bold text-gray-800">850.000₫</span>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4 mb-4">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60' viewBox='0 0 60 60'%3E%3Crect width='60' height='60' fill='%23e5e7eb'/%3E%3Ccircle cx='30' cy='30' r='20' fill='%23374151'/%3E%3Ctext x='30' y='35' text-anchor='middle' fill='white' font-size='10'%3EWatch%3C/text%3E%3C/svg%3E" alt="Apple Watch" class="w-15 h-15 rounded-lg object-cover">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800">Apple Watch Series 9</h4>
                            <p class="text-sm text-gray-500">Màu: Hồng, Dây Sport</p>
                            <p class="text-sm text-gray-500">Số lượng: 1</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60' viewBox='0 0 60 60'%3E%3Crect width='60' height='60' fill='%23e5e7eb'/%3E%3Crect x='15' y='20' width='30' height='20' fill='%23374151'/%3E%3Ctext x='30' y='35' text-anchor='middle' fill='white' font-size='8'%3ECharger%3C/text%3E%3C/svg%3E" alt="Charger" class="w-15 h-15 rounded-lg object-cover">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800">Sạc MagSafe 15W</h4>
                            <p class="text-sm text-gray-500">Màu: Trắng</p>
                            <p class="text-sm text-gray-500">Số lượng: 1</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button onclick="trackOrder('VD123456790')" class="flex-1 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        Theo dõi đơn hàng
                    </button>
                    <button onclick="viewOrderDetails('DH001236')" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        Xem chi tiết
                    </button>
                </div>
            </div>

            <!-- Order 4 - Delivered -->
            <div class="order-card bg-white rounded-xl shadow-sm border border-gray-200 p-6" data-status="delivered">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-4">
                    <div class="flex items-center gap-4 mb-4 lg:mb-0">
                        <div class="bg-green-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Đơn hàng #DH001237</h3>
                            <p class="text-sm text-gray-500">Đặt ngày: 05/12/2024</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                            ✅ Đã giao hàng
                        </span>
                        <span class="text-lg font-bold text-gray-800">1.200.000₫</span>
                    </div>
                </div>

                <div class="grid md:grid-cols-1 gap-4 mb-4">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60' viewBox='0 0 60 60'%3E%3Crect width='60' height='60' fill='%23e5e7eb'/%3E%3Crect x='10' y='15' width='40' height='30' fill='%23374151'/%3E%3Ctext x='30' y='35' text-anchor='middle' fill='white' font-size='10'%3EiPad%3C/text%3E%3C/svg%3E" alt="iPad" class="w-15 h-15 rounded-lg object-cover">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800">iPad Air 10.9" 64GB WiFi</h4>
                            <p class="text-sm text-gray-500">Màu: Xanh Dương</p>
                            <p class="text-sm text-gray-500">Số lượng: 1</p>
                        </div>
                    </div>
                </div>

                <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-sm font-medium text-green-800">Đã giao thành công</span>
                    </div>
                    <p class="text-sm text-green-700">Giao hàng thành công ngày 08/12/2024 lúc 14:30</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button onclick="reviewProduct('DH001237')" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        ⭐ Đánh giá sản phẩm
                    </button>
                    <button onclick="reorderProduct('DH001237')" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        Mua lại
                    </button>
                    <button onclick="viewOrderDetails('DH001237')" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        Xem chi tiết
                    </button>
                </div>
            </div>
        </div>

        <!-- Empty State (hidden by default) -->
        <div id="emptyState" class="hidden text-center py-12">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-800 mb-2">Không có đơn hàng nào</h3>
                <p class="text-gray-500 mb-6">Bạn chưa có đơn hàng nào trong danh mục này</p>
                <button onclick="window.open('https://example.com/shop', '_blank')" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                    Tiếp tục mua sắm
                </button>
            </div>
        </div>
    </main>
</div>


<!-- Order Details Modal -->
<div id="orderModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800">Chi tiết đơn hàng</h2>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-6" id="modalContent">
                <!-- Content will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <script>

        // ==== SAMPLE ORDER DATA (để demo "Xem chi tiết" & "Mua lại") ====
        const ORDER_DETAILS = {
            'DH001234': {
                id: 'DH001234',
                date: '15/12/2024',
                status: 'Đang xử lý',
                total: '2.450.000₫',
                address: '123 Nguyễn Văn Linh, Quận 7, TP.HCM',
                phone: '0901234567',
                items: [
                { name: 'iPhone 15 Pro 256GB', price: '29.990.000₫', qty: 1, variant: {color: 'Titan Tự Nhiên'} },
                { name: 'AirPods Pro (Gen 2)',  price: '6.490.000₫',  qty: 1, variant: {color: 'Trắng'} }
                ]
            },
            'DH001235': {
                id: 'DH001235',
                date: '12/12/2024',
                status: 'Đang giao hàng',
                total: '1.890.000₫',
                address: '12 Lý Thường Kiệt, Q10, TP.HCM',
                phone: '0900000001',
                items: [
                { name: 'MacBook Air M2 13" 256GB', price: '27.990.000₫', qty: 1, variant: {color: 'Xám Không Gian'} }
                ]
            },
            'DH001236': {
                id: 'DH001236',
                date: '10/12/2024',
                status: 'Đang giao hàng',
                total: '850.000₫',
                address: '78 Đinh Tiên Hoàng, Q1, TP.HCM',
                phone: '0900000002',
                items: [
                { name: 'Apple Watch Series 9', price: '10.990.000₫', qty: 1, variant: {color:'Hồng'} },
                { name: 'Sạc MagSafe 15W',     price: '1.290.000₫',  qty: 1, variant: {color:'Trắng'} }
                ]
            },
            'DH001237': {
                id: 'DH001237',
                date: '05/12/2024',
                status: 'Đã giao hàng',
                total: '1.200.000₫',
                address: '45 Võ Văn Ngân, TP. Thủ Đức',
                phone: '0900000003',
                items: [
                { name: 'iPad Air 10.9" 64GB WiFi', price: '13.990.000₫', qty: 1, variant: {color:'Xanh Dương'} }
                ]
            },
        };

        // ==== CART HELPERS (đồng bộ với trang giỏ) ====
        function parseVND(str) {
            if (typeof str === 'number') return str;
                return Number(String(str).replace(/[^\d]/g, '')) || 0;
            }

        function slugify(str='') {
            return String(str)
                .normalize('NFKD').replace(/[\u0300-\u036f]/g, '')
                .toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
        }
        function buildSkuKey(name, variant = {}) {
            const n = slugify(name||'');
            const storage = slugify(variant?.storage||'');
            const color = slugify(variant?.color||'');
            return [n, storage, color].join('|');
        }

        function getCartArray() {
            try { return JSON.parse(localStorage.getItem('cart')||'[]'); } catch { return []; }
        }
        function saveCartArray(arr) {
            localStorage.setItem('cart', JSON.stringify(arr));
        }

        // Hợp nhất item vào mảng cart (gộp theo SKU)
        function upsertCartItem(cartArr, {name, price, qty=1, variant={}, image='default'}) {
            const key = buildSkuKey(name, variant);
            const idx = cartArr.findIndex(x => buildSkuKey(x.name, x.variant||{}) === key);
            if (idx === -1) {
                cartArr.push({
                id: key,
                name,
                price: Number(price) || 0,
                quantity: Number(qty) || 1,
                image,
                selected: true,
                variant: { storage: variant?.storage||'', color: variant?.color||'' }
                });
            } else {
                cartArr[idx].quantity = Number(cartArr[idx].quantity||0) + (Number(qty)||1);
                cartArr[idx].price = Number(price) || cartArr[idx].price; // giữ giá mới nhất
                cartArr[idx].selected = true;
            }
        }

        function toast(msg, type='success') {
            const el = document.createElement('div');
            el.className = `fixed top-4 right-4 z-[9999] px-4 py-2 rounded-lg text-white ${type==='success'?'bg-green-500':'bg-red-500'}`;
            el.textContent = msg;
            document.body.appendChild(el);
            setTimeout(()=>el.remove(), 2500);
        }


        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners for modal
            const modal = document.getElementById('orderModal');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeModal();
                    }
                });
            }
        });

        function filterOrders(status) {
            const orders = document.querySelectorAll('.order-card');
            const filterBtns = document.querySelectorAll('.filter-btn');
            const emptyState = document.getElementById('emptyState');
            
            // Update active button
            filterBtns.forEach(btn => {
                btn.classList.remove('active', 'bg-blue-500', 'text-white');
                btn.classList.add('text-gray-600', 'hover:bg-gray-100');
            });
            event.target.classList.add('active', 'bg-blue-500', 'text-white');
            event.target.classList.remove('text-gray-600', 'hover:bg-gray-100');
            
            let visibleCount = 0;
            
            orders.forEach(order => {
                if (status === 'all' || order.dataset.status === status) {
                    order.style.display = 'block';
                    visibleCount++;
                } else {
                    order.style.display = 'none';
                }
            });
            
            // Show/hide empty state
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }

        function viewOrderDetails(orderId) {
            const modal = document.getElementById('orderModal');
            const modalContent = document.getElementById('modalContent');
            const order = ORDER_DETAILS[orderId] || ORDER_DETAILS['DH001234'];

            const computedTotal = formatVND(sumOrderItems(order));

            modal.classList.remove('hidden');
            modalContent.innerHTML = `
                <div class="space-y-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                    <h3 class="font-semibold text-gray-800 mb-3">Thông tin đơn hàng</h3>
                    <div class="space-y-2 text-sm">
                        <p><span class="text-gray-500">Mã đơn hàng:</span> ${order.id}</p>
                        <p><span class="text-gray-500">Ngày đặt:</span> ${order.date}</p>
                        <p><span class="text-gray-500">Trạng thái:</span> <span class="text-blue-600 font-medium">${order.status}</span></p>
                        <p><span class="text-gray-500">Tổng tiền:</span> <span class="font-bold text-lg">${computedTotal}</span></p>
                    </div>
                    </div>
                    <div>
                    <h3 class="font-semibold text-gray-800 mb-3">Thông tin giao hàng</h3>
                    <div class="space-y-2 text-sm">
                        <p><span class="text-gray-500">Địa chỉ:</span> ${order.address}</p>
                        <p><span class="text-gray-500">Số điện thoại:</span> ${order.phone}</p>
                        <p><span class="text-gray-500">Phương thức:</span> Giao hàng tiêu chuẩn</p>
                    </div>
                    </div>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-800 mb-3">Sản phẩm đã đặt</h3>
                    <div class="space-y-3">
                    ${order.items.map(item => `
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium">${item.name}</p>
                            <p class="text-sm text-gray-500">
                            Số lượng: ${item.qty}
                            ${item?.variant?.color ? ` • Màu: ${item.variant.color}` : ''}
                            </p>
                        </div>
                        <p class="font-medium">${formatVND(parseVND(item.price))}</p>
                        </div>
                    `).join('')}
                    </div>
                </div>
                </div>
            `;

            // Sau khi mở modal cũng sync lại card ngoài (phòng khi dữ liệu đã đổi)
            syncOrderCardFromDetails(order.id);
            }


        function closeModal() {
            const modal = document.getElementById('orderModal');
            const modalContent = modal.querySelector('.bg-white');
            modalContent.classList.remove('modal-show');
            modalContent.classList.add('modal-hide');
            
            // Wait for animation to finish before hiding modal
            setTimeout(() => {
                modal.classList.add('hidden');
                modalContent.classList.remove('modal-hide');
            }, 300);
        }

        function cancelOrder(orderId) {
            if (!confirm(`Bạn có chắc chắn muốn xóa (ẩn) đơn hàng ${orderId}?`)) return;

            // Cập nhật UI thẻ đơn tương ứng
            const card = [...document.querySelectorAll('.order-card')]
                .find(el => el.querySelector('h3')?.textContent?.includes(`#${orderId}`));
            if (!card) { alert('Không tìm thấy thẻ đơn hàng trên trang.'); return; }

            // Đổi badge trạng thái
            const badge = card.querySelector('.status-badge');
            if (badge) {
                badge.textContent = '🗑️ Đã xoá';
                badge.className = 'status-badge px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600';
            }

            // Áp class mờ toàn card + vô hiệu nút "Hủy đơn hàng"
            card.classList.add('order-deleted');
            const cancelBtn = [...card.querySelectorAll('button')].find(b=>b.textContent?.trim().includes('Hủy đơn hàng'));
            if (cancelBtn) {
                cancelBtn.disabled = true;
                cancelBtn.classList.add('opacity-60','cursor-not-allowed');
            }

            toast(`Đơn hàng ${orderId} đã được xoá (ẩn).`, 'success');
        }


        function trackOrder(trackingId) {
            // mở/scroll tới panel theo dõi và đảm bảo đã bật realtime
            startLiveTracking(trackingId);
            // cuộn đến card chứa trackingId
            const card = [...document.querySelectorAll('.order-card')]
                .find(el => el.innerText.includes(trackingId));
            if (card) card.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }


        // ==== BASE URL trang review (Blade sẽ render URL đúng) ====
        const REVIEW_URL_BASE = "{{ url('/customer/review') }}";

        // Giữ nguyên các hàm slugify/buildSkuKey bạn đang có
        function slugify(str='') {
            return String(str)
                .normalize('NFKD').replace(/[\u0300-\u036f]/g, '')
                .toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
        }
        function buildSkuKey(name, variant = {}) {
            const n = slugify(name||'');
            const storage = slugify(variant?.storage||'');
            const color = slugify(variant?.color||'');
            return [n, storage, color].join('|');
        }

        // === Tạo URL để nhảy sang review và focus đúng sản phẩm ===
        function buildReviewUrl(item, orderId) {
            const sku = buildSkuKey(item?.name || '', item?.variant || {});
            const params = new URLSearchParams({
                order: orderId,
                sku: sku,
                name: item?.name || '',
                color: item?.variant?.color || ''
            });
            return `${REVIEW_URL_BASE}?${params.toString()}`;
        }

        // === Chỉ cho review nếu đơn đã "Đã giao hàng" & điều hướng đúng sản phẩm ===
        function reviewProduct(orderId) {
            const order = ORDER_DETAILS[orderId];
            if (!order) {
                alert(`Không tìm thấy đơn ${orderId}.`); return;
            }
            // Chỉ cho đánh giá khi đã giao
            if ((order.status || '').toLowerCase().includes('đã giao') === false) {
                alert('Đơn này chưa giao xong, chưa thể đánh giá sản phẩm.');
                return;
            }

            // 1 sản phẩm -> nhảy thẳng
            if (order.items?.length === 1) {
                const url = buildReviewUrl(order.items[0], orderId);
                window.location.href = url;
                return;
            }

            // Nhiều sản phẩm -> mở modal chọn và mỗi nút "⭐ Đánh giá" sẽ build URL riêng
            const modal = document.getElementById('orderModal');
            const modalContent = document.getElementById('modalContent');
            modal.classList.remove('hidden');

            modalContent.innerHTML = `
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800">Chọn sản phẩm để đánh giá</h3>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="space-y-3">
                        ${order.items.map(it => {
                            const url = buildReviewUrl(it, orderId);
                            return `
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-medium">${it.name}</p>
                                        <p class="text-sm text-gray-500">
                                            Số lượng: ${it.qty || 1}
                                            ${it?.variant?.color ? `• Màu: ${it.variant.color}` : ''}
                                        </p>
                                    </div>
                                    <a href="${url}"
                                    class="px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm font-medium">
                                        ⭐ Đánh giá
                                    </a>
                                </div>
                            `;
                        }).join('')}
                    </div>
                </div>
            `;
        }


        function reorderProduct(orderId) {
            const order = ORDER_DETAILS[orderId];
            if (!order || !Array.isArray(order.items) || order.items.length === 0) {
                alert(`Không tìm thấy sản phẩm của đơn ${orderId}.`);
                return;
            }
            const cart = getCartArray();
            order.items.forEach(it => {
                upsertCartItem(cart, {
                name: it.name,
                price: parseVND(it.price),
                qty: it.qty || 1,
                variant: it.variant || {},
                image: 'default'
                });
            });
            saveCartArray(cart);
            toast(`Đã thêm ${order.items.length} sản phẩm từ đơn ${orderId} vào giỏ hàng!`, 'success');
        }

        /* ========== FIX: Đồng bộ card ngoài với “Xem chi tiết” ========== */
        function parseVND(str) {
            if (typeof str === 'number') return str;
            return Number(String(str).replace(/[^\d]/g, '')) || 0;
        }
        function formatVND(n) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' })
                .format(Number(n) || 0).replace('₫','₫');
        }
        function sumOrderItems(order) {
            if (!order?.items?.length) return 0;
            return order.items.reduce((s, it) => s + (parseVND(it.price) * (Number(it.qty)||1)), 0);
        }
        function findOrderCard(orderId) {
            // Tìm card theo tiêu đề h3 chứa “#<ID>”
            const cards = document.querySelectorAll('.order-card');
            for (const card of cards) {
                const h3 = card.querySelector('h3');
                if (h3 && h3.textContent.includes(`#${orderId}`)) return card;
            }
            return null;
        }
        function syncOrderCardFromDetails(orderId) {
            const order = ORDER_DETAILS?.[orderId];
            if (!order) return;
            const card = findOrderCard(orderId);
            if (!card) return;

            // 1) Tính lại total từ items
            const computedTotal = sumOrderItems(order);

            // 2) Cập nhật số tiền hiển thị ngoài card (span tổng tiền)
            const totalSpan = card.querySelector('.text-lg.font-bold, .text-lg.font-bold.text-gray-800');
            if (totalSpan) totalSpan.textContent = formatVND(computedTotal);

            // 3) Đồng bộ trạng thái (nếu muốn chặt chẽ hơn)
            const badge = card.querySelector('.status-badge') || card.querySelector('span.bg-green-100, span.bg-blue-100, span.bg-yellow-100');
            if (badge) {
                const st = (order.status || '').toLowerCase();
                if (st.includes('giao')) {           // Đã giao hàng
                    badge.textContent = '✅ Đã giao hàng';
                    badge.className = 'status-badge bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium';
                    card.dataset.status = 'delivered';
                } else if (st.includes('đang giao')) {
                    badge.textContent = '🚚 Đang giao hàng';
                    badge.className = 'status-badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium';
                    card.dataset.status = 'shipping';
                } else if (st.includes('xử lý')) {
                    badge.textContent = '🔄 Đang xử lý';
                    badge.className = 'status-badge bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium';
                    card.dataset.status = 'processing';
                }
            }
        }

        /* Gọi đồng bộ cho tất cả đơn có trong ORDER_DETAILS khi trang tải xong */
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof ORDER_DETAILS === 'object') {
                Object.keys(ORDER_DETAILS).forEach(syncOrderCardFromDetails);
            }
        });

    </script>
@endsection