@extends('customer.layout')
@section('title', 'Sản phẩm')

@section('content')
    <!-- Category Navigation Bar -->
        <!-- Top Navigation Bar -->
        <header class="bg-white shadow-lg">
            <div class="container mx-auto px-4 py-6">
                <!-- Categories -->
                <div class="mb-6">
                <nav class="flex flex-wrap justify-center gap-3">
                    <button onclick="filterByCategory('all')" class="px-6 py-3 bg-blue-50 text-blue-600 rounded-lg font-medium border-2 border-blue-600">
                        📋 Tất cả sản phẩm
                    </button>
                    <button onclick="filterByCategory('phone')" class="px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium border-2 border-gray-300 transition-colors">
                        📱 Điện thoại
                    </button>
                    <button onclick="filterByCategory('laptop')" class="px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium border-2 border-gray-300 transition-colors">
                        💻 Laptop
                    </button>
                    <button onclick="filterByCategory('accessory')" class="px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium border-2 border-gray-300 transition-colors">
                        🎧 Phụ kiện
                    </button>
                    <button onclick="filterByCategory('table')" class="px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium border-2 border-gray-300 transition-colors">
                        📱 Table
                    </button>
                    <button onclick="filterByCategory('watch')" class="px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium border-2 border-gray-300 transition-colors">
                        ⌚ Đồng hồ
                    </button>
                </nav>
            </div>

                <!-- Search Bar -->
                <div class="relative  ">
                    <input type="text" id="search-input" placeholder="Tìm kiếm sản phẩm..." 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-300"
                        onkeyup="searchProducts(event)">
                    <button onclick="performSearch()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600 text-lg">
                        🔍
                    </button>
                </div>
            
                <!-- Filters -->
                <div class="flex flex-wrap justify-center gap-8">
                    <div>
                        <h3 class="font-bold text-gray-800 mb-3 text-center">Lọc theo giá</h3>
                        <div class="flex flex-wrap gap-4 justify-center">
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2" onchange="filterByPrice('under-10m')">
                                <span class="text-sm">Dưới 10 triệu</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2" onchange="filterByPrice('10m-20m')">
                                <span class="text-sm">10 - 20 triệu</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2" onchange="filterByPrice('over-20m')">
                                <span class="text-sm">Trên 20 triệu</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-bold text-gray-800 mb-3 text-center">Thương hiệu</h3>
                        <div class="flex flex-wrap gap-4 justify-center">
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2" onchange="filterByBrand('apple')">
                                <span class="text-sm">Apple</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2" onchange="filterByBrand('samsung')">
                                <span class="text-sm">Samsung</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2" onchange="filterByBrand('xiaomi')">
                                <span class="text-sm">Xiaomi</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </header>

    <!-- Main Layout with Sidebar -->
    <div class="flex min-h-screen bg-gray-50">
        <!-- Main Content -->
        <main class="flex-1 p-8">
        <!-- Product List View -->
        <div id="product-list" class="fade-in">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Sản phẩm nổi bật</h2>
                <div class="flex items-center space-x-4">
                    <select onchange="sortProducts(this.value)" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
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
                        <button onclick="showProductDetail(1)" class="view-detail-btn w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-medium transition-colors">
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

                        <!-- Màu sắc -->
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-3">Màu sắc:</h3>
                        <div class="flex space-x-3" id="color-options">
                            <button type="button" class="option-color w-12 h-12 rounded-full bg-gray-800 border-2 border-gray-300" data-color="Đen"></button>
                            <button type="button" class="option-color w-12 h-12 rounded-full bg-blue-600 border-2 border-gray-300" data-color="Xanh"></button>
                            <button type="button" class="option-color w-12 h-12 rounded-full bg-purple-600 border-2 border-gray-300" data-color="Tím"></button>
                            <button type="button" class="option-color w-12 h-12 rounded-full bg-yellow-400 border-2 border-gray-300" data-color="Vàng"></button>
                        </div>
                    </div>

                    <!-- Dung lượng -->
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-3">Dung lượng:</h3>
                        <div class="flex space-x-3" id="storage-options">
                            <button type="button" class="option-storage px-4 py-2 border-2 border-gray-300 text-gray-600 rounded-lg font-medium hover:border-blue-500" data-storage="256GB">256GB</button>
                            <button type="button" class="option-storage px-4 py-2 border-2 border-gray-300 text-gray-600 rounded-lg font-medium hover:border-blue-500" data-storage="512GB">512GB</button>
                            <button type="button" class="option-storage px-4 py-2 border-2 border-gray-300 text-gray-600 rounded-lg font-medium hover:border-blue-500" data-storage="1TB">1TB</button>
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

                        <div class="space-y-3 mb-6">
                            <button onclick="addToCart(document.getElementById('detail-title').textContent, parsePrice(document.getElementById('detail-price').textContent), { storage: selectedStorage, color: selectedColor }, parseInt(document.getElementById('quantity').textContent,10))" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-bold text-lg transition-colors">
                                Thêm vào giỏ hàng
                            </button>
                            <button class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-lg font-bold text-lg transition-colors">
                                Mua ngay
                            </button>
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

    <script>
        let currentQuantity = 1;
        let currentFilter = 'all';
        let currentPriceFilters = [];
        let currentBrandFilters = [];

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
                releaseDate: new Date('2023-09-22')
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
                releaseDate: new Date('2024-03-08')
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
                releaseDate: new Date('2022-09-23')
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
                releaseDate: new Date('2023-09-22')
            }
        };

        function showProductList() {
            document.getElementById('product-list').classList.remove('hidden');
            document.getElementById('product-detail').classList.add('hidden');
        }

        function showProductDetail(productId) {
            const product = products[productId];
            
            document.getElementById('detail-title').textContent = product.title;
            document.getElementById('detail-price').textContent = product.price;
            document.getElementById('main-image').innerHTML = `<span class="text-8xl">${product.emoji}</span>`;
            
            const oldPriceElement = document.getElementById('detail-old-price');
            if (product.oldPrice) {
                oldPriceElement.textContent = product.oldPrice;
                oldPriceElement.classList.remove('hidden');
            } else {
                oldPriceElement.classList.add('hidden');
            }
            
            document.getElementById('product-list').classList.add('hidden');
            document.getElementById('product-detail').classList.remove('hidden');
            
            // Reset quantity
            currentQuantity = 1;
            document.getElementById('quantity').textContent = currentQuantity;
        }

        function increaseQuantity() {
            if (currentQuantity < 10) {
                currentQuantity++;
                document.getElementById('quantity').textContent = currentQuantity;
            }
        }

        function decreaseQuantity() {
            if (currentQuantity > 1) {
                currentQuantity--;
                document.getElementById('quantity').textContent = currentQuantity;
            }
        }
        // Trạng thái lựa chọn
        let selectedColor = null;
        let selectedStorage = null;

        // Tăng giá theo dung lượng (tuỳ chỉnh theo shop)
        const storagePriceDelta = {
        '256GB': 0,
        '512GB': 3000000, // +3 triệu
        '1TB'  : 6000000  // +6 triệu
        };

        // Khởi tạo handlers cho options (gọi 1 lần khi load trang)
        initOptionHandlers();
        function initOptionHandlers() {
        // Chọn màu
        document.getElementById('color-options')?.addEventListener('click', (e) => {
            const btn = e.target.closest('.option-color');
            if (!btn) return;
            // Bỏ chọn tất cả
            document.querySelectorAll('.option-color').forEach(b => {
            b.classList.remove('ring-4','ring-blue-500','border-blue-500');
            b.classList.add('border-gray-300');
            b.setAttribute('aria-pressed', 'false');
            });
            // Chọn 1
            btn.classList.add('ring-4','ring-blue-500','border-blue-500');
            btn.classList.remove('border-gray-300');
            btn.setAttribute('aria-pressed', 'true');
            selectedColor = btn.getAttribute('data-color');
        });

        // Chọn dung lượng
        document.getElementById('storage-options')?.addEventListener('click', (e) => {
            const btn = e.target.closest('.option-storage');
            if (!btn) return;
            // Bỏ chọn tất cả
            document.querySelectorAll('.option-storage').forEach(b => {
            b.classList.remove('border-blue-500','bg-blue-50','text-blue-600');
            b.classList.add('border-gray-300','text-gray-600');
            b.setAttribute('aria-pressed', 'false');
            });
            // Chọn 1
            btn.classList.add('border-blue-500','bg-blue-50','text-blue-600');
            btn.classList.remove('border-gray-300','text-gray-600');
            btn.setAttribute('aria-pressed', 'true');
            selectedStorage = btn.getAttribute('data-storage');

            // Cập nhật giá hiển thị theo dung lượng
            const base = productsByTitle(document.getElementById('detail-title')?.textContent)?.priceValue
                        || parsePrice(document.getElementById('detail-price')?.textContent || '0');
            const newPrice = base + (storagePriceDelta[selectedStorage] || 0);
            if (!Number.isNaN(newPrice)) {
            document.getElementById('detail-price').textContent = formatVND(newPrice);
            }
        });
        }

        // Hàm tìm sản phẩm theo title (để lấy base priceValue)
        function productsByTitle(title) {
        if (!title) return null;
        const ids = Object.keys(products);
        for (const id of ids) {
            if (products[id].title === title) return products[id];
        }
        return null;
        }

        function formatVND(n) {
        // hiển thị dạng 29.990.000₫
        return n.toLocaleString('vi-VN') + '₫';
        }

        // Gọi lại khi chuyển sản phẩm chi tiết để reset lựa chọn
        const _origShowProductDetail = showProductDetail;
        showProductDetail = function(productId){
        _origShowProductDetail(productId);

        // Reset lựa chọn + style
        selectedColor = null;
        selectedStorage = null;

        document.querySelectorAll('.option-color').forEach(b => {
            b.classList.remove('ring-4','ring-blue-500','border-blue-500');
            b.classList.add('border-gray-300');
            b.setAttribute('aria-pressed','false');
        });

        document.querySelectorAll('.option-storage').forEach(b => {
            b.classList.remove('border-blue-500','bg-blue-50','text-blue-600');
            b.classList.add('border-gray-300','text-gray-600');
            b.setAttribute('aria-pressed','false');
        });

        // Khôi phục giá gốc của sản phẩm khi vừa vào chi tiết
        const p = products[productId];
        if (p?.priceValue) {
            document.getElementById('detail-price').textContent = formatVND(p.priceValue);
        }
        };

        // Bọc lại addToCart để kiểm tra đã chọn đủ chưa và đưa biến thể vào cart
        const _origAddToCart = addToCart;
        addToCart = function(productName, price){
        // Nếu người dùng đã chọn dung lượng, cập nhật price theo delta (đảm bảo giỏ đúng giá)
        let finalPrice = price;
        if (selectedStorage && Number.isFinite(price)) {
            finalPrice = price + (storagePriceDelta[selectedStorage] || 0);
        }

        // Bắt buộc chọn màu + dung lượng (tuỳ policy của bạn)
        if (!selectedColor || !selectedStorage) {
            showToast('Vui lòng chọn Màu sắc và Dung lượng trước khi thêm vào giỏ!', 'error');
            return;
        }

        // Gọi hàm gốc (đã có quantity)
        _origAddToCart(productName, finalPrice);

        // Ghi đè item cuối vừa thêm để kèm biến thể (color/storage)
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        if (cart.length) {
            cart[cart.length - 1].variant = {
            color: selectedColor,
            storage: selectedStorage
            };
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        // Thông báo thành công kèm biến thể
        showToast(`Đã thêm ${productName} (${selectedStorage}, ${selectedColor}) vào giỏ hàng!`, 'success');
        };

        // Toast helper (success/error)
        function showToast(message, type='success'){
        const el = document.createElement('div');
        el.className = `fixed top-4 right-4 ${type==='success' ? 'bg-green-600' : 'bg-red-600'} text-white px-6 py-3 rounded-lg shadow-lg z-50`;
        el.textContent = message;
        document.body.appendChild(el);
        setTimeout(()=>el.remove(), 2200);
        }

        // parsePrice bạn đã thêm ở trước đó:
        function parsePrice(text){
        const num = text.replace(/[^\d]/g,'');
        return Number(num);
        }


        function addToCart(productName, price) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            const qty = parseInt(document.getElementById('quantity')?.textContent, 10) || 1;

            const product = {
                id: Date.now(),
                name: productName,
                price: price,
                quantity: qty,
                image: 'default'
            };

            cart.push(product);
            localStorage.setItem('cart', JSON.stringify(cart));

            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50';
            notification.textContent = `Đã thêm ${productName} (x${qty}) vào giỏ hàng!`;
            document.body.appendChild(notification);

            setTimeout(() => notification.remove(), 2000);
        }


        function showTab(tabName) {
            // Hide all tab contents
            document.getElementById('tab-content-description').classList.add('hidden');
            document.getElementById('tab-content-specs').classList.add('hidden');
            document.getElementById('tab-content-reviews').classList.add('hidden');
            
            // Remove active state from all tabs
            document.getElementById('tab-description').classList.remove('border-blue-600', 'text-blue-600');
            document.getElementById('tab-specs').classList.remove('border-blue-600', 'text-blue-600');
            document.getElementById('tab-reviews').classList.remove('border-blue-600', 'text-blue-600');
            
            document.getElementById('tab-description').classList.add('text-gray-600');
            document.getElementById('tab-specs').classList.add('text-gray-600');
            document.getElementById('tab-reviews').classList.add('text-gray-600');
            
            // Show selected tab content and activate tab
            document.getElementById('tab-content-' + tabName).classList.remove('hidden');
            document.getElementById('tab-' + tabName).classList.add('border-blue-600', 'text-blue-600');
            document.getElementById('tab-' + tabName).classList.remove('text-gray-600');
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
            const buttons = document.querySelectorAll('nav button');
            buttons.forEach(btn => {
                btn.classList.remove('bg-blue-50', 'text-blue-600', 'border-blue-600');
                btn.classList.add('text-gray-600', 'border-gray-300');
            });

            // Add active state to selected button
            const activeButton = document.querySelector(`button[onclick*="${activeCategory}"]`);
            if (activeButton) {
                activeButton.classList.add('bg-blue-50', 'text-blue-600', 'border-blue-600');
                activeButton.classList.remove('text-gray-600', 'border-gray-300');
            }
        }

        function filterProducts() {
            const productCards = document.querySelectorAll('.product-card');
            
            productCards.forEach((card, index) => {
                const productId = index + 1;
                const product = products[productId];
                let shouldShow = true;

                // Category filter
                if (currentFilter !== 'all' && product.category !== currentFilter) {
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

                // Show/hide product
                if (shouldShow) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function parsePrice(text){
            // Lấy toàn bộ chữ số, bỏ dấu chấm, khoảng trắng, ký hiệu ₫
            const num = text.replace(/[^\d]/g, '');
            return Number(num); // VND dưới dạng số
        }

        function searchProducts(event) {
            if (event.key === 'Enter') {
                performSearch();
            }
        }

        function performSearch() {
            const searchTerm = document.getElementById('search-input').value.toLowerCase();
            const productCards = document.querySelectorAll('.product-card');
            
            productCards.forEach((card, index) => {
                const productId = index + 1;
                const product = products[productId];
                const productTitle = product.title.toLowerCase();
                
                if (productTitle.includes(searchTerm) || searchTerm === '') {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }



        function sortProducts(sortType) {
            const productGrid = document.getElementById('product-grid');
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
                case 'price-low':
                    sortedProducts = productsWithElements.sort((a, b) => a.data.priceValue - b.data.priceValue);
                    break;
                case 'price-high':
                    sortedProducts = productsWithElements.sort((a, b) => b.data.priceValue - a.data.priceValue);
                    break;
                case 'newest':
                    sortedProducts = productsWithElements.sort((a, b) => b.data.releaseDate - a.data.releaseDate);
                    break;
                default:
                    // Default order (original order)
                    sortedProducts = productsWithElements.sort((a, b) => a.id - b.id);
            }

            // Clear the grid and re-append in sorted order
            productGrid.innerHTML = '';
            sortedProducts.forEach(product => {
                productGrid.appendChild(product.element);
            });
        }

        function parsePrice(text) {
            const num = text.replace(/[^\d]/g, ''); // bỏ . , ₫, khoảng trắng
            return Number(num);
        }
    </script>
@endsection