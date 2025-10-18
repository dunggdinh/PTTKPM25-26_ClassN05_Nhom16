@extends('customer.layout')
@section('title', 'Giỏ Hàng')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Cart Items Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-semibold mb-6 text-gray-800">Sản Phẩm Trong Giỏ</h2>
                    
                    <!-- Cart Items Container -->
                    <div id="cart-items-container">
                        <!-- Items will be dynamically loaded here -->
                    </div>
                </div>
            </div>

            <!-- Checkout Section -->
            <div class="lg:col-span-1">
                <!-- Order Summary -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Tóm Tắt Đơn Hàng</h2>
                    
                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tạm tính:</span>
                            <span id="subtotal" class="font-semibold">76.970.000₫</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Phí vận chuyển:</span>
                            <span class="font-semibold text-green-600">Miễn phí</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Thuế VAT (10%):</span>
                            <span id="tax" class="font-semibold">7.697.000₫</span>
                        </div>
                        <hr class="my-3">
                        <div class="flex justify-between text-lg">
                            <span class="font-semibold text-gray-800">Tổng cộng:</span>
                            <span id="total" class="font-bold text-blue-600">84.667.000₫</span>
                        </div>
                    </div>

                    <!-- Promo Code -->
                    <div class="mb-6">
                        <label for="promo-code" class="block text-sm font-medium text-gray-700 mb-2">Mã giảm giá</label>
                        <select id="promo-code" onchange="applyPromo()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent mb-3">
                            <option value="">Chọn mã giảm giá</option>
                            <option value="GIAM10">GIAM10 - Giảm 10%</option>
                            <option value="GIAM50K">GIAM50K - Giảm 50.000₫</option>
                            <option value="FREESHIP">FREESHIP - Miễn phí vận chuyển</option>
                            <option value="NEWUSER">NEWUSER - Giảm 15% cho khách mới</option>
                        </select>
                        <div class="flex">
                            <input type="text" id="custom-promo" placeholder="Hoặc nhập mã giảm giá khác" class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <button onclick="applyCustomPromo()" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-r-lg transition-colors">
                                Áp dụng
                            </button>
                        </div>
                    </div>

                    <button onclick="proceedToCheckout()" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105">
                        Tiến Hành Thanh Toán
                    </button>
                </div>

                <!-- Payment Methods -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Phương Thức Thanh Toán</h3>
                    <div class="space-y-3">
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="payment" value="card" class="mr-3" checked>
                            <div class="flex items-center">
                                <span class="text-2xl mr-2">💳</span>
                                <span>Thẻ tín dụng/ghi nợ</span>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="payment" value="vnpay" class="mr-3">
                            <div class="flex items-center">
                                <span class="text-2xl mr-2">📱</span>
                                <span>VNPay</span>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="payment" value="banking" class="mr-3">
                            <div class="flex items-center">
                                <span class="text-2xl mr-2">🏦</span>
                                <span>Chuyển khoản ngân hàng</span>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="payment" value="cod" class="mr-3">
                            <div class="flex items-center">
                                <span class="text-2xl mr-2">💰</span>
                                <span>Thanh toán khi nhận hàng</span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message (Hidden by default) -->
        <div id="success-message" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl p-8 max-w-md mx-4 text-center fade-in">
                <div class="text-6xl mb-4">✅</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Đặt Hàng Thành Công!</h3>
                <p class="text-gray-600 mb-6">Cảm ơn bạn đã mua sắm. Chúng tôi sẽ liên hệ sớm nhất để xác nhận đơn hàng.</p>
                <button onclick="closeSuccess()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                    Đóng
                </button>
            </div>
        </div>
    </main>

    <script>
        // ---- Helpers cho biến thể & SKU ----
        function slugify(str='') {
        return String(str)
            .normalize('NFKD')
            .replace(/[\u0300-\u036f]/g, '') // bỏ dấu tiếng Việt
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)/g, '');
        }

        // Tạo khóa duy nhất cho 1 biến thể của sản phẩm
        function buildSkuKey(name, variant = {}) {
            const n = slugify(name || '');
            const storage = slugify(variant?.storage || '');
            const color = slugify(variant?.color || '');
            // name|storage|color (ví dụ: iphone-15-pro-max|512gb|xanh)
            return [n, storage, color].join('|');
        }

        // Hợp nhất các item trùng SKU (cộng quantity, giữ giá đơn vị mới nhất)
        function consolidateCartArrayToMap(arr = []) {
            const map = {};
            for (const item of arr) {
                const variant = item.variant || { storage: '', color: '' };
                const key = buildSkuKey(item.name, variant);
                if (!map[key]) {
                map[key] = {
                    ...item,
                    id: key,
                    variant,
                    quantity: Number(item.quantity) || 1,
                    // 👇 Quan trọng: nếu chưa có selected thì mặc định true
                    selected: (item.selected ?? true)
                };
                } else {
                map[key].quantity += Number(item.quantity) || 1;
                map[key].price = Number(item.price);
                // nếu item cũ chưa có selected mà item mới có → ưu tiên true
                map[key].selected = (map[key].selected ?? true) && (item.selected ?? true);
                }
            }
            return map;
            }


        // Global Cart Management System
        class CartManager {
            constructor() {
                this.storageKey = 'cart'; // cùng key với addToCart ở trang khác
                this.loadCart();
            }

            loadCart() {
                const saved = localStorage.getItem(this.storageKey);
                if (saved) {
                const arr = JSON.parse(saved);
                // Chuẩn hoá + gộp dòng theo SKU
                this.cartItems = consolidateCartArrayToMap(arr);
                this.saveCart(); // lưu lại dạng chuẩn hoá
                } else {
                this.cartItems = {};
                }
            }

            saveCart() {
                const cartArray = Object.values(this.cartItems);
                localStorage.setItem(this.storageKey, JSON.stringify(cartArray));
                this.updateCartCount();
            }

            // Thêm sp vào giỏ (có thể gọi từ trang khác): name, price, variant = {storage,color}, quantity = 1
            addToCart(productName, price, variant = {}, quantity = 1) {
                const key = buildSkuKey(productName, variant);
                const unitPrice = Number(price);

                if (this.cartItems[key]) {
                this.cartItems[key].quantity += Number(quantity) || 1;
                // cập nhật giá đơn vị mới nhất (tuỳ policy)
                this.cartItems[key].price = unitPrice;
                } else {
                this.cartItems[key] = {
                    id: key,
                    name: productName,
                    price: unitPrice,     // giá đơn vị
                    quantity: Number(quantity) || 1,
                    image: 'default',
                    selected: true,
                    variant: {
                    storage: variant?.storage || '',
                    color: variant?.color || ''
                    }
                };
                }
                this.saveCart();
                return key; // trả về id (SKU)
            }

            removeItem(itemId) {
                delete this.cartItems[itemId];
                this.saveCart();
            }

            updateQuantity(itemId, newQuantity) {
                if (this.cartItems[itemId] && newQuantity > 0) {
                this.cartItems[itemId].quantity = Number(newQuantity);
                this.saveCart();
                return true;
                }
                return false;
            }

            updateSelection(itemId, selected) {
                if (this.cartItems[itemId]) {
                this.cartItems[itemId].selected = !!selected;
                this.saveCart();
                }
            }

            getCartCount() {
                return Object.values(this.cartItems).reduce((sum, it) => sum + (Number(it.quantity) || 0), 0);
            }

            updateCartCount() {
                const el = document.getElementById('cart-count');
                if (el) el.textContent = this.getCartCount();
            }

            clearCart() {
                this.cartItems = {};
                this.saveCart();
            }
            }


        // Initialize cart manager
        const cartManager = new CartManager();
        let cartItems = cartManager.cartItems;
        let appliedDiscount = { type: '', amount: 0 };

        // Sync cartItems with cartManager whenever it changes
        function syncCartItems() {
            cartItems = cartManager.cartItems;
        }

        // Global function for other pages to add items (compatible with your format)
        window.addToCart = function(productName, price, variant = {}, quantity = 1) {
            const itemId = cartManager.addToCart(productName, price, variant, quantity);
            showNotification(`Đã thêm ${productName}${variant?.storage ? ' ('+variant.storage : ''}${variant?.color ? (variant.storage ? ', ' : ' (') + variant.color : ''}${(variant?.storage || variant?.color) ? ')' : ''} vào giỏ hàng!`, 'success');
            syncCartItems();
            renderCartItems();
            updateTotals();
            return itemId;
        };

        // Global function to get cart count
        window.getCartCount = function() {
            return cartManager.getCartCount();
        };

        // Render cart items dynamically
        function renderCartItems() {
            const container = document.getElementById('cart-items-container');
            const items = Object.values(cartItems);

            container.innerHTML = items.map((item, index) => {
                const isLast = index === items.length - 1;
                const borderClass = isLast ? '' : 'border-b pb-6 mb-6';
                const emoji = getProductEmoji(item.name);
                const variantText = [item?.variant?.storage, item?.variant?.color].filter(Boolean).join(', ');

                return `
                <div class="flex items-center ${borderClass}">
                    <input type="checkbox" id="select-${item.id}" class="mr-4 w-5 h-5 text-blue-600 rounded focus:ring-blue-500" ${item.selected ? 'checked' : ''} onchange="updateSelection()">
                    <div class="w-20 h-20 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-2xl">${emoji}</span>
                    </div>
                    <div class="flex-1">
                    <h3 class="font-semibold text-gray-800">${item.name}</h3>
                    ${variantText ? `<p class="text-gray-500 text-sm">Biến thể: ${variantText}</p>` : ''}
                    <p class="text-blue-600 font-semibold mt-1">${formatCurrency(item.price)}</p>
                    </div>
                    <div class="flex items-center space-x-3">
                    <button onclick="updateQuantity('${item.id}', -1)" class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center transition-colors">
                        <span class="text-gray-600">−</span>
                    </button>

                    <span id="qty-${item.id}" class="w-8 text-center font-semibold">${item.quantity}</span>

                    <button onclick="updateQuantity('${item.id}', 1)" class="w-8 h-8 rounded-full bg-blue-500 hover:bg-blue-600 text-white flex items-center justify-center transition-colors">
                        <span>+</span>
                    </button>

                    </div>
                    <button onclick="removeItem('${item.id}')" class="ml-4 text-red-500 hover:text-red-700 transition-colors" aria-label="Xóa sản phẩm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    </button>
                </div>
                `;
            }).join('');
            }


        // Get appropriate emoji for product
        function getProductEmoji(productName) {
            const name = productName.toLowerCase();
            if (name.includes('iphone') || name.includes('phone')) return '📱';
            if (name.includes('macbook') || name.includes('laptop')) return '💻';
            if (name.includes('airpods') || name.includes('headphone')) return '🎧';
            if (name.includes('ipad') || name.includes('tablet')) return '📱';
            if (name.includes('watch')) return '⌚';
            if (name.includes('mouse')) return '🖱️';
            if (name.includes('keyboard')) return '⌨️';
            return '📦';
        }

        // Update selection
        function updateSelection() {
            for (let itemId in cartItems) {
                const checkbox = document.getElementById(`select-${itemId}`);
                if (checkbox) {
                    cartManager.updateSelection(itemId, checkbox.checked);
                    cartItems[itemId].selected = checkbox.checked;
                }
            }
            updateTotals();
        }

        function updateQuantity(itemId, delta) {
            if (cartItems[itemId]) {
                const currentQuantity = Number(cartItems[itemId].quantity) || 1;
                const newQuantity = Math.max(1, currentQuantity + Number(delta));

                if (cartManager.updateQuantity(itemId, newQuantity)) {
                syncCartItems();
                const qtyElement = document.getElementById(`qty-${itemId}`);
                if (qtyElement) qtyElement.textContent = newQuantity;
                updateTotals();
                showNotification(`Đã cập nhật số lượng: ${newQuantity}`, 'success');
                }
            }
            }



        // Remove item
        function removeItem(itemId) {
            cartManager.removeItem(itemId);
            syncCartItems();
            renderCartItems();
            updateTotals();
            showNotification('Đã xóa sản phẩm khỏi giỏ hàng', 'success');
        }

        // Update totals
        function updateTotals() {
            let subtotal = 0;
            for (let item of Object.values(cartItems)) {
                // Ép kiểu an toàn
                const price = Number(item.price) || 0;
                const qty = Number(item.quantity) || 0;
                if (item.selected) subtotal += price * qty;
            }

            // Tính discount
            let discountAmount = 0;
            if (appliedDiscount.type === 'percentage') {
                discountAmount = subtotal * (appliedDiscount.amount / 100);
            } else if (appliedDiscount.type === 'fixed') {
                discountAmount = Number(appliedDiscount.amount) || 0;
            }
            // Không cho vượt subtotal và không âm
            discountAmount = Math.max(0, Math.min(discountAmount, subtotal));

            const discountedSubtotal = subtotal - discountAmount;
            const tax = discountedSubtotal * 0.1;
            const total = discountedSubtotal + tax;

            document.getElementById('subtotal').textContent = formatCurrency(subtotal);
            document.getElementById('tax').textContent = formatCurrency(tax);
            document.getElementById('total').textContent = formatCurrency(total);

            // Hiện dòng “Giảm giá”
            const discountElement = document.getElementById('discount-row');
            if (discountAmount > 0) {
                if (!discountElement) {
                const discountRow = document.createElement('div');
                discountRow.id = 'discount-row';
                discountRow.className = 'flex justify-between text-green-600';
                discountRow.innerHTML = `
                    <span>Giảm giá:</span>
                    <span id="discount-amount">-${formatCurrency(discountAmount)}</span>
                `;
                document.getElementById('tax').parentElement.insertAdjacentElement('beforebegin', discountRow);
                } else {
                document.getElementById('discount-amount').textContent = `-${formatCurrency(discountAmount)}`;
                }
            } else if (discountElement) {
                discountElement.remove();
            }
            }


        // Format currency
        function formatCurrency(amount) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(amount).replace('₫', '₫');
        }

        // Apply promo code
        function applyPromo() {
            const promoCode = document.getElementById('promo-code').value;
            
            // Clear custom input when using dropdown
            if (promoCode) {
                document.getElementById('custom-promo').value = '';
            }
            
            applyPromoCode(promoCode);
        }

        // Apply custom promo code
        function applyCustomPromo() {
            const customCode = document.getElementById('custom-promo').value.trim().toUpperCase();
            
            if (!customCode) {
                showNotification('Vui lòng nhập mã giảm giá', 'error');
                return;
            }
            
            // Clear dropdown selection when using custom input
            document.getElementById('promo-code').value = '';
            
            applyPromoCode(customCode);
        }

        // Apply promo code logic
        function applyPromoCode(promoCode) {
            // Reset discount
            appliedDiscount = { type: '', amount: 0 };
            
            switch (promoCode) {
                case 'GIAM10':
                    appliedDiscount = { type: 'percentage', amount: 10 };
                    showNotification('Áp dụng mã giảm giá thành công! Giảm 10%', 'success');
                    break;
                case 'GIAM50K':
                    appliedDiscount = { type: 'fixed', amount: 50000 };
                    showNotification('Áp dụng mã giảm giá thành công! Giảm 50.000₫', 'success');
                    break;
                case 'FREESHIP':
                    showNotification('Áp dụng mã miễn phí vận chuyển thành công!', 'success');
                    break;
                case 'NEWUSER':
                    appliedDiscount = { type: 'percentage', amount: 15 };
                    showNotification('Áp dụng mã giảm giá thành công! Giảm 15% cho khách mới', 'success');
                    break;
                case 'SAVE20':
                    appliedDiscount = { type: 'percentage', amount: 20 };
                    showNotification('Áp dụng mã giảm giá thành công! Giảm 20%', 'success');
                    break;
                case 'GIAM100K':
                    appliedDiscount = { type: 'fixed', amount: 100000 };
                    showNotification('Áp dụng mã giảm giá thành công! Giảm 100.000₫', 'success');
                    break;
                case '':
                    showNotification('Đã bỏ áp dụng mã giảm giá', 'success');
                    break;
                default:
                    if (promoCode) {
                        showNotification('Mã giảm giá không hợp lệ', 'error');
                    }
                    break;
            }
            
            updateTotals();
        }

        // Show notification
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 fade-in ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Proceed to checkout
        function proceedToCheckout() {
            const selectedPayment = document.querySelector('input[name="payment"]:checked').value;
            document.getElementById('success-message').classList.remove('hidden');
        }

        // Close success message
        function closeSuccess() {
            document.getElementById('success-message').classList.add('hidden');
        }

        // Add fadeOut animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeOut {
                from { opacity: 1; transform: translateX(0); }
                to { opacity: 0; transform: translateX(-100%); }
            }
        `;
        document.head.appendChild(style);

        // Demo function to show how to add items from other pages
        window.demoAddProduct = function() {
            addToCart('iPad Pro M4', 28990000);
        };

        // Initialize the cart display
        function initializeCart() {
            renderCartItems();
            updateTotals();
        }

        // Initialize when page loads
        initializeCart();
    </script>
@endsection
