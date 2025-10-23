@extends('customer.layout')
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

        <!-- Promotion Categories -->
        <section class="mb-12">
            <div class="flex flex-wrap justify-center gap-4 mb-8">
                <button onclick="window.location.href='{{ url('/customer/product') }}?category=all'" class="category-btn bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700 transition-colors" data-category="all">
                    Tất cả
                </button>
                <button onclick="window.location.href='{{ url('/customer/product') }}?category=smartphone'" class="category-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-full font-semibold hover:bg-gray-300 transition-colors" data-category="smartphone">
                    📱 Smartphone
                </button>
                <button onclick="window.location.href='{{ url('/customer/product') }}?category=laptop'" class="category-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-full font-semibold hover:bg-gray-300 transition-colors" data-category="laptop">
                    💻 Laptop
                </button>
                <button onclick="window.location.href='{{ url('/customer/product') }}?category=accessories'" class="category-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-full font-semibold hover:bg-gray-300 transition-colors" data-category="accessories">
                    🎧 Phụ kiện
                </button>
                <button onclick="window.location.href='{{ url('/customer/product') }}?category=home'" class="category-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-full font-semibold hover:bg-gray-300 transition-colors" data-category="home">
                    🏠 Gia dụng
                </button>
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
        const vouchers = @json($vouchers);

        // ====== UTIL ======
        function formatPrice(n) {
            n = Number(n) || 0;
            return n.toLocaleString('vi-VN') + '₫';
        }
        function formatVNDate(iso) {
            if (!iso) return '';
            const d = new Date(iso);
            return d.toLocaleString('vi-VN', { hour12: false });
        }
        function showNotification(message) {
            const el = document.createElement('div');
            el.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 ease-in-out transform translate-x-full';
            el.textContent = message;
            document.body.appendChild(el);
            requestAnimationFrame(function(){ el.style.transform = 'translateX(0)'; });
            setTimeout(function(){
                el.style.transform = 'translateX(100%)';
                setTimeout(function(){ if (el && el.parentNode) el.parentNode.removeChild(el); }, 300);
            }, 3000);
        }

        // ====== ÁP MÃ (demo đơn giản) ======
        var appliedVouchers = [];
        function applyVoucherByCode(code) {
            var v = (vouchers || []).find(function(x){ return x.code === code; });
            if (!v) { showNotification('Mã không hợp lệ!'); return; }
            // Chuẩn hoá type: DB có thể là 'amount'
            v.type = (v.type === 'amount') ? 'fixed' : v.type;
            appliedVouchers = [v];
            showNotification('Đã áp dụng mã ' + v.code);
        }

        
        // ====== RENDER VOUCHER LIST (sao chép + chuyển trang khi áp mã) ======
        function renderVoucherList() {
            const wrap = document.getElementById('voucher-list');
            if (!wrap) return;

            wrap.innerHTML = '';

            // Nếu không có voucher nào
            if (!vouchers || vouchers.length === 0) {
                const emptyDiv = document.createElement('div');
                emptyDiv.className = 'col-span-3 text-gray-500';
                emptyDiv.textContent = 'Hiện chưa có mã khuyến mãi nào đang hoạt động.';
                wrap.appendChild(emptyDiv);
                return;
            }

            // Lặp từng voucher để tạo card
            vouchers.forEach(v => {
                const type = (v.type === 'amount') ? 'fixed' : v.type;
                const badgeText = (type === 'fixed')
                    ? (Number(v.value).toLocaleString('vi-VN') + '₫')
                    : ('-' + Number(v.discount).toLocaleString('vi-VN') + '%');
                const minOrderText = (v.minOrder && Number(v.minOrder) > 0)
                    ? ('ĐH tối thiểu: ' + Number(v.minOrder).toLocaleString('vi-VN') + '₫')
                    : 'Không yêu cầu ĐH tối thiểu';

                // Tạo card chính
                const card = document.createElement('article');
                card.className = 'bg-white rounded-2xl shadow p-5 flex flex-col justify-between';

                // Header voucher
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

                // Nội dung chi tiết
                const p = document.createElement('p');
                p.className = 'text-gray-600 mb-2';
                p.textContent = v.description ?? '';

                const ul = document.createElement('ul');
                ul.className = 'text-sm text-gray-500 space-y-1';

                const li1 = document.createElement('li');
                li1.textContent = minOrderText;

                const li2 = document.createElement('li');
                li2.textContent = 'Hiệu lực: ' + formatVNDate(v.start_date) + ' → ' + formatVNDate(v.end_date);

                ul.appendChild(li1);
                ul.appendChild(li2);

                // Nút hành động
                const btnWrap = document.createElement('div');
                btnWrap.className = 'mt-4 grid grid-cols-2 gap-3';

                // 🔹 Nút SAO CHÉP
                const btnCopy = document.createElement('button');
                btnCopy.type = 'button';
                btnCopy.className = 'border border-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-50';
                btnCopy.textContent = 'Sao chép';
                btnCopy.addEventListener('click', e => {
                    e.preventDefault();
                    navigator.clipboard.writeText(v.code).then(() => {
                        showNotification('Đã sao chép mã ' + v.code);
                    });
                });

                // 🔹 Nút ÁP MÃ
                const btnApply = document.createElement('button');
                btnApply.type = 'button';
                btnApply.className = 'bg-gradient-to-r from-green-500 to-teal-500 text-white py-2 rounded-lg font-semibold hover:opacity-90';
                btnApply.textContent = 'Áp mã';
                btnApply.addEventListener('click', e => {
                    e.preventDefault();
                    // Lưu mã vào localStorage (để trang product có thể dùng)
                    localStorage.setItem('selectedVoucher', JSON.stringify(v));
                    // ⏩ Chuyển sang trang sản phẩm
                    setTimeout(() => {
                        window.location.href = '/customer/product'; // 🔥 thay đường dẫn nếu cần
                    }, 1200);
                });

                btnWrap.appendChild(btnCopy);
                btnWrap.appendChild(btnApply);

                // Gộp card
                card.appendChild(head);
                card.appendChild(p);
                card.appendChild(ul);
                card.appendChild(btnWrap);

                // Thêm vào danh sách
                wrap.appendChild(card);
            });
        }



        // ====== FLASH SALE COUNTDOWN (an toàn, không lỗi nếu thiếu DOM) ======
        function updateFlashSaleCountdown() {
            var hoursElement = document.getElementById('hours');
            var minutesElement = document.getElementById('minutes');
            var secondsElement = document.getElementById('seconds');
            var flashSaleSection = document.querySelector('.countdown');
            if (!hoursElement || !minutesElement || !secondsElement || !flashSaleSection) return;

            var now = new Date();
            var currentHour = now.getHours();
            var flashSaleTitle = flashSaleSection.querySelector('h2');
            var flashSaleDesc  = flashSaleSection.querySelector('p');

            if (currentHour >= 20 && currentHour < 22) {
                var endTime = new Date(); endTime.setHours(22,0,0,0);
                var timeLeft = endTime - now;
                var h = Math.floor(timeLeft / (1000*60*60));
                var m = Math.floor((timeLeft % (1000*60*60)) / (1000*60));
                var s = Math.floor((timeLeft % (1000*60)) / 1000);
                hoursElement.textContent = String(h).padStart(2,'0');
                minutesElement.textContent = String(m).padStart(2,'0');
                secondsElement.textContent = String(s).padStart(2,'0');
                if (flashSaleTitle) flashSaleTitle.textContent = '⚡ FLASH SALE ĐANG DIỄN RA - Còn lại';
                if (flashSaleDesc)  flashSaleDesc.textContent  = 'Giảm đến 70% cho tất cả sản phẩm! Nhanh tay kẻo lỡ!';
                flashSaleSection.style.background = 'linear-gradient(45deg, #ff6b6b, #ee5a24)';
            } else {
                var nextFlashSale = new Date();
                if (currentHour >= 22) nextFlashSale.setDate(nextFlashSale.getDate() + 1);
                nextFlashSale.setHours(20,0,0,0);
                var tl = nextFlashSale - now;
                var hh = Math.floor(tl / (1000*60*60));
                var mm = Math.floor((tl % (1000*60*60)) / (1000*60));
                var ss = Math.floor((tl % (1000*60)) / 1000);
                hoursElement.textContent = String(hh).padStart(2,'0');
                minutesElement.textContent = String(mm).padStart(2,'0');
                secondsElement.textContent = String(ss).padStart(2,'0');
                if (flashSaleTitle) flashSaleTitle.textContent = '⏰ FLASH SALE SẮP BẮT ĐẦU - Còn';
                if (flashSaleDesc)  flashSaleDesc.textContent  = 'Flash Sale 8h-10h tối hàng ngày. Chuẩn bị sẵn sàng!';
                flashSaleSection.style.background = 'linear-gradient(45deg, #667eea, #764ba2)';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            renderVoucherList();
            updateFlashSaleCountdown();
            setInterval(updateFlashSaleCountdown, 1000);
        });
    </script>
@endsection
