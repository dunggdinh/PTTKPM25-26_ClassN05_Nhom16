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

        <!-- Nút tiến hành thanh toán -->
        <button onclick="proceedToCheckout()" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105">
            Tiến Hành Thanh Toán
        </button>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

        <div id="qr-code" class="mt-4"></div>
    </main>

    <script>
    /* ===== Helpers giữ nguyên ===== */
    function slugify(str='') {
        return String(str).normalize('NFKD').replace(/[\u0300-\u036f]/g,'').toLowerCase()
            .replace(/[^a-z0-9]+/g,'-').replace(/(^-|-$)/g,'');
    }
    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN', {style: 'currency', currency: 'VND'})
            .format(amount).replace('₫','₫');
    }
    function getProductEmoji(productName) {
        const name = (productName||'').toLowerCase();
        if (name.includes('iphone') || name.includes('phone')) return '📱';
        if (name.includes('macbook') || name.includes('laptop')) return '💻';
        if (name.includes('airpods') || name.includes('headphone')) return '🎧';
        if (name.includes('ipad') || name.includes('tablet')) return '📱';
        if (name.includes('watch')) return '⌚';
        if (name.includes('mouse')) return '🖱️';
        if (name.includes('keyboard')) return '⌨️';
        return '📦';
    }
    function showNotification(message, type) {
        const n = document.createElement('div');
        n.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 fade-in ${type==='success'?'bg-green-500':'bg-red-500'}`;
        n.textContent = message; document.body.appendChild(n);
        setTimeout(()=>n.remove(),3000);
    }

    /* ====== Trạng thái toàn cục (dùng DB) ====== */
    let CART = { cart_id: '', items: [], subtotal: 0 };
    let appliedDiscount = { type: '', amount: 0 }; // vẫn tính trên client như trước

    /* ====== API helpers ====== */
    async function apiGet(url) {
        const res = await fetch(url, {headers: {'Accept':'application/json'}});
        if (!res.ok) throw new Error(await res.text());
        return res.json();
    }
    async function apiJson(url, method, data) {
        const res = await fetch(url, {
            method,
            headers: {
            'Content-Type':'application/json',
            'Accept':'application/json',
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            body: JSON.stringify(data||{})
        });
        if (!res.ok) throw new Error(await res.text());
        return res.json();
    }

    /* ====== Load từ DB ====== */
    async function loadCart() {
        const data = await apiGet('/cart/data');
        CART.cart_id = data.cart_id;
        // server trả: items = [{cart_item_id, product_id, name, price, quantity}]
        CART.items = data.items || [];
        CART.subtotal = data.subtotal || 0;
    }

    /* ====== Render ====== */
    function renderCartItems() {
        const container = document.getElementById('cart-items-container');
        const items = CART.items;

        if (selectedItems.length === 0) {
            orderSummary.innerHTML = '<p class="text-gray-500">Chưa chọn sản phẩm nào.</p>';
            return;
        }

        container.innerHTML = items.map((it, idx) => {
            const isLast = idx === items.length - 1;
            const borderClass = isLast ? '' : 'border-b pb-6 mb-6';
            const emoji = getProductEmoji(it.name);
            const price = Number(it.price)||0;

            return `
            <div class="flex items-center ${borderClass}">
                <input type="checkbox" id="select-${it.cart_item_id}" class="mr-4 w-5 h-5 text-blue-600 rounded focus:ring-blue-500" checked onchange="updateSelection('${it.cart_item_id}')">
                <div class="w-20 h-20 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center mr-4">
                <span class="text-2xl">${emoji}</span>
                </div>
                <div class="flex-1">
                <h3 class="font-semibold text-gray-800">${it.name}</h3>
                <p class="text-blue-600 font-semibold mt-1">${formatCurrency(price)}</p>
                </div>
                <div class="flex items-center space-x-3">
                <button onclick="changeQuantity('${it.cart_item_id}', -1)" class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center transition-colors"><span class="text-gray-600">−</span></button>
                <span id="qty-${it.cart_item_id}" class="w-8 text-center font-semibold">${it.quantity}</span>
                <button onclick="changeQuantity('${it.cart_item_id}', 1)" class="w-8 h-8 rounded-full bg-blue-500 hover:bg-blue-600 text-white flex items-center justify-center transition-colors"><span>+</span></button>
                </div>
                <div class="w-28 text-right font-semibold ml-4">
                ${formatCurrency(price * (Number(it.quantity)||1))}
                </div>
                <button onclick="removeItem('${it.cart_item_id}')" class="ml-4 text-red-500 hover:text-red-700 transition-colors" aria-label="Xóa sản phẩm">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            `;
        }).join('');

        updateTotals();
    }

    /* ====== Selection (client-only) ======
    Ta lưu "selected" tạm thời trên DOM (checkbox). Nếu muốn persist về DB, cần thêm cột/field. */
    function updateSelection(cartItemId) {
        // chỉ cần tính lại totals theo checkbox
        updateTotals();
    }

    /* ====== Cập nhật số lượng (PATCH /cart/item/{id}) ====== */
    async function changeQuantity(cartItemId, delta) {
        const item = CART.items.find(x=>x.cart_item_id===cartItemId);
        if (!item) return;
        const newQty = Math.max(1, (Number(item.quantity)||1) + Number(delta));
        await apiJson(`/cart/item/${cartItemId}`, 'PATCH', {quantity: newQty});
        item.quantity = newQty;
        document.getElementById(`qty-${cartItemId}`).textContent = newQty;
        renderCartItems();
        showNotification(`Đã cập nhật số lượng: ${newQty}`, 'success');
    }

    /* ====== Xoá item (DELETE /cart/item/{id}) ====== */
    async function removeItem(cartItemId) {
        await apiJson(`/cart/item/${cartItemId}`, 'DELETE');
        CART.items = CART.items.filter(x=>x.cart_item_id !== cartItemId);
        renderCartItems();
        showNotification('Đã xóa sản phẩm khỏi giỏ hàng', 'success');
    }

    /* ====== Tổng tiền (dựa trên checkbox + discount client) ====== */
    function updateTotals() {
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
    function applyPromoCode(code){
        appliedDiscount={type:'',amount:0};
        switch(code){
            case 'GIAM10': appliedDiscount={type:'percentage',amount:10}; showNotification('Áp dụng mã giảm giá thành công! Giảm 10%','success'); break;
            case 'GIAM50K': appliedDiscount={type:'fixed',amount:50000}; showNotification('Áp dụng mã giảm giá thành công! Giảm 50.000₫','success'); break;
            case 'FREESHIP': showNotification('Áp dụng mã miễn phí vận chuyển thành công!','success'); break;
            case 'NEWUSER': appliedDiscount={type:'percentage',amount:15}; showNotification('Áp dụng mã giảm giá thành công! Giảm 15%','success'); break;
            case 'SAVE20': appliedDiscount={type:'percentage',amount:20}; showNotification('Áp dụng mã giảm giá thành công! Giảm 20%','success'); break;
            case 'GIAM100K': appliedDiscount={type:'fixed',amount:100000}; showNotification('Áp dụng mã giảm giá thành công! Giảm 100.000₫','success'); break;
            case '': showNotification('Đã bỏ áp dụng mã giảm giá','success'); break;
            default: if(code) showNotification('Mã giảm giá không hợp lệ','error'); break;
        }
        updateTotals();
    }

    /* ====== Thanh toán (demo) ====== */
    function proceedToCheckout(){
        const selectedPayment = document.querySelector('input[name="payment"]:checked')?.value;
        // TODO: tạo Order từ giỏ (gọi endpoint /checkout) – tuỳ flow của cậu
        document.getElementById('success-message').classList.remove('hidden');
    }

    function closeSuccess(){
        document.getElementById('success-message').classList.add('hidden');
        showNotification('Cảm ơn bạn đã mua sắm tại cửa hàng!', 'success');
        // Có thể xóa sạch giỏ nếu muốn
        apiJson('/cart/clear', 'DELETE').then(()=>{
            CART.items = [];
            renderCartItems();
        });
    }

    /* ====== Khởi tạo khi load trang ====== */
    document.addEventListener('DOMContentLoaded', async ()=>{
        try {
            await loadCart();
            renderCartItems();
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

        fetch('{{ route("customer.vnpay.create") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ items: selectedItems })
        })
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
</script>


@endsection
