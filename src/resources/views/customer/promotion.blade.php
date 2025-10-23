@extends('customer.layout')
@php
    use App\Models\admin\Discount;
    use Carbon\Carbon;

    $now = Carbon::now();

    $vouchers = Discount::query()
        ->where('status', '!=', 'Tạm dừng')
        ->where(function ($q) use ($now) {
            $q->whereNull('start_date')
              ->orWhere('start_date', '<=', $now);
        })
        ->where(function ($q) use ($now) {
            $q->whereNull('end_date')
              ->orWhere('end_date', '>=', $now);
        })
        ->orderBy('end_date', 'asc')
        ->get()
        ->map(function ($d) {
            // ép end_date về 23:59:59 của ngày đó nếu có ngày mà chưa có time
            $start = $d->start_date ? Carbon::parse($d->start_date) : null;
            $end   = $d->end_date   ? Carbon::parse($d->end_date)->endOfDay() : null;

            return [
                'code'        => (string)($d->code ?? ''),
                'type'        => (string)($d->type ?? ''),   // 'percent' | 'amount'
                'value'       => (float) ($d->value ?? 0),
                'start_date'  => $start?->format('Y-m-d H:i:s'),
                'end_date'    => $end?->format('Y-m-d H:i:s'),
                'minOrder'    => null,
                'description' => null,
            ];
        })
        ->values()
        ->all();
@endphp


@section('title', 'Khuyến mãi')

