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
            @forelse (($cart->CartItem ?? collect()) as $item)
                <div class="flex items-center justify-between border-b py-4">
                    <input type="checkbox"
                        class="cart-checkbox mr-3"
                        data-id="{{ $item->cart_item_id }}"
                        data-name="{{ $item->product->name ?? 'Sản phẩm' }}"
                        data-price="{{ $item->product->price ?? 0 }}"
                        data-quantity="{{ $item->quantity }}">
                    <div class="flex-1">
                        <div class="font-semibold">{{ $item->product->name ?? 'Sản phẩm' }}</div>
                        <div class="text-gray-600 text-sm">
                            Giá: {{ number_format($item->product->price ?? 0, 0, ',', '.') }}₫
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="button" class="decrease bg-gray-200 px-2 rounded" data-id="{{ $item->cart_item_id }}">−</button>
                        <input type="number" class="w-12 text-center border rounded quantity-input"
                            value="{{ $item->quantity }}" min="1" data-id="{{ $item->cart_item_id }}">
                        <button type="button" class="increase bg-gray-200 px-2 rounded" data-id="{{ $item->cart_item_id }}">+</button>
                        <button type="button" class="remove-item text-red-600 hover:text-red-800 ml-3"
                                data-id="{{ $item->cart_item_id }}">Xóa</button>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 px-2 py-4">Giỏ hàng trống.</p>
            @endforelse
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
    
    {{-- WRAPPER: 2 cột cạnh nhau trên màn hình ≥ lg --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">

        {{-- Cột 1: Phương thức thanh toán --}}
        <section class="bg-white border rounded-2xl shadow-sm p-6 h-full">
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

            {{-- nếu có thêm phương thức khác, thêm các label tương tự ở đây --}}
        </section>

        {{-- Cột 2: Địa chỉ giao hàng --}}
        <section class="bg-white border rounded-2xl shadow-sm p-6 h-full">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Địa chỉ giao hàng</h2>
                <a href="{{ url('/customer/profile') }}" class="text-blue-600 hover:underline text-sm">Quản lý địa chỉ</a>
            </div>

            {{-- Hàng trên: chọn địa chỉ (bên trái) + card hiển thị (bên phải) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Chọn địa chỉ</label>
                    <select id="addressSelect" class="w-full border rounded-lg px-3 py-2">
                        <option value="">-- Chọn địa chỉ --</option>
                        {{-- JS sẽ fill options từ localStorage --}}
                    </select>
                </div>

                <div id="addressDetail" class="text-gray-700 text-sm border rounded-xl px-4 py-3 bg-gray-50">
                    Chưa chọn địa chỉ
                </div>
            </div>
        </section>
    </div>

    <!-- Nút tiến hành thanh toán -->
    <button onclick="placeOrder()" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105 mt-6">
      Đặt hàng
    </button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <div id="qr-code" class="mt-4"></div>
    
  </main>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const cartForm = document.getElementById('cart-form');
  const orderSummary = document.getElementById('order-summary');
  const promoSelect = document.getElementById('promo-code');
  const customPromoInput = document.getElementById('custom-promo');

  let appliedDiscount = null;

  function updateOrderSummary() {
    const selectedItems = [...cartForm.querySelectorAll('.cart-checkbox')]
      .filter(cb => cb.checked)
      .map(cb => ({
        id: cb.dataset.id,
        name: cb.dataset.name,
        price: parseFloat(cb.dataset.price),
        quantity: parseInt(cb.dataset.quantity)
      }));

    if (!selectedItems.length) {
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

    let discountAmount = 0;
    if (appliedDiscount) {
      discountAmount = appliedDiscount.type === 'percent'
        ? subtotal * (appliedDiscount.value / 100)
        : appliedDiscount.value;
    }

    const taxBase = Math.max(0, subtotal - discountAmount);
    const tax = taxBase * 0.1;
    const total = taxBase + tax;

    html += `
      <div class="mt-2 border-t pt-2">
        <div class="flex justify-between"><span>Tạm tính:</span><span>${subtotal.toLocaleString('vi-VN')}₫</span></div>
        ${appliedDiscount ? `<div class="flex justify-between text-green-600"><span>Giảm giá (${appliedDiscount.code}):</span><span>-${discountAmount.toLocaleString('vi-VN')}₫</span></div>` : ''}
        <div class="flex justify-between"><span>VAT 10%:</span><span>${tax.toLocaleString('vi-VN')}₫</span></div>
        <div class="flex justify-between font-semibold text-lg mt-1"><span>Tổng cộng:</span><span>${total.toLocaleString('vi-VN')}₫</span></div>
      </div>`;
    orderSummary.innerHTML = html;
  }

  // +/- số lượng
  cartForm.querySelectorAll('.increase').forEach(btn => {
    btn.addEventListener('click', async () => {
      const id = btn.dataset.id;
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

  // nhập trực tiếp
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
      await fetch(`/customer/cart/item/${cartItemId}`, {
        method: 'PATCH',
        headers: {'Content-Type': 'application/json','X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: JSON.stringify({ quantity })
      });
      const checkbox = cartForm.querySelector(`.cart-checkbox[data-id="${cartItemId}"]`);
      if (checkbox) checkbox.dataset.quantity = quantity;
      updateOrderSummary();
    } catch (err) { console.error(err); }
  }

  // chọn sản phẩm
  cartForm.querySelectorAll('.cart-checkbox').forEach(cb => {
    cb.addEventListener('change', updateOrderSummary);
  });

  // áp mã từ dropdown
  window.applyPromo = function () {
    const opt = promoSelect.selectedOptions[0];
    appliedDiscount = (!opt || !opt.value) ? null : {
      code: opt.value,
      type: opt.dataset.type,
      value: parseFloat(opt.dataset.value)
    };
    updateOrderSummary();
  };

  // xóa 1 item
  async function removeItem(cartItemId) {
    try {
      const res = await fetch(`/customer/cart/item/${cartItemId}`, {
        method: 'DELETE',
        headers: {'Content-Type': 'application/json','X-CSRF-TOKEN': '{{ csrf_token() }}'}
      });
      if (!res.ok) throw new Error('Remove failed');
      const row = cartForm.querySelector(`.cart-checkbox[data-id="${cartItemId}"]`)?.closest('.flex.items-center.justify-between.border-b.py-4');
      if (row) row.remove();
      updateOrderSummary();
    } catch (e) {
      alert('Xóa sản phẩm thất bại, thử lại sau.');
      console.error(e);
    }
  }
  cartForm.addEventListener('click', (e) => {
    const btn = e.target.closest('.remove-item');
    if (!btn) return;
    const id = btn.dataset.id;
    if (!id) return;
    removeItem(id);
  });

  // xóa tất cả
  async function clearCart() {
    if (!confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng?')) return;
    try {
      const res = await fetch(`/customer/cart/clear`, {
        method: 'DELETE',
        headers: {'Content-Type': 'application/json','X-CSRF-TOKEN': '{{ csrf_token() }}'}
      });
      if (!res.ok) throw new Error('Clear failed');
      cartForm.innerHTML = '';
      updateOrderSummary();
    } catch (e) {
      alert('Xóa toàn bộ giỏ hàng thất bại.');
      console.error(e);
    }
  }
  document.getElementById('clear-cart')?.addEventListener('click', clearCart);

  // áp mã custom
  window.applyCustomPromo = function () {
    const code = customPromoInput.value.trim();
    if (!code) return alert('Vui lòng nhập mã giảm giá');
    fetch(`/customer/cart/validate-discount?code=${encodeURIComponent(code)}`)
      .then(res => res.json())
      .then(data => {
        if (!data.valid) return alert(data.message || 'Mã không hợp lệ');
        appliedDiscount = { code: data.code, type: data.type, value: parseFloat(data.value) };
        promoSelect.value = '';
        updateOrderSummary();
      });
  };

  // tạo thanh toán (QR)
  window.proceedToCheckout = async function () {
    const selectedItems = [...cartForm.querySelectorAll('.cart-checkbox')]
      .filter(cb => cb.checked)
      .map(cb => cb.dataset.id);

    if (!selectedItems.length) return alert('Vui lòng chọn sản phẩm để thanh toán');

    try {
      const res = await fetch('/cart/checkout', {
        method: 'POST',
        headers: {'Content-Type': 'application/json','X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: JSON.stringify({ items: selectedItems, discount: appliedDiscount })
      });
      const data = await res.json();
      if (data.success && data.payment_url) {
        document.getElementById('qr-code').innerHTML = '';
        new QRCode(document.getElementById('qr-code'), { text: data.payment_url, width: 200, height: 200 });
        alert('Quét QR code để thanh toán');
      } else {
        alert(data.message || 'Tạo QR code thất bại');
      }
    } catch (e) {
      console.error(e);
      alert('Có lỗi khi tạo thanh toán');
    }
  };

  window.placeOrder = async function () {
    const cartForm = document.getElementById('cart-form');
    const selectedItems = [...cartForm.querySelectorAll('.cart-checkbox')]
        .filter(cb => cb.checked)
        .map(cb => cb.dataset.id);

    if (!selectedItems.length) { alert('Vui lòng chọn sản phẩm để đặt hàng'); return; }

    try {
        const url = '{{ route("customer.cart.place") }}'; // dùng tên route mới
        const res = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ items: selectedItems })
        });
        if (!res.ok) {
            const txt = await res.text();
            console.error('Server Error', res.status, txt);
            return alert('Có lỗi khi tạo đơn hàng (HTTP ' + res.status + '). Xem console.');
        }
        const data = await res.json();

        // ✅ Thành công: xoá các dòng đã đặt và cập nhật tóm tắt
        const successMessage = document.getElementById('success-message');
        if (successMessage) successMessage.classList.remove('hidden');

        selectedItems.forEach(id => {
            const row = cartForm.querySelector(`.cart-checkbox[data-id="${id}"]`)?.closest('.flex.items-center.justify-between.border-b.py-4');
            row?.remove();
        });

        // gọi lại tính tổng
        (typeof updateOrderSummary === 'function') && updateOrderSummary();

    } catch (err) {
        console.error('Fetch failed:', err);
        alert('Có lỗi xảy ra khi đặt hàng (network/JS). Xem console để biết thêm.');
    }
    };

  // khởi tạo
  updateOrderSummary();
});

// 1 bản closeSuccess duy nhất ngoài cùng
function closeSuccess() {
  document.getElementById('success-message')?.classList.add('hidden');
}
</script>
<script>
const ADDRESS_KEY = 'electrostore_addresses_v1';

function cartLoadAddresses(){
  const list = JSON.parse(localStorage.getItem(ADDRESS_KEY) || '[]');
  const sel = document.getElementById('addressSelect');
  const det = document.getElementById('addressDetail');
  if (!sel) return;

  sel.innerHTML = '<option value="">-- Chọn địa chỉ --</option>';
  list.forEach(a => {
    const opt = document.createElement('option');
    opt.value = a.id;
    opt.textContent = (a.is_default ? '⭐ ' : '') + (a.address_name || 'Địa chỉ');
    sel.appendChild(opt);
  });

  // auto chọn mặc định
  const def = list.find(x => x.is_default);
  if (def) { sel.value = def.id; det.innerHTML = renderAddrHTML(def); }
  else { det.textContent = 'Chưa chọn địa chỉ'; }

  sel.addEventListener('change', () => {
    const chosen = list.find(x => x.id === sel.value);
    det.innerHTML = chosen ? renderAddrHTML(chosen) : 'Chưa chọn địa chỉ';
    // gắn vào input ẩn nếu có form checkout
    attachAddressToCheckout(chosen || null);
  });

  // gắn ngay lần đầu
  attachAddressToCheckout(def || null);
}

function renderAddrHTML(a){
  return `
    <div><strong>${a.address_name || 'Địa chỉ'}</strong></div>
    <div>${a.address_detail || ''}</div>
    <div>${[a.district, a.city].filter(Boolean).join(', ')}</div>
    ${a.phone ? `<div>SĐT: ${a.phone}</div>` : ''}
    ${a.is_default ? `<span class="inline-block mt-1 text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded">Mặc định</span>` : ''}
  `;
}

// Gắn địa chỉ vào form submit (để server tạo đơn)
function attachAddressToCheckout(addr){
  const form = document.getElementById('checkoutForm'); // đổi id theo form của bạn
  if (!form) return;
  let hidden = form.querySelector('input[name="shipping_address_json"]');
  if (!hidden) {
    hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'shipping_address_json';
    form.appendChild(hidden);
  }
  hidden.value = addr ? JSON.stringify(addr) : '';
}

document.addEventListener('DOMContentLoaded', cartLoadAddresses);
</script>

@endsection
