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
        let selectedRating = 0;
        
        // Xử lý đánh giá sao
        const stars = document.querySelectorAll('.star');
        const ratingText = document.getElementById('ratingText');
        
        const ratingLabels = {
            1: \'Rất tệ\',
            2: \'Tệ\', 
            3: \'Bình thường\',
            4: \'Tốt\',
            5: \'Tuyệt vời\'
        };
        
        stars.forEach(star => {
            star.addEventListener(\'click\', () => {
                selectedRating = parseInt(star.dataset.rating);
                updateStars();
                ratingText.textContent = ratingLabels[selectedRating];
            });
            
            star.addEventListener(\'mouseenter\', () => {
                const rating = parseInt(star.dataset.rating);
                highlightStarsHover(rating);
            });
        });
        
        document.getElementById(\'starRating\').addEventListener(\'mouseleave\', () => {
            updateStars();
        });
        
        function highlightStarsHover(rating) {
            stars.forEach((star, index) => {
                star.classList.remove(\'active\', \'hover\');
                if (index < rating) {
                    star.classList.add(\'hover\');
                }
            });
        }
        
        function updateStars() {
            stars.forEach((star, index) => {
                star.classList.remove(\'active\', \'hover\');
                if (index < selectedRating) {
                    star.classList.add(\'active\');
                }
            });
        }
        
        // Xử lý form gửi đánh giá
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('customerName').value.trim();
            const title = document.getElementById('reviewTitle').value.trim();
            const content = document.getElementById('reviewContent').value.trim();
            
            if (!name || !title || !content || selectedRating === 0) {
                showNotification('Vui lòng điền đầy đủ thông tin và chọn số sao!', 'error');
                return;
            }
            
            // Tạo đánh giá mới
            createReviewElement(name, title, content, selectedRating).then(newReview => {
                const reviewsList = document.getElementById('reviewsList');
                
                // Add fade-in animation
                newReview.style.opacity = '0';
                newReview.style.transform = 'translateY(-20px)';
                reviewsList.insertBefore(newReview, reviewsList.firstChild);
                
                // Trigger animation
                requestAnimationFrame(() => {
                    newReview.style.opacity = '1';
                    newReview.style.transform = 'translateY(0)';
                });
                
                // Reset form
                this.reset();
                selectedRating = 0;
                updateStars();
                ratingText.textContent = 'Chọn số sao';
                
                showNotification('Cảm ơn bạn đã gửi đánh giá! 🎉', 'success');
            });
        });
        
        async function createReviewElement(name, title, content, rating) {
            const reviewDiv = document.createElement('div');
            reviewDiv.className = 'review-card border border-gray-200 rounded-lg p-6';
            reviewDiv.dataset.stars = rating;
            reviewDiv.style.transition = 'all 0.3s ease-out';
            
            const stars = '⭐'.repeat(rating);
            const initial = name.charAt(0).toUpperCase();
            const colors = ['bg-blue-500', 'bg-pink-500', 'bg-green-500', 'bg-purple-500', 'bg-red-500'];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            
            // Format current date
            const now = new Date();
            const formattedDate = now.toLocaleDateString('vi-VN', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
            
            reviewDiv.innerHTML = `
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 ${randomColor} rounded-full flex items-center justify-center text-white font-semibold">
                            ${initial}
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">${name}</h4>
                            <p class="text-sm text-gray-600">Vừa xong</p>
                        </div>
                    </div>
                    <div class="flex text-yellow-400">
                        ${stars}
                    </div>
                </div>
                <h5 class="font-semibold text-gray-800 mb-2">${title}</h5>
                <p class="text-gray-700 leading-relaxed">${content}</p>
                <div class="flex items-center gap-4 mt-4 text-sm text-gray-600">
                    <button class="like-btn flex items-center gap-1 hover:text-blue-600 transition-colors" data-liked="false" data-count="0">
                        <span class="like-icon">🤍</span> <span class="like-count">0</span>
                    </button>
                    <button class="reply-btn flex items-center gap-1 hover:text-blue-600">
                        💬 Trả lời
                    </button>
                </div>
            `;
            
            return reviewDiv;
        }
        
        function showNotification(message, type = 'success') {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.notification');
            existingNotifications.forEach(notif => notif.remove());
            
            const notification = document.createElement('div');
            notification.className = `notification fixed top-4 right-4 px-6 py-3 rounded-lg text-white font-semibold z-50 transform transition-all duration-300 ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            } translate-x-full`;
            
            // Add icon based on type
            const icon = type === 'success' ? '✅' : '❌';
            notification.innerHTML = `<div class="flex items-center gap-2">
                <span>${icon}</span>
                <span>${message}</span>
            </div>`;
            
            document.body.appendChild(notification);
            
            // Slide in
            requestAnimationFrame(() => {
                notification.style.transform = 'translateX(0)';
            });
            
            // Slide out and remove
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                notification.style.opacity = '0';
                setTimeout(() => {
                    if (notification.parentNode) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }
        
        // Xử lý lọc theo số sao
        document.getElementById(\'starFilter\').addEventListener(\'change\', (e) => {
            const filterValue = e.target.value;
            const reviewsList = document.getElementById(\'reviewsList\');
            const reviews = Array.from(reviewsList.children);
            
            reviews.forEach(review => {
                if (filterValue === \'all\') {
                    review.style.display = \'block\';
                } else {
                    const reviewStars = review.dataset.stars;
                    if (reviewStars === filterValue) {
                        review.style.display = \'block\';
                    } else {
                        review.style.display = \'none\';
                    }
                }
            });
            
            // Đếm số đánh giá hiển thị
            const visibleReviews = reviews.filter(review => review.style.display !== \'none\').length;
            const filterText = filterValue === \'all\' ? \'tất cả đánh giá\' : `đánh giá ${filterValue} sao`;
            showNotification(`Hiển thị ${visibleReviews} ${filterText}! ⭐`, 'success');
            
            // Animate filtered reviews
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

        // Xử lý sắp xếp đánh giá
        document.getElementById('sortSelect').addEventListener('change', (e) => {
            const sortType = e.target.value;
            const reviewsList = document.getElementById(\'reviewsList\');
            const reviews = Array.from(reviewsList.children).filter(review => review.style.display !== \'none\');
            
            reviews.sort((a, b) => {
                switch(sortType) {
                    case \'newest\':
                        // Mới nhất lên đầu (thứ tự hiện tại)
                        return 0;
                    case \'oldest\':
                        // Cũ nhất lên đầu (đảo ngược)
                        return reviews.indexOf(b) - reviews.indexOf(a);
                    case \'highest\':
                        // Đánh giá cao nhất
                        const starsA = parseInt(a.dataset.stars);
                        const starsB = parseInt(b.dataset.stars);
                        return starsB - starsA;
                    case \'lowest\':
                        // Đánh giá thấp nhất
                        const starsA2 = parseInt(a.dataset.stars);
                        const starsB2 = parseInt(b.dataset.stars);
                        return starsA2 - starsB2;
                    default:
                        return 0;
                }
            });
            
            // Xóa và thêm lại theo thứ tự mới (chỉ các review hiển thị)
            const allReviews = Array.from(reviewsList.children);
            const hiddenReviews = allReviews.filter(review => review.style.display === \'none\');
            
            reviewsList.innerHTML = \'\';
            reviews.forEach(review => reviewsList.appendChild(review));
            hiddenReviews.forEach(review => reviewsList.appendChild(review));
            
            showNotification(`Đã sắp xếp theo ${e.target.selectedOptions[0].text.toLowerCase()}! 📋`, \'success\');
        });
        
        // Xử lý nút like
        document.addEventListener(\'click\', (e) => {
            const likeBtn = e.target.closest(\'.like-btn\');
            if (likeBtn) {
                const isLiked = likeBtn.dataset.liked === \'true\';
                const currentCount = parseInt(likeBtn.dataset.count);
                const likeIcon = likeBtn.querySelector(\'.like-icon\');
                const likeCount = likeBtn.querySelector(\'.like-count\');
                
                if (isLiked) {
                    // Unlike
                    likeBtn.dataset.liked = \'false\';
                    likeBtn.dataset.count = currentCount - 1;
                    likeIcon.textContent = \'🤍\';
                    likeCount.textContent = currentCount - 1;
                    likeBtn.style.color = \'#6b7280\';
                } else {
                    // Like
                    likeBtn.dataset.liked = \'true\';
                    likeBtn.dataset.count = currentCount + 1;
                    likeIcon.textContent = \'❤️\';
                    likeCount.textContent = currentCount + 1;
                    likeBtn.style.color = \'#dc2626\';
                }
            }
            
            // Xử lý nút trả lời
            const replyBtn = e.target.closest(\'.reply-btn\');
            if (replyBtn) {
                const reviewCard = replyBtn.closest(\'.review-card\');
                
                // Kiểm tra xem đã có form trả lời chưa
                let existingReplyForm = reviewCard.querySelector(\'.reply-form\');
                if (existingReplyForm) {
                    existingReplyForm.remove();
                    return;
                }
                
                // Tạo form trả lời
                const replyForm = document.createElement(\'div\');
                replyForm.className = \'reply-form mt-4 p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500\';
                replyForm.innerHTML = `
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-sm font-medium text-gray-700">💬 Trả lời đánh giá này:</span>
                    </div>
                    <div class="space-y-3">
                        <input type="text" class="reply-name w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tên của bạn">
                        <textarea class="reply-content w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none" rows="3" placeholder="Viết phản hồi của bạn..."></textarea>
                        <div class="flex gap-2">
                            <button class="submit-reply bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition duration-200">
                                Gửi phản hồi
                            </button>
                            <button class="cancel-reply bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium py-2 px-4 rounded-lg transition duration-200">
                                Hủy
                            </button>
                        </div>
                    </div>
                `;
                
                reviewCard.appendChild(replyForm);
                
                // Focus vào input tên
                replyForm.querySelector(\'.reply-name\').focus();
                
                // Xử lý nút gửi phản hồi
                replyForm.querySelector(\'.submit-reply\').addEventListener(\'click\', () => {
                    const replyName = replyForm.querySelector(\'.reply-name\').value;
                    const replyContent = replyForm.querySelector(\'.reply-content\').value;
                    
                    if (!replyName || !replyContent) {
                        showNotification(\'Vui lòng điền đầy đủ thông tin phản hồi!\', \'error\');
                        return;
                    }
                    
                    // Tạo phản hồi
                    const replyDiv = document.createElement(\'div\');
                    replyDiv.className = \'mt-4 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500\';
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
                    
                    showNotification(\'Phản hồi đã được gửi thành công! 💬\', \'success\');
                });
                
                // Xử lý nút hủy
                replyForm.querySelector(\'.cancel-reply\').addEventListener(\'click\', () => {
                    replyForm.remove();
                });
            }
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement(\'script\');d.innerHTML="window.__CF$cv$params={r:\'98f5f31a27e00eeb\',t:\'MTc2MDYwMDg2Mi4wMDAwMDA=\'};var a=document.createElement(\'script\');a.nonce=\'\';a.src=\'/cdn-cgi/challenge-platform/scripts/jsd/main.js\';document.getElementsByTagName(\'head\')[0].appendChild(a);";b.getElementsByTagName(\'head\')[0].appendChild(d)}}if(document.body){var a=document.createElement(\'iframe\');a.height=1;a.width=1;a.style.position=\'absolute\';a.style.top=0;a.style.left=0;a.style.border=\'none\';a.style.visibility=\'hidden\';document.body.appendChild(a);if(\'loading\'!==document.readyState)c();else if(window.addEventListener)document.addEventListener(\'DOMContentLoaded\',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);\'loading\'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
@endsection
