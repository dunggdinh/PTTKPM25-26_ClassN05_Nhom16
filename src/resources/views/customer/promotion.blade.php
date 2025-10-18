@extends('customer.layout')
@section('title', 'Khuyến mãi')

@section('content')
<body class="ml-64 w-[calc(100%-16rem)] min-h-screen p-8 pt-24 transition-all bg-gray-50">
    <main class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <header class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">🎉 Chương Trình Khuyến Mãi Hot</h1>
            <p class="text-lg text-gray-600">Cơ hội vàng để sở hữu những sản phẩm công nghệ tuyệt vời với giá ưu đãi!</p>
        </header>

        <!-- Flash Sale Banner -->
        <section class="countdown text-white rounded-2xl p-8 mb-8 text-center">
            <div class="flash-sale">
                <h2 class="text-3xl font-bold mb-4">⚡ FLASH SALE - Chỉ còn</h2>
                <div class="flex justify-center space-x-4 mb-4">
                    <div class="bg-white bg-opacity-20 rounded-lg p-3">
                        <div class="text-2xl font-bold" id="hours">12</div>
                        <div class="text-sm">Giờ</div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg p-3">
                        <div class="text-2xl font-bold" id="minutes">34</div>
                        <div class="text-sm">Phút</div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg p-3">
                        <div class="text-2xl font-bold" id="seconds">56</div>
                        <div class="text-sm">Giây</div>
                    </div>
                </div>
                <p class="text-xl">Giảm đến 70% cho tất cả sản phẩm!</p>
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
        // Countdown timer functionality
        function updateCountdown() {
            const hours = document.getElementById(\'hours\');
            const minutes = document.getElementById(\'minutes\');
            const seconds = document.getElementById(\'seconds\');
            
            let h = parseInt(hours.textContent);
            let m = parseInt(minutes.textContent);
            let s = parseInt(seconds.textContent);
            
            s--;
            if (s < 0) {
                s = 59;
                m--;
                if (m < 0) {
                    m = 59;
                    h--;
                    if (h < 0) {
                        h = 23;
                    }
                }
            }
            
            hours.textContent = h.toString().padStart(2, \'0\');
            minutes.textContent = m.toString().padStart(2, \'0\');
            seconds.textContent = s.toString().padStart(2, \'0\');
        }
        
        setInterval(updateCountdown, 1000);
        
        // Category filtering functionality
        const categoryButtons = document.querySelectorAll(\'.category-btn\');
        const promotionCards = document.querySelectorAll(\'.promotion-card\');
        
        categoryButtons.forEach(button => {
            button.addEventListener(\'click\', function() {
                const category = this.getAttribute(\'data-category\');
                
                // Update active button
                categoryButtons.forEach(btn => {
                    btn.classList.remove(\'bg-blue-600\', \'text-white\');
                    btn.classList.add(\'bg-gray-200\', \'text-gray-700\');
                });
                this.classList.remove(\'bg-gray-200\', \'text-gray-700\');
                this.classList.add(\'bg-blue-600\', \'text-white\');
                
                // Filter cards
                promotionCards.forEach(card => {
                    if (category === \'all\' || card.getAttribute(\'data-category\') === category) {
                        card.style.display = \'block\';
                        setTimeout(() => {
                            card.style.opacity = \'1\';
                            card.style.transform = \'translateY(0)\';
                        }, 100);
                    } else {
                        card.style.opacity = \'0\';
                        card.style.transform = \'translateY(20px)\';
                        setTimeout(() => {
                            card.style.display = \'none\';
                        }, 300);
                    }
                });
            });
        });
        
        // Add to cart functionality for all buy buttons
        const buyButtons = document.querySelectorAll(\'button:contains("Mua ngay")\');
        document.querySelectorAll(\'button\').forEach(button => {
            if (button.textContent.includes(\'Mua ngay\')) {
                button.addEventListener(\'click\', function() {
                    const card = this.closest(\'.promotion-card\');
                    const productName = card.querySelector(\'h3\').textContent;
                    
                    // Visual feedback
                    this.textContent = \'Đã thêm vào giỏ! ✓\';
                    this.classList.add(\'bg-green-500\');
                    
                    setTimeout(() => {
                        this.textContent = \'Mua ngay\';
                        this.classList.remove(\'bg-green-500\');
                    }, 2000);
                    
                    // Show success message
                    showNotification(`Đã thêm ${productName} vào giỏ hàng!`);
                });
            }
        });
        
        // Notification system
        function showNotification(message) {
            const notification = document.createElement(\'div\');
            notification.className = \'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300\';
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.remove(\'translate-x-full\');
            }, 100);
            
            setTimeout(() => {
                notification.classList.add(\'translate-x-full\');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement(\'script\');d.innerHTML="window.__CF$cv$params={r:\'98f5c680f3fa107d\',t:\'MTc2MDU5OTAzNS4wMDAwMDA=\'};var a=document.createElement(\'script\');a.nonce=\'\';a.src=\'/cdn-cgi/challenge-platform/scripts/jsd/main.js\';document.getElementsByTagName(\'head\')[0].appendChild(a);";b.getElementsByTagName(\'head\')[0].appendChild(d)}}if(document.body){var a=document.createElement(\'iframe\');a.height=1;a.width=1;a.style.position=\'absolute\';a.style.top=0;a.style.left=0;a.style.border=\'none\';a.style.visibility=\'hidden\';document.body.appendChild(a);if(\'loading\'!==document.readyState)c();else if(window.addEventListener)document.addEventListener(\'DOMContentLoaded\',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);\'loading\'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
@endsection