@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header Section -->
        <header class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">🎉 Chương Trình Khuyến Mãi Hot</h1>
            <p class="text-lg text-gray-600">Cơ hội vàng để sở hữu những sản phẩm công nghệ tuyệt vời với giá ưu đãi!</p>
        </header>

        <!-- Flash Sale Banner -->
        <section class="countdown bg-gradient-to-r from-red-600 to-pink-600 text-white rounded-2xl p-8 mb-8 text-center">
            <div class="flash-sale">
                <h2 class="text-3xl font-bold mb-4">⚡ FLASH SALE - Chỉ còn</h2>
                <div class="flex justify-center space-x-4 mb-4">
                    <div class="bg-black bg-opacity-30 backdrop-blur-sm rounded-lg p-4 min-w-[80px]">
                        <div class="text-3xl font-bold" id="hours">12</div>
                        <div class="text-sm">Giờ</div>
                    </div>
                    <div class="bg-black bg-opacity-30 backdrop-blur-sm rounded-lg p-4 min-w-[80px]">
                        <div class="text-3xl font-bold" id="minutes">34</div>
                        <div class="text-sm">Phút</div>
                    </div>
                    <div class="bg-black bg-opacity-30 backdrop-blur-sm rounded-lg p-4 min-w-[80px]">
                        <div class="text-3xl font-bold" id="seconds">56</div>
                        <div class="text-sm">Giây</div>
                    </div>
                </div>
                <p class="text-xl font-semibold">Giảm đến 70% cho tất cả sản phẩm!</p>
            </div>
        </section>

       <!-- Vouchers from Database -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">🎫 Mã khuyến mãi hiện có</h2>

            <div id="voucher-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- JS sẽ render các voucher ở đây -->
            </div>

            <div class="mt-6 text-sm text-gray-500">
            *Chỉ những mã đang hoạt động theo thời gian hiện tại được hiển thị.
            </div>
        </section>


        <!-- Cart Button -->
        <button id="cart-button" class="fixed bottom-6 right-6 bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 transition-colors z-40">
            <div class="relative">
                🛒
                <span id="cart-badge" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center" style="display: none;">0</span>
            </div>
        </button>

        <!-- Special Offers Section -->
        <section class="mt-16 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl p-8 text-center text-white">
            <h2 class="text-3xl font-bold mb-4">🎁 Ưu Đãi Đặc Biệt</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white bg-opacity-20 rounded-xl p-6">
                    <div class="text-3xl mb-3">🚚</div>
                    <h3 class="font-bold text-lg mb-2">Miễn phí vận chuyển</h3>
                    <p class="text-sm">Cho đơn hàng từ 500.000₫</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-xl p-6">
                    <div class="text-3xl mb-3">🔄</div>
                    <h3 class="font-bold text-lg mb-2">Đổi trả 30 ngày</h3>
                    <p class="text-sm">Không hài lòng hoàn tiền 100%</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-xl p-6">
                    <div class="text-3xl mb-3">🛡️</div>
                    <h3 class="font-bold text-lg mb-2">Bảo hành chính hãng</h3>
                    <p class="text-sm">Cam kết sản phẩm chính hãng</p>
                </div>
            </div>
        </section>
    </main>

 <script>
    // ====== DATA TỪ BACKEND ======
    const vouchers = @json($vouchers ?? []);

    // ====== UTIL ======
    const VN = 'vi-VN';
    const pad2 = n => String(n).padStart(2,'0');

    function formatPrice(n) {
        n = Number(n) || 0;
        return n.toLocaleString(VN) + '₫';
    }
    function safeDate(iso) {
        // Chấp nhận cả 'YYYY-MM-DD HH:mm:ss' và ISO
        if (!iso) return null;
        const replaced = String(iso).replace(' ', 'T'); // '2025-10-23 12:30:00' -> '2025-10-23T12:30:00'
        const d = new Date(replaced);
        return isNaN(d.getTime()) ? null : d;
    }
    function formatVNDate(iso) {
        const d = safeDate(iso);
        if (!d) return '';
        return d.toLocaleString(VN, { hour12: false });
    }
    function nowMs(){ return Date.now(); }

    function showNotification(message, ok=true) {
        const el = document.createElement('div');
        el.className = (ok
            ? 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 ease-in-out transform translate-x-full'
            : 'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 ease-in-out transform translate-x-full');
        el.textContent = message;
        document.body.appendChild(el);
        requestAnimationFrame(() => { el.style.transform = 'translateX(0)'; });
        setTimeout(() => {
            el.style.transform = 'translateX(100%)';
            setTimeout(() => { el.remove(); }, 300);
        }, 3000);
    }

    // ====== TRẠNG THÁI VOUCHER ======
    function voucherStatus(v) {
        const start = safeDate(v.start_date);
        const end   = safeDate(v.end_date);
        const now   = nowMs();

        // coi thiếu mốc là -∞ / +∞
        const sMs = start ? start.getTime() : -Infinity; // không có start => đã bắt đầu từ trước
        const eMs = end   ? end.getTime()   :  Infinity; // không có end   => không hết hạn

        if (now < sMs) return { state: 'upcoming', msToStart: sMs - now };
        if (now > eMs) return { state: 'expired',  msSinceEnd: now - eMs };

        // active: nếu không có end_date thì không đếm ngược
        return { state: 'active', msLeft: isFinite(eMs) ? (eMs - now) : null };
    }


    // ====== ÁP MÃ (demo đơn giản) ======
    function applyVoucherByCode(code) {
        const v = (vouchers || []).find(x => x.code === code);
        if (!v) { showNotification('Mã không hợp lệ!', false); return; }
        const st = voucherStatus(v);
        if (st.state !== 'active') {
            showNotification(st.state === 'upcoming' ? 'Mã chưa bắt đầu áp dụng!' : 'Mã đã hết hạn!', false);
            return;
        }
        v.type = (v.type === 'amount') ? 'fixed' : v.type;
        localStorage.setItem('selectedVoucher', JSON.stringify(v));
        showNotification('Đã áp dụng mã ' + v.code);
        setTimeout(() => { window.location.href = '/customer/product'; }, 800);
    }

    // ====== RENDER VOUCHER LIST + COUNTDOWN ======
    let countdownRegistry = []; // lưu các phần tử để tick mỗi giây

    // ====== TICK COUNTDOWN TOÀN CỤC ======
    function tickCountdowns() {
        const now = nowMs();
        countdownRegistry.forEach(item => {
            if (!item || !item.el) return;
            let ms;
            if (item.type === 'toEnd' && item.end) {
                ms = item.end - now;
                if (ms <= 0) { item.el.textContent = '00:00:00'; return; }
            } else if (item.type === 'toStart' && item.start) {
                ms = item.start - now;
                if (ms <= 0) { item.el.textContent = '00:00:00'; return; }
            } else return;

            const totalSec = Math.floor(ms / 1000);
            const hh = Math.floor(totalSec / 3600);
            const mm = Math.floor((totalSec % 3600) / 60);
            const ss = totalSec % 60;
            item.el.textContent = `${pad2(hh)}:${pad2(mm)}:${pad2(ss)}`;
        });
    }

    // ====== FLASH SALE COUNTDOWN (giữ nguyên, có tối ưu null-safe) ======
    function updateFlashSaleCountdown() {
        const hoursElement = document.getElementById('hours');
        const minutesElement = document.getElementById('minutes');
        const secondsElement = document.getElementById('seconds');
        const flashSaleSection = document.querySelector('.countdown');
        if (!hoursElement || !minutesElement || !secondsElement || !flashSaleSection) return;

        const now = new Date();
        const currentHour = now.getHours();
        const flashSaleTitle = flashSaleSection.querySelector('h2');
        const flashSaleDesc  = flashSaleSection.querySelector('p');

        if (currentHour >= 20 && currentHour < 22) {
            const endTime = new Date(); endTime.setHours(22,0,0,0);
            const timeLeft = endTime - now;
            const h = Math.floor(timeLeft / (1000*60*60));
            const m = Math.floor((timeLeft % (1000*60*60)) / (1000*60));
            const s = Math.floor((timeLeft % (1000*60)) / 1000);
            hoursElement.textContent = pad2(h);
            minutesElement.textContent = pad2(m);
            secondsElement.textContent = pad2(s);
            if (flashSaleTitle) flashSaleTitle.textContent = '⚡ FLASH SALE ĐANG DIỄN RA - Còn lại';
            if (flashSaleDesc)  flashSaleDesc.textContent  = 'Giảm đến 70% cho tất cả sản phẩm! Nhanh tay kẻo lỡ!';
            flashSaleSection.style.background = 'linear-gradient(45deg, #ff6b6b, #ee5a24)';
        } else {
            const nextFlashSale = new Date();
            if (currentHour >= 22) nextFlashSale.setDate(nextFlashSale.getDate() + 1);
            nextFlashSale.setHours(20,0,0,0);
            const tl = nextFlashSale - now;
            const hh = Math.floor(tl / (1000*60*60));
            const mm = Math.floor((tl % (1000*60*60)) / (1000*60));
            const ss = Math.floor((tl % (1000*60)) / 1000);
            hoursElement.textContent = pad2(hh);
            minutesElement.textContent = pad2(mm);
            secondsElement.textContent = pad2(ss);
            if (flashSaleTitle) flashSaleTitle.textContent = '⏰ FLASH SALE SẮP BẮT ĐẦU - Còn';
            if (flashSaleDesc)  flashSaleDesc.textContent  = 'Flash Sale 8h-10h tối hàng ngày. Chuẩn bị sẵn sàng!';
            flashSaleSection.style.background = 'linear-gradient(45deg, #667eea, #764ba2)';
        }
    }

    // ====== INIT ======
    document.addEventListener('DOMContentLoaded', function () {
        renderVoucherList();         // render danh sách mã hoạt động
        tickCountdowns();            // tick lần đầu
        setInterval(tickCountdowns, 1000); // cập nhật mỗi giây

        updateFlashSaleCountdown();
        setInterval(updateFlashSaleCountdown, 1000);
    });
