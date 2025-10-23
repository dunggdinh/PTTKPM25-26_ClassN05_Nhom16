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
                <button onclick="redirectToCategory('Tai nghe')" class="bg-white p-6 rounded-xl text-center category-icon hover:bg-red-50 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500">
                    <div class="w-12 h-12 mx-auto mb-3 text-red-500 text-3xl">
                        🎧
                    </div>
                    <p class="font-medium text-gray-700">Tai nghe</p>
                </button>
                <button onclick="redirectToCategory('Đồng hồ')" class="bg-white p-6 rounded-xl text-center category-icon hover:bg-green-50 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <div class="w-12 h-12 mx-auto mb-3 text-green-500 text-3xl">
                        ⌚
                    </div>
                    <p class="font-medium text-gray-700">Đồng hồ</p>
                </button>
                <button onclick="redirectToCategory('Camera')" class="bg-white p-6 rounded-xl text-center category-icon hover:bg-purple-50 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <div class="w-12 h-12 mx-auto mb-3 text-purple-500 text-3xl">
                        📷
                    </div>
                    <p class="font-medium text-gray-700">Camera</p>
                </button>
                <button onclick="redirectToCategory('Gaming')" class="bg-white p-6 rounded-xl text-center category-icon hover:bg-orange-50 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <div class="w-12 h-12 mx-auto mb-3 text-orange-500 text-3xl">
                        🎮
                    </div>
                    <p class="font-medium text-gray-700">Gaming</p>
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
                        <button onclick="addToCart('iPhone 15 Pro Max', '29.990.000₫')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
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
                    <h3 class="font-semibold text-gray-800 mb-2">MacBook Air M3</h3>
                    <p class="text-gray-600 text-sm mb-3">13 inch - 8GB RAM - 256GB SSD</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-bold text-red-600">27.990.000₫</span>
                        <button onclick="addToCart('MacBook Air M3', '27.990.000₫')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            Mua
                        </button>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="bg-white rounded-xl p-6 product-card cursor-pointer">
                    <div class="bg-gray-100 rounded-lg p-4 mb-4 flex items-center justify-center h-48">
                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                            <path d="M20 30 Q20 20 30 20 L50 20 Q60 20 60 30 L60 50 Q60 60 50 60 L30 60 Q20 60 20 50 Z" fill="#1f2937"/>
                            <circle cx="25" cy="35" r="8" fill="#374151"/>
                            <circle cx="55" cy="35" r="8" fill="#374151"/>
                            <path d="M25 50 Q40 55 55 50" stroke="#6b7280" stroke-width="3" fill="none"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">AirPods Pro 2</h3>
                    <p class="text-gray-600 text-sm mb-3">Chống ồn chủ động</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-bold text-red-600">6.490.000₫</span>
                        <button onclick="addToCart('AirPods Pro 2', '6.490.000₫')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            Mua
                        </button>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="bg-white rounded-xl p-6 product-card cursor-pointer">
                    <div class="bg-gray-100 rounded-lg p-4 mb-4 flex items-center justify-center h-48">
                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                            <circle cx="40" cy="40" r="30" fill="#1f2937" stroke="#374151" stroke-width="2"/>
                            <circle cx="40" cy="40" r="20" fill="#374151"/>
                            <rect x="35" y="10" width="10" height="15" rx="2" fill="#6b7280"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Apple Watch Series 9</h3>
                    <p class="text-gray-600 text-sm mb-3">45mm GPS - Dây Sport</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-bold text-red-600">9.990.000₫</span>
                        <button onclick="addToCart('Apple Watch Series 9', '9.990.000₫')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
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
        window.location.href = '{{ url('/customer/product') }}';
    }

    function redirectToCategory(categoryName) {
        // Map friendly names to exact database category IDs
        const categoryMap = {
            'Điện thoại': 'SM_001',
            'Laptop': 'LT_001',  // Updated to match exact database category ID
            'Tai nghe': 'headphone',
            'Đồng hồ': 'watch', 
            'Camera': 'camera',
            'Gaming': 'gaming'
        };
        
        const categoryId = categoryMap[categoryName] || 'all';
        window.location.href = `{{ url('/customer/product') }}?search=&category=${encodeURIComponent(categoryId)}&sort_by=name&sort_direction=asc`;
    }

    function addToCart(productName, price) {
        // Get existing cart from localStorage or create new one
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
            
        // Add product to cart
        const product = {
            id: Date.now(),
            name: productName,
            price: price,
            quantity: 1,
            image: 'default'
        };
            
        cart.push(product);
        localStorage.setItem('cart', JSON.stringify(cart));
            
        // Show success notification
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50';
        notification.textContent = `Đã thêm ${productName} vào giỏ hàng!`;
        document.body.appendChild(notification);
            
        setTimeout(() => {
            notification.remove();
        }, 2000);
    }

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

        // Thêm vào giỏ hàng
        document.querySelectorAll('.product-card button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                
                const productName = this.closest('.product-card').querySelector('h3').textContent;
                
                // Tạo và hiển thị thông báo
                const notification = document.createElement("div");
                notification.className = "fixed top-4 right-4 bg-orange-600 text-white px-6 py-3 rounded-lg shadow-lg z-50";
                notification.textContent = `Đã thêm ${productName} vào giỏ hàng!`;
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
