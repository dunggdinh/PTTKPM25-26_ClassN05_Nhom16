@extends('customer.layout')
@section('title', 'Giỏ Hàng')
@section('content')
<body class="ml-64 w-[calc(100%-16rem)] min-h-screen p-8 pt-24 transition-all bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Cart Items Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-semibold mb-6 text-gray-800">Sản Phẩm Trong Giỏ</h2>
                    
                    <!-- Cart Item 1 -->
                    <div class="flex items-center border-b pb-6 mb-6">
                        <input type="checkbox" id="select-item1" class="mr-4 w-5 h-5 text-blue-600 rounded focus:ring-blue-500" checked onchange="updateSelection()">
                        <div class="w-20 h-20 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center mr-4">
                            <span class="text-2xl">📱</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">iPhone 15 Pro Max</h3>
                            <p class="text-gray-600 text-sm">Màu: Titan Tự Nhiên, 256GB</p>
                            <p class="text-blue-600 font-semibold mt-1">29.990.000₫</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button onclick="updateQuantity(\'item1\', -1)" class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center transition-colors">
                                <span class="text-gray-600">−</span>
                            </button>
                            <span id="qty-item1" class="w-8 text-center font-semibold">1</span>
                            <button onclick="updateQuantity(\'item1\', 1)" class="w-8 h-8 rounded-full bg-blue-500 hover:bg-blue-600 text-white flex items-center justify-center transition-colors">
                                <span>+</span>
                            </button>
                        </div>
                        <button onclick="removeItem(\'item1\')" class="ml-4 text-red-500 hover:text-red-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Cart Item 2 -->
                    <div class="flex items-center border-b pb-6 mb-6">
                        <input type="checkbox" id="select-item2" class="mr-4 w-5 h-5 text-blue-600 rounded focus:ring-blue-500" checked onchange="updateSelection()">
                        <div class="w-20 h-20 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center mr-4">
                            <span class="text-2xl">💻</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">MacBook Air M3</h3>
                            <p class="text-gray-600 text-sm">Màu: Midnight, 13 inch, 512GB</p>
                            <p class="text-blue-600 font-semibold mt-1">32.990.000₫</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button onclick="updateQuantity(\'item2\', -1)" class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center transition-colors">
                                <span class="text-gray-600">−</span>
                            </button>
                            <span id="qty-item2" class="w-8 text-center font-semibold">1</span>
                            <button onclick="updateQuantity(\'item2\', 1)" class="w-8 h-8 rounded-full bg-blue-500 hover:bg-blue-600 text-white flex items-center justify-center transition-colors">
                                <span>+</span>
                            </button>
                        </div>
                        <button onclick="removeItem(\'item2\')" class="ml-4 text-red-500 hover:text-red-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Cart Item 3 -->
                    <div class="flex items-center">
                        <input type="checkbox" id="select-item3" class="mr-4 w-5 h-5 text-blue-600 rounded focus:ring-blue-500" checked onchange="updateSelection()">
                        <div class="w-20 h-20 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center mr-4">
                            <span class="text-2xl">🎧</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">AirPods Pro (Gen 3)</h3>
                            <p class="text-gray-600 text-sm">Màu: Trắng, USB-C</p>
                            <p class="text-blue-600 font-semibold mt-1">6.990.000₫</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button onclick="updateQuantity(\'item3\', -1)" class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center transition-colors">
                                <span class="text-gray-600">−</span>
                            </button>
                            <span id="qty-item3" class="w-8 text-center font-semibold">2</span>
                            <button onclick="updateQuantity(\'item3\', 1)" class="w-8 h-8 rounded-full bg-blue-500 hover:bg-blue-600 text-white flex items-center justify-center transition-colors">
                                <span>+</span>
                            </button>
                        </div>
                        <button onclick="removeItem(\'item3\')" class="ml-4 text-red-500 hover:text-red-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
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
        // Cart data
        let cartItems = {
            item1: { name: \'iPhone 15 Pro Max\', price: 29990000, quantity: 1, selected: true },
            item2: { name: \'MacBook Air M3\', price: 32990000, quantity: 1, selected: true },
            item3: { name: \'AirPods Pro (Gen 3)\', price: 6990000, quantity: 2, selected: true }
        };

        let appliedDiscount = { type: \'\', amount: 0 };

        // Update selection
        function updateSelection() {
            for (let itemId in cartItems) {
                const checkbox = document.getElementById(`select-${itemId}`);
                if (checkbox) {
                    cartItems[itemId].selected = checkbox.checked;
                }
            }
            updateTotals();
        }

        // Update quantity
        function updateQuantity(itemId, change) {
            if (cartItems[itemId]) {
                cartItems[itemId].quantity = Math.max(1, cartItems[itemId].quantity + change);
                document.getElementById(`qty-${itemId}`).textContent = cartItems[itemId].quantity;
                updateTotals();
            }
        }

        // Remove item
        function removeItem(itemId) {
            const itemElement = document.getElementById(`qty-${itemId}`).closest(\'.flex.items-center.border-b, .flex.items-center\').parentElement;
            itemElement.style.animation = \'fadeOut 0.3s ease-out\';
            setTimeout(() => {
                delete cartItems[itemId];
                itemElement.remove();
                updateTotals();
            }, 300);
        }

        // Update totals
        function updateTotals() {
            let subtotal = 0;
            for (let item of Object.values(cartItems)) {
                if (item.selected) {
                    subtotal += item.price * item.quantity;
                }
            }
            
            // Apply discount
            let discountAmount = 0;
            if (appliedDiscount.type === \'percentage\') {
                discountAmount = subtotal * (appliedDiscount.amount / 100);
            } else if (appliedDiscount.type === \'fixed\') {
                discountAmount = appliedDiscount.amount;
            }
            
            const discountedSubtotal = subtotal - discountAmount;
            const tax = discountedSubtotal * 0.1;
            const total = discountedSubtotal + tax;
            
            document.getElementById(\'subtotal\').textContent = formatCurrency(subtotal);
            document.getElementById(\'tax\').textContent = formatCurrency(tax);
            document.getElementById(\'total\').textContent = formatCurrency(total);
            
            // Show discount if applied
            const discountElement = document.getElementById(\'discount-row\');
            if (discountAmount > 0) {
                if (!discountElement) {
                    const discountRow = document.createElement(\'div\');
                    discountRow.id = \'discount-row\';
                    discountRow.className = \'flex justify-between text-green-600\';
                    discountRow.innerHTML = `
                        <span>Giảm giá:</span>
                        <span id="discount-amount">-${formatCurrency(discountAmount)}</span>
                    `;
                    document.getElementById(\'tax\').parentElement.insertAdjacentElement(\'beforebegin\', discountRow);
                } else {
                    document.getElementById(\'discount-amount\').textContent = `-${formatCurrency(discountAmount)}`;
                }
            } else if (discountElement) {
                discountElement.remove();
            }
        }

        // Format currency
        function formatCurrency(amount) {
            return new Intl.NumberFormat(\'vi-VN\', {
                style: \'currency\',
                currency: \'VND\'
            }).format(amount).replace(\'₫\', \'₫\');
        }

        // Apply promo code
        function applyPromo() {
            const promoCode = document.getElementById(\'promo-code\').value;
            
            // Clear custom input when using dropdown
            if (promoCode) {
                document.getElementById(\'custom-promo\').value = \'\';
            }
            
            applyPromoCode(promoCode);
        }

        // Apply custom promo code
        function applyCustomPromo() {
            const customCode = document.getElementById(\'custom-promo\').value.trim().toUpperCase();
            
            if (!customCode) {
                showNotification(\'Vui lòng nhập mã giảm giá\', \'error\');
                return;
            }
            
            // Clear dropdown selection when using custom input
            document.getElementById(\'promo-code\').value = \'\';
            
            applyPromoCode(customCode);
        }

        // Apply promo code logic
        function applyPromoCode(promoCode) {
            // Reset discount
            appliedDiscount = { type: \'\', amount: 0 };
            
            switch (promoCode) {
                case \'GIAM10\':
                    appliedDiscount = { type: \'percentage\', amount: 10 };
                    showNotification(\'Áp dụng mã giảm giá thành công! Giảm 10%\', \'success\');
                    break;
                case \'GIAM50K\':
                    appliedDiscount = { type: \'fixed\', amount: 50000 };
                    showNotification(\'Áp dụng mã giảm giá thành công! Giảm 50.000₫\', \'success\');
                    break;
                case \'FREESHIP\':
                    showNotification(\'Áp dụng mã miễn phí vận chuyển thành công!\', \'success\');
                    break;
                case \'NEWUSER\':
                    appliedDiscount = { type: \'percentage\', amount: 15 };
                    showNotification(\'Áp dụng mã giảm giá thành công! Giảm 15% cho khách mới\', \'success\');
                    break;
                case \'SAVE20\':
                    appliedDiscount = { type: \'percentage\', amount: 20 };
                    showNotification(\'Áp dụng mã giảm giá thành công! Giảm 20%\', \'success\');
                    break;
                case \'GIAM100K\':
                    appliedDiscount = { type: \'fixed\', amount: 100000 };
                    showNotification(\'Áp dụng mã giảm giá thành công! Giảm 100.000₫\', \'success\');
                    break;
                case \'\':
                    showNotification(\'Đã bỏ áp dụng mã giảm giá\', \'success\');
                    break;
                default:
                    if (promoCode) {
                        showNotification(\'Mã giảm giá không hợp lệ\', \'error\');
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
            (document.body || document.documentElement).appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }


        // Proceed to checkout
        function proceedToCheckout() {
            const selectedPayment = document.querySelector(\'input[name="payment"]:checked\').value;
            document.getElementById(\'success-message\').classList.remove(\'hidden\');
        }

        // Close success message
        function closeSuccess() {
            document.getElementById(\'success-message\').classList.add(\'hidden\');
        }

        // Add fadeOut animation
        const style = document.createElement(\'style\');
        style.textContent = `
            @keyframes fadeOut {
                from { opacity: 1; transform: translateX(0); }
                to { opacity: 0; transform: translateX(-100%); }
            }
        `;
        document.head.appendChild(style);

        // Initialize totals
        updateTotals();
    </script>
</body>
@endsection
