@extends('customer.layout')
@section('title', 'Đánh giá sản phẩm')

@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Sản phẩm chờ đánh giá -->
        <section class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">📦 Sản phẩm đã mua</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="purchasedProducts">
                <div class="col-span-full text-center text-gray-500" id="eligiblePlaceholder">
                    Đang tải sản phẩm đủ điều kiện...
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Form viết đánh giá -->
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">✍️ Viết đánh giá</h3>
                    <!-- Hiển thị sản phẩm đang viết đánh giá -->
                    <div id="selectedProductBox" class="hidden mb-4">
                        <div class="flex items-center gap-2 bg-blue-50 border border-blue-200 rounded-lg px-3 py-2">
                            <span class="text-sm text-blue-700">Đang viết cho:</span>
                            <span id="selectedProductName" class="text-sm font-semibold text-blue-800"></span>
                            <button type="button" id="clearSelectedProduct"
                                    class="ml-auto text-xs bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded">
                            ✖ Đổi sản phẩm
                            </button>
                        </div>
                    </div>

                    <!-- Ẩn để submit -->
                    <input type="hidden" id="productId" name="product_id">
                    <input type="hidden" id="productName" name="product_name">

                    <form id="reviewForm" class="space-y-4">
                        <div>
                            <label for="customerName" class="block text-sm font-medium text-gray-700 mb-2">Tên của bạn</label>
                            <input type="text" id="customerName" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Nhập tên của bạn">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Đánh giá sao</label>
                            <div class="star-rating" id="starRating">
                                <span class="star" data-rating="1">★</span>
                                <span class="star" data-rating="2">★</span>
                                <span class="star" data-rating="3">★</span>
                                <span class="star" data-rating="4">★</span>
                                <span class="star" data-rating="5">★</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1" id="ratingText">Chọn số sao</p>
                        </div>
                        
                        <div>
                            <label for="reviewTitle" class="block text-sm font-medium text-gray-700 mb-2">Tiêu đề đánh giá</label>
                            <input type="text" id="reviewTitle" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tóm tắt trải nghiệm của bạn">
                        </div>
                        
                        <div>
                            <label for="reviewContent" class="block text-sm font-medium text-gray-700 mb-2">Nội dung đánh giá</label>
                            <textarea id="reviewContent" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none" placeholder="Chia sẻ chi tiết về sản phẩm..."></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-105">
                            📝 Gửi đánh giá
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Danh sách đánh giá -->
            <section class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <h3 class="text-xl font-semibold text-gray-800">💬 Đánh giá từ khách hàng</h3>
                        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <select id="starFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm">
                                <option value="all">Tất cả đánh giá</option>
                                <option value="5">⭐⭐⭐⭐⭐ (5 sao)</option>
                                <option value="4">⭐⭐⭐⭐ (4 sao)</option>
                                <option value="3">⭐⭐⭐ (3 sao)</option>
                                <option value="2">⭐⭐ (2 sao)</option>
                                <option value="1">⭐ (1 sao)</option>
                            </select>
                            <select id="sortSelect" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm">
                                <option value="newest">Mới nhất</option>
                                <option value="oldest">Cũ nhất</option>
                                <option value="highest">Đánh giá cao nhất</option>
                                <option value="lowest">Đánh giá thấp nhất</option>
                            </select>
                        </div>
                    </div>
                    
                    <div id="reviewsList" class="space-y-6">
                    </div>

                    <!-- Phân trang -->
                    <div id="reviewsPagination" class="flex justify-center mt-8"></div>
                </div>
            </section>
        </div>
    </main>

    <script>
    window.REVIEW_ROUTES = {
        list:    "{{ route('customer.reviews.list') }}",
        eligible:"{{ route('customer.reviews.eligible') }}",
        store:   "{{ route('customer.reviews.store') }}"
    };

    function statusBadgeClass(statusRaw='') {
        const s = (statusRaw||'').toLowerCase().trim();
        if (['đã nhận hàng','đã giao','hoàn thành','delivered','completed'].includes(s)) {
            return 'bg-green-100 text-green-800';
        }
        if (['đang giao','shipping','shipped','processing'].includes(s)) {
            return 'bg-yellow-100 text-yellow-800';
        }
        if (['đã hủy','cancelled','canceled'].includes(s)) {
            return 'bg-red-100 text-red-800';
        }
        return 'bg-gray-100 text-gray-800';
        }

    async function loadEligibleProducts() {
        try {
            const res  = await fetch(REVIEW_ROUTES.eligible, { credentials:'same-origin' });
            const json = await res.json();
            const wrap = document.getElementById('purchasedProducts');
            wrap.innerHTML = '';

            const items = Array.isArray(json?.data) ? json.data : [];
            if (!items.length) {
                wrap.innerHTML = `<p class="text-gray-500 text-center col-span-full">Bạn chưa có sản phẩm đủ điều kiện đánh giá.</p>`;
                return;
            }

            items.forEach(item => {
                const okStatuses = ['đã nhận hàng','đã giao','hoàn thành','delivered','completed'];
                const isOK = okStatuses.includes((item.order_status||'').toLowerCase().trim());
                const btnClass = isOK
                    ? 'bg-blue-600 hover:bg-blue-700 text-white'
                    : 'bg-gray-300 text-gray-500 cursor-not-allowed';
                const disabledAttr = isOK ? '' : 'disabled';
                const badgeCls = statusBadgeClass(item.order_status);

                wrap.insertAdjacentHTML('beforeend', `
                    <div class="product-card bg-white rounded-lg border hover:shadow-lg transition-shadow p-4">
                        <div class="relative">
                            <div class="bg-gray-100 rounded-lg p-4 text-center mb-4">
                                ${item.product_image
                                    ? `<img src="${item.product_image}" class="mx-auto w-16 h-16 object-contain mb-2">`
                                    : `<div class="text-4xl mb-2">📦</div>`}
                                <h3 class="text-lg font-semibold text-gray-800">${item.product_name ?? ''}</h3>
                                <p class="text-sm text-gray-600">${item.product_desc ?? ''}</p>
                            </div>
                            <div class="absolute top-2 right-2">
                                <span class="${badgeCls} text-xs font-medium px-2.5 py-1 rounded-full">
                                    ${item.order_status ?? '—'}
                                </span>
                            </div>
                        </div>
                        <div class="text-sm text-gray-600 mb-4">
                            <p>Đơn hàng: #${item.order_id}</p>
                            <p>Ngày mua: ${item.ordered_at ? new Date(item.ordered_at).toLocaleDateString('vi-VN') : ''}</p>
                        </div>
                        <button onclick="showReviewForm(this)"
                                data-product-id="${item.product_id}"
                                data-product-name="${item.product_name ?? ''}"
                                data-order-id="${item.order_id}"
                                class="w-full ${btnClass} font-medium py-2 px-4 rounded-lg transition-colors"
                                ${disabledAttr}>
                            ✍️ Viết đánh giá
                        </button>
                    </div>
                `);
            });
        } catch (e) {
            console.error(e);
            const wrap = document.getElementById('purchasedProducts');
            if (wrap) wrap.innerHTML = `<p class="text-red-600 text-center col-span-full">Không tải được danh sách sản phẩm.</p>`;
        }
    }

    

    document.addEventListener('DOMContentLoaded', () => {
        let selectedRating = 0;
        loadEligibleProducts();
        let currentPage = 1;

        // Lần đầu load
        loadReviews();

        // --- Tham chiếu DOM dùng chung ---
        const selectedProductBox = document.getElementById('selectedProductBox');
        const selectedProductName = document.getElementById('selectedProductName');
        const productIdInput = document.getElementById('productId');
        const productNameInput = document.getElementById('productName');

        // ====== STAR RATING ======
        const stars = document.querySelectorAll('.star');
        const ratingText = document.getElementById('ratingText');

        const ratingLabels = {
            1: 'Rất tệ',
            2: 'Tệ',
            3: 'Bình thường',
            4: 'Tốt',
            5: 'Tuyệt vời'
        };
            
        document.getElementById('starFilter').addEventListener('change', () => { currentPage = 1; loadReviews(); });
        document.getElementById('sortSelect').addEventListener('change', () => { currentPage = 1; loadReviews(); });

        async function loadReviews(page = currentPage) {
            const starVal = document.getElementById('starFilter').value; // 'all' | '1..5'
            const sortVal = document.getElementById('sortSelect').value; // 'newest' | 'oldest' | 'highest' | 'lowest'

            const params = new URLSearchParams();
            params.set('sort', sortVal);
            params.set('page', page);
            params.set('per_page', 6);
            if (starVal !== 'all') params.set('stars', starVal);

            try {
                const url = `${REVIEW_ROUTES.list}?${params.toString()}`;
                const res = await fetch(url, { credentials: 'same-origin' });
                if (!res.ok) throw new Error('Không tải được danh sách đánh giá');
                const json = await res.json();
                renderReviews(json.data);
                renderPagination(json.meta);
                currentPage = json.meta.current_page;
            } catch (e) {
                console.error(e);
                showNotification('Không tải được đánh giá. Vui lòng thử lại!', 'error');
            }
        }

        function renderReviews(items=[]) {
            const container = document.getElementById('reviewsList');
            container.innerHTML = '';
            if (!items.length) {
                container.innerHTML = `<div class="text-center text-gray-600">Chưa có đánh giá nào.</div>`;
                return;
            }
            items.forEach(r => container.appendChild(makeReviewCard(r)));
        }

        function renderPagination(meta) {
            const wrap = document.getElementById('reviewsPagination');
            if (!wrap) return;
            if (!meta || meta.last_page <= 1) { wrap.innerHTML = ''; return; }

            const { current_page, last_page } = meta;

            const btn = (label, page, disabled=false, active=false) => {
                const base = 'px-3 py-2 rounded-lg';
                const cls = active
                    ? 'bg-blue-600 text-white'
                    : (disabled ? 'text-gray-400' : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50');
                return `<button data-page="${page}" class="${base} ${cls}" ${disabled?'disabled':''}>${label}</button>`;
            };

            let html = `<nav class="flex items-center gap-2">`;
            html += btn('← Trước', current_page - 1, current_page === 1);
            for (let p = 1; p <= last_page; p++) {
                if (p === 1 || p === last_page || Math.abs(p - current_page) <= 1) {
                    html += btn(p, p, false, p === current_page);
                } else if (p === 2 && current_page > 3) {
                    html += `<span class="px-2 text-gray-400">...</span>`;
                } else if (p === last_page - 1 && current_page < last_page - 2) {
                    html += `<span class="px-2 text-gray-400">...</span>`;
                }
            }
            html += btn('Sau →', current_page + 1, current_page === last_page);
            html += `</nav>`;

            wrap.innerHTML = html;
            wrap.querySelectorAll('button[data-page]').forEach(b => {
                b.addEventListener('click', () => {
                    const p = parseInt(b.dataset.page, 10);
                    if (!isNaN(p)) loadReviews(p);
                });
            });
        }

        // Tạo 1 review card từ dữ liệu server
        function makeReviewCard(r) {
            // r: { review_id, rating, comment, image_url, created_at, user:{name}, product:{name} ... }
            const card = document.createElement('div');
            card.className = 'review-card border border-gray-200 rounded-lg p-6';
            card.dataset.stars = r.rating?.toString() ?? '0';

            const name = (r.user?.name || 'Ẩn danh').toString();
            const initial = name.charAt(0).toUpperCase();
            const colors = ['bg-blue-500','bg-pink-500','bg-green-500','bg-purple-500','bg-red-500'];
            const color = colors[Math.floor(Math.random()*colors.length)];
            const dateTxt = formatDateVN(r.created_at);
            const starsTxt = '⭐'.repeat(Math.max(0, Math.min(5, parseInt(r.rating || 0,10))));

            // comment hiện đang chứa (title + \n\n + comment) theo controller; có thể split ra nếu muốn
            const [titleLine, ...rest] = (r.comment || '').split('\n\n');
            const title = titleLine || 'Đánh giá sản phẩm';
            const content = rest.join('\n\n') || (r.comment || '');

            card.innerHTML = `
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 ${color} rounded-full flex items-center justify-center text-white font-semibold">
                            ${initial}
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">${escapeHtml(name)}</h4>
                            <p class="text-sm text-gray-600">${dateTxt}</p>
                        </div>
                    </div>
                    <div class="flex text-yellow-400">${starsTxt}</div>
                </div>

                <div class="mb-2">
                    <span class="inline-flex items-center gap-1 text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded-full">
                        🛍️ Cho sản phẩm: <strong>${escapeHtml(r.product?.name || r.product_id || '')}</strong>
                    </span>
                </div>

                <h5 class="font-semibold text-gray-800 mb-2">${escapeHtml(title)}</h5>
                <p class="text-gray-700 leading-relaxed whitespace-pre-line">${escapeHtml(content)}</p>

                <div class="flex items-center gap-4 mt-4 text-sm text-gray-600">
                    <button class="like-btn flex items-center gap-1 hover:text-blue-600 transition-colors" data-liked="false" data-count="0">
                        <span class="like-icon">🤍</span> <span class="like-count">0</span>
                    </button>
                    <button class="reply-btn flex items-center gap-1 hover:text-blue-600">💬 Trả lời</button>
                </div>
            `;
            return card;
        }

        function formatDateVN(iso) {
            if (!iso) return '';
            const d = new Date(iso);
            return d.toLocaleDateString('vi-VN', { day:'2-digit', month:'2-digit', year:'numeric' });
        }
        function escapeHtml(s=''){return s.replace(/[&<>"']/g, m=>({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' }[m]));}

        // Expose nếu cần reload sau submit
        window.reloadReviews = () => loadReviews(1);

        function updateStars() {
            stars.forEach((star, index) => {
                star.classList.remove('active', 'hover');
                if (index < selectedRating) star.classList.add('active');
            });
        }

        function highlightStarsHover(rating) {
            stars.forEach((star, index) => {
                star.classList.remove('hover');
                if (index < rating) star.classList.add('hover');
            });
        }

        stars.forEach(star => {
            star.addEventListener('click', () => {
                selectedRating = parseInt(star.dataset.rating, 10);
                updateStars();
                ratingText.textContent = ratingLabels[selectedRating];
            });

            star.addEventListener('mouseenter', () => {
                const rating = parseInt(star.dataset.rating, 10);
                highlightStarsHover(rating);
            });
        });

        document.getElementById('starRating').addEventListener('mouseleave', updateStars);

        // ====== SUBMIT REVIEW ======
        document.getElementById('reviewForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const name = document.getElementById('customerName').value.trim();
            const title = document.getElementById('reviewTitle').value.trim();
            const content = document.getElementById('reviewContent').value.trim();
            const selectedProductId = productIdInput.value.trim();
            const selectedProductNm = productNameInput.value.trim();

            if (!selectedProductId) {
                showNotification('Vui lòng chọn sản phẩm cần đánh giá (nhấn "✍️ Viết đánh giá" ở sản phẩm).', 'error');
                return;
            }
            if (!name || !title || !content || selectedRating === 0) {
                showNotification('Vui lòng điền đầy đủ thông tin và chọn số sao!', 'error');
                return;
            }

            try {
                const fd = new FormData();
                fd.append('product_id', selectedProductId);

                // lấy order_id từ button sản phẩm nếu có
                const btnSel = document.querySelector(
                    `[data-product-id="${CSS.escape(selectedProductId)}"][data-product-name="${CSS.escape(selectedProductNm)}"]`
                );
                if (btnSel?.dataset.orderId) fd.append('order_id', btnSel.dataset.orderId);

                fd.append('rating', selectedRating);
                fd.append('title', title);
                fd.append('comment', content);
                // Nếu có input ảnh: fd.append('image', document.getElementById('reviewImage')?.files?.[0] ?? null);

                const res = await fetch(REVIEW_ROUTES.store, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',                 // 👈 BẮT LARAVEL TRẢ JSON (k redirect về HTML)
                        'X-Requested-With': 'XMLHttpRequest'         // 👈 Cho middleware hiểu là AJAX
                    },
                    body: fd,
                    credentials: 'same-origin',
                    redirect: 'manual'                              // 👈 Nếu bị 302 sẽ không tự theo, mình bắt lỗi luôn
                });

                // ĐỪNG parse JSON nếu server trả HTML
                let json;
                try {
                    json = await res.json();
                } catch (_) {
                    const text = await res.text();
                    // Một số trường hợp trình duyệt chặn đọc body khi redirect: báo lỗi rõ ràng
                    throw new Error(`Máy chủ trả về trang HTML (có thể 419/302). Status=${res.status}`);
                }

                if (res.status === 419) {
                    throw new Error('CSRF hết hạn. Vui lòng tải lại trang và thử lại.');
                }
                if (!res.ok) {
                    throw new Error(json?.message || 'Gửi đánh giá thất bại');
                }

                if (!res.ok) throw new Error(json.message || 'Gửi đánh giá thất bại');

                // render card mới từ server (để đồng bộ định dạng)
                const serverReview = json.data; // { review_id, rating, comment, image_url, created_at, ... }
                serverReview.user = { name };
                serverReview.product = { name: selectedProductNm };

                const reviewsList = document.getElementById('reviewsList');
                const newCard = makeReviewCard(serverReview);
                newCard.style.opacity = '0';
                newCard.style.transform = 'translateY(-20px)';
                reviewsList.insertBefore(newCard, reviewsList.firstChild);
                requestAnimationFrame(() => {
                    newCard.style.opacity = '1';
                    newCard.style.transform = 'translateY(0)';
                });

                // reset form + chip
                this.reset();
                selectedRating = 0;
                updateStars();
                ratingText.textContent = 'Chọn số sao';
                selectedProductBox.classList.add('hidden');
                selectedProductName.textContent = '';
                productIdInput.value = '';
                productNameInput.value = '';

                showNotification('Cảm ơn bạn đã gửi đánh giá! 🎉', 'success');

                // reload danh sách eligible (sp này đã review)
                if (typeof loadEligibleProducts === 'function') loadEligibleProducts();

            } catch (err) {
                console.error(err);
                showNotification(err.message, 'error');
            }
        });

        async function createReviewElement(name, title, content, rating, productName) {
            const reviewDiv = document.createElement('div');
            reviewDiv.className = 'review-card border border-gray-200 rounded-lg p-6';
            reviewDiv.dataset.stars = rating;
            reviewDiv.style.transition = 'all 0.3s ease-out';

            const starsTxt = '⭐'.repeat(rating);
            const initial = name.charAt(0).toUpperCase();
            const colors = ['bg-blue-500', 'bg-pink-500', 'bg-green-500', 'bg-purple-500', 'bg-red-500'];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];

            const now = new Date();
            const formattedDate = now.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit', year: 'numeric' });

            reviewDiv.innerHTML = `
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center gap-3">
                    <div class="w-10 h-10 ${randomColor} rounded-full flex items-center justify-center text-white font-semibold">
                        ${initial}
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">${name}</h4>
                        <p class="text-sm text-gray-600">${formattedDate}</p>
                    </div>
                    </div>
                    <div class="flex text-yellow-400">${starsTxt}</div>
                </div>

                <div class="mb-2">
                    <span class="inline-flex items-center gap-1 text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded-full">
                    🛍️ Cho sản phẩm: <strong>${productName}</strong>
                    </span>
                </div>

                <h5 class="font-semibold text-gray-800 mb-2">${title}</h5>
                <p class="text-gray-700 leading-relaxed">${content}</p>

                <div class="flex items-center gap-4 mt-4 text-sm text-gray-600">
                    <button class="like-btn flex items-center gap-1 hover:text-blue-600 transition-colors" data-liked="false" data-count="0">
                    <span class="like-icon">🤍</span> <span class="like-count">0</span>
                    </button>
                    <button class="reply-btn flex items-center gap-1 hover:text-blue-600">💬 Trả lời</button>
                </div>
            `;
            return reviewDiv;
        }

        // ====== TOAST NOTIF ======
        function showNotification(message, type = 'success') {
            document.querySelectorAll('.notification').forEach(n => n.remove());

            const notification = document.createElement('div');
            notification.className =
                `notification fixed top-4 right-4 px-6 py-3 rounded-lg text-white font-semibold z-50 transform transition-all duration-300 ${
                    type === 'success' ? 'bg-green-500' : 'bg-red-500'
                } translate-x-full`;
            const icon = type === 'success' ? '✅' : '❌';
            notification.innerHTML = `<div class="flex items-center gap-2"><span>${icon}</span><span>${message}</span></div>`;
            document.body.appendChild(notification);

            requestAnimationFrame(() => { notification.style.transform = 'translateX(0)'; });

            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // ====== Lọc theo sao ======
        document.getElementById('starFilter').addEventListener('change', (e) => {
            const filterValue = e.target.value;
            const reviewsList = document.getElementById('reviewsList');
            const reviews = Array.from(reviewsList.children);

            reviews.forEach(review => {
                if (filterValue === 'all') {
                    review.style.display = 'block';
                } else {
                    const reviewStars = review.dataset.stars;
                    review.style.display = (reviewStars === filterValue) ? 'block' : 'none';
                }
            });

            const visibleReviews = reviews.filter(r => r.style.display !== 'none').length;
            const filterText = filterValue === 'all' ? 'tất cả đánh giá' : `đánh giá ${filterValue} sao`;

            reviews.forEach(review => {
                if (review.style.display === 'block') {
                    review.style.opacity = '0';
                    review.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        review.style.opacity = '1';
                        review.style.transform = 'translateY(0)';
                    }, 100);
                }
            });
        });

        // ====== Sắp xếp ======
        document.getElementById('sortSelect').addEventListener('change', (e) => {
            const sortType = e.target.value;
            const reviewsList = document.getElementById('reviewsList');
            const all = Array.from(reviewsList.children);
            const visible = all.filter(r => r.style.display !== 'none');
            const hidden = all.filter(r => r.style.display === 'none');

            visible.sort((a, b) => {
                if (sortType === 'highest' || sortType === 'lowest') {
                    const A = parseInt(a.dataset.stars, 10);
                    const B = parseInt(b.dataset.stars, 10);
                    return sortType === 'highest' ? (B - A) : (A - B);
                }
                // newest/oldest: vì demo tĩnh, giữ/đảo thứ tự hiện tại
                return sortType === 'oldest' ? (visible.indexOf(b) - visible.indexOf(a)) : 0;
            });

            reviewsList.innerHTML = '';
            visible.forEach(r => reviewsList.appendChild(r));
            hidden.forEach(r => reviewsList.appendChild(r));

            showNotification(`Đã sắp xếp theo ${e.target.selectedOptions[0].text.toLowerCase()}! 📋`, 'success');
        });

        // ====== Like & Reply ======
        document.addEventListener('click', (e) => {
            const likeBtn = e.target.closest('.like-btn');
            if (likeBtn) {
                const isLiked = likeBtn.dataset.liked === 'true';
                const current = parseInt(likeBtn.dataset.count, 10);
                const likeIcon = likeBtn.querySelector('.like-icon');
                const likeCount = likeBtn.querySelector('.like-count');

                if (isLiked) {
                    likeBtn.dataset.liked = 'false';
                    likeBtn.dataset.count = current - 1;
                    likeIcon.textContent = '🤍';
                    likeCount.textContent = current - 1;
                    likeBtn.style.color = '#6b7280';
                } else {
                    likeBtn.dataset.liked = 'true';
                    likeBtn.dataset.count = current + 1;
                    likeIcon.textContent = '❤️';
                    likeCount.textContent = current + 1;
                    likeBtn.style.color = '#dc2626';
                }
            }

            const replyBtn = e.target.closest('.reply-btn');
            if (replyBtn) {
                const reviewCard = replyBtn.closest('.review-card');
                let existing = reviewCard.querySelector('.reply-form');
                if (existing) { existing.remove(); return; }

                const replyForm = document.createElement('div');
                replyForm.className = 'reply-form mt-4 p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500';
                replyForm.innerHTML = `
                    <div class="flex items-center gap-2 mb-3">
                    <span class="text-sm font-medium text-gray-700">💬 Trả lời đánh giá này:</span>
                    </div>
                    <div class="space-y-3">
                    <input type="text" class="reply-name w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tên của bạn">
                    <textarea class="reply-content w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none" rows="3" placeholder="Viết phản hồi của bạn..."></textarea>
                    <div class="flex gap-2">
                        <button class="submit-reply bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition duration-200">Gửi phản hồi</button>
                        <button class="cancel-reply bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium py-2 px-4 rounded-lg transition duration-200">Hủy</button>
                    </div>
                    </div>
                `;
                reviewCard.appendChild(replyForm);
                replyForm.querySelector('.reply-name').focus();

                replyForm.querySelector('.submit-reply').addEventListener('click', () => {
                    const replyName = replyForm.querySelector('.reply-name').value.trim();
                    const replyContent = replyForm.querySelector('.reply-content').value.trim();
                    if (!replyName || !replyContent) {
                        showNotification('Vui lòng điền đầy đủ thông tin phản hồi!', 'error');
                        return;
                    }
                    const replyDiv = document.createElement('div');
                    replyDiv.className = 'mt-4 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500';
                    replyDiv.innerHTML = `
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                ${replyName.charAt(0).toUpperCase()}
                            </div>
                            <div>
                                <h6 class="font-medium text-gray-800 text-sm">${replyName}</h6>
                                <p class="text-xs text-gray-600">Vừa xong</p>
                            </div>
                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Phản hồi</span>
                        </div>
                        <p class="text-gray-700 text-sm leading-relaxed">${replyContent}</p>
                    `;
                    replyForm.remove();
                    reviewCard.appendChild(replyDiv);
                    showNotification('Phản hồi đã được gửi thành công! 💬', 'success');
                });

                replyForm.querySelector('.cancel-reply').addEventListener('click', () => replyForm.remove());
            }
        });

        // ====== Nút “✖ Đổi sản phẩm” ======
        document.getElementById('clearSelectedProduct').addEventListener('click', () => {
            selectedProductBox.classList.add('hidden');
            selectedProductName.textContent = '';
            productIdInput.value = '';
            productNameInput.value = '';
        });

        // ====== Preselect qua query (?review_product_id=&review_product_name=) ======
        (function preselectFromQuery() {
            const params = new URLSearchParams(window.location.search);
            const pid = params.get('review_product_id');
            const pname = params.get('review_product_name');
            if (pid && pname) {
                selectedProductName.textContent = pname;
                productIdInput.value = pid;
                productNameInput.value = pname;
                selectedProductBox.classList.remove('hidden');
                document.getElementById('reviewForm').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        })();
    });

        // ====== Quan trọng: đưa ra GLOBAL để HTML onclick gọi được ======
    window.showReviewForm = function (btn) {
        const pid = btn.dataset.productId;
        const pname = btn.dataset.productName;

        const selectedProductBox = document.getElementById('selectedProductBox');
        const selectedProductName = document.getElementById('selectedProductName');
        const productIdInput = document.getElementById('productId');
        const productNameInput = document.getElementById('productName');

        selectedProductName.textContent = pname;
        productIdInput.value = pid;
        productNameInput.value = pname;

        selectedProductBox.classList.remove('hidden');
        document.getElementById('reviewTitle').focus();
        document.getElementById('reviewForm').scrollIntoView({ behavior: 'smooth', block: 'start' });

        const form = document.getElementById('reviewForm');
        form.classList.add('ring-2','ring-blue-300','rounded-lg');
        setTimeout(() => form.classList.remove('ring-2','ring-blue-300'), 600);
    };

    </script>
@endsection
