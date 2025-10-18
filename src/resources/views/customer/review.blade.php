@extends('customer.layout')
@section('title', 'Đánh giá sản phẩm')

@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Sản phẩm chờ đánh giá -->
        <section class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">📦 Sản phẩm đã mua</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="purchasedProducts">
                <!-- iPhone 15 Pro Max -->
                <div class="product-card bg-white rounded-lg border hover:shadow-lg transition-shadow p-4">
                    <div class="relative">
                        <div class="bg-gray-100 rounded-lg p-4 text-center mb-4">
                            <div class="text-4xl mb-2">📱</div>
                            <h3 class="text-lg font-semibold text-gray-800">iPhone 15 Pro Max</h3>
                            <p class="text-sm text-gray-600">256GB - Titan Tự Nhiên</p>
                        </div>
                        <div class="absolute top-2 right-2">
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full">Đã nhận hàng</span>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 mb-4">
                        <p>Đơn hàng: #DH001234</p>
                        <p>Ngày mua: 15/10/2025</p>
                    </div>
                    <button onclick="showReviewForm(this)" data-product-id="1" data-product-name="iPhone 15 Pro Max" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        ✍️ Viết đánh giá
                    </button>
                </div>

                <!-- MacBook Air M3 -->
                <div class="product-card bg-white rounded-lg border hover:shadow-lg transition-shadow p-4">
                    <div class="relative">
                        <div class="bg-gray-100 rounded-lg p-4 text-center mb-4">
                            <div class="text-4xl mb-2">💻</div>
                            <h3 class="text-lg font-semibold text-gray-800">MacBook Air M3</h3>
                            <p class="text-sm text-gray-600">8GB RAM - 256GB SSD</p>
                        </div>
                        <div class="absolute top-2 right-2">
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full">Đã nhận hàng</span>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 mb-4">
                        <p>Đơn hàng: #DH001235</p>
                        <p>Ngày mua: 16/10/2025</p>
                    </div>
                    <button onclick="showReviewForm(this)" data-product-id="2" data-product-name="MacBook Air M3"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        ✍️ Viết đánh giá
                    </button>
                </div>

                <!-- AirPods Pro 2 -->
                <div class="product-card bg-white rounded-lg border hover:shadow-lg transition-shadow p-4">
                    <div class="relative">
                        <div class="bg-gray-100 rounded-lg p-4 text-center mb-4">
                            <div class="text-4xl mb-2">🎧</div>
                            <h3 class="text-lg font-semibold text-gray-800">AirPods Pro 2</h3>
                            <p class="text-sm text-gray-600">Trắng</p>
                        </div>
                        <div class="absolute top-2 right-2">
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-1 rounded-full">Đang giao</span>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 mb-4">
                        <p>Đơn hàng: #DH001236</p>
                        <p>Ngày mua: 17/10/2025</p>
                    </div>
                    <button disabled
                            class="w-full bg-gray-300 text-gray-500 font-medium py-2 px-4 rounded-lg cursor-not-allowed">
                        ⏳ Chờ nhận hàng
                    </button>
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
                        <!-- Đánh giá mẫu -->
                        <div class="review-card border border-gray-200 rounded-lg p-6" data-stars="5">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                                        A
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">Anh Tuấn</h4>
                                        <p class="text-sm text-gray-600">15/12/2024</p>
                                    </div>
                                </div>
                                <div class="flex text-yellow-400">
                                    ⭐⭐⭐⭐⭐
                                </div>
                            </div>
                            <h5 class="font-semibold text-gray-800 mb-2">Sản phẩm tuyệt vời, đáng đồng tiền!</h5>
                            <p class="text-gray-700 leading-relaxed">
                                Mình đã sử dụng iPhone 15 Pro Max được 2 tháng và cảm thấy rất hài lòng. Camera chụp ảnh cực kỳ sắc nét, pin trâu, hiệu năng mượt mà. Đặc biệt là tính năng Action Button rất tiện lợi. Giao hàng nhanh, đóng gói cẩn thận. Sẽ tiếp tục ủng hộ shop!
                            </p>
                            <div class="flex items-center gap-4 mt-4 text-sm text-gray-600">
                                <button class="like-btn flex items-center gap-1 hover:text-blue-600 transition-colors" data-liked="false" data-count="12">
                                    <span class="like-icon">🤍</span> <span class="like-count">12</span>
                                </button>
                                <button class="reply-btn flex items-center gap-1 hover:text-blue-600">
                                    💬 Trả lời
                                </button>
                            </div>
                        </div>

                        <div class="review-card border border-gray-200 rounded-lg p-6" data-stars="5">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center text-white font-semibold">
                                        M
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">Mai Linh</h4>
                                        <p class="text-sm text-gray-600">12/12/2024</p>
                                    </div>
                                </div>
                                <div class="flex text-yellow-400">
                                    ⭐⭐⭐⭐⭐
                                </div>
                            </div>
                            <h5 class="font-semibold text-gray-800 mb-2">Camera quá đỉnh, chụp ảnh như pro!</h5>
                            <p class="text-gray-700 leading-relaxed">
                                Lần đầu dùng iPhone và mình thực sự bị choáng ngợp bởi chất lượng camera. Chụp ảnh ban đêm cũng rất sáng và rõ nét. Màn hình sống động, màu sắc chân thực. Duy nhất là hơi nặng một chút nhưng quen rồi cũng ok. Recommend cho ai đang phân vân!
                            </p>
                            <div class="flex items-center gap-4 mt-4 text-sm text-gray-600">
                                <button class="like-btn flex items-center gap-1 hover:text-blue-600 transition-colors" data-liked="false" data-count="8">
                                    <span class="like-icon">🤍</span> <span class="like-count">8</span>
                                </button>
                                <button class="reply-btn flex items-center gap-1 hover:text-blue-600">
                                    💬 Trả lời
                                </button>
                            </div>
                        </div>

                        <div class="review-card border border-gray-200 rounded-lg p-6" data-stars="4">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-semibold">
                                        H
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">Hoàng Nam</h4>
                                        <p class="text-sm text-gray-600">10/12/2024</p>
                                    </div>
                                </div>
                                <div class="flex text-yellow-400">
                                    ⭐⭐⭐⭐
                                </div>
                            </div>
                            <h5 class="font-semibold text-gray-800 mb-2">Tốt nhưng có một số điểm cần cải thiện</h5>
                            <p class="text-gray-700 leading-relaxed">
                                Sản phẩm nhìn chung ok, hiệu năng mạnh mẽ, chơi game mượt. Tuy nhiên giá hơi cao so với mặt bằng chung và thời lượng pin có thể tốt hơn nữa. Bù lại thì thiết kế đẹp, cầm nắm chắc chắn. Shop giao hàng đúng hẹn, nhân viên tư vấn nhiệt tình.
                            </p>
                            <div class="flex items-center gap-4 mt-4 text-sm text-gray-600">
                                <button class="like-btn flex items-center gap-1 hover:text-blue-600 transition-colors" data-liked="false" data-count="5">
                                    <span class="like-icon">🤍</span> <span class="like-count">5</span>
                                </button>
                                <button class="reply-btn flex items-center gap-1 hover:text-blue-600">
                                    💬 Trả lời
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Phân trang -->
                    <div class="flex justify-center mt-8">
                        <nav class="flex items-center gap-2">
                            <button class="px-3 py-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg">
                                ← Trước
                            </button>
                            <button class="px-3 py-2 bg-blue-600 text-white rounded-lg">1</button>
                            <button class="px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg">2</button>
                            <button class="px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg">3</button>
                            <button class="px-3 py-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg">
                                Sau →
                            </button>
                        </nav>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        let selectedRating = 0;

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
        document.getElementById('reviewForm').addEventListener('submit', function (e) {
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

            createReviewElement(name, title, content, selectedRating, selectedProductNm).then(newReview => {
                const reviewsList = document.getElementById('reviewsList');

                newReview.style.opacity = '0';
                newReview.style.transform = 'translateY(-20px)';
                reviewsList.insertBefore(newReview, reviewsList.firstChild);

                requestAnimationFrame(() => {
                    newReview.style.opacity = '1';
                    newReview.style.transform = 'translateY(0)';
                });

                this.reset();
                selectedRating = 0;
                updateStars();
                ratingText.textContent = 'Chọn số sao';

                showNotification('Cảm ơn bạn đã gửi đánh giá! 🎉', 'success');

                // Reset chip chọn sản phẩm
                selectedProductBox.classList.add('hidden');
                selectedProductName.textContent = '';
                productIdInput.value = '';
                productNameInput.value = '';
            });
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
            showNotification(`Hiển thị ${visibleReviews} ${filterText}! ⭐`, 'success');

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

<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script\');d.innerHTML="window.__CF$cv$params={r:'98f5f31a27e00eeb\',t:'MTc2MDYwMDg2Mi4wMDAwMDA=\'};var a=document.createElement('script\');a.nonce='\';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js\';document.getElementsByTagName('head\')[0].appendChild(a);";b.getElementsByTagName('head\')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe\');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none\';a.style.visibility='hidden\';document.body.appendChild(a);if('loading\'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded\',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading\'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
@endsection
