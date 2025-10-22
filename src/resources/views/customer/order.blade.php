@extends('customer.layout')
@section('title', 'Đơn hàng')

@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Đơn Hàng Của Tôi</h1>
            <p class="text-gray-600">Theo dõi và quản lý các đơn hàng của bạn</p>
        </header>

        @php
            // Map status DB -> key dùng cho data-status và badge
            $statusKey = function($s){
                $s = mb_strtolower($s ?? '');
                if (str_contains($s, 'đã giao')) return 'delivered';
                if (str_contains($s, 'đang giao')) return 'shipping';
                if (str_contains($s, 'chờ') || str_contains($s, 'xử lý')) return 'processing';
                return 'processing';
            };

            $countAll = $orders->count();
            $countProcessing = $orders->filter(fn($o)=>$statusKey($o->status)==='processing')->count();
            $countShipping   = $orders->filter(fn($o)=>$statusKey($o->status)==='shipping')->count();
            $countDelivered  = $orders->filter(fn($o)=>$statusKey($o->status)==='delivered')->count();
        @endphp

        <!-- Filter Tabs -->
        <div class="bg-white rounded-lg shadow-sm mb-6 p-1">
            <div class="flex flex-wrap gap-1">
                <button onclick="filterOrders('all', this)" class="filter-btn active px-4 py-2 rounded-md text-sm font-medium transition-colors bg-blue-500 text-white">
                    Tất cả ({{ $countAll }})
                </button>
                <button onclick="filterOrders('processing', this)" class="filter-btn px-4 py-2 rounded-md text-sm font-medium transition-colors text-gray-600 hover:bg-gray-100">
                    Đang xử lý ({{ $countProcessing }})
                </button>
                <button onclick="filterOrders('shipping', this)" class="filter-btn px-4 py-2 rounded-md text-sm font-medium transition-colors text-gray-600 hover:bg-gray-100">
                    Đang giao ({{ $countShipping }})
                </button>
                <button onclick="filterOrders('delivered', this)" class="filter-btn px-4 py-2 rounded-md text-sm font-medium transition-colors text-gray-600 hover:bg-gray-100">
                    Đã giao ({{ $countDelivered }})
                </button>
            </div>
        </div>

        <!-- Orders List -->
        <div class="space-y-6" id="ordersList">
            @forelse ($orders as $o)
                @php
                    $key = $statusKey($o->status);
                    $badge = [
                        'processing' => ['🔄 Đang xử lý','bg-yellow-100 text-yellow-800'],
                        'shipping'   => ['🚚 Đang giao hàng','bg-blue-100 text-blue-800'],
                        'delivered'  => ['✅ Đã giao hàng','bg-green-100 text-green-800'],
                    ][$key];
                    $totalVND = number_format((int)$o->total_amount, 0, ',', '.') . '₫';
                @endphp

                <div class="order-card bg-white rounded-xl shadow-sm border border-gray-200 p-6" data-status="{{ $key }}">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-4">
                        <div class="flex items-center gap-4 mb-4 lg:mb-0">
                            <div class="bg-blue-100 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Đơn hàng #{{ $o->order_id }}</h3>
                                <p class="text-sm text-gray-500">Đặt ngày: {{ optional($o->created_at)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="status-badge {{ $badge[1] }} px-3 py-1 rounded-full text-sm font-medium">
                                {{ $badge[0] }}
                            </span>
                            <span class="text-lg font-bold text-gray-800">{{ $totalVND }}</span>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-{{ max(1, min(2, $o->orderItems->count())) }} gap-4 mb-4">
                        @foreach ($o->orderItems as $it)
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                            {{-- Ảnh demo --}}
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60' viewBox='0 0 60 60'%3E%3Crect width='60' height='60' fill='%23e5e7eb'/%3E%3Crect x='15' y='15' width='30' height='30' fill='%23374151'/%3E%3C/svg%3E" class="w-15 h-15 rounded-lg object-cover" alt="product">
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-800">{{ $it->product->name ?? ('SP#'.$it->product_id) }}</h4>
                                <p class="text-sm text-gray-500">Số lượng: {{ (int)$it->quantity }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <button onclick="viewOrderDetails('{{ $o->order_id }}')" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Xem chi tiết
                        </button>

                        @if ($key === 'processing')
                            <button onclick="cancelOrder('{{ $o->order_id }}')" class="flex-1 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                Hủy đơn hàng
                            </button>
                        @elseif ($key === 'shipping')
                            <button onclick="trackOrder('{{ $o->order_id }}')" class="flex-1 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                Theo dõi đơn hàng
                            </button>
                        @elseif ($key === 'delivered')
                            <button onclick="reviewProduct('{{ $o->order_id }}')" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                ⭐ Đánh giá sản phẩm
                            </button>
                            <button onclick="reorderProduct('{{ $o->order_id }}')" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                Mua lại
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                {{-- Không có đơn nào: dùng Empty State phía dưới --}}
            @endforelse
        </div>

        <!-- Empty State -->
        <div id="emptyState" class="{{ $orders->count() ? 'hidden' : '' }} text-center py-12">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-800 mb-2">Không có đơn hàng nào</h3>
                <p class="text-gray-500 mb-6">Bạn chưa có đơn hàng nào trong danh mục này</p>
                <a href="{{ url('/customer/product') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                    Tiếp tục mua sắm
                </a>
            </div>
        </div>
    </main>
</div>

<!-- Order Details Modal -->
<div id="orderModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-800">Chi tiết đơn hàng</h2>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6" id="modalContent"></div>
    </div>
</div>

{{-- ==================== SCRIPTS ==================== --}}
<script>
/* ---------- Helpers ---------- */
const REVIEW_URL_BASE = "{{ url('/customer/review') }}";

function formatVND(n) {
    return new Intl.NumberFormat('vi-VN', { style:'currency', currency:'VND' })
        .format(Number(n)||0).replace('₫','₫');
}
function toast(msg, type='success') {
    const el = document.createElement('div');
    el.className = `fixed top-4 right-4 z-[9999] px-4 py-2 rounded-lg text-white ${type==='success'?'bg-green-600':'bg-red-600'}`;
    el.textContent = msg;
    document.body.appendChild(el);
    setTimeout(()=>el.remove(), 2200);
}
function closeModal() {
    document.getElementById('orderModal')?.classList.add('hidden');
}

/* ---------- Filter ---------- */
function filterOrders(status, el) {
    const orders = document.querySelectorAll('.order-card');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const emptyState = document.getElementById('emptyState');

    filterBtns.forEach(btn => {
        btn.classList.remove('active', 'bg-blue-500', 'text-white');
        btn.classList.add('text-gray-600', 'hover:bg-gray-100');
    });
    const target = el || event?.currentTarget || event?.target;
    if (target) {
        target.classList.add('active', 'bg-blue-500', 'text-white');
        target.classList.remove('text-gray-600', 'hover:bg-gray-100');
    }

    let visible = 0;
    orders.forEach(card => {
        if (status === 'all' || card.dataset.status === status) {
            card.style.display = 'block';
            visible++;
        } else {
            card.style.display = 'none';
        }
    });
    if (emptyState) emptyState.classList.toggle('hidden', visible !== 0);
}

/* ---------- Fetch order JSON for modal / reorder / review ---------- */
async function fetchOrder(orderId){
    try{
        const res = await fetch(`{{ url('/customer/orders') }}/${orderId}`, {
            headers: { 'Accept':'application/json' }
        });
        if(!res.ok) throw new Error('HTTP '+res.status);
        return await res.json();
    }catch(e){
        toast('Không tải được chi tiết đơn.', 'error');
        return null;
    }
}

/* ---------- View Details (Modal) ---------- */
async function viewOrderDetails(orderId){
    const modal = document.getElementById('orderModal');
    const modalContent = document.getElementById('modalContent');
    const order = await fetchOrder(orderId);
    if(!order) return;

    modal.classList.remove('hidden');
    modalContent.innerHTML = `
        <div class="space-y-6">
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold text-gray-800 mb-3">Thông tin đơn hàng</h3>
                    <div class="space-y-2 text-sm">
                        <p><span class="text-gray-500">Mã đơn hàng:</span> ${order.id}</p>
                        <p><span class="text-gray-500">Ngày đặt:</span> ${order.date || ''}</p>
                        <p><span class="text-gray-500">Trạng thái:</span> <span class="text-blue-600 font-medium">${order.status}</span></p>
                        <p><span class="text-gray-500">Tổng tiền:</span> <span class="font-bold text-lg">${formatVND(order.total)}</span></p>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800 mb-3">Thông tin giao hàng</h3>
                    <div class="space-y-2 text-sm">
                        <p><span class="text-gray-500">Địa chỉ:</span> ${order.address || ''}</p>
                        <p><span class="text-gray-500">Số điện thoại:</span> ${order.phone || ''}</p>
                        <p><span class="text-gray-500">Phương thức:</span> Giao hàng tiêu chuẩn</p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 mb-3">Sản phẩm đã đặt</h3>
                <div class="space-y-3">
                    ${Array.isArray(order.items) ? order.items.map(item => `
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-medium">${item.name}</p>
                                <p class="text-sm text-gray-500">
                                    Số lượng: ${item.qty}
                                    ${item?.variant?.color ? ` • Màu: ${item.variant.color}` : ''}
                                </p>
                            </div>
                            <p class="font-medium">${formatVND(item.price)}</p>
                        </div>
                    `).join('') : ''}
                </div>
            </div>
        </div>
    `;
}

/* ---------- Reorder (đẩy lại vào localStorage giỏ hàng) ---------- */
function slugify(str=''){
    return String(str)
        .normalize('NFKD').replace(/[\u0300-\u036f]/g, '')
        .toLowerCase().replace(/[^a-z0-9]+/g,'-').replace(/(^-|-$)/g,'');
}
function buildSkuKey(name, variant={}){
    return [slugify(name||''), slugify(variant?.storage||''), slugify(variant?.color||'')].join('|');
}
function getCartArray(){ try { return JSON.parse(localStorage.getItem('cart')||'[]'); } catch { return []; } }
function saveCartArray(arr){ localStorage.setItem('cart', JSON.stringify(arr)); }
function upsertCartItem(cartArr, {name, price, qty=1, variant={}, image='default'}){
    const key = buildSkuKey(name, variant);
    const idx = cartArr.findIndex(x => buildSkuKey(x.name, x.variant||{}) === key);
    if (idx === -1) {
        cartArr.push({
            id: key, name, price: Number(price)||0, quantity: Number(qty)||1,
            image, selected: true, variant: { storage: variant?.storage||'', color: variant?.color||'' }
        });
    } else {
        cartArr[idx].quantity = (Number(cartArr[idx].quantity)||0) + (Number(qty)||1);
        cartArr[idx].price = Number(price) || cartArr[idx].price;
        cartArr[idx].selected = true;
    }
}

async function reorderProduct(orderId){
    const order = await fetchOrder(orderId);
    if(!order || !Array.isArray(order.items) || order.items.length===0){
        toast('Không tìm thấy sản phẩm để mua lại.', 'error'); return;
    }
    const cart = getCartArray();
    order.items.forEach(it => {
        upsertCartItem(cart, {
            name: it.name, price: Number(it.price)||0, qty: Number(it.qty)||1,
            variant: it.variant || {}, image: 'default'
        });
    });
    saveCartArray(cart);
    toast(`Đã thêm ${order.items.length} sản phẩm từ đơn ${orderId} vào giỏ hàng!`, 'success');
}

/* ---------- Review (đi tới trang review đúng SKU) ---------- */
function buildReviewUrl(item, orderId){
    const sku = buildSkuKey(item?.name || '', item?.variant || {});
    const params = new URLSearchParams({
        order: orderId, sku: sku, name: item?.name || '', color: item?.variant?.color || ''
    });
    return `${REVIEW_URL_BASE}?${params.toString()}`;
}
async function reviewProduct(orderId){
    const order = await fetchOrder(orderId);
    if(!order){ return; }
    const st = (order.status||'').toLowerCase();
    if(!st.includes('đã giao')){
        toast('Đơn này chưa giao xong, chưa thể đánh giá.', 'error'); return;
    }
    if(Array.isArray(order.items) && order.items.length === 1){
        window.location.href = buildReviewUrl(order.items[0], orderId);
        return;
    }
    // nhiều sản phẩm -> mở modal chọn
    const modal = document.getElementById('orderModal');
    const modalContent = document.getElementById('modalContent');
    modal.classList.remove('hidden');
    modalContent.innerHTML = `
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Chọn sản phẩm để đánh giá</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="space-y-3">
                ${(order.items||[]).map(it=>{
                    const url = buildReviewUrl(it, orderId);
                    return `
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-medium">${it.name}</p>
                                <p class="text-sm text-gray-500">
                                    Số lượng: ${it.qty||1}
                                    ${it?.variant?.color ? `• Màu: ${it.variant.color}` : ''}
                                </p>
                            </div>
                            <a href="${url}" class="px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm font-medium">
                                ⭐ Đánh giá
                            </a>
                        </div>
                    `;
                }).join('')}
            </div>
        </div>
    `;
}

/* ---------- Optional UI actions giữ nguyên style ---------- */
function cancelOrder(orderId){
    if(!confirm(`Bạn có chắc chắn muốn xóa (ẩn) đơn hàng ${orderId}?`)) return;
    const card = [...document.querySelectorAll('.order-card')]
        .find(el => el.querySelector('h3')?.textContent?.includes(`#${orderId}`));
    if (!card) { toast('Không tìm thấy thẻ đơn hàng.', 'error'); return; }
    const badge = card.querySelector('.status-badge');
    if (badge) {
        badge.textContent = '🗑️ Đã xoá';
        badge.className = 'status-badge px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600';
    }
    card.classList.add('opacity-60');
    const btn = [...card.querySelectorAll('button')].find(b=>b.textContent?.trim().includes('Hủy đơn hàng'));
    if (btn) { btn.disabled = true; btn.classList.add('cursor-not-allowed'); }
    toast(`Đơn hàng ${orderId} đã được xoá (ẩn).`, 'success');
}
function trackOrder(trackingId){
    // Hook tích hợp real-time sau: hiện chỉ scroll tới card để minh hoạ
    const card = [...document.querySelectorAll('.order-card')]
        .find(el => el.innerText.includes(trackingId));
    if (card) card.scrollIntoView({ behavior: 'smooth', block: 'center' });
    toast('Đang mở theo dõi đơn hàng…');
}

/* ---------- Khởi tạo ---------- */
document.addEventListener('DOMContentLoaded', () => {
    // set filter mặc định: all -> đã có class active trên nút đầu tiên
});
</script>
@endsection
