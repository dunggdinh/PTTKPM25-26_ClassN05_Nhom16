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

            <!-- đổi grid -> stack -->
            <div id="voucher-list" class="space-y-6"></div>

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

  const palettes = [
    ['from-purple-600','to-pink-600'],
    ['from-blue-600','to-cyan-500'],
    ['from-green-600','to-emerald-500'],
    ['from-rose-600','to-orange-500'],
    ['from-indigo-600','to-violet-500'],
  ];

  const filtered = (vouchers || []).filter(v => {
    const s = safeDate(v.start_date);
    const e = safeDate(v.end_date);
    const now = Date.now();
    const sMs = s ? s.getTime() : -Infinity;
    const eMs = e ? e.getTime() : Infinity;
    return sMs <= now && now <= eMs;
  });

  if (filtered.length === 0) {
    const empty = document.createElement('div');
    empty.className = 'text-gray-500 text-center';
    empty.textContent = 'Hiện chưa có mã khuyến mãi nào đang hoạt động.';
    wrap.appendChild(empty);
    return;
  }

  filtered.forEach((v, idx) => {
    const pal = palettes[idx % palettes.length];
    const from = pal[0], to = pal[1];

    const banner = document.createElement('section');
    banner.className =
      `rounded-2xl p-6 text-white text-center bg-gradient-to-r ${from} ${to} shadow-lg font-sans`;

    const st = voucherStatus(v);
    const end = safeDate(v.end_date);

    // Tiêu đề
    const header = document.createElement('div');
    header.innerHTML = `
      <h3 class="text-2xl md:text-3xl mb-1 tracking-wide uppercase drop-shadow-sm">
        🎟️ Mã ${v.code}
      </h3>
      <p class="text-sm md:text-base opacity-90 mb-3">
        Hiệu lực: ${formatVNDate(v.start_date)} → ${formatVNDate(v.end_date)}
      </p>
    `;

    // Bộ đếm
    const timerRow = document.createElement('div');
    timerRow.className = 'flex justify-center gap-3 mb-3';

    const createTimerBox = (label) => {
      const box = document.createElement('div');
      box.className = 'bg-black/30 backdrop-blur-sm rounded-lg p-3 min-w-[70px]';
      const val = document.createElement('div');
      val.className = 'text-3xl font-bold';
      val.textContent = '00';
      const lbl = document.createElement('div');
      lbl.className = 'text-xs opacity-90';
      lbl.textContent = label;
      box.appendChild(val);
      box.appendChild(lbl);
      return { box, val };
    };

    const H = createTimerBox('Giờ');
    const M = createTimerBox('Phút');
    const S = createTimerBox('Giây');
    timerRow.append(H.box, M.box, S.box);

    // Trạng thái
    const stateLine = document.createElement('p');
    stateLine.className = 'text-base md:text-lg font-medium mb-2';
    if (st.state === 'active') {
      stateLine.textContent = '✨ Mã đang hoạt động — nhanh tay sử dụng!';
    } else if (st.state === 'upcoming') {
      stateLine.textContent = '⏰ Mã sắp bắt đầu — chuẩn bị sẵn sàng!';
    } else {
      stateLine.textContent = '❌ Mã đã hết hạn.';
    }

    // Gắn tất cả (không còn nút nào)
    banner.append(header, timerRow, stateLine);
    wrap.appendChild(banner);

    // Countdown
    const eMs = end ? end.getTime() : null;
    countdownRegistry.push({
      el: { h: H.val, m: M.val, s: S.val },
      type: 'toEnd',
      end: eMs
    });
  });

  // Ticker cho đồng hồ
  function tickVoucherBanners() {
    const now = Date.now();
    countdownRegistry.forEach(item => {
      if (!item || !item.el) return;
      if (item.type === 'toEnd' && item.end) {
        let ms = item.end - now;
        if (ms <= 0) ms = 0;
        const totalSec = Math.floor(ms / 1000);
        const hh = Math.floor(totalSec / 3600);
        const mm = Math.floor((totalSec % 3600) / 60);
        const ss = totalSec % 60;
        item.el.h.textContent = pad2(hh);
        item.el.m.textContent = pad2(mm);
        item.el.s.textContent = pad2(ss);
      }
    });
  }
  tickVoucherBanners();
  if (!window.__voucherTickInterval) {
    window.__voucherTickInterval = setInterval(tickVoucherBanners, 1000);
  }
}
</script>

@endsection
