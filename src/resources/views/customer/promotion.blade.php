@extends('customer.layout')
@section('title', 'Khuyến mãi')

@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header Section -->
        <header class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">🎉 Chương Trình Khuyến Mãi Hot</h1>
            <p class="text-lg text-gray-600">Cơ hội vàng để sở hữu những sản phẩm công nghệ tuyệt vời với giá ưu đãi!</p>
        </header>

        <!-- Flash Sale Banner -->
        <section class="countdown bg-gradient-to-r from-red-600 to-pink-600 text-white rounded-2xl p-8 mb-8 text-center">
            <div class="flash-sale">
                <h2 class="text-3xl font-bold mb-4">⚡ FLASH SALE - Chỉ còn</h2>
                <div class="flex justify-center space-x-4 mb-4">
                    <div class="bg-black bg-opacity-30 backdrop-blur-sm rounded-lg p-4 min-w-[80px]">
                        <div class="text-3xl font-bold" id="hours">12</div>
                        <div class="text-sm">Giờ</div>
                    </div>
                    <div class="bg-black bg-opacity-30 backdrop-blur-sm rounded-lg p-4 min-w-[80px]">
                        <div class="text-3xl font-bold" id="minutes">34</div>
                        <div class="text-sm">Phút</div>
                    </div>
                    <div class="bg-black bg-opacity-30 backdrop-blur-sm rounded-lg p-4 min-w-[80px]">
                        <div class="text-3xl font-bold" id="seconds">56</div>
                        <div class="text-sm">Giây</div>
                    </div>
                </div>
                <p class="text-xl font-semibold">Giảm đến 70% cho tất cả sản phẩm!</p>
            </div>
        </section>

        <!-- Promotion Categories -->
        <section class="mb-12">
            <div class="flex flex-wrap justify-center gap-4 mb-8">
                <button class="category-btn bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700 transition-colors" data-category="all">
                    Tất cả
                </button>
                <button class="category-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-full font-semibold hover:bg-gray-300 transition-colors" data-category="smartphone">
                    📱 Smartphone
                </button>
                <button class="category-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-full font-semibold hover:bg-gray-300 transition-colors" data-category="laptop">
                    💻 Laptop
                </button>
                <button class="category-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-full font-semibold hover:bg-gray-300 transition-colors" data-category="accessories">
                    🎧 Phụ kiện
                </button>
                <button class="category-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-full font-semibold hover:bg-gray-300 transition-colors" data-category="home">
                    🏠 Gia dụng
                </button>
            </div>
        </section>

        <!-- Promotion Cards Grid -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="promotions-grid">
            <!-- Smartphone Promotion -->
            <article class="promotion-card bg-white rounded-2xl shadow-lg overflow-hidden" data-category="smartphone">
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 p-6 text-white">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-bold">iPhone 15 Pro</h3>
                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">-25%</span>
                    </div>
                    <div class="text-4xl mb-2">📱</div>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <span class="text-gray-500 line-through text-lg">29.990.000₫</span>
                        <span class="text-3xl font-bold text-red-600 ml-2">22.490.000₫</span>
                    </div>
                    <p class="text-gray-600 mb-4">Tặng kèm ốp lưng + cường lực cao cấp trị giá 500.000₫</p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Còn lại: 15 sản phẩm</span>
                        <div class="bg-gray-200 rounded-full h-2 flex-1 ml-4">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 70%"></div>
                        </div>
                    </div>
                    <button class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                        Mua ngay
                    </button>
                </div>
            </article>

            <!-- Laptop Promotion -->
            <article class="promotion-card bg-white rounded-2xl shadow-lg overflow-hidden" data-category="laptop">
                <div class="bg-gradient-to-r from-blue-500 to-cyan-500 p-6 text-white">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-bold">MacBook Air M3</h3>
                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">-20%</span>
                    </div>
                    <div class="text-4xl mb-2">💻</div>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <span class="text-gray-500 line-through text-lg">34.990.000₫</span>
                        <span class="text-3xl font-bold text-red-600 ml-2">27.990.000₫</span>
                    </div>
                    <p class="text-gray-600 mb-4">Tặng balo laptop + chuột không dây trị giá 800.000₫</p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Còn lại: 8 sản phẩm</span>
                        <div class="bg-gray-200 rounded-full h-2 flex-1 ml-4">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 40%"></div>
                        </div>
                    </div>
                    <button class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                        Mua ngay
                    </button>
                </div>
            </article>

            <!-- Accessories Promotion -->
            <article class="promotion-card bg-white rounded-2xl shadow-lg overflow-hidden" data-category="accessories">
                <div class="bg-gradient-to-r from-green-500 to-teal-500 p-6 text-white">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-bold">AirPods Pro 2</h3>
                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">-30%</span>
                    </div>
                    <div class="text-4xl mb-2">🎧</div>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <span class="text-gray-500 line-through text-lg">6.990.000₫</span>
                        <span class="text-3xl font-bold text-red-600 ml-2">4.890.000₫</span>
                    </div>
                    <p class="text-gray-600 mb-4">Mua 2 tặng 1 - Ưu đãi cực khủng cho nhóm bạn</p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Còn lại: 25 sản phẩm</span>
                        <div class="bg-gray-200 rounded-full h-2 flex-1 ml-4">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                    <button class="w-full bg-gradient-to-r from-green-500 to-teal-500 text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                        Mua ngay
                    </button>
                </div>
            </article>

            <!-- Smart TV Promotion -->
            <article class="promotion-card bg-white rounded-2xl shadow-lg overflow-hidden" data-category="home">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 p-6 text-white">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-bold">Smart TV 55" 4K</h3>
                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">-40%</span>
                    </div>
                    <div class="text-4xl mb-2">📺</div>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <span class="text-gray-500 line-through text-lg">15.990.000₫</span>
                        <span class="text-3xl font-bold text-red-600 ml-2">9.590.000₫</span>
                    </div>
                    <p class="text-gray-600 mb-4">Miễn phí lắp đặt + Tặng soundbar trị giá 2.000.000₫</p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Còn lại: 12 sản phẩm</span>
                        <div class="bg-gray-200 rounded-full h-2 flex-1 ml-4">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 60%"></div>
                        </div>
                    </div>
                    <button class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                        Mua ngay
                    </button>
                </div>
            </article>

            <!-- Gaming Setup Promotion -->
            <article class="promotion-card bg-white rounded-2xl shadow-lg overflow-hidden" data-category="accessories">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-500 p-6 text-white">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-bold">Gaming Setup</h3>
                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">-35%</span>
                    </div>
                    <div class="text-4xl mb-2">🎮</div>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <span class="text-gray-500 line-through text-lg">8.990.000₫</span>
                        <span class="text-3xl font-bold text-red-600 ml-2">5.840.000₫</span>
                    </div>
                    <p class="text-gray-600 mb-4">Combo bàn phím cơ + chuột gaming + tai nghe</p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Còn lại: 20 sản phẩm</span>
                        <div class="bg-gray-200 rounded-full h-2 flex-1 ml-4">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                    <button class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                        Mua ngay
                    </button>
                </div>
            </article>

            <!-- Smart Watch Promotion -->
            <article class="promotion-card bg-white rounded-2xl shadow-lg overflow-hidden" data-category="accessories">
                <div class="bg-gradient-to-r from-pink-500 to-rose-500 p-6 text-white">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-bold">Apple Watch S9</h3>
                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">-28%</span>
                    </div>
                    <div class="text-4xl mb-2">⌚</div>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <span class="text-gray-500 line-through text-lg">10.990.000₫</span>
                        <span class="text-3xl font-bold text-red-600 ml-2">7.910.000₫</span>
                    </div>
                    <p class="text-gray-600 mb-4">Tặng thêm 2 dây đeo thể thao trị giá 600.000₫</p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Còn lại: 18 sản phẩm</span>
                        <div class="bg-gray-200 rounded-full h-2 flex-1 ml-4">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 65%"></div>
                        </div>
                    </div>
                    <button class="w-full bg-gradient-to-r from-pink-500 to-rose-500 text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                        Mua ngay
                    </button>
                </div>
            </article>
        </section>

        <!-- Shopping Cart -->
        <div id="cart-sidebar" class="fixed top-0 right-0 h-full w-96 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 z-50 overflow-y-auto">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">🛒 Giỏ hàng</h2>
                    <button id="close-cart" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                </div>
                <div class="mt-2">
                    <span class="text-sm text-gray-600">Số lượng: </span>
                    <span id="cart-count" class="font-bold text-blue-600">0</span>
                </div>
            </div>
            
            <div id="cart-items" class="p-6">
                <div class="text-center text-gray-500 py-8" id="empty-cart">
                    <div class="text-4xl mb-4">🛒</div>
                    <p>Giỏ hàng của bạn đang trống</p>
                </div>
            </div>
            
            <div id="cart-footer" class="border-t p-6 bg-gray-50" style="display: none;">
                <div class="mb-4">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Tổng cộng:</span>
                        <span id="cart-total" class="text-red-600">0₫</span>
                    </div>
                    <div class="text-sm text-green-600 mt-1" id="voucher-savings" style="display: none;">
                        Tiết kiệm: <span id="savings-amount">0₫</span> với voucher
                    </div>
                </div>
                <button class="w-full bg-gradient-to-r from-green-500 to-teal-500 text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                    Thanh toán ngay
                </button>
            </div>
        </div>

        <!-- Cart Button -->
        <button id="cart-button" class="fixed bottom-6 right-6 bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 transition-colors z-40">
            <div class="relative">
                🛒
                <span id="cart-badge" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center" style="display: none;">0</span>
            </div>
        </button>

        <!-- Special Offers Section -->
        <section class="mt-16 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl p-8 text-center text-white">
            <h2 class="text-3xl font-bold mb-4">🎁 Ưu Đãi Đặc Biệt</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white bg-opacity-20 rounded-xl p-6">
                    <div class="text-3xl mb-3">🚚</div>
                    <h3 class="font-bold text-lg mb-2">Miễn phí vận chuyển</h3>
                    <p class="text-sm">Cho đơn hàng từ 500.000₫</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-xl p-6">
                    <div class="text-3xl mb-3">🔄</div>
                    <h3 class="font-bold text-lg mb-2">Đổi trả 30 ngày</h3>
                    <p class="text-sm">Không hài lòng hoàn tiền 100%</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-xl p-6">
                    <div class="text-3xl mb-3">🛡️</div>
                    <h3 class="font-bold text-lg mb-2">Bảo hành chính hãng</h3>
                    <p class="text-sm">Cam kết sản phẩm chính hãng</p>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize countdown timer
            initializeCountdown();
            // Initialize category filters
            initializeCategoryFilters();
            // Initialize buy buttons
            initializeBuyButtons();
        });

        // Countdown timer functionality
        function updateFlashSaleCountdown() {
            const now = new Date();
            const currentHour = now.getHours();
            const currentMinute = now.getMinutes();
            const currentSecond = now.getSeconds();
            
            const hoursElement = document.getElementById('hours');
            const minutesElement = document.getElementById('minutes');
            const secondsElement = document.getElementById('seconds');
            const flashSaleSection = document.querySelector('.countdown');
            const flashSaleTitle = flashSaleSection.querySelector('h2');
            const flashSaleDesc = flashSaleSection.querySelector('p');
            
            // Check if currently in Flash Sale time (8PM - 10PM)
            if (currentHour >= 20 && currentHour < 22) {
                // During Flash Sale - countdown to end (10PM)
                const endTime = new Date();
                endTime.setHours(22, 0, 0, 0);
                
                const timeLeft = endTime - now;
                const hours = Math.floor(timeLeft / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                
                hoursElement.textContent = hours.toString().padStart(2, '0');
                minutesElement.textContent = minutes.toString().padStart(2, '0');
                secondsElement.textContent = seconds.toString().padStart(2, '0');
                
                flashSaleTitle.textContent = '⚡ FLASH SALE ĐANG DIỄN RA - Còn lại';
                flashSaleDesc.textContent = 'Giảm đến 70% cho tất cả sản phẩm! Nhanh tay kẻo lỡ!';
                flashSaleSection.style.background = 'linear-gradient(45deg, #ff6b6b, #ee5a24)';
                
            } else {
                // Outside Flash Sale - countdown to next 8PM
                let nextFlashSale = new Date();
                
                if (currentHour >= 22) {
                    // After 10PM, next Flash Sale is tomorrow 8PM
                    nextFlashSale.setDate(nextFlashSale.getDate() + 1);
                }
                nextFlashSale.setHours(20, 0, 0, 0);
                
                const timeLeft = nextFlashSale - now;
                const hours = Math.floor(timeLeft / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                
                hoursElement.textContent = hours.toString().padStart(2, '0');
                minutesElement.textContent = minutes.toString().padStart(2, '0');
                secondsElement.textContent = seconds.toString().padStart(2, '0');
                
                flashSaleTitle.textContent = '⏰ FLASH SALE SẮP BẮT ĐẦU - Còn';
                flashSaleDesc.textContent = 'Flash Sale 8h-10h tối hàng ngày. Chuẩn bị sẵn sàng!';
                flashSaleSection.style.background = 'linear-gradient(45deg, #667eea, #764ba2)';
            }
        }

        // Update countdown every second
        updateFlashSaleCountdown();
        setInterval(updateFlashSaleCountdown, 1000);
        
        // Category filtering functionality
        const categoryButtons = document.querySelectorAll('.category-btn');
        const promotionCards = document.querySelectorAll('.promotion-card');
        
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                const category = this.getAttribute('data-category');
                
                // Update active button
                categoryButtons.forEach(btn => {
                    btn.classList.remove('bg-blue-600', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-700');
                });
                this.classList.remove('bg-gray-200', 'text-gray-700');
                this.classList.add('bg-blue-600', 'text-white');
                
                // Filter cards
                promotionCards.forEach(card => {
                    if (category === 'all' || card.getAttribute('data-category') === category) {
                        card.style.display = 'block';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 100);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
        
        // Shopping cart functionality
        let cart = [];
        let cartTotal = 0;
        let appliedVouchers = [];
        
        // Voucher database
        const vouchers = [
            { code: 'SAVE15', discount: 15, description: 'Giảm 15% cho đơn hàng này', minOrder: 0 },
            { code: 'WELCOME20', discount: 20, description: 'Giảm 20% cho khách hàng mới', minOrder: 1000000 },
            { code: 'MEGA25', discount: 25, description: 'Giảm 25% cho đơn hàng trên 5 triệu', minOrder: 5000000 },
            { code: 'FLASH30', discount: 30, description: 'Giảm 30% Flash Sale đặc biệt', minOrder: 2000000 }
        ];
        
        function getRandomVoucher() {
            return vouchers[Math.floor(Math.random() * vouchers.length)];
        }
        
        function formatPrice(price) {
            return price.toLocaleString('vi-VN') + '₫';
        }
        
        function updateCartUI() {
            const cartCount = document.getElementById('cart-count');
            const cartBadge = document.getElementById('cart-badge');
            const cartItems = document.getElementById('cart-items');
            const cartFooter = document.getElementById('cart-footer');
            const emptyCart = document.getElementById('empty-cart');
            const cartTotalElement = document.getElementById('cart-total');
            
            cartCount.textContent = cart.length;
            
            if (cart.length > 0) {
                cartBadge.textContent = cart.length;
                cartBadge.style.display = 'flex';
                emptyCart.style.display = 'none';
                cartFooter.style.display = 'block';
                
                // Calculate total with voucher discount
                let subtotal = cart.reduce((sum, item) => sum + item.price, 0);
                let discount = 0;
                
                if (appliedVouchers.length > 0) {
                    const voucher = appliedVouchers[0];
                    discount = subtotal * (voucher.discount / 100);
                    document.getElementById('voucher-savings').style.display = 'block';
                    document.getElementById('savings-amount').textContent = formatPrice(discount);
                }
                
                cartTotal = subtotal - discount;
                cartTotalElement.textContent = formatPrice(cartTotal);
                
                // Update cart items display
                cartItems.innerHTML = cart.map((item, index) => `
                    <div class="flex items-center justify-between p-4 border-b">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800">${item.name}</h4>
                            <p class="text-red-600 font-bold">${formatPrice(item.price)}</p>
                        </div>
                        <button onclick="removeFromCart(${index})" class="text-red-500 hover:text-red-700 ml-4">
                            🗑️
                        </button>
                    </div>
                `).join('');
                
                // Show applied voucher
                if (appliedVouchers.length > 0) {
                    const voucher = appliedVouchers[0];
                    cartItems.innerHTML += `
                        <div class="bg-green-50 p-4 rounded-lg mt-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="font-bold text-green-600">🎫 ${voucher.code}</span>
                                    <p class="text-sm text-green-600">${voucher.description}</p>
                                </div>
                                <span class="text-green-600 font-bold">-${voucher.discount}%</span>
                            </div>
                        </div>
                    `;
                }
            } else {
                cartBadge.style.display = 'none';
                emptyCart.style.display = 'block';
                cartFooter.style.display = 'none';
                cartItems.innerHTML = `
                    <div class="text-center text-gray-500 py-8" id="empty-cart">
                        <div class="text-4xl mb-4">🛒</div>
                        <p>Giỏ hàng của bạn đang trống</p>
                    </div>
                `;
            }
        }
        
        function addToCart(productName, price) {
            const item = { name: productName, price: price };
            cart.push(item);
            
            // Auto-apply voucher for first purchase or random chance
            if (cart.length === 1 || Math.random() < 0.3) {
                const voucher = getRandomVoucher();
                if (!appliedVouchers.find(v => v.code === voucher.code)) {
                    appliedVouchers.push(voucher);
                    showVoucherModal(voucher);
                }
            }
            
            updateCartUI();
            showNotification(`Đã thêm ${productName} vào giỏ hàng!`);
        }
        
        function removeFromCart(index) {
            cart.splice(index, 1);
            updateCartUI();
        }
        
        function showVoucherModal(voucher) {
            const modal = document.getElementById('voucher-modal');
            const code = document.getElementById('voucher-code');
            const description = document.getElementById('voucher-description');
            
            code.textContent = voucher.code;
            description.textContent = voucher.description;
            modal.style.display = 'flex';
        }
        
        // Add to cart functionality for all buy buttons
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('Mua ngay')) {
                button.addEventListener('click', function() {
                    const card = this.closest('.promotion-card');
                    const productName = card.querySelector('h3').textContent;
                    const priceText = card.querySelector('.text-red-600').textContent;
                    const price = parseInt(priceText.replace(/[^\d]/g, ''));
                    
                    // Visual feedback
                    const originalText = this.textContent;
                    const originalClasses = this.className;
                    
                    this.textContent = 'Đã thêm vào giỏ! ✓';
                    this.className = this.className.replace(/from-\w+-\d+\s+to-\w+-\d+/, 'from-green-500 to-green-600');
                    
                    setTimeout(() => {
                        this.textContent = originalText;
                        this.className = originalClasses;
                    }, 2000);
                    
                    // Add to cart
                    addToCart(productName, price);
                });
            }
        });
        
        // Cart sidebar functionality
        document.getElementById('cart-button').addEventListener('click', function() {
            document.getElementById('cart-sidebar').classList.remove('translate-x-full');
        });
        
        document.getElementById('close-cart').addEventListener('click', function() {
            document.getElementById('cart-sidebar').classList.add('translate-x-full');
        });
        
        // Voucher modal functionality
        document.getElementById('close-voucher-modal').addEventListener('click', function() {
            document.getElementById('voucher-modal').style.display = 'none';
        });
        
        // Close cart when clicking outside
        document.addEventListener('click', function(e) {
            const cartSidebar = document.getElementById('cart-sidebar');
            const cartButton = document.getElementById('cart-button');
            
            if (!cartSidebar.contains(e.target) && !cartButton.contains(e.target)) {
                cartSidebar.classList.add('translate-x-full');
            }
        });

        // Category filtering functionality
        function initializeCategoryFilters() {
            const categoryButtons = document.querySelectorAll('.category-btn');
            const promotionCards = document.querySelectorAll('.promotion-card');
            
            // Add transition styles to cards
            promotionCards.forEach(card => {
                card.style.transition = 'all 0.3s ease-in-out';
            });
            
            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.dataset.category;
                    
                    // Update active button styles
                    categoryButtons.forEach(btn => {
                        if (btn === this) {
                            btn.classList.remove('bg-gray-200', 'text-gray-700');
                            btn.classList.add('bg-blue-600', 'text-white');
                        } else {
                            btn.classList.remove('bg-blue-600', 'text-white');
                            btn.classList.add('bg-gray-200', 'text-gray-700');
                        }
                    });
                    
                    // Filter cards with animation
                    promotionCards.forEach(card => {
                        if (category === 'all' || card.dataset.category === category) {
                            card.style.display = 'block';
                            requestAnimationFrame(() => {
                                card.style.opacity = '1';
                                card.style.transform = 'translateY(0)';
                            });
                        } else {
                            card.style.opacity = '0';
                            card.style.transform = 'translateY(20px)';
                            setTimeout(() => {
                                card.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            });
        }

        // Buy button functionality
        function initializeBuyButtons() {
            document.querySelectorAll('button').forEach(button => {
                if (button.textContent.trim() === 'Mua ngay') {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const card = this.closest('.promotion-card');
                        const productName = card.querySelector('h3').textContent;
                        const originalText = this.textContent;
                        const originalClasses = [...this.classList];
                        
                        // Visual feedback
                        this.textContent = 'Đã thêm vào giỏ! ✓';
                        this.classList.add('bg-green-500', 'hover:bg-green-600');
                        
                        setTimeout(() => {
                            this.textContent = originalText;
                            this.classList.remove('bg-green-500', 'hover:bg-green-600');
                        }, 2000);
                        
                        showNotification(`Đã thêm ${productName} vào giỏ hàng!`);
                    });
                }
            });
        }

        // Notification system
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 ease-in-out transform translate-x-full';
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Trigger animation
            requestAnimationFrame(() => {
                notification.style.transform = 'translateX(0)';
            });
            
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement(\'script\');d.innerHTML="window.__CF$cv$params={r:\'98f5c680f3fa107d\',t:\'MTc2MDU5OTAzNS4wMDAwMDA=\'};var a=document.createElement(\'script\');a.nonce=\'\';a.src=\'/cdn-cgi/challenge-platform/scripts/jsd/main.js\';document.getElementsByTagName(\'head\')[0].appendChild(a);";b.getElementsByTagName(\'head\')[0].appendChild(d)}}if(document.body){var a=document.createElement(\'iframe\');a.height=1;a.width=1;a.style.position=\'absolute\';a.style.top=0;a.style.left=0;a.style.border=\'none\';a.style.visibility=\'hidden\';document.body.appendChild(a);if(\'loading\'!==document.readyState)c();else if(window.addEventListener)document.addEventListener(\'DOMContentLoaded\',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);\'loading\'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
@endsection