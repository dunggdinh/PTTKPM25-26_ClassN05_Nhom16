@extends('customer.layout')
@section('title', 'Sản phẩm')

@section('content')
    <!-- Category Navigation Bar -->
    <div class="bg-white shadow-sm mb-6">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <!-- Categories -->
                <div class="flex space-x-6">
                    <button data-category="all" class="category-nav-btn text-gray-600 hover:text-blue-600 font-medium flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-50 transition-all">
                        <span class="text-xl">📋</span>
                        <span>Tất cả</span>
                    </button>
                    <button data-category="phone" class="category-nav-btn text-gray-600 hover:text-blue-600 font-medium flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-50 transition-all">
                        <span class="text-xl">📱</span>
                        <span>Điện thoại</span>
                    </button>
                    <button data-category="laptop" class="category-nav-btn text-gray-600 hover:text-blue-600 font-medium flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-50 transition-all">
                        <span class="text-xl">💻</span>
                        <span>Laptop</span>
                    </button>
                    <button data-category="tablet" class="category-nav-btn text-gray-600 hover:text-blue-600 font-medium flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-50 transition-all">
                        <span class="text-xl">📱</span>
                        <span>Tablet</span>
                    </button>
                    <button data-category="accessory" class="category-nav-btn text-gray-600 hover:text-blue-600 font-medium flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-50 transition-all">
                        <span class="text-xl">🎧</span>
                        <span>Phụ kiện</span>
                    </button>
                    <button data-category="watch" class="category-nav-btn text-gray-600 hover:text-blue-600 font-medium flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-50 transition-all">
                        <span class="text-xl">⌚</span>
                        <span>Đồng hồ</span>
                    </button>
                </div>

                <!-- Search Bar -->
                <div class="relative w-72">
                    <input type="text" 
                           id="nav-search-input"
                           placeholder="Tìm kiếm sản phẩm..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-300"
                    >
                    <button id="nav-search-btn" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600">
                        🔍
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Layout with Sidebar -->
    <div class="flex min-h-screen bg-gray-50">
        <!-- Main Content -->
        <main class="flex-1 p-8">
        <!-- Product List View -->
        <div id="product-list" class="fade-in">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Sản phẩm nổi bật</h2>
                <div class="flex items-center space-x-4">
                    <select id="sort-select" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <option value="default">Sắp xếp theo giá</option>
                        <option value="price-low">Giá thấp đến cao</option>
                        <option value="price-high">Giá cao đến thấp</option>
                        <option value="newest">Mới nhất</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Product Card 1 -->
                <div class="product-card bg-white rounded-xl shadow-md overflow-hidden" data-product-id="1" data-category="phone" data-brand="apple" data-price="29990000">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <span class="text-6xl">📱</span>
                        </div>
                        <span class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">-20%</span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2 text-gray-800">iPhone 15 Pro Max</h3>
                        <p class="text-gray-600 text-sm mb-3">Điện thoại thông minh cao cấp với chip A17 Pro</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">29.990.000₫</span>
                                <span class="text-sm text-gray-500 line-through ml-2">37.490.000₫</span>
                            </div>
                        </div>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                ⭐⭐⭐⭐⭐
                            </div>
                            <span class="text-sm text-gray-600 ml-2">(128 đánh giá)</span>
                        </div>
                        <button class="view-detail-btn w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-medium transition-colors">
                            Xem chi tiết
                        </button>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="product-card bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <span class="text-6xl">💻</span>
                        </div>
                        <span class="absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded-full text-sm font-bold">Mới</span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2 text-gray-800">MacBook Air M3</h3>
                        <p class="text-gray-600 text-sm mb-3">Laptop siêu mỏng với chip M3 mạnh mẽ</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">28.990.000₫</span>
                            </div>
                        </div>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                ⭐⭐⭐⭐⭐
                            </div>
                            <span class="text-sm text-gray-600 ml-2">(89 đánh giá)</span>
                        </div>
                        <button onclick="showProductDetail(2)" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-medium transition-colors">
                            Xem chi tiết
                        </button>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="product-card bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <span class="text-6xl">🎧</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2 text-gray-800">AirPods Pro 2</h3>
                        <p class="text-gray-600 text-sm mb-3">Tai nghe không dây chống ồn chủ động</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">6.490.000₫</span>
                            </div>
                        </div>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                ⭐⭐⭐⭐⭐
                            </div>
                            <span class="text-sm text-gray-600 ml-2">(256 đánh giá)</span>
                        </div>
                        <button onclick="showProductDetail(3)" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-medium transition-colors">
                            Xem chi tiết
                        </button>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="product-card bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <span class="text-6xl">⌚</span>
                        </div>
                        <span class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">-15%</span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2 text-gray-800">Apple Watch Series 9</h3>
                        <p class="text-gray-600 text-sm mb-3">Đồng hồ thông minh với tính năng sức khỏe</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">9.990.000₫</span>
                                <span class="text-sm text-gray-500 line-through ml-2">11.990.000₫</span>
                            </div>
                        </div>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                ⭐⭐⭐⭐⭐
                            </div>
                            <span class="text-sm text-gray-600 ml-2">(167 đánh giá)</span>
                        </div>
                        <button onclick="showProductDetail(4)" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-medium transition-colors">
                            Xem chi tiết
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Detail View -->
        <div id="product-detail" class="hidden fade-in">
            <div class="mb-4">
                <button onclick="showProductList()" class="text-blue-600 hover:text-blue-800 font-medium">
                    ← Quay lại danh sách sản phẩm
                </button>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
                    <!-- Product Images -->
                    <div>
                        <div class="mb-4">
                            <div id="main-image" class="w-full h-96 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center">
                                <span class="text-8xl">📱</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center cursor-pointer border-2 border-blue-500">
                                <span class="text-2xl">📱</span>
                            </div>
                            <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center cursor-pointer">
                                <span class="text-2xl">📱</span>
                            </div>
                            <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center cursor-pointer">
                                <span class="text-2xl">📱</span>
                            </div>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div>
                        <h1 id="detail-title" class="text-3xl font-bold text-gray-800 mb-4">iPhone 15 Pro Max</h1>
                        
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400 text-lg">
                                ⭐⭐⭐⭐⭐
                            </div>
                            <span class="text-gray-600 ml-2">(128 đánh giá)</span>
                            <span class="text-blue-600 ml-4 cursor-pointer hover:underline">Viết đánh giá</span>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-center space-x-4 mb-2">
                                <span id="detail-price" class="text-4xl font-bold text-blue-600">29.990.000₫</span>
                                <span id="detail-old-price" class="text-xl text-gray-500 line-through">37.490.000₫</span>
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">-20%</span>
                            </div>
                            <p class="text-green-600 font-medium">✓ Còn hàng - Giao hàng miễn phí</p>
                        </div>

                        <div class="mb-6">
                            <h3 class="font-bold text-lg mb-3">Màu sắc:</h3>
                            <div class="flex space-x-3">
                                <button class="w-12 h-12 rounded-full bg-gray-800 border-4 border-blue-500"></button>
                                <button class="w-12 h-12 rounded-full bg-blue-600 border-2 border-gray-300"></button>
                                <button class="w-12 h-12 rounded-full bg-purple-600 border-2 border-gray-300"></button>
                                <button class="w-12 h-12 rounded-full bg-yellow-400 border-2 border-gray-300"></button>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="font-bold text-lg mb-3">Dung lượng:</h3>
                            <div class="flex space-x-3">
                                <button class="px-4 py-2 border-2 border-blue-500 bg-blue-50 text-blue-600 rounded-lg font-medium">256GB</button>
                                <button class="px-4 py-2 border-2 border-gray-300 text-gray-600 rounded-lg font-medium hover:border-blue-500">512GB</button>
                                <button class="px-4 py-2 border-2 border-gray-300 text-gray-600 rounded-lg font-medium hover:border-blue-500">1TB</button>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="font-bold text-lg mb-3">Số lượng:</h3>
                            <div class="flex items-center space-x-3">
                                <button onclick="decreaseQuantity()" class="quantity-btn w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center font-bold">-</button>
                                <span id="quantity" class="text-xl font-bold px-4">1</span>
                                <button onclick="increaseQuantity()" class="quantity-btn w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center font-bold">+</button>
                            </div>
                        </div>

                        <div class="space-y-4 mb-6">
                            <button onclick="purchaseNow()" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-4 rounded-lg font-bold text-lg transition-colors flex items-center justify-center gap-2">
                                <span>🛒</span> Mua ngay
                            </button>
                            <div class="grid grid-cols-2 gap-4">
                                <button onclick="addToCartAndContinue()" class="bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-bold transition-colors flex items-center justify-center gap-2">
                                    <span>➕</span> Thêm vào giỏ
                                </button>
                                <button onclick="addToCartAndCheckout()" class="bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-bold transition-colors flex items-center justify-center gap-2">
                                    <span>✓</span> Thêm và thanh toán
                                </button>
                            </div>
                        </div>

                        <!-- Purchase Success Modal -->
                        <div id="purchaseModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                            <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4 relative">
                                <div id="purchaseModalContent" class="text-center">
                                    <!-- Content will be set by JavaScript -->
                                </div>
                            </div>
                        </div>

                        <div class="border-t pt-6">
                            <h3 class="font-bold text-lg mb-3">Thông tin sản phẩm:</h3>
                            <ul class="space-y-2 text-gray-700">
                                <li>• Chip A17 Pro 3nm tiên tiến</li>
                                <li>• Camera chính 48MP với zoom quang học 5x</li>
                                <li>• Màn hình Super Retina XDR 6.7 inch</li>
                                <li>• Khung Titanium cao cấp</li>
                                <li>• Hỗ trợ sạc không dây MagSafe</li>
                                <li>• Kháng nước IP68</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Tabs -->
            <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="border-b">
                    <div class="flex">
                        <button onclick="showTab(\'description\')" id="tab-description" class="px-6 py-4 font-medium border-b-2 border-blue-600 text-blue-600">
                            Mô tả sản phẩm
                        </button>
                        <button onclick="showTab(\'specs\')" id="tab-specs" class="px-6 py-4 font-medium text-gray-600 hover:text-blue-600">
                            Thông số kỹ thuật
                        </button>
                        <button onclick="showTab(\'reviews\')" id="tab-reviews" class="px-6 py-4 font-medium text-gray-600 hover:text-blue-600">
                            Đánh giá (128)
                        </button>
                    </div>
                </div>

                <div class="p-6">
                    <div id="tab-content-description">
                        <h3 class="text-xl font-bold mb-4">iPhone 15 Pro Max - Đỉnh cao công nghệ</h3>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            iPhone 15 Pro Max mang đến trải nghiệm đỉnh cao với chip A17 Pro được sản xuất trên tiến trình 3nm tiên tiến nhất. 
                            Thiết kế khung Titanium cao cấp vừa nhẹ vừa bền, kết hợp cùng màn hình Super Retina XDR 6.7 inch sắc nét.
                        </p>
                        <p class="text-gray-700 leading-relaxed">
                            Hệ thống camera Pro với cảm biến chính 48MP và zoom quang học 5x cho phép bạn chụp ảnh chuyên nghiệp. 
                            Pin lâu dài và sạc nhanh giúp bạn luôn kết nối suốt cả ngày.
                        </p>
                    </div>

                    <div id="tab-content-specs" class="hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-bold mb-3">Thông số chung</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li><strong>Màn hình:</strong> 6.7 inch Super Retina XDR</li>
                                    <li><strong>Chip:</strong> A17 Pro 3nm</li>
                                    <li><strong>Dung lượng:</strong> 256GB/512GB/1TB</li>
                                    <li><strong>RAM:</strong> 8GB</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-bold mb-3">Camera & Pin</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li><strong>Camera sau:</strong> 48MP chính + 12MP góc rộng + 12MP tele</li>
                                    <li><strong>Camera trước:</strong> 12MP TrueDepth</li>
                                    <li><strong>Pin:</strong> 4441 mAh</li>
                                    <li><strong>Sạc:</strong> 27W có dây, 15W MagSafe</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="tab-content-reviews" class="hidden">
                        <div class="space-y-6">
                            <div class="border-b pb-4">
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400">⭐⭐⭐⭐⭐</div>
                                    <span class="font-bold ml-2">Nguyễn Văn A</span>
                                    <span class="text-gray-500 ml-2">• 2 ngày trước</span>
                                </div>
                                <p class="text-gray-700">Sản phẩm rất tuyệt vời, camera chụp ảnh đẹp, pin trâu. Giao hàng nhanh, đóng gói cẩn thận.</p>
                            </div>
                            <div class="border-b pb-4">
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400">⭐⭐⭐⭐⭐</div>
                                    <span class="font-bold ml-2">Trần Thị B</span>
                                    <span class="text-gray-500 ml-2">• 1 tuần trước</span>
                                </div>
                                <p class="text-gray-700">Máy chạy mượt, thiết kế đẹp. Rất hài lòng với sản phẩm này!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="font-bold text-lg mb-4">TechStore</h3>
                    <p class="text-gray-300">Cửa hàng điện tử uy tín với sản phẩm chính hãng và dịch vụ tốt nhất.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Liên kết</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white">Về chúng tôi</a></li>
                        <li><a href="#" class="hover:text-white">Chính sách bảo hành</a></li>
                        <li><a href="#" class="hover:text-white">Hướng dẫn mua hàng</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Hỗ trợ</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white">Liên hệ</a></li>
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Đổi trả</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Theo dõi</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-2xl hover:text-blue-400">📘</a>
                        <a href="#" class="text-2xl hover:text-pink-400">📷</a>
                        <a href="#" class="text-2xl hover:text-blue-300">🐦</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Initializing product page...');
            initializePage();
        });

        // Core functionality
        function initializePage() {
            setupCategoryNavigation();
            setupSearch();
            setupProductCards();
        }

        // Category Navigation
        function setupCategoryNavigation() {
            const categoryButtons = document.querySelectorAll('.category-nav-btn');
            categoryButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const category = button.dataset.category;
                    setActiveCategory(button);
                    filterProductsByCategory(category);
                });
            });
        }

        function setActiveCategory(selectedButton) {
            // Remove active state from all buttons
            document.querySelectorAll('.category-nav-btn').forEach(btn => {
                btn.classList.remove('bg-blue-50', 'text-blue-600');
                btn.classList.add('text-gray-600');
            });

            // Add active state to selected button
            selectedButton.classList.add('bg-blue-50', 'text-blue-600');
            selectedButton.classList.remove('text-gray-600');
        }

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing...');
            initializeProducts();
            setupEventListeners();
            setupNavigationBar();
        });

        // Product filtering and display
        function filterProductsByCategory(category) {
            const productCards = document.querySelectorAll('.product-card');
            const fadeOut = [
                { opacity: 1, transform: 'translateY(0)' },
                { opacity: 0, transform: 'translateY(-10px)' }
            ];
            const fadeIn = [
                { opacity: 0, transform: 'translateY(-10px)' },
                { opacity: 1, transform: 'translateY(0)' }
            ];
            const animationTiming = { duration: 300, easing: 'ease-out' };

            productCards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                    card.animate(fadeIn, animationTiming);
                } else {
                    const animation = card.animate(fadeOut, animationTiming);
                    animation.onfinish = () => {
                        card.style.display = 'none';
                    };
                }
            });
        }

        // Purchase functionality
        function showPurchaseModal(title, message, type = 'success') {
            const modal = document.getElementById('purchaseModal');
            const content = document.getElementById('purchaseModalContent');
            
            let icon = type === 'success' ? '✅' : type === 'info' ? 'ℹ️' : '❌';
            let color = type === 'success' ? 'text-green-600' : type === 'info' ? 'text-blue-600' : 'text-red-600';
            
            content.innerHTML = `
                <div class="text-4xl mb-4">${icon}</div>
                <h3 class="text-xl font-bold ${color} mb-2">${title}</h3>
                <p class="text-gray-600 mb-6">${message}</p>
                <div class="flex gap-3">
                    <button onclick="hidePurchaseModal()" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg transition-colors">
                        Đóng
                    </button>
                    ${type === 'success' ? `
                    <button onclick="window.location.href='/checkout'" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors">
                        Đến giỏ hàng
                    </button>
                    ` : ''}
                </div>
            `;
            
            modal.classList.remove('hidden');
            
            // Close modal when clicking outside
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    hidePurchaseModal();
                }
            });
        }

        function hidePurchaseModal() {
            const modal = document.getElementById('purchaseModal');
            modal.classList.add('hidden');
        }

        function purchaseNow() {
            const productTitle = document.querySelector('#detail-title').textContent;
            const quantity = document.querySelector('#quantity').textContent;
            showPurchaseModal(
                'Đặt hàng thành công!',
                `Bạn đã đặt mua ${quantity} ${productTitle}. Chúng tôi sẽ liên hệ với bạn để xác nhận đơn hàng.`,
                'success'
            );
        }

        function addToCartAndContinue() {
            const productTitle = document.querySelector('#detail-title').textContent;
            showPurchaseModal(
                'Đã thêm vào giỏ hàng',
                `${productTitle} đã được thêm vào giỏ hàng của bạn.`,
                'info'
            );
        }

        function addToCartAndCheckout() {
            const productTitle = document.querySelector('#detail-title').textContent;
            showPurchaseModal(
                'Đã thêm vào giỏ hàng',
                `${productTitle} đã được thêm vào giỏ hàng. Bạn có thể tiến hành thanh toán ngay bây giờ.`,
                'success'
            );
        }

        // Product cards functionality
        function setupProductCards() {
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach(card => {
                const viewDetailBtn = card.querySelector('.view-detail-btn');
                if (viewDetailBtn) {
                    viewDetailBtn.addEventListener('click', () => {
                        const productId = card.dataset.productId;
                        showProductDetail(productId);
                    });
                }
            });
        }

        const products = {
            1: {
                title: "iPhone 15 Pro Max",
                price: "29.990.000₫",
                priceValue: 29990000,
                oldPrice: "37.490.000₫",
                emoji: "📱",
                category: "phone",
                brand: "apple",
                priceRange: "over-20m",
                releaseDate: new Date(\'2023-09-22\')
            },
            2: {
                title: "MacBook Air M3",
                price: "28.990.000₫",
                priceValue: 28990000,
                oldPrice: null,
                emoji: "💻",
                category: "laptop",
                brand: "apple",
                priceRange: "over-20m",
                releaseDate: new Date(\'2024-03-08\')
            },
            3: {
                title: "AirPods Pro 2",
                price: "6.490.000₫",
                priceValue: 6490000,
                oldPrice: null,
                emoji: "🎧",
                category: "accessory",
                brand: "apple",
                priceRange: "under-10m",
                releaseDate: new Date(\'2022-09-23\')
            },
            4: {
                title: "Apple Watch Series 9",
                price: "9.990.000₫",
                priceValue: 9990000,
                oldPrice: "11.990.000₫",
                emoji: "⌚",
                category: "accessory",
                brand: "apple",
                priceRange: "under-10m",
                releaseDate: new Date(\'2023-09-22\')
            }
        };

        function setupNavigationBar() {
            // Category navigation
            $$('.category-nav-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const category = btn.dataset.category;
                    filterByCategory(category);
                    setActiveCategory(category);
                });
            });

            // Navigation search
            $('#nav-search-input')?.addEventListener('keyup', (e) => {
                if (e.key === 'Enter') {
                    performNavSearch();
                }
            });

            $('#nav-search-btn')?.addEventListener('click', () => {
                performNavSearch();
            });
        }

        function performNavSearch() {
            const searchTerm = $('#nav-search-input')?.value.toLowerCase() || '';
            const productCards = $$('.product-card');

            let hasResults = false;
            productCards.forEach(card => {
                const title = card.querySelector('h3')?.textContent.toLowerCase() || '';
                const description = card.querySelector('p')?.textContent.toLowerCase() || '';
                
                if (title.includes(searchTerm) || description.includes(searchTerm) || searchTerm === '') {
                    card.style.display = 'block';
                    hasResults = true;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide no results message
            const noResults = $('#no-results');
            if (noResults) {
                noResults.style.display = hasResults ? 'none' : 'block';
            }

            // Reset category filters
            if (searchTerm) {
                setActiveCategory('all');
            }
        }

        function setupEventListeners() {
            console.log('Setting up event listeners...');
            
            // Category filters in sidebar
            $$('.sidebar-category').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const category = button.dataset.category;
                    filterByCategory(category);
                    setActiveCategory(category);
                    console.log('Category filter clicked:', category);
                });
            });

            // Price filters
            $$('[data-price-range]').forEach(checkbox => {
                checkbox.addEventListener('change', (e) => {
                    const range = checkbox.dataset.priceRange;
                    filterByPrice(range);
                    console.log('Price filter changed:', range);
                });
            });

            // Brand filters
            $$('[data-brand]').forEach(checkbox => {
                checkbox.addEventListener('change', (e) => {
                    const brand = checkbox.dataset.brand;
                    filterByBrand(brand);
                    console.log('Brand filter changed:', brand);
                });
            });

            // Search functionality
            const searchInput = $('#search-input');
            if (searchInput) {
                searchInput.addEventListener('keyup', (e) => {
                    if (e.key === 'Enter') {
                        performSearch();
                    }
                });
            }

            // Product cards click handlers
            $$('.product-card').forEach(card => {
                const productId = card.dataset.productId;
                if (productId) {
                    card.querySelector('.view-detail-btn')?.addEventListener('click', () => {
                        showProductDetail(productId);
                    });
                }
            });

            // Quantity buttons
            setupQuantityControls();
            
            // Sort dropdown
            $('#sort-select')?.addEventListener('change', (e) => {
                sortProducts(e.target.value);
            });
        }

        function initializeProducts() {
            console.log('Initializing products...');

            // Initialize search
            const searchInput = document.getElementById('search-input');
            if (searchInput) {
                searchInput.addEventListener('keyup', searchProducts);
            }

            // Initialize quantity buttons
            const quantityBtns = document.querySelectorAll('.quantity-btn');
            quantityBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (this.textContent === '+') {
                        increaseQuantity();
                    } else {
                        decreaseQuantity();
                    }
                });
            });

            // Show initial product list
            showProductList();
        }

        function showProductList() {
            const productList = document.getElementById('product-list');
            const productDetail = document.getElementById('product-detail');
            
            if (productList && productDetail) {
                productList.classList.remove('hidden');
                productDetail.classList.add('hidden');
            }
        }

        function showProductDetail(productId) {
            const product = products[productId];
            
            document.getElementById(\'detail-title\').textContent = product.title;
            document.getElementById(\'detail-price\').textContent = product.price;
            document.getElementById(\'main-image\').innerHTML = `<span class="text-8xl">${product.emoji}</span>`;
            
            const oldPriceElement = document.getElementById(\'detail-old-price\');
            if (product.oldPrice) {
                oldPriceElement.textContent = product.oldPrice;
                oldPriceElement.classList.remove(\'hidden\');
            } else {
                oldPriceElement.classList.add(\'hidden\');
            }
            
            document.getElementById(\'product-list\').classList.add(\'hidden\');
            document.getElementById(\'product-detail\').classList.remove(\'hidden\');
            
            // Reset quantity
            currentQuantity = 1;
            document.getElementById(\'quantity\').textContent = currentQuantity;
        }

        function increaseQuantity() {
            if (currentQuantity < 10) {
                currentQuantity++;
                document.getElementById(\'quantity\').textContent = currentQuantity;
            }
        }

        function decreaseQuantity() {
            if (currentQuantity > 1) {
                currentQuantity--;
                document.getElementById(\'quantity\').textContent = currentQuantity;
            }
        }

        function addToCart() {
            cartCount += currentQuantity;
            document.getElementById(\'cart-count\').textContent = cartCount;
            
            // Show success message
            const button = event.target;
            const originalText = button.textContent;
            button.textContent = \'Đã thêm vào giỏ hàng!\';
            button.classList.add(\'bg-green-600\');
            button.classList.remove(\'bg-blue-600\');
            
            setTimeout(() => {
                button.textContent = originalText;
                button.classList.remove(\'bg-green-600\');
                button.classList.add(\'bg-blue-600\');
            }, 2000);
        }

        function showTab(tabName) {
            // Hide all tab contents
            document.getElementById(\'tab-content-description\').classList.add(\'hidden\');
            document.getElementById(\'tab-content-specs\').classList.add(\'hidden\');
            document.getElementById(\'tab-content-reviews\').classList.add(\'hidden\');
            
            // Remove active state from all tabs
            document.getElementById(\'tab-description\').classList.remove(\'border-blue-600\', \'text-blue-600\');
            document.getElementById(\'tab-specs\').classList.remove(\'border-blue-600\', \'text-blue-600\');
            document.getElementById(\'tab-reviews\').classList.remove(\'border-blue-600\', \'text-blue-600\');
            
            document.getElementById(\'tab-description\').classList.add(\'text-gray-600\');
            document.getElementById(\'tab-specs\').classList.add(\'text-gray-600\');
            document.getElementById(\'tab-reviews\').classList.add(\'text-gray-600\');
            
            // Show selected tab content and activate tab
            document.getElementById(\'tab-content-\' + tabName).classList.remove(\'hidden\');
            document.getElementById(\'tab-\' + tabName).classList.add(\'border-blue-600\', \'text-blue-600\');
            document.getElementById(\'tab-\' + tabName).classList.remove(\'text-gray-600\');
        }

        function filterByCategory(category) {
            currentFilter = category;
            updateSidebarActive(category);
            filterProducts();
        }

        function filterByPrice(priceRange) {
            const index = currentPriceFilters.indexOf(priceRange);
            if (index > -1) {
                currentPriceFilters.splice(index, 1);
            } else {
                currentPriceFilters.push(priceRange);
            }
            filterProducts();
        }

        function filterByBrand(brand) {
            const index = currentBrandFilters.indexOf(brand);
            if (index > -1) {
                currentBrandFilters.splice(index, 1);
            } else {
                currentBrandFilters.push(brand);
            }
            filterProducts();
        }

        function updateSidebarActive(activeCategory) {
            // Remove active state from all buttons
            const buttons = document.querySelectorAll(\'aside button\');
            buttons.forEach(btn => {
                btn.classList.remove(\'bg-blue-50\', \'text-blue-600\', \'border-l-4\', \'border-blue-600\');
                btn.classList.add(\'text-gray-600\');
            });

            // Add active state to selected button
            const activeButton = document.querySelector(`button[onclick*="${activeCategory}"]`) || 
                                document.querySelector(\'button[onclick="showProductList()"]\');
            if (activeButton) {
                activeButton.classList.add(\'bg-blue-50\', \'text-blue-600\', \'border-l-4\', \'border-blue-600\');
                activeButton.classList.remove(\'text-gray-600\');
            }
        }

        function filterProducts() {
            try {
                const productCards = document.querySelectorAll('.product-card');
                if (!productCards.length) {
                    console.error('No product cards found');
                    return;
                }

                let hasVisibleProducts = false;
                
                // Animation setup
                const fadeOut = [
                    { opacity: 1, transform: 'translateY(0)' },
                    { opacity: 0, transform: 'translateY(-10px)' }
                ];
                const fadeIn = [
                    { opacity: 0, transform: 'translateY(-10px)' },
                    { opacity: 1, transform: 'translateY(0)' }
                ];
                const animationTiming = {
                    duration: 300,
                    easing: 'ease-out'
                };            productCards.forEach((card, index) => {
                const productId = index + 1;
                const product = products[productId];
                let shouldShow = true;

                // Category filter
                if (currentFilter !== \'all\' && product.category !== currentFilter) {
                    shouldShow = false;
                }

                // Price filter
                if (currentPriceFilters.length > 0 && !currentPriceFilters.includes(product.priceRange)) {
                    shouldShow = false;
                }

                // Brand filter
                if (currentBrandFilters.length > 0 && !currentBrandFilters.includes(product.brand)) {
                    shouldShow = false;
                }

                // Show/hide product with animation
                if (shouldShow) {
                    card.style.display = 'block';
                    card.animate(fadeIn, animationTiming);
                } else {
                    card.animate(fadeOut, animationTiming).onfinish = () => {
                        card.style.display = 'none';
                    };
                }
            });
        }

        function searchProducts(event) {
            try {
                if (event.key === 'Enter') {
                    performSearch();
                }
            } catch (error) {
                console.error('Error in search products:', error);
            }
        }

        function performSearch() {
            try {
                const searchInput = document.getElementById('search-input');
                if (!searchInput) {
                    console.error('Search input not found');
                    return;
                }

                const searchTerm = searchInput.value.toLowerCase();
                const productCards = document.querySelectorAll('.product-card');
            
            productCards.forEach((card, index) => {
                const productId = index + 1;
                const product = products[productId];
                const productTitle = product.title.toLowerCase();
                
                if (productTitle.includes(searchTerm) || searchTerm === \'\') {
                    card.style.display = \'block\';
                } else {
                    card.style.display = \'none\';
                }
            });
        }

        function showCart() {
            // Create cart modal
            const modal = document.createElement(\'div\');
            modal.className = \'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50\';
            
            const cartContent = cartCount === 0 ? 
                \'Giỏ hàng của bạn đang trống!\' : 
                `Bạn có ${cartCount} sản phẩm trong giỏ hàng`;
                
            modal.innerHTML = `
                <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
                    <h3 class="text-xl font-bold mb-4">Giỏ hàng của bạn</h3>
                    <p class="text-gray-600 mb-4">${cartContent}</p>
                    <div class="flex space-x-3">
                        <button onclick="closeModal()" 
                                class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-2 rounded-lg">
                            Đóng
                        </button>
                        ${cartCount > 0 ? `
                        <button onclick="checkout()" 
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg">
                            Thanh toán
                        </button>` : \'\'}
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
        }

        function closeModal() {
            const modal = document.querySelector(\'.fixed.inset-0\');
            if (modal) {
                modal.remove();
            }
        }

        function checkout() {
            // Create checkout notification
            const notification = document.createElement(\'div\');
            notification.className = \'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50\';
            notification.textContent = \'Chức năng thanh toán đang được phát triển!\';
            document.body.appendChild(notification);
            
            // Remove notification after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
            
            closeModal();
        }

        function sortProducts(sortType) {
            const productGrid = document.querySelector(\'.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-3.xl\\:grid-cols-4\');
            const productCards = Array.from(productGrid.children);
            
            // Create array of products with their data and DOM elements
            const productsWithElements = productCards.map((card, index) => {
                const productId = index + 1;
                return {
                    element: card,
                    data: products[productId],
                    id: productId
                };
            });

            // Sort based on selected option
            let sortedProducts;
            switch(sortType) {
                case \'price-low\':
                    sortedProducts = productsWithElements.sort((a, b) => a.data.priceValue - b.data.priceValue);
                    break;
                case \'price-high\':
                    sortedProducts = productsWithElements.sort((a, b) => b.data.priceValue - a.data.priceValue);
                    break;
                case \'newest\':
                    sortedProducts = productsWithElements.sort((a, b) => b.data.releaseDate - a.data.releaseDate);
                    break;
                default:
                    // Default order (original order)
                    sortedProducts = productsWithElements.sort((a, b) => a.id - b.id);
            }

            // Clear the grid and re-append in sorted order
            productGrid.innerHTML = \'\';
            sortedProducts.forEach(product => {
                productGrid.appendChild(product.element);
            });
        }
    </script>
@endsection