@extends('customer.layout')
@section('title', 'Trang Chủ')

@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Hero Banner -->
        <section class="banner-gradient rounded-2xl text-white p-8 mb-12 relative overflow-hidden">
            <div class="relative z-10">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Khuyến mãi lớn cuối năm</h1>
                <p class="text-xl mb-6 opacity-90">Giảm giá lên đến 50% cho tất cả sản phẩm điện tử</p>
                <button onclick="redirectToProduct()" class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Mua ngay
                </button>
            </div>
            <div class="absolute right-8 top-1/2 transform -translate-y-1/2 opacity-20">
                <svg width="200" height="200" viewBox="0 0 200 200" fill="currentColor">
                    <rect x="20" y="40" width="160" height="100" rx="8" stroke="currentColor" stroke-width="2" fill="none"/>
                    <rect x="40" y="60" width="120" height="60" rx="4" fill="currentColor"/>
                    <circle cx="60" cy="160" r="8" fill="currentColor"/>
                    <circle cx="140" cy="160" r="8" fill="currentColor"/>
                </svg>
            </div>
        </section>

        <!-- Categories -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Danh mục sản phẩm</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <button onclick="redirectToCategory('Điện thoại')" class="bg-white p-6 rounded-xl text-center category-icon hover:bg-blue-50 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="w-12 h-12 mx-auto mb-3 text-blue-500 text-3xl">
                        📱
                    </div>
                    <p class="font-medium text-gray-700">Điện thoại</p>
                </button>
                <button onclick="redirectToCategory('Laptop')" class="bg-white p-6 rounded-xl text-center category-icon hover:bg-gray-50 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    <div class="w-12 h-12 mx-auto mb-3 text-gray-600 text-3xl">
                        💻
                    </div>
                    <p class="font-medium text-gray-700">Laptop</p>
                </button>
            </div>
        </section>

        <!-- Featured Products -->
        <section class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Sản phẩm nổi bật</h2>
                <a href="{{ url('/customer/product') }}" class="text-blue-600 hover:text-blue-800 font-medium">Xem tất cả →</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Product 1 -->
                <div class="bg-white rounded-xl p-6 product-card cursor-pointer">
                    <div class="bg-gray-100 rounded-lg p-4 mb-4 flex items-center justify-center h-48">
                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                            <rect x="10" y="5" width="60" height="70" rx="8" fill="#1f2937" stroke="#374151" stroke-width="2"/>
                            <rect x="15" y="15" width="50" height="30" rx="4" fill="#3b82f6"/>
                            <circle cx="40" cy="60" r="8" fill="#6b7280"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">iPhone 15 Pro Max</h3>
                    <p class="text-gray-600 text-sm mb-3">256GB - Titan Tự Nhiên</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-bold text-red-600">29.990.000₫</span>
                        <button
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
                            data-product-id="PRD_051"
                            data-price="29990000"
                        >
                            Mua
                        </button>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="bg-white rounded-xl p-6 product-card cursor-pointer">
                    <div class="bg-gray-100 rounded-lg p-4 mb-4 flex items-center justify-center h-48">
                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                            <rect x="5" y="20" width="70" height="45" rx="6" fill="#1f2937" stroke="#374151" stroke-width="2"/>
                            <rect x="10" y="25" width="60" height="35" rx="3" fill="#374151"/>
                            <rect x="30" y="67" width="20" height="8" rx="2" fill="#6b7280"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">MacBook Pro 16 M3 Max</h3>
                    <p class="text-gray-600 text-sm mb-3">13 inch - 8GB RAM - 256GB SSD</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-bold text-red-600">69.990.000₫</span>
                        <button
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
                            data-product-id="PRD_012"
                            data-price="69990000"
                        >
                            Mua
                        </button>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="bg-white rounded-xl p-6 product-card cursor-pointer">
                    <div class="bg-gray-100 rounded-lg p-4 mb-4 flex items-center justify-center h-48">
                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                            <rect x="5" y="20" width="70" height="45" rx="6" fill="#1f2937" stroke="#374151" stroke-width="2"/>
                            <rect x="10" y="25" width="60" height="35" rx="3" fill="#374151"/>
                            <rect x="30" y="67" width="20" height="8" rx="2" fill="#6b7280"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Acer Nitro 5</h3>
                    <p class="text-gray-600 text-sm mb-3">13 inch - 8GB RAM - 512GB SSD</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-bold text-red-600">26.990.000₫</span>
                        <button
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
                            data-product-id="PRD_004"
                            data-price="26990000"
                        >
                            Mua
                        </button>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="bg-white rounded-xl p-6 product-card cursor-pointer">
                    <div class="bg-gray-100 rounded-lg p-4 mb-4 flex items-center justify-center h-48">
                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                            <rect x="10" y="5" width="60" height="70" rx="8" fill="#1f2937" stroke="#374151" stroke-width="2"/>
                            <rect x="15" y="15" width="50" height="30" rx="4" fill="#3b82f6"/>
                            <circle cx="40" cy="60" r="8" fill="#6b7280"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Samsung Galaxy S24 Ultra</h3>
                    <p class="text-gray-600 text-sm mb-3">512GB - Đen</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-bold text-red-600">30.490.000₫</span>
                        <button
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
                            data-product-id="PRD_052"
                            data-price="30490000"
                        >
                            Mua
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Special Offers -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Ưu đãi đặc biệt</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-r from-red-500 to-pink-500 rounded-xl p-6 text-white">
                    <h3 class="text-xl font-bold mb-2">Flash Sale 24h</h3>
                    <p class="mb-4 opacity-90">Giảm giá sốc các sản phẩm điện thoại</p>
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="bg-white bg-opacity-20 rounded-lg p-2 text-center">
                            <div class="text-lg font-bold">12</div>
                            <div class="text-xs">Giờ</div>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-lg p-2 text-center">
                            <div class="text-lg font-bold">34</div>
                            <div class="text-xs">Phút</div>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-lg p-2 text-center">
                            <div class="text-lg font-bold">56</div>
                            <div class="text-xs">Giây</div>
                        </div>
                    </div>
                    <button onclick="redirectToProduct()" class="bg-white text-red-500 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Mua ngay
                    </button>
                </div>
            </div>
        </section>
    </main>