</script>
<script>
function renderVoucherList() {
  const wrap = document.getElementById('voucher-list');
  if (!wrap) return;
  wrap.innerHTML = '';
  countdownRegistry = [];

  // Lọc các mã đang có hiệu lực ở thời điểm hiện tại
  const filtered = (vouchers || []).filter(v => {
    const s = safeDate(v.start_date);
    const e = safeDate(v.end_date);
    const now = Date.now();
    const sMs = s ? s.getTime() : -Infinity;   // không có start => coi như đã bắt đầu
    const eMs = e ? e.getTime() : Infinity;    // không có end   => không hết hạn
    return sMs <= now && now <= eMs;
  });

  if (filtered.length === 0) {
    const empty = document.createElement('div');
    empty.className = 'col-span-3 text-gray-500';
    empty.textContent = 'Hiện chưa có mã khuyến mãi nào đang hoạt động.';
    wrap.appendChild(empty);
    return;
  }

  filtered.forEach((v, idx) => {
    const type = (v.type === 'amount') ? 'fixed' : v.type;
    const badgeText = (type === 'fixed')
      ? (Number(v.value ?? 0).toLocaleString('vi-VN') + '₫')
      : ('-' + Number(v.value ?? 0).toLocaleString('vi-VN') + '%');

    const card = document.createElement('article');
    card.className = 'bg-white rounded-2xl shadow p-5 flex flex-col justify-between';

    // Header
    const head = document.createElement('div');
    head.className = 'flex items-start justify-between mb-3';

    const h3 = document.createElement('h3');
    h3.className = 'text-xl font-bold text-gray-800';
    h3.textContent = 'Mã ' + v.code;

    const badge = document.createElement('span');
    badge.className = 'px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-bold';
    badge.textContent = badgeText;

    head.appendChild(h3);
    head.appendChild(badge);

    // Mô tả + chi tiết
    const p = document.createElement('p');
    p.className = 'text-gray-600 mb-2';
    p.textContent = v.description ?? '';

    const ul = document.createElement('ul');
    ul.className = 'text-sm text-gray-500 space-y-1';
    const li1 = document.createElement('li');
    li1.textContent = 'Hiệu lực: ' + formatVNDate(v.start_date) + ' → ' + formatVNDate(v.end_date);
    ul.appendChild(li1);

    // Countdown
    const countdownLine = document.createElement('div');
    countdownLine.className = 'mt-2 text-sm font-medium';

    const cdPill = document.createElement('span');
    cdPill.className = 'inline-block px-3 py-1 rounded-full text-white';

    const st = voucherStatus(v);
    const sMs = safeDate(v.start_date) ? safeDate(v.start_date).getTime() : null;
    const eMs = safeDate(v.end_date) ? safeDate(v.end_date).getTime() : null;
    const now = Date.now();

    if (st.state === 'active') {
      cdPill.classList.add('bg-green-600');
      if (eMs && eMs > now) {
        cdPill.innerHTML = 'Còn lại: <span data-cd="'+idx+'">--:--:--</span>';
        countdownRegistry.push({ el: cdPill.querySelector('[data-cd]'), type: 'toEnd', end: eMs });
      } else {
        cdPill.textContent = 'Không giới hạn thời gian';
      }
    } else if (st.state === 'upcoming') {
      cdPill.classList.add('bg-amber-600');
      cdPill.innerHTML = 'Chưa bắt đầu: <span data-cd="'+idx+'">--:--:--</span>';
      if (sMs && sMs > now) {
        countdownRegistry.push({ el: cdPill.querySelector('[data-cd]'), type: 'toStart', start: sMs });
      }
    } else {
      cdPill.classList.add('bg-gray-500');
      cdPill.textContent = 'Hết hạn';
    }

    countdownLine.appendChild(cdPill);

    // Actions
    const btnWrap = document.createElement('div');
    btnWrap.className = 'mt-4 grid grid-cols-2 gap-3';

    const btnCopy = document.createElement('button');
    btnCopy.type = 'button';
    btnCopy.className = 'border border-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-50';
    btnCopy.textContent = 'Sao chép';
    btnCopy.addEventListener('click', e => {
      e.preventDefault();
      navigator.clipboard.writeText(v.code).then(() => showNotification('Đã sao chép mã ' + v.code));
    });

    const btnApply = document.createElement('button');
    btnApply.type = 'button';
    btnApply.className = 'bg-gradient-to-r from-green-500 to-teal-500 text-white py-2 rounded-lg font-semibold hover:opacity-90 disabled:opacity-50';
    btnApply.textContent = 'Áp mã';
    btnApply.addEventListener('click', e => {
      e.preventDefault();
      applyVoucherByCode(v.code);
    });
    if (st.state !== 'active') {
      btnApply.disabled = true;
      btnApply.title = (st.state === 'upcoming') ? 'Mã chưa bắt đầu' : 'Mã đã hết hạn';
    }

    // Gộp
    btnWrap.appendChild(btnCopy);
    btnWrap.appendChild(btnApply);
    card.appendChild(head);
    card.appendChild(p);
    card.appendChild(ul);
    card.appendChild(countdownLine);
    card.appendChild(btnWrap);
    wrap.appendChild(card);
  });
}
</script>


@endsection
