<!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Trang chủ -->
            <div id="home" class="section animate-fade-in">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Trang chủ</h2>
                    
                    <!-- Banner -->
                    <div class="bg-gradient-to-r from-purple-400 to-pink-400 rounded-xl p-8 text-white mb-8 card-hover">
                        <h3 class="text-2xl font-bold mb-2">Khuyến mãi đặc biệt!</h3>
                        <p class="text-lg mb-4">Giảm giá lên đến 50% cho tất cả sản phẩm</p>
                        <button onclick="showSection('promotions')" class="bg-white text-purple-600 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            Xem ngay
                        </button>
                    </div>

                    <!-- Sản phẩm nổi bật -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                            <div class="product-image w-full h-32 rounded-lg mb-4 flex items-center justify-center">
                                <i class="fas fa-laptop text-4xl text-gray-400"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800 mb-2">Laptop Gaming</h4>
                            <p class="text-purple-600 font-bold text-lg">25.990.000₫</p>
                            <button onclick="addToCart('laptop-gaming')" class="w-full mt-3 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors">
                                Thêm vào giỏ
                            </button>
                        </div>
                        
                        <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                            <div class="product-image w-full h-32 rounded-lg mb-4 flex items-center justify-center">
                                <i class="fas fa-mobile-alt text-4xl text-gray-400"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800 mb-2">Smartphone Pro</h4>
                            <p class="text-purple-600 font-bold text-lg">15.990.000₫</p>
                            <button onclick="addToCart('smartphone-pro')" class="w-full mt-3 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors">
                                Thêm vào giỏ
                            </button>
                        </div>
                        
                        <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                            <div class="product-image w-full h-32 rounded-lg mb-4 flex items-center justify-center">
                                <i class="fas fa-headphones text-4xl text-gray-400"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800 mb-2">Tai nghe Bluetooth</h4>
                            <p class="text-purple-600 font-bold text-lg">2.990.000₫</p>
                            <button onclick="addToCart('headphones')" class="w-full mt-3 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors">
                                Thêm vào giỏ
                            </button>
                        </div>
                        
                        <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                            <div class="product-image w-full h-32 rounded-lg mb-4 flex items-center justify-center">
                                <i class="fas fa-tablet-alt text-4xl text-gray-400"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800 mb-2">Tablet Pro</h4>
                            <p class="text-purple-600 font-bold text-lg">12.990.000₫</p>
                            <button onclick="addToCart('tablet-pro')" class="w-full mt-3 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors">
                                Thêm vào giỏ
                            </button>
                        </div>
                    </div>

                    <!-- Khuyến mãi -->
                    <div class="bg-gradient-to-r from-green-400 to-blue-400 rounded-xl p-6 text-white">
                        <h3 class="text-xl font-bold mb-4">🎉 Khuyến mãi hôm nay</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-white/20 rounded-lg p-4">
                                <h4 class="font-semibold mb-2">Miễn phí vận chuyển</h4>
                                <p class="text-sm">Cho đơn hàng từ 500.000₫</p>
                            </div>
                            <div class="bg-white/20 rounded-lg p-4">
                                <h4 class="font-semibold mb-2">Giảm 20%</h4>
                                <p class="text-sm">Cho khách hàng mới</p>
                            </div>
                            <div class="bg-white/20 rounded-lg p-4">
                                <h4 class="font-semibold mb-2">Tích điểm x2</h4>
                                <p class="text-sm">Cuối tuần này</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>