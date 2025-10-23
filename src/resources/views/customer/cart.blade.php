@extends('customer.layout')
@section('title', 'Giỏ Hàng')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- 🛒 Cart Items Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-semibold mb-6 text-gray-800">Sản Phẩm Trong Giỏ</h2>

                    <div class="flex items-center justify-between mb-4">
                        <div class="text-sm text-gray-500">Tích chọn các sản phẩm để thao tác nhanh</div>
                        <div class="space-x-2">
                            <button type="button" id="clear-cart" class="px-3 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg">
                                Xóa tất cả
                            </button>
                        </div>
                    </div>

                    <form id="cart-form">
                        @foreach ($cart->CartItem as $item)
                        <div class="flex items-center justify-between border-b py-4">
                            <input type="checkbox" 
                                class="cart-checkbox mr-3" 
                                data-id="{{ $item->cart_item_id  }}"
                                data-name="{{ $item->product->name }}"
                                data-price="{{ $item->product->price }}"
                                data-quantity="{{ $item->quantity }}">

                            <div class="flex-1">
                                <div class="font-semibold">{{ $item->product->name }}</div>
                                <div class="text-gray-600 text-sm">
                                    Giá: {{ number_format($item->product->price, 0, ',', '.') }}₫
                                </div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <button type="button" class="decrease bg-gray-200 px-2 rounded" data-id="{{ $item->cart_item_id }}">−</button>
                                <input type="number" class="w-12 text-center border rounded quantity-input" value="{{ $item->quantity }}" min="1" data-id="{{ $item->cart_item_id }}">
                                <button type="button" class="increase bg-gray-200 px-2 rounded" data-id="{{ $item->cart_item_id }}">+</button>
                                <button type="button" class="remove-item text-red-600 hover:text-red-800 ml-3" data-id="{{ $item->cart_item_id }}">Xóa</button>
                            </div>
                        </div>
                        @endforeach

                    </form>
                </div>
            </div>

            <!-- 💳 Checkout Section -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Tóm Tắt Đơn Hàng</h2>
                    <div id="order-summary">
                        <p class="text-gray-500">Chưa chọn sản phẩm nào.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Promo Code -->
        <div class="mb-6">
            <label for="promo-code" class="block text-sm font-medium text-gray-700 mb-2">Mã giảm giá</label>

            <!-- Dropdown load dynamic -->
            <select id="promo-code" onchange="applyPromo()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent mb-3">
                <option value="">Chọn mã giảm giá</option>
                @foreach ($discounts as $discount)
                    <option value="{{ $discount->code }}"
                            data-type="{{ $discount->type }}"
                            data-value="{{ $discount->value }}">
                        {{ $discount->code }} - 
                        @if($discount->type === 'percent')
                            Giảm {{ $discount->value }}%
                        @else
                            Giảm {{ number_format($discount->value,0,',','.') }}₫
                        @endif
                    </option>
                @endforeach
            </select>

            <div class="flex">
                <input type="text" id="custom-promo" placeholder="Hoặc nhập mã giảm giá khác" class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <button onclick="applyCustomPromo()" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-r-lg transition-colors">
                    Áp dụng
                </button>
            </div>
        </div>
        <!-- Payment Methods -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Phương Thức Thanh Toán</h3>
                    <div class="space-y-3">
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


        <!-- Nút tiến hành thanh toán -->
        <button onclick="placeOrder()" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105">
            Đặt hàng
        </button>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

        <div id="qr-code" class="mt-4"></div>
    </main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cartForm = document.getElementById('cart-form');
    const orderSummary = document.getElementById('order-summary');
    const promoSelect = document.getElementById('promo-code');
    const customPromoInput = document.getElementById('custom-promo');

    let appliedDiscount = null;

    // ✅ Cập nhật order summary
    function updateOrderSummary() {
        const selectedItems = [...cartForm.querySelectorAll('.cart-checkbox')]
            .filter(cb => cb.checked)
            .map(cb => ({
                id: cb.dataset.id,
                name: cb.dataset.name,
                price: parseFloat(cb.dataset.price),
                quantity: parseInt(cb.dataset.quantity)
            }));

        if (selectedItems.length === 0) {
            orderSummary.innerHTML = '<p class="text-gray-500">Chưa chọn sản phẩm nào.</p>';
            return;
        }

        let subtotal = 0;
        let html = '<ul class="space-y-2">';
        selectedItems.forEach(item => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;
            html += `<li class="flex justify-between">
                        <span>${item.name} x ${item.quantity}</span>
                        <span>${itemTotal.toLocaleString('vi-VN')}₫</span>
                     </li>`;
        });
        html += '</ul>';

        // Áp dụng giảm giá
        let discountAmount = 0;
        if (appliedDiscount) {
            if (appliedDiscount.type === 'percent') {
                discountAmount = subtotal * (appliedDiscount.value / 100);
            } else {
                discountAmount = appliedDiscount.value;
            }
            // discountAmount = Math.min(discountAmount, subtotal); // ✅ giới hạn
        }


        const tax = (subtotal - discountAmount) * 0.1;
        const total = subtotal - discountAmount + tax;

        html += `
            <div class="mt-2 border-t pt-2">
                <div class="flex justify-between"><span>Tạm tính:</span><span>${subtotal.toLocaleString('vi-VN')}₫</span></div>
                ${appliedDiscount ? `<div class="flex justify-between text-green-600"><span>Giảm giá (${appliedDiscount.code}):</span><span>-${discountAmount.toLocaleString('vi-VN')}₫</span></div>` : ''}
                <div class="flex justify-between"><span>VAT 10%:</span><span>${tax.toLocaleString('vi-VN')}₫</span></div>
                <div class="flex justify-between font-semibold text-lg mt-1"><span>Tổng cộng:</span><span>${total.toLocaleString('vi-VN')}₫</span></div>
            </div>
        `;

        orderSummary.innerHTML = html;
    }

    // ✅ Cập nhật quantity khi bấm +/-
    cartForm.querySelectorAll('.increase').forEach(btn => {
        btn.addEventListener('click', async () => {
            const id = btn.dataset.id;
            // tìm chính xác input có cùng data-id
            const input = cartForm.querySelector(`.quantity-input[data-id="${id}"]`);
            input.value = parseInt(input.value) + 1;
            await updateQuantity(id, input.value);
        });
    });

    cartForm.querySelectorAll('.decrease').forEach(btn => {
        btn.addEventListener('click', async () => {
            const id = btn.dataset.id;
            const input = cartForm.querySelector(`.quantity-input[data-id="${id}"]`);
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                await updateQuantity(id, input.value);
            }
        });
    });



    // ✅ Input quantity thay đổi trực tiếp
    cartForm.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', async () => {
            let val = parseInt(input.value);
            if (val < 1) val = 1;
            input.value = val;
            await updateQuantity(input.dataset.id, val);
        });
    });

    async function updateQuantity(cartItemId, quantity) {
        try {
            await fetch(`/cart/update/${cartItemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity })
            });
            // Cập nhật data-quantity
            const checkbox = cartForm.querySelector(`.cart-checkbox[data-id="${cartItemId}"]`);
            checkbox.dataset.quantity = quantity;
            updateOrderSummary();
        } catch (err) {
            console.error(err);
        }
    }

    // ✅ Checkbox chọn sản phẩm
    cartForm.querySelectorAll('.cart-checkbox').forEach(cb => {
        cb.addEventListener('change', updateOrderSummary);
    });

    // ✅ Áp dụng mã discount chọn từ dropdown
    window.applyPromo = function() {
        const opt = promoSelect.selectedOptions[0];
        if (!opt || !opt.value) {
            appliedDiscount = null;
        } else {
            appliedDiscount = {
                code: opt.value,
                type: opt.dataset.type,
                value: parseFloat(opt.dataset.value)
            };
        }
        updateOrderSummary();
    }

    // ===== XÓA 1 ITEM =====
    async function removeItem(cartItemId) {
        try {
            const res = await fetch(`/cart/remove/${cartItemId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
            });
            if (!res.ok) throw new Error('Remove failed');
            // Xóa dòng trên UI
            const row = cartForm.querySelector(`.cart-checkbox[data-id="${cartItemId}"]`)?.closest('.flex.items-center.justify-between.border-b.py-4');
            if (row) row.remove();
            updateOrderSummary();
        } catch (e) {
            alert('Xóa sản phẩm thất bại, thử lại sau.');
            console.error(e);
        }
    }

    // Gắn sự kiện nút "Xóa" từng dòng
    cartForm.addEventListener('click', (e) => {
        const btn = e.target.closest('.remove-item');
        if (!btn) return;
        const id = btn.dataset.id;
        if (!id) return;
        removeItem(id);
    });

    // ===== XÓA TẤT CẢ =====
    async function clearCart() {
        if (!confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng?')) return;
        try {
            const res = await fetch(`/cart/clear`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            if (!res.ok) throw new Error('Clear failed');
            // Xóa sạch UI
            cartForm.innerHTML = '';
            updateOrderSummary();
        } catch (e) {
            alert('Xóa toàn bộ giỏ hàng thất bại.');
            console.error(e);
        }
    }
    document.getElementById('clear-cart')?.addEventListener('click', clearCart);

    // ✅ Áp dụng mã custom nhập tay
    window.applyCustomPromo = function() {
        const code = customPromoInput.value.trim();
        if (!code) return alert('Vui lòng nhập mã giảm giá');

        // Cậu có thể gọi API validate mã giảm giá
        // Ví dụ: /cart/validate-discount?code=xxx
        fetch(`/cart/validate-discount?code=${code}`)
            .then(res => res.json())
            .then(data => {
                if (!data.valid) return alert(data.message || 'Mã không hợp lệ');
                appliedDiscount = {
                    code: data.code,
                    type: data.type,
                    value: parseFloat(data.value)
                };
                promoSelect.value = '';
                updateOrderSummary();
            });
    }



    // ✅ Xác nhận thanh toán
    window.proceedToCheckout = function() {
        const selectedItems = [...cartForm.querySelectorAll('.cart-checkbox')]
            .filter(cb => cb.checked)
            .map(cb => cb.dataset.id);

        if (selectedItems.length === 0) return alert('Vui lòng chọn sản phẩm để thanh toán');

        .then(res => res.json())
        .then(data => {
            if (data.success && data.payment_url) {
                // Hiển thị QR code
                document.getElementById('qr-code').innerHTML = '';
                new QRCode(document.getElementById('qr-code'), {
                    text: data.payment_url,
                    width: 200,
                    height: 200
                });

                alert('Quét QR code để thanh toán');

                // Có thể poll trạng thái đơn hàng (xem bước 3)
            } else {
                alert(data.message || 'Tạo QR code thất bại');
            }
        });
    }



    // ✅ Chạy lần đầu
    updateOrderSummary();
    });
    function closeSuccess() {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.classList.add('hidden'); 
        }
    }


    // ✅ Hàm đặt hàng mới
    window.placeOrder = function() {
        const selectedItems = [...cartForm.querySelectorAll('.cart-checkbox')]
            .filter(cb => cb.checked)
            .map(cb => cb.dataset.id);

        if (selectedItems.length === 0) {
            return alert('Vui lòng chọn sản phẩm để đặt hàng');
        }

        fetch('{{ route("customer.cart.placeOrder") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ items: selectedItems })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Hiển thị popup thành công
                const successMessage = document.getElementById('success-message');
                if (successMessage) {
                    successMessage.classList.remove('hidden');
                }

                // Xóa sản phẩm đã đặt khỏi giỏ hàng UI
                selectedItems.forEach(id => {
                    const itemDiv = cartForm.querySelector(`.cart-checkbox[data-id="${id}"]`);
                    if (itemDiv) {
                        itemDiv.closest('div.flex.items-center.justify-between').remove();
                    }
                });

                // Cập nhật lại order summary
                updateOrderSummary();

            } else {
                alert(data.message || 'Đặt hàng thất bại');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Có lỗi xảy ra khi đặt hàng');
        });
    }
</script>


@endsection
