<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce - Khách hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="gradient-header text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <i class="fas fa-store text-purple-600 text-lg"></i>
                    </div>
                    <h1 class="text-xl font-bold text-white">ShopVN</h1>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32'%3E%3Ccircle cx='16' cy='16' r='16' fill='%23f0f0f0'/%3E%3Ctext x='16' y='20' text-anchor='middle' font-size='14' fill='%23666'%3E👤%3C/text%3E%3C/svg%3E" alt="Avatar" class="w-8 h-8 rounded-full">
                        <span class="text-sm">Xin chào, <span id="userName">Khách hàng</span></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg sidebar-transition">
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <button onclick="showSection('home')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-home text-gray-500"></i>
                            <span>Trang chủ</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('products')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-box text-gray-500"></i>
                            <span>Sản phẩm</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('cart')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-shopping-cart text-gray-500"></i>
                            <span>Giỏ hàng</span>
                            <span id="cartCount" class="bg-red-500 text-white text-xs rounded-full px-2 py-1 ml-auto">3</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('orders')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-clipboard-list text-gray-500"></i>
                            <span>Đơn hàng của tôi</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('account')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-user text-gray-500"></i>
                            <span>Tài khoản</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('support')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-headset text-gray-500"></i>
                            <span>Hỗ trợ</span>
                        </button>
                    </li>
                </ul>
            </nav>
        </aside>

        

    



        

            

            

            
        </main>
    </div>

    

    
        </div>
    </div>

    <!-- Modal thanh toán -->
    <div id="checkoutModal" class="fixed inset-0 bg-black bg-opacity-50 modal-overlay hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-8 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto modal-content">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Thanh toán</h3>
                <button onclick="closeCheckoutModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form onsubmit="processCheckout(event)" class="space-y-6">
                <div>
                    <h4 class="font-semibold text-lg mb-4">Thông tin giao hàng</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Họ và tên</label>
                            <input type="text" required class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại</label>
                            <input type="tel" required class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Địa chỉ giao hàng</label>
                        <textarea required rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input"></textarea>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-semibold text-lg mb-4">Phương thức thanh toán</h4>
                    <div class="space-y-3">
                        <label class="flex items-center space-x-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="paymentMethod" value="cod" checked class="text-purple-600">
                            <i class="fas fa-money-bill-wave text-green-600"></i>
                            <span>Thanh toán khi nhận hàng (COD)</span>
                        </label>
                        <label class="flex items-center space-x-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="paymentMethod" value="bank" class="text-purple-600">
                            <i class="fas fa-university text-blue-600"></i>
                            <span>Chuyển khoản ngân hàng</span>
                        </label>
                        <label class="flex items-center space-x-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="paymentMethod" value="card" class="text-purple-600">
                            <i class="fas fa-credit-card text-purple-600"></i>
                            <span>Thẻ tín dụng/ghi nợ</span>
                        </label>
                    </div>
                </div>
                
                <div class="border-t pt-4">
                    <div class="flex justify-between items-center text-xl font-bold text-gray-800 mb-4">
                        <span>Tổng thanh toán:</span>
                        <span id="checkoutTotal">0₫</span>
                    </div>
                    <button type="submit" class="w-full btn-primary text-white py-3 rounded-lg text-lg font-semibold">
                        Đặt hàng
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notification -->
    <div id="notification" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg notification hidden z-50">
        <div class="flex items-center space-x-2">
            <i class="fas fa-check-circle"></i>
            <span id="notificationText"></span>
        </div>
    </div>

    <script>
        // Dữ liệu mẫu
        let products = [
            {
                id: 'laptop-gaming',
                name: 'Laptop Gaming Pro',
                price: 25990000,
                category: 'laptop',
                brand: 'dell',
                description: 'Laptop gaming cao cấp với card đồ họa mạnh mẽ, phù hợp cho game thủ và designer.',
                image: 'fas fa-laptop',
                rating: 4.5,
                reviews: 128
            },
            {
                id: 'smartphone-pro',
                name: 'Smartphone Pro Max',
                price: 15990000,
                category: 'phone',
                brand: 'apple',
                description: 'Điện thoại thông minh cao cấp với camera chuyên nghiệp và hiệu năng vượt trội.',
                image: 'fas fa-mobile-alt',
                rating: 4.7,
                reviews: 256
            },
            {
                id: 'headphones',
                name: 'Tai nghe Bluetooth Premium',
                price: 2990000,
                category: 'accessories',
                brand: 'samsung',
                description: 'Tai nghe không dây chất lượng cao với công nghệ chống ồn.',
                image: 'fas fa-headphones',
                rating: 4.3,
                reviews: 89
            },
            {
                id: 'tablet-pro',
                name: 'Tablet Pro 12.9"',
                price: 12990000,
                category: 'tablet',
                brand: 'apple',
                description: 'Máy tính bảng cao cấp với màn hình lớn, phù hợp cho công việc và giải trí.',
                image: 'fas fa-tablet-alt',
                rating: 4.6,
                reviews: 167
            },
            {
                id: 'laptop-ultrabook',
                name: 'Ultrabook Business',
                price: 18990000,
                category: 'laptop',
                brand: 'hp',
                description: 'Laptop mỏng nhẹ cho doanh nhân, pin trâu và hiệu năng ổn định.',
                image: 'fas fa-laptop',
                rating: 4.4,
                reviews: 95
            },
            {
                id: 'smartphone-mid',
                name: 'Smartphone Galaxy A54',
                price: 8990000,
                category: 'phone',
                brand: 'samsung',
                description: 'Điện thoại tầm trung với camera chất lượng và pin lâu.',
                image: 'fas fa-mobile-alt',
                rating: 4.2,
                reviews: 342
            },
            {
                id: 'smartwatch',
                name: 'Đồng hồ thông minh Apple Watch',
                price: 7990000,
                category: 'accessories',
                brand: 'apple',
                description: 'Đồng hồ thông minh theo dõi sức khỏe và thể thao.',
                image: 'fas fa-clock',
                rating: 4.6,
                reviews: 189
            },
            {
                id: 'keyboard-gaming',
                name: 'Bàn phím cơ Gaming RGB',
                price: 1590000,
                category: 'accessories',
                brand: 'dell',
                description: 'Bàn phím cơ với đèn LED RGB, phù hợp cho game thủ.',
                image: 'fas fa-keyboard',
                rating: 4.1,
                reviews: 76
            },
            {
                id: 'mouse-wireless',
                name: 'Chuột không dây Logitech',
                price: 890000,
                category: 'accessories',
                brand: 'hp',
                description: 'Chuột không dây ergonomic, pin lâu và độ chính xác cao.',
                image: 'fas fa-mouse',
                rating: 4.3,
                reviews: 124
            },
            {
                id: 'monitor-4k',
                name: 'Màn hình 4K 27 inch',
                price: 6990000,
                category: 'accessories',
                brand: 'dell',
                description: 'Màn hình 4K IPS với màu sắc chính xác cho designer.',
                image: 'fas fa-desktop',
                rating: 4.5,
                reviews: 67
            },
            {
                id: 'speaker-bluetooth',
                name: 'Loa Bluetooth JBL',
                price: 1290000,
                category: 'accessories',
                brand: 'samsung',
                description: 'Loa bluetooth chống nước với âm thanh mạnh mẽ.',
                image: 'fas fa-volume-up',
                rating: 4.4,
                reviews: 203
            },
            {
                id: 'tablet-budget',
                name: 'Tablet Samsung Galaxy Tab A8',
                price: 4990000,
                category: 'tablet',
                brand: 'samsung',
                description: 'Tablet giá rẻ phù hợp cho học tập và giải trí cơ bản.',
                image: 'fas fa-tablet-alt',
                rating: 4.0,
                reviews: 156
            },
            {
                id: 'laptop-student',
                name: 'Laptop Sinh viên HP Pavilion',
                price: 12990000,
                category: 'laptop',
                brand: 'hp',
                description: 'Laptop phù hợp cho sinh viên với giá cả hợp lý.',
                image: 'fas fa-laptop',
                rating: 4.2,
                reviews: 234
            },
            {
                id: 'phone-budget',
                name: 'Điện thoại Xiaomi Redmi',
                price: 3990000,
                category: 'phone',
                brand: 'samsung',
                description: 'Điện thoại giá rẻ với cấu hình ổn định.',
                image: 'fas fa-mobile-alt',
                rating: 3.9,
                reviews: 445
            },
            {
                id: 'webcam-hd',
                name: 'Webcam HD 1080p',
                price: 790000,
                category: 'accessories',
                brand: 'hp',
                description: 'Webcam chất lượng cao cho họp online và livestream.',
                image: 'fas fa-video',
                rating: 4.1,
                reviews: 89
            },
            {
                id: 'powerbank',
                name: 'Pin sạc dự phòng 20000mAh',
                price: 590000,
                category: 'accessories',
                brand: 'samsung',
                description: 'Pin sạc dự phòng dung lượng lớn, sạc nhanh.',
                image: 'fas fa-battery-full',
                rating: 4.3,
                reviews: 312
            }
        ];

        let cart = [
            { id: 'laptop-gaming', name: 'Laptop Gaming Pro', price: 25990000, quantity: 1 },
            { id: 'smartphone-pro', name: 'Smartphone Pro Max', price: 15990000, quantity: 1 },
            { id: 'headphones', name: 'Tai nghe Bluetooth Premium', price: 2990000, quantity: 1 }
        ];

        let currentUser = null;

        // Navigation
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.section').forEach(section => {
                section.classList.add('hidden');
            });
            
            // Show selected section
            document.getElementById(sectionId).classList.remove('hidden');
            
            // Update active nav item
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.classList.remove('active');
            });
            event.target.closest('.sidebar-item').classList.add('active');

            // Load section-specific data
            if (sectionId === 'products') {
                loadProducts();
            } else if (sectionId === 'cart') {
                loadCart();
            }
        }

        // Authentication
        function showAuthModal(type) {
            const modal = document.getElementById('authModal');
            const title = document.getElementById('authTitle');
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const forgotForm = document.getElementById('forgotForm');

            // Hide all forms
            loginForm.classList.add('hidden');
            registerForm.classList.add('hidden');
            forgotForm.classList.add('hidden');

            if (type === 'login') {
                title.textContent = 'Đăng nhập';
                loginForm.classList.remove('hidden');
            } else if (type === 'register') {
                title.textContent = 'Đăng ký';
                registerForm.classList.remove('hidden');
            }

            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.add('open'), 10);
        }

        function closeAuthModal() {
            const modal = document.getElementById('authModal');
            modal.classList.remove('open');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        function showForgotPassword() {
            const title = document.getElementById('authTitle');
            const loginForm = document.getElementById('loginForm');
            const forgotForm = document.getElementById('forgotForm');

            title.textContent = 'Quên mật khẩu';
            loginForm.classList.add('hidden');
            forgotForm.classList.remove('hidden');
        }

        function handleLogin(event) {
            event.preventDefault();
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;

            // Simulate login
            currentUser = { name: 'Nguyễn Văn A', email: email };
            document.getElementById('userName').textContent = currentUser.name;
            
            showNotification('Đăng nhập thành công!');
            closeAuthModal();
        }

        function handleRegister(event) {
            event.preventDefault();
            const name = document.getElementById('registerName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = document.getElementById('registerConfirmPassword').value;

            if (password !== confirmPassword) {
                showNotification('Mật khẩu xác nhận không khớp!', 'error');
                return;
            }

            // Simulate registration
            currentUser = { name: name, email: email };
            document.getElementById('userName').textContent = currentUser.name;
            
            showNotification('Đăng ký thành công!');
            closeAuthModal();
        }

        function handleForgotPassword(event) {
            event.preventDefault();
            showNotification('Link đặt lại mật khẩu đã được gửi đến email của bạn!');
            closeAuthModal();
        }

        function logout() {
            currentUser = null;
            document.getElementById('userName').textContent = 'Khách hàng';
            showNotification('Đã đăng xuất!');
        }

        function clearLoginForm() {
            document.getElementById('loginEmail').value = '';
            document.getElementById('loginPassword').value = '';
            showNotification('Đã xóa thông tin đăng nhập!');
        }

        function clearRegisterForm() {
            document.getElementById('registerName').value = '';
            document.getElementById('registerEmail').value = '';
            document.getElementById('registerPhone').value = '';
            document.getElementById('registerPassword').value = '';
            document.getElementById('registerConfirmPassword').value = '';
            showNotification('Đã xóa thông tin đăng ký!');
        }

        function clearForgotForm() {
            document.getElementById('forgotEmail').value = '';
            showNotification('Đã xóa email!');
        }

        // Products
        function loadProducts() {
            const productList = document.getElementById('productList');
            productList.innerHTML = '';

            products.forEach(product => {
                const productCard = document.createElement('div');
                productCard.className = 'bg-white rounded-xl shadow-md p-6 card-hover';
                productCard.innerHTML = `
                    <div class="product-image w-full h-32 rounded-lg mb-4 flex items-center justify-center">
                        <i class="${product.image} text-4xl text-gray-400"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">${product.name}</h4>
                    <div class="flex items-center mb-2">
                        <div class="star-rating text-sm mr-2">
                            ${generateStars(product.rating)}
                        </div>
                        <span class="text-gray-500 text-sm">(${product.reviews})</span>
                    </div>
                    <p class="text-purple-600 font-bold text-lg mb-3">${formatPrice(product.price)}</p>
                    <div class="space-y-2">
                        <button onclick="viewProduct('${product.id}')" class="w-full bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 transition-colors">
                            Xem chi tiết
                        </button>
                        <button onclick="addToCart('${product.id}')" class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors">
                            Thêm vào giỏ
                        </button>
                    </div>
                `;
                productList.appendChild(productCard);
            });
        }

        function searchProducts() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const filteredProducts = products.filter(product => 
                product.name.toLowerCase().includes(searchTerm) ||
                product.description.toLowerCase().includes(searchTerm)
            );
            displayFilteredProducts(filteredProducts);
        }

        function applyFilters() {
            const category = document.getElementById('categoryFilter').value;
            const brand = document.getElementById('brandFilter').value;
            const minPrice = parseInt(document.getElementById('minPrice').value) || 0;
            const maxPrice = parseInt(document.getElementById('maxPrice').value) || Infinity;

            const filteredProducts = products.filter(product => {
                return (!category || product.category === category) &&
                       (!brand || product.brand === brand) &&
                       (product.price >= minPrice && product.price <= maxPrice);
            });

            displayFilteredProducts(filteredProducts);
        }

        function displayFilteredProducts(filteredProducts) {
            const productList = document.getElementById('productList');
            productList.innerHTML = '';

            if (filteredProducts.length === 0) {
                productList.innerHTML = '<div class="col-span-full text-center text-gray-500 py-8">Không tìm thấy sản phẩm nào</div>';
                return;
            }

            filteredProducts.forEach(product => {
                const productCard = document.createElement('div');
                productCard.className = 'bg-white rounded-xl shadow-md p-6 card-hover';
                productCard.innerHTML = `
                    <div class="product-image w-full h-32 rounded-lg mb-4 flex items-center justify-center">
                        <i class="${product.image} text-4xl text-gray-400"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">${product.name}</h4>
                    <div class="flex items-center mb-2">
                        <div class="star-rating text-sm mr-2">
                            ${generateStars(product.rating)}
                        </div>
                        <span class="text-gray-500 text-sm">(${product.reviews})</span>
                    </div>
                    <p class="text-purple-600 font-bold text-lg mb-3">${formatPrice(product.price)}</p>
                    <div class="space-y-2">
                        <button onclick="viewProduct('${product.id}')" class="w-full bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 transition-colors">
                            Xem chi tiết
                        </button>
                        <button onclick="addToCart('${product.id}')" class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors">
                            Thêm vào giỏ
                        </button>
                    </div>
                `;
                productList.appendChild(productCard);
            });
        }

        function viewProduct(productId) {
            const product = products.find(p => p.id === productId);
            if (!product) return;

            document.getElementById('productTitle').textContent = product.name;
            document.getElementById('productPrice').textContent = formatPrice(product.price);
            document.getElementById('productDescription').textContent = product.description;
            document.getElementById('productImage').innerHTML = `<i class="${product.image} text-6xl text-gray-400"></i>`;
            document.getElementById('productQuantity').value = 1;

            const modal = document.getElementById('productModal');
            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.add('open'), 10);
        }

        function closeProductModal() {
            const modal = document.getElementById('productModal');
            modal.classList.remove('open');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        function increaseQuantity() {
            const input = document.getElementById('productQuantity');
            input.value = parseInt(input.value) + 1;
        }

        function decreaseQuantity() {
            const input = document.getElementById('productQuantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        function addToCartFromModal() {
            const title = document.getElementById('productTitle').textContent;
            const quantity = parseInt(document.getElementById('productQuantity').value);
            
            // Find product by title (simplified)
            const product = products.find(p => p.name === title);
            if (product) {
                addToCart(product.id, quantity);
                closeProductModal();
            }
        }

        function buyNow() {
            addToCartFromModal();
            showSection('cart');
        }

        // Cart
        function addToCart(productId, quantity = 1) {
            const product = products.find(p => p.id === productId);
            if (!product) return;

            const existingItem = cart.find(item => item.id === productId);
            if (existingItem) {
                existingItem.quantity += quantity;
            } else {
                cart.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    quantity: quantity
                });
            }

            updateCartCount();
            showNotification(`Đã thêm ${product.name} vào giỏ hàng!`);
        }

        function loadCart() {
            const cartItems = document.getElementById('cartItems');
            const cartTotal = document.getElementById('cartTotal');

            if (cart.length === 0) {
                cartItems.innerHTML = '<div class="text-center text-gray-500 py-8">Giỏ hàng trống</div>';
                cartTotal.textContent = '0₫';
                return;
            }

            cartItems.innerHTML = '';
            let total = 0;

            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;

                const cartItem = document.createElement('div');
                cartItem.className = 'flex items-center justify-between p-4 border rounded-lg';
                cartItem.innerHTML = `
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                            <i class="fas fa-box text-gray-400"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">${item.name}</h4>
                            <p class="text-gray-600">${formatPrice(item.price)}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button onclick="updateCartQuantity('${item.id}', ${item.quantity - 1})" class="w-8 h-8 bg-gray-200 rounded flex items-center justify-center hover:bg-gray-300">
                            <i class="fas fa-minus text-sm"></i>
                        </button>
                        <span class="w-8 text-center">${item.quantity}</span>
                        <button onclick="updateCartQuantity('${item.id}', ${item.quantity + 1})" class="w-8 h-8 bg-gray-200 rounded flex items-center justify-center hover:bg-gray-300">
                            <i class="fas fa-plus text-sm"></i>
                        </button>
                        <button onclick="removeFromCart('${item.id}')" class="ml-4 text-red-600 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                cartItems.appendChild(cartItem);
            });

            cartTotal.textContent = formatPrice(total);
        }

        function updateCartQuantity(productId, newQuantity) {
            if (newQuantity <= 0) {
                removeFromCart(productId);
                return;
            }

            const item = cart.find(item => item.id === productId);
            if (item) {
                item.quantity = newQuantity;
                loadCart();
                updateCartCount();
            }
        }

        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            loadCart();
            updateCartCount();
            showNotification('Đã xóa sản phẩm khỏi giỏ hàng!');
        }

        function updateCartCount() {
            const count = cart.reduce((total, item) => total + item.quantity, 0);
            document.getElementById('cartCount').textContent = count;
        }

        function proceedToCheckout() {
            if (cart.length === 0) {
                showNotification('Giỏ hàng trống!', 'error');
                return;
            }

            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            document.getElementById('checkoutTotal').textContent = formatPrice(total);
            const modal = document.getElementById('checkoutModal');
            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.add('open'), 10);
        }

        function closeCheckoutModal() {
            const modal = document.getElementById('checkoutModal');
            modal.classList.remove('open');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        function processCheckout(event) {
            event.preventDefault();
            
            // Simulate order processing
            const orderId = 'DH' + Date.now().toString().slice(-6);
            
            showNotification(`Đặt hàng thành công! Mã đơn hàng: ${orderId}`);
            
            // Clear cart
            cart = [];
            updateCartCount();
            loadCart();
            
            closeCheckoutModal();
            showSection('orders');
        }

        // Orders
        function viewOrderDetail(orderId) {
            showNotification(`Xem chi tiết đơn hàng ${orderId}`);
        }

        function trackOrder(orderId) {
            showNotification(`Theo dõi đơn hàng ${orderId}: Đang giao hàng`);
        }

        // Account
        function updateProfile(event) {
            event.preventDefault();
            showNotification('Cập nhật thông tin thành công!');
        }

        function changePassword(event) {
            event.preventDefault();
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (newPassword !== confirmPassword) {
                showNotification('Mật khẩu xác nhận không khớp!', 'error');
                return;
            }

            showNotification('Đổi mật khẩu thành công!');
            
            // Clear form
            document.getElementById('currentPassword').value = '';
            document.getElementById('newPassword').value = '';
            document.getElementById('confirmPassword').value = '';
        }

        function cancelProfileUpdate() {
            // Reset form to original values
            document.getElementById('fullName').value = 'Nguyễn Văn A';
            document.getElementById('email').value = 'nguyenvana@email.com';
            document.getElementById('phone').value = '0123456789';
            document.getElementById('address').value = '123 Đường ABC, Quận 1, TP.HCM';
            showNotification('Đã hủy thay đổi thông tin!');
        }

        function cancelPasswordChange() {
            // Clear password form
            document.getElementById('currentPassword').value = '';
            document.getElementById('newPassword').value = '';
            document.getElementById('confirmPassword').value = '';
            showNotification('Đã hủy đổi mật khẩu!');
        }

        function clearSupportForm() {
            // Clear support form
            document.getElementById('issueType').value = '';
            document.getElementById('issueTitle').value = '';
            document.getElementById('issueDescription').value = '';
            showNotification('Đã xóa nội dung form!');
        }

        // Support
        function sendMessage() {
            const input = document.getElementById('chatInput');
            const message = input.value.trim();
            
            if (!message) return;

            const chatMessages = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'mb-3 text-right';
            messageDiv.innerHTML = `
                <div class="bg-purple-100 text-purple-800 p-3 rounded-lg inline-block">
                    ${message}
                </div>
                <div class="text-xs text-gray-500 mt-1">Bạn - ${new Date().toLocaleTimeString('vi-VN', {hour: '2-digit', minute: '2-digit'})}</div>
            `;
            chatMessages.appendChild(messageDiv);

            input.value = '';
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Simulate response
            setTimeout(() => {
                const responseDiv = document.createElement('div');
                responseDiv.className = 'mb-3';
                responseDiv.innerHTML = `
                    <div class="bg-blue-100 text-blue-800 p-3 rounded-lg inline-block">
                        Cảm ơn bạn đã liên hệ! Chúng tôi sẽ hỗ trợ bạn ngay.
                    </div>
                    <div class="text-xs text-gray-500 mt-1">Hỗ trợ viên - ${new Date().toLocaleTimeString('vi-VN', {hour: '2-digit', minute: '2-digit'})}</div>
                `;
                chatMessages.appendChild(responseDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 1000);
        }

        function submitSupportRequest(event) {
            event.preventDefault();
            showNotification('Yêu cầu hỗ trợ đã được gửi! Chúng tôi sẽ phản hồi trong 24h.');
            
            // Clear form
            document.getElementById('issueType').value = '';
            document.getElementById('issueTitle').value = '';
            document.getElementById('issueDescription').value = '';
        }

        function toggleFAQ(id) {
            const faq = document.getElementById(`faq${id}`);
            faq.classList.toggle('hidden');
        }

        function showReviewForm() {
            showNotification('Tính năng viết đánh giá đang được phát triển!');
        }

        // Utilities
        function formatPrice(price) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(price);
        }

        function generateStars(rating) {
            const fullStars = Math.floor(rating);
            const hasHalfStar = rating % 1 !== 0;
            let stars = '';

            for (let i = 0; i < fullStars; i++) {
                stars += '<i class="fas fa-star"></i>';
            }

            if (hasHalfStar) {
                stars += '<i class="fas fa-star-half-alt"></i>';
            }

            const emptyStars = 5 - Math.ceil(rating);
            for (let i = 0; i < emptyStars; i++) {
                stars += '<i class="far fa-star"></i>';
            }

            return stars;
        }

        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notificationText');
            
            notificationText.textContent = message;
            
            if (type === 'error') {
                notification.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg notification z-50';
            } else {
                notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg notification z-50';
            }
            
            notification.classList.remove('hidden');
            
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 3000);
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            showSection('home');
            updateCartCount();
            
            // Add enter key support for chat
            document.getElementById('chatInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'98937a68721f0452',t:'MTc1OTU2ODMxNC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