</div>

<script>
    function redirectToProduct() {
        window.location.href = 'product';
    }

    function redirectToCategory(categoryName) {
        const categoryMap = {
            'Điện thoại': 'SM_001',
            'Laptop': 'LT_001', 
        };
        
        const categoryId = categoryMap[categoryName] || 'all';
        window.location.href = `{{ url('/customer/product') }}?search=&category=${encodeURIComponent(categoryId)}&sort_by=name&sort_direction=asc`;
    }

    const CART_KEY = 'cart';

    function toNumber(v) {
        if (typeof v === 'number') return v;
        // bỏ mọi ký tự không phải số: dấu chấm, phẩy, ký hiệu ₫ ...
        return Number(String(v).replace(/[^\d]/g, '')) || 0;
    }

    function toast(msg, bg = 'bg-green-600') {
        const n = document.createElement('div');
        n.className = `fixed top-4 right-4 ${bg} text-white px-6 py-3 rounded-lg shadow-lg z-50`;
        n.textContent = msg;
        document.body.appendChild(n);
        setTimeout(() => n.remove(), 2000);
    }

    function addToCart(productId, quantity = 1) {
        // Gửi vào giỏ DB (đúng với trang cart của bạn)
        fetch('{{ route("customer.cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ product_id: productId, quantity })
        })
        .then(async (res) => {
            // Nếu bị redirect do chưa đăng nhập
            if (res.status === 401 || res.redirected) {
                toast('Vui lòng đăng nhập để thêm vào giỏ', 'bg-orange-600');
                // chuyển hướng trang đăng nhập nếu muốn:
                // window.location.href = '/login';
                return;
            }
            const data = await res.json().catch(() => ({}));
            if (res.ok && (data.success ?? true)) {
                toast('Đã thêm vào giỏ hàng!');
                // (tuỳ chọn) cập nhật badge số lượng ở header:
                // updateCartBadge();
            } else {
                toast(data.message || 'Thêm giỏ hàng thất bại', 'bg-red-600');
            }
        })
        .catch(() => {
            toast('Lỗi mạng, thử lại sau', 'bg-red-600');
        });
    }


    // Thêm vào giỏ hàng (GỌI addToCart)
    document.querySelectorAll('.product-card button').forEach(button => {
        button.addEventListener('click', function (e) {
            e.stopPropagation();
            const productId = this.dataset.productId;
            if (!productId) {
                toast('Mã sản phẩm không hợp lệ', 'bg-red-600');
                return;
            }
        addToCart(productId, 1);
        });
    });

    function redirectToPromotion() {
        window.location.href = 'promotion';
    }

    function handleNewsletter(event) {
        event.preventDefault();
        const email = event.target.email.value;
            
        // Show success message
        const form = event.target;
        const successMsg = document.createElement('div');
        successMsg.className = 'mt-4 p-4 bg-green-100 text-green-700 rounded-lg';
        successMsg.textContent = 'Cảm ơn bạn đã đăng ký! Chúng tôi sẽ gửi thông tin khuyến mãi đến email của bạn.';
            
        form.appendChild(successMsg);
        form.email.value = '';
            
        // Remove message after 3 seconds
        setTimeout(() => {
            successMsg.remove();
        }, 3000);
        }

    document.addEventListener('DOMContentLoaded', function() {
        // Đăng ký newsletter
        function handleNewsletter(event) {
            event.preventDefault();
            const email = event.target.email.value;
            
            // Hiển thị thông báo thành công
            const form = event.target;
            const successMsg = document.createElement("div");
            successMsg.className = "mt-4 p-4 bg-green-100 text-green-700 rounded-lg";
            successMsg.textContent = "Cảm ơn bạn đã đăng ký! Chúng tôi sẽ gửi thông tin khuyến mãi đến email của bạn.";
            
            form.appendChild(successMsg);
            form.email.value = "";
            
            // Xóa thông báo sau 3 giây
            setTimeout(() => {
                successMsg.remove();
            }, 3000);
        }

        // Click vào danh mục
        document.querySelectorAll('.category-icon').forEach(icon => {
            icon.addEventListener('click', function() {
                const category = this.querySelector('p').textContent;
                
                // Tạo và hiển thị thông báo
                const notification = document.createElement("div");
                notification.className = "fixed top-4 right-4 bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg z-50";
                notification.textContent = `Đang tải danh mục ${category}...`;
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.remove();
                }, 2000);
            });
        });

        // Click vào sản phẩm
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', function(e) {
                if (e.target.tagName === 'BUTTON') return;
                
                const productName = this.querySelector('h3').textContent;
                
                // Tạo và hiển thị thông báo
                const notification = document.createElement("div");
                notification.className = "fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50";
                notification.textContent = `Đang xem chi tiết ${productName}...`;
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.remove();
                }, 2000);
            });
        });

        // Đếm ngược flash sale
        function updateCountdown() {
            const hours = document.querySelector('.bg-gradient-to-r .text-lg');
            if (hours) {
                let currentHours = parseInt(hours.textContent);
                let currentMinutes = parseInt(hours.parentElement.nextElementSibling.querySelector('.text-lg').textContent);
                let currentSeconds = parseInt(hours.parentElement.nextElementSibling.nextElementSibling.querySelector('.text-lg').textContent);
                
                currentSeconds--;
                if (currentSeconds < 0) {
                    currentSeconds = 59;
                    currentMinutes--;
                    if (currentMinutes < 0) {
                        currentMinutes = 59;
                        currentHours--;
                        if (currentHours < 0) {
                            currentHours = 23;
                        }
                    }
                }
                
                hours.textContent = currentHours.toString().padStart(2, "0");
                hours.parentElement.nextElementSibling.querySelector('.text-lg').textContent = currentMinutes.toString().padStart(2, "0");
                hours.parentElement.nextElementSibling.nextElementSibling.querySelector('.text-lg').textContent = currentSeconds.toString().padStart(2, "0");
            }
        }
        
        setInterval(updateCountdown, 1000);
    });

    // Gán sự kiện cho form newsletter
    const newsletterForm = document.querySelector('form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', handleNewsletter);
    }
</script>
@endsection
