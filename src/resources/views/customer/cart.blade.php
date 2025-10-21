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

        if (!items.length) {
            container.innerHTML = `<div class="text-gray-500">Giỏ hàng trống.</div>`;
            updateTotals();
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
        CART.items.forEach(it => {
            const cb = document.getElementById(`select-${it.cart_item_id}`);
            const selected = cb ? cb.checked : true;
            if (selected) subtotal += (Number(it.price)||0) * (Number(it.quantity)||0);
        });

        // discount client như cũ
        let discountAmount = 0;
        if (appliedDiscount.type === 'percentage') {
            discountAmount = subtotal * (appliedDiscount.amount/100);
        } else if (appliedDiscount.type === 'fixed') {
            discountAmount = Number(appliedDiscount.amount)||0;
        }
        discountAmount = Math.max(0, Math.min(discountAmount, subtotal));

        const discountedSubtotal = subtotal - discountAmount;
        const tax = discountedSubtotal * 0.1;
        const total = discountedSubtotal + tax;

        document.getElementById('subtotal').textContent = formatCurrency(subtotal);
        document.getElementById('tax').textContent = formatCurrency(tax);
        document.getElementById('total').textContent = formatCurrency(total);

        // dòng "Giảm giá"
        const discountElement = document.getElementById('discount-row');
        if (discountAmount > 0) {
            if (!discountElement) {
            const discountRow = document.createElement('div');
            discountRow.id = 'discount-row';
            discountRow.className = 'flex justify-between text-green-600';
            discountRow.innerHTML = `<span>Giảm giá:</span><span id="discount-amount">-${formatCurrency(discountAmount)}</span>`;
            document.getElementById('tax').parentElement.insertAdjacentElement('beforebegin', discountRow);
            } else {
            document.getElementById('discount-amount').textContent = `-${formatCurrency(discountAmount)}`;
            }
        } else if (discountElement) {
            discountElement.remove();
        }
    }

    /* ====== Áp mã giảm giá (giữ nguyên logic) ====== */
    function applyPromo(){ const v=document.getElementById('promo-code').value; if(v) document.getElementById('custom-promo').value=''; applyPromoCode(v); }
        function applyCustomPromo(){
        const v=document.getElementById('custom-promo').value.trim().toUpperCase();
        if(!v) return showNotification('Vui lòng nhập mã giảm giá','error');
        document.getElementById('promo-code').value='';
        applyPromoCode(v);
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
            showNotification('Không thể tải giỏ hàng. Hãy thử lại!', 'error');
        }
    });
    </script>

@endsection
