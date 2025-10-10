<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Hệ thống Quản lý Cửa hàng Điện tử - Admin + Storefront</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body class="bg-gray-50">

  <!-- Header -->
  <header class="gradient-bg text-white shadow-lg fixed w-full top-0 z-50">
    <div class="flex items-center justify-between px-6 py-4">
      <div class="flex items-center space-x-4">
        <i class="fas fa-store text-2xl"></i>
        <h1 class="text-xl font-bold">Thiết bị điện tử</h1>
      </div>
      <div class="flex items-center space-x-4">
        <button class="bg-white text-blue-600 px-3 py-1 rounded" onclick="showSection('store_home')">
          Xem cửa hàng
        </button>
        <div class="flex items-center space-x-2">
          <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32'%3E%3Ccircle cx='16' cy='16' r='16' fill='%23ffffff'/%3E%3Ctext x='16' y='21' text-anchor='middle' fill='%23667eea' font-family='Arial' font-size='14' font-weight='bold'%3EA%3C/text%3E%3C/svg%3E" alt="Admin" class="w-8 h-8 rounded-full">
          <span class="font-medium">User</span>
        </div>
      </div>
    </div>
  </header>

  <div class="flex pt-16 min-h-screen">
    <!-- Sidebar (kept admin links + store links) -->
    <aside class="w-72 bg-white shadow-lg h-screen sticky top-16 overflow-y-auto z-40">
      <nav class="mt-6">
        <div class="px-4 mb-4"><h2 class="text-gray-600 text-sm font-semibold uppercase">Quản lý</h2></div>

        <!-- existing admin items (kept) -->
        <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700" onclick="showSection('dashboard')">
          <i class="fas fa-tachometer-alt mr-3"></i><span>Dashboard</span>
        </a>

        <!-- ... (other admin items omitted for brevity in sidebar) ... -->

        <div class="px-4 mt-6 mb-2">
          <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Cửa hàng (Khách hàng)</h3>
        </div>
        <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700" onclick="showSection('store_home')">
          <i class="fas fa-home mr-3"></i><span>Trang chủ (Storefront)</span>
        </a>
        <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700" onclick="showSection('store_products')">
          <i class="fas fa-shopping-bag mr-3"></i><span>Sản phẩm (Shop)</span>
        </a>
        <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700" onclick="showSection('cart')">
          <i class="fas fa-shopping-cart mr-3"></i><span>Giỏ hàng</span>
        </a>
        <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700" onclick="showSection('orders')">
          <i class="fas fa-box-open mr-3"></i><span>Đơn hàng của tôi</span>
        </a>
        <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700" onclick="showSection('profile')">
          <i class="fas fa-user mr-3"></i><span>Tài khoản</span>
        </a>
        <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700" onclick="showSection('support')">
          <i class="fas fa-headset mr-3"></i><span>Hỗ trợ</span>
        </a>
      </nav>
    </aside>

    <!-- Main content area (contains both admin sections and store sections) -->
    <main class="flex-1 p-6 animate-fade-in">
      <!-- ====== ADMIN Dashboard (kept from original) ====== -->
      <div id="dashboard" class="section hidden">
        <div class="mb-6">
          <h2 class="text-2xl font-bold text-gray-800">Dashboard Tổng quan</h2>
          <p class="text-gray-600 mt-1">Chào mừng bạn đến với hệ thống quản lý</p>
        </div>
        <!-- stats cards (kept minimal) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div class="bg-gradient-to-r from-purple-400 to-pink-400 text-white p-6 rounded-lg">
            <p class="text-sm">Tổng đơn hàng</p><p class="text-2xl font-bold">1,234</p>
          </div>
          <div class="bg-gradient-to-r from-blue-400 to-cyan-400 text-white p-6 rounded-lg">
            <p class="text-sm">Doanh thu</p><p class="text-2xl font-bold">₫45.2M</p>
          </div>
          <div class="bg-gradient-to-r from-green-400 to-teal-300 text-white p-6 rounded-lg">
            <p class="text-sm">Khách hàng</p><p class="text-2xl font-bold">892</p>
          </div>
          <div class="bg-gradient-to-r from-pink-400 to-yellow-300 text-white p-6 rounded-lg">
            <p class="text-sm">Sản phẩm</p><p class="text-2xl font-bold">156</p>
          </div>
        </div>
      </div>

      <!-- ========== STORE: Trang chủ (banner, featured, promos) ========== -->
      <section id="store_home" class="section hidden">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <!-- main banner -->
          <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <div class="h-56 rounded-lg overflow-hidden relative">
              <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=1600&auto=format&fit=crop&ixlib=rb-4.0.3&s=..." alt="banner" class="w-full h-full object-cover">
              <div class="absolute left-6 bottom-6 bg-white/80 p-4 rounded">
                <h3 class="text-2xl font-bold">Khuyến mãi Mùa Hè - Giảm đến 30%</h3>
                <p class="text-sm mt-1">Mua laptop, nhận quà chính hãng</p>
                <button class="mt-3 px-4 py-2 gradient-bg text-white rounded" onclick="showSection('promotions')">Xem khuyến mãi</button>
              </div>
            </div>

            <!-- Featured products carousel (simplified) -->
            <div class="mt-6">
              <h4 class="text-lg font-semibold mb-3">Sản phẩm nổi bật</h4>
              <div id="featured-products" class="grid grid-cols-2 md:grid-cols-4 gap-4"></div>
            </div>
          </div>

          <!-- promotions / quick links -->
          <aside class="bg-white rounded-lg shadow p-6">
            <h4 class="text-lg font-semibold mb-3">Khuyến mãi</h4>
            <ul id="promo-list" class="space-y-3">
              <!-- populated by JS -->
            </ul>

            <div class="mt-6">
              <h4 class="text-lg font-semibold mb-3">Tìm kiếm nhanh</h4>
              <div class="flex items-center">
                <input id="store-search" type="text" placeholder="Tìm sản phẩm..." class="flex-1 px-3 py-2 border rounded-l-lg" oninput="renderStoreProducts()">
                <button class="px-3 py-2 bg-blue-600 text-white rounded-r-lg" onclick="renderStoreProducts()"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </aside>
        </div>
      </section>

      <!-- ========== STORE: Danh sách sản phẩm + filters ========== -->
      <section id="store_products" class="section hidden">
        <div class="flex justify-between items-center mb-4">
          <div>
            <h2 class="text-2xl font-bold">Cửa hàng - Tất cả sản phẩm</h2>
            <p class="text-sm text-gray-600">Filter theo danh mục, thương hiệu, giá</p>
          </div>
          <div class="flex items-center space-x-2">
            <select id="filter-category" class="border rounded px-3 py-2" onchange="renderStoreProducts()">
              <option value="all">Tất cả danh mục</option>
            </select>
            <select id="filter-brand" class="border rounded px-3 py-2" onchange="renderStoreProducts()">
              <option value="all">Tất cả thương hiệu</option>
            </select>
            <select id="filter-price" class="border rounded px-3 py-2" onchange="renderStoreProducts()">
              <option value="all">Giá: Tất cả</option>
              <option value="0-5000000">Dưới 5,000,000</option>
              <option value="5000000-15000000">5,000,000 - 15,000,000</option>
              <option value="15000000-999999999">Trên 15,000,000</option>
            </select>
          </div>
        </div>

        <div id="product-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <!-- JS sẽ render các card sản phẩm -->
        </div>
      </section>

      <!-- ========== Product detail ========== -->
      <section id="product_detail" class="section hidden">
        <div class="bg-white rounded-lg shadow p-6">
          <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/3">
              <img id="detail-image" src="" alt="product" class="w-full h-72 object-cover rounded">
            </div>
            <div class="md:w-2/3">
              <h3 id="detail-title" class="text-2xl font-bold"></h3>
              <p id="detail-brand" class="text-sm text-gray-500 mb-3"></p>
              <p id="detail-price" class="text-xl font-semibold text-red-600 mb-4"></p>
              <p id="detail-desc" class="text-gray-700 mb-4"></p>
              <div class="flex items-center space-x-3 mb-4">
                <input id="qty" type="number" value="1" min="1" class="w-20 border rounded px-2 py-1">
                <button class="px-4 py-2 bg-blue-600 text-white rounded" onclick="addToCartFromDetail()">Thêm vào giỏ</button>
                <button class="px-4 py-2 border rounded" onclick="showSection('cart')">Xem giỏ hàng</button>
              </div>

              <div>
                <h4 class="font-semibold mb-2">Đánh giá</h4>
                <div id="detail-reviews" class="space-y-2 text-sm text-gray-700"></div>
                <button class="mt-3 px-3 py-2 bg-green-600 text-white rounded" onclick="showSection('write_review')">Viết đánh giá</button>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ========== Cart & Checkout ========== -->
      <section id="cart" class="section hidden">
        <div class="bg-white rounded-lg shadow p-6">
          <h2 class="text-2xl font-bold mb-4">Giỏ hàng</h2>
          <div id="cart-list" class="space-y-4"></div>

          <div class="mt-6 flex justify-end items-center space-x-4">
            <div class="text-right">
              <p class="text-sm text-gray-600">Tạm tính</p>
              <p id="cart-subtotal" class="text-xl font-bold">₫0</p>
            </div>
            <button class="px-4 py-2 bg-blue-600 text-white rounded" onclick="showSection('checkout')">Thanh toán</button>
          </div>
        </div>
      </section>

      <section id="checkout" class="section hidden">
        <div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
          <h2 class="text-2xl font-bold mb-4">Thanh toán</h2>
          <form id="checkout-form" onsubmit="handleCheckout(event)">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <input id="chk-name" type="text" placeholder="Họ tên" required class="border rounded px-3 py-2">
              <input id="chk-phone" type="text" placeholder="Số điện thoại" required class="border rounded px-3 py-2">
              <input id="chk-address" type="text" placeholder="Địa chỉ giao hàng" required class="border rounded px-3 py-2 md:col-span-2">
              <select id="chk-payment" class="border rounded px-3 py-2 md:col-span-2">
                <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                <option value="momo">Ví MoMo</option>
                <option value="card">Thẻ tín dụng/ghi nợ (Visa/Master)</option>
              </select>
            </div>
            <div class="mt-4">
              <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Xác nhận và Thanh toán</button>
            </div>
          </form>
        </div>
      </section>

      <!-- ========== Orders list & detail (customer) ========== -->
      <section id="orders" class="section hidden">
        <div class="bg-white rounded-lg shadow p-6">
          <h2 class="text-2xl font-bold mb-4">Đơn hàng của tôi</h2>
          <div id="orders-list" class="space-y-3">
            <!-- populated by JS -->
          </div>
        </div>
      </section>

      <section id="order_detail" class="section hidden">
        <div class="bg-white rounded-lg shadow p-6">
          <button class="mb-4 text-sm text-blue-600" onclick="showSection('orders')">&larr; Quay lại</button>
          <h3 id="order-id" class="text-xl font-semibold mb-2"></h3>
          <p id="order-status" class="text-sm text-gray-600 mb-4"></p>
          <div id="order-items" class="space-y-2"></div>
          <div class="mt-4">
            <h4 class="font-semibold">Theo dõi vận chuyển</h4>
            <p id="order-tracking" class="text-sm text-gray-700 mt-2">Mã tracking: <span id="tracking-code">-</span></p>
          </div>
        </div>
      </section>

      <!-- ========== Profile & change password ========== -->
      <section id="profile" class="section hidden">
        <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
          <h2 class="text-2xl font-bold mb-4">Thông tin cá nhân</h2>
          <form id="profile-form" onsubmit="updateProfile(event)">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <input id="profile-name" type="text" placeholder="Họ tên" class="border rounded px-3 py-2">
              <input id="profile-email" type="email" placeholder="Email" class="border rounded px-3 py-2">
              <input id="profile-phone" type="text" placeholder="Số điện thoại" class="border rounded px-3 py-2">
            </div>
            <div class="mt-4 flex space-x-3">
              <button class="px-4 py-2 bg-blue-600 text-white rounded">Cập nhật</button>
              <button type="button" class="px-4 py-2 border rounded" onclick="showSection('change_password')">Đổi mật khẩu</button>
            </div>
          </form>
        </div>
      </section>

      <section id="change_password" class="section hidden">
        <div class="bg-white rounded-lg shadow p-6 max-w-md">
          <h3 class="text-xl font-semibold mb-3">Đổi mật khẩu</h3>
          <form onsubmit="changePassword(event)">
            <input id="old-pass" type="password" placeholder="Mật khẩu cũ" class="w-full border rounded px-3 py-2 mb-3" required>
            <input id="new-pass" type="password" placeholder="Mật khẩu mới" class="w-full border rounded px-3 py-2 mb-3" required>
            <input id="confirm-pass" type="password" placeholder="Xác nhận mật khẩu mới" class="w-full border rounded px-3 py-2 mb-3" required>
            <button class="px-4 py-2 bg-green-600 text-white rounded">Lưu mật khẩu</button>
          </form>
        </div>
      </section>

      <!-- ========== Reviews: write & view ========== -->
      <section id="write_review" class="section hidden">
        <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
          <h3 class="text-xl font-semibold mb-3">Viết đánh giá</h3>
          <form onsubmit="submitReview(event)">
            <input id="review-product-id" type="hidden">
            <div class="mb-3">
              <label class="text-sm">Đánh giá (1-5)</label>
              <select id="review-rating" class="border rounded px-3 py-2 w-24">
                <option>5</option><option>4</option><option>3</option><option>2</option><option>1</option>
              </select>
            </div>
            <textarea id="review-text" rows="4" class="w-full border rounded px-3 py-2 mb-3" placeholder="Chia sẻ cảm nhận của bạn..." required></textarea>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Gửi đánh giá</button>
          </form>
        </div>
      </section>

      <section id="view_reviews" class="section hidden">
        <div class="bg-white rounded-lg shadow p-6 max-w-3xl">
          <h3 class="text-xl font-semibold mb-3">Đánh giá sản phẩm</h3>
          <div id="reviews-list" class="space-y-3"></div>
        </div>
      </section>

      <!-- ========== Promotions list ========== -->
      <section id="promotions" class="section hidden">
        <div class="bg-white rounded-lg shadow p-6">
          <h2 class="text-2xl font-bold mb-4">Chương trình khuyến mãi</h2>
          <div id="promotions-list" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
        </div>
      </section>

      <!-- ========== Support (live chat mock + ticket) ========== -->
      <section id="support" class="section hidden">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-semibold mb-4">Live Chat (mô phỏng)</h3>
            <div id="live-chat-window" class="h-96 overflow-y-auto border rounded p-3 bg-gray-50"></div>
            <div class="mt-3 flex">
              <input id="live-msg" class="flex-1 border rounded-l px-3 py-2" placeholder="Gửi tin nhắn...">
              <button class="px-4 py-2 bg-blue-600 text-white rounded-r" onclick="sendLiveMessage()">Gửi</button>
            </div>
          </div>
          <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-semibold mb-3">Gửi yêu cầu hỗ trợ</h3>
            <form onsubmit="submitTicket(event)">
              <input id="ticket-name" class="w-full border rounded px-3 py-2 mb-3" placeholder="Tên" required>
              <input id="ticket-phone" class="w-full border rounded px-3 py-2 mb-3" placeholder="Số điện thoại" required>
              <textarea id="ticket-desc" rows="4" class="w-full border rounded px-3 py-2 mb-3" placeholder="Mô tả vấn đề..." required></textarea>
              <button class="px-4 py-2 bg-green-600 text-white rounded">Gửi yêu cầu</button>
            </form>
          </div>
        </div>
      </section>

      <!-- ========== Auth: login / register / forgot ========== -->
      <section id="auth" class="section hidden">
        <div class="max-w-2xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-semibold mb-3">Đăng nhập</h3>
            <form onsubmit="login(event)">
              <input id="login-email" class="w-full border rounded px-3 py-2 mb-3" placeholder="Email" required>
              <input id="login-pass" type="password" class="w-full border rounded px-3 py-2 mb-3" placeholder="Mật khẩu" required>
              <div class="flex justify-between items-center mb-3">
                <label class="flex items-center"><input type="checkbox" id="remember" class="mr-2">Ghi nhớ đăng nhập</label>
                <button type="button" class="text-sm text-blue-600" onclick="showSection('forgot')">Quên mật khẩu?</button>
              </div>
              <button class="px-4 py-2 bg-blue-600 text-white rounded">Đăng nhập</button>
            </form>
          </div>
          <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-semibold mb-3">Đăng ký</h3>
            <form onsubmit="register(event)">
              <input id="reg-name" class="w-full border rounded px-3 py-2 mb-3" placeholder="Họ tên" required>
              <input id="reg-email" class="w-full border rounded px-3 py-2 mb-3" placeholder="Email" required>
              <input id="reg-phone" class="w-full border rounded px-3 py-2 mb-3" placeholder="Số điện thoại" required>
              <input id="reg-pass" type="password" class="w-full border rounded px-3 py-2 mb-3" placeholder="Mật khẩu" required>
              <button class="px-4 py-2 bg-green-600 text-white rounded">Đăng ký</button>
            </form>
          </div>
        </div>
      </section>

      <section id="forgot" class="section hidden">
        <div class="bg-white rounded-lg shadow p-6 max-w-md mx-auto">
          <h3 class="text-xl font-semibold mb-3">Quên mật khẩu</h3>
          <form onsubmit="forgotPassword(event)">
            <input id="forgot-email" class="w-full border rounded px-3 py-2 mb-3" placeholder="Nhập email để nhận link đặt lại" required>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Gửi link đặt lại</button>
          </form>
        </div>
      </section>

      <!-- Toast -->
      <div id="toast" class="fixed right-6 bottom-6 bg-black text-white px-4 py-2 rounded opacity-0 pointer-events-none transition-opacity">...</div>
    </main>
  </div>

  <!-- ====== Scripts: demo data + behaviors ====== -->
  <script>
    /* ---------- Demo data ---------- */
    const PRODUCTS = [
      { id: 'P001', title: 'iPhone 14 Pro', brand: 'Apple', category: 'phone', price: 29990000, img: 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=800&auto=format&fit=crop' , featured:true,
        desc: 'Điện thoại Apple iPhone 14 Pro - Camera mạnh, chip nhanh', reviews: [{r:5, text:'Tuyệt vời!'}]
      },
      { id: 'P002', title: 'Samsung Galaxy S23', brand: 'Samsung', category: 'phone', price: 20990000, img: 'https://images.unsplash.com/photo-1541807084-5c52b6baf9c8?q=80&w=800&auto=format&fit=crop', featured:true, desc:'Samsung flagship', reviews:[] },
      { id: 'P003', title: 'Dell XPS 13 Plus', brand: 'Dell', category: 'laptop', price: 42990000, img:'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=800&auto=format&fit=crop', featured:true, desc:'Laptop cao cấp nhẹ', reviews:[] },
      { id: 'P004', title: 'Mouse Logitech MX', brand:'Logitech', category:'accessory', price: 1450000, img:'https://images.unsplash.com/photo-1585386959984-a4155220b0f9?q=80&w=800&auto=format&fit=crop', featured:false, desc:'Chuột văn phòng' }
    ];

    const PROMOS = [
      { id:'PR1', title:'Giảm 10% cho đơn hàng trên 5 triệu', until:'31/12/2025' },
      { id:'PR2', title:'Tặng tai nghe khi mua laptop', until:'30/11/2025' }
    ];

    // simple in-memory cart & orders (frontend demo)
    let CART = [];
    let ORDERS = [];

    /* ---------- Utilities ---------- */
    const formatVND = (n) => {
      return new Intl.NumberFormat('vi-VN').format(n) + ' VNĐ';
    };

    function toast(msg, time=2000){
      const t = document.getElementById('toast');
      t.textContent = msg;
      t.classList.remove('opacity-0');
      t.classList.add('opacity-100');
      setTimeout(()=>{ t.classList.add('opacity-0'); }, time);
    }

    /* ---------- Render functions ---------- */
    function renderFeatured(){
      const el = document.getElementById('featured-products');
      if(!el) return;
      el.innerHTML = '';
      PRODUCTS.filter(p=>p.featured).forEach(p=>{
        const card = document.createElement('div');
        card.className = 'bg-white rounded-lg p-3 shadow card-hover';
        card.innerHTML = `
          <img src="${p.img}" alt="${p.title}" class="h-28 w-full object-cover rounded mb-2">
          <div class="text-sm font-medium">${p.title}</div>
          <div class="text-sm text-red-600 font-semibold">${formatVND(p.price)}</div>
          <div class="mt-2"><button class="text-xs px-2 py-1 border rounded" onclick="openProductDetail('${p.id}')">Xem</button></div>
        `;
        el.appendChild(card);
      });
    }

    function renderPromos(){
      const el = document.getElementById('promo-list');
      if(!el) return;
      el.innerHTML = '';
      PROMOS.forEach(p=>{
        const li = document.createElement('li');
        li.className = 'p-3 border rounded';
        li.innerHTML = `<div class="text-sm font-medium">${p.title}</div><div class="text-xs text-gray-500">Hết hạn: ${p.until}</div>`;
        el.appendChild(li);
      });
      const pl = document.getElementById('promotions-list');
      if(pl){
        pl.innerHTML = PROMOS.map(p=>`<div class="p-4 border rounded"><h4 class="font-semibold">${p.title}</h4><p class="text-xs text-gray-600">Hạn: ${p.until}</p></div>`).join('');
      }
    }

    function renderStoreProducts(){
      const q = (document.getElementById('store-search')?.value || '').toLowerCase();
      const cat = document.getElementById('filter-category')?.value || 'all';
      const brand = document.getElementById('filter-brand')?.value || 'all';
      const price = document.getElementById('filter-price')?.value || 'all';
      const grid = document.getElementById('product-grid');
      if(!grid) return;
      let items = PRODUCTS.filter(p=> true);
      if(q) items = items.filter(p=> p.title.toLowerCase().includes(q) || p.brand.toLowerCase().includes(q));
      if(cat!=='all') items = items.filter(p=> p.category===cat);
      if(brand!=='all') items = items.filter(p=> p.brand===brand);
      if(price !== 'all'){
        const [low,high] = price.split('-').map(Number);
        items = items.filter(p=> p.price >= low && p.price <= high);
      }
      grid.innerHTML = items.map(p=>`
        <div class="bg-white rounded-lg shadow p-3">
          <img src="${p.img}" alt="${p.title}" class="h-40 w-full object-cover rounded mb-3">
          <div class="text-sm font-medium">${p.title}</div>
          <div class="text-xs text-gray-500">${p.brand}</div>
          <div class="text-red-600 font-semibold mt-2">${formatVND(p.price)}</div>
          <div class="mt-3 flex space-x-2">
            <button class="px-3 py-1 border rounded" onclick="openProductDetail('${p.id}')">Xem chi tiết</button>
            <button class="px-3 py-1 bg-blue-600 text-white rounded" onclick="addToCart('${p.id}')">Thêm vào giỏ</button>
          </div>
        </div>
      `).join('');
    }

    function populateFilters(){
      const cats = new Set(PRODUCTS.map(p=>p.category));
      const brands = new Set(PRODUCTS.map(p=>p.brand));
      const catSel = document.getElementById('filter-category');
      const brandSel = document.getElementById('filter-brand');
      if(catSel){ cats.forEach(c=> catSel.insertAdjacentHTML('beforeend', `<option value="${c}">${c}</option>`)); }
      if(brandSel){ brands.forEach(b=> brandSel.insertAdjacentHTML('beforeend', `<option value="${b}">${b}</option>`)); }
    }

    /* ---------- Product detail ---------- */
    function openProductDetail(id){
      const p = PRODUCTS.find(x=>x.id===id);
      if(!p) return;
      document.getElementById('detail-image').src = p.img;
      document.getElementById('detail-title').textContent = p.title;
      document.getElementById('detail-brand').textContent = p.brand + ' • ' + p.category;
      document.getElementById('detail-price').textContent = formatVND(p.price);
      document.getElementById('detail-desc').textContent = p.desc;
      const rev = document.getElementById('detail-reviews');
      rev.innerHTML = (p.reviews || []).map(r=>`<div class="border rounded p-2 text-sm">${'★'.repeat(r.r)} <div>${r.text}</div></div>`).join('') || '<div class="text-sm text-gray-500">Chưa có đánh giá</div>';
      document.getElementById('review-product-id').value = id;
      showSection('product_detail');
    }

    /* ---------- Cart ---------- */
    function addToCart(id){
      const p = PRODUCTS.find(x=>x.id===id);
      if(!p) return toast('Sản phẩm không tồn tại');
      const found = CART.find(i=>i.id===id);
      if(found) found.qty += 1;
      else CART.push({ id: p.id, title: p.title, price: p.price, qty: 1, img: p.img });
      toast('Đã thêm vào giỏ hàng');
      renderCart();
    }
    function addToCartFromDetail(){
      const id = document.getElementById('review-product-id').value || null;
      const qty = Number(document.getElementById('qty').value || 1);
      const p = PRODUCTS.find(x=>x.id===id);
      if(!p) return toast('Lỗi sản phẩm');
      const found = CART.find(i=>i.id===id);
      if(found) found.qty += qty; else CART.push({ id:p.id, title:p.title, price:p.price, qty:qty, img:p.img });
      toast('Đã thêm vào giỏ');
      showSection('cart'); renderCart();
    }
    function renderCart(){
      const el = document.getElementById('cart-list');
      if(!el) return;
      if(CART.length===0) el.innerHTML = '<div class="text-gray-500">Giỏ hàng trống</div>';
      else el.innerHTML = CART.map(it=>`
        <div class="flex items-center justify-between border rounded p-3">
          <div class="flex items-center space-x-3">
            <img src="${it.img}" class="w-16 h-16 object-cover rounded">
            <div>
              <div class="font-medium">${it.title}</div>
              <div class="text-sm text-gray-500">${formatVND(it.price)}</div>
            </div>
          </div>
          <div class="flex items-center space-x-3">
            <input type="number" min="1" value="${it.qty}" onchange="updateCartQty('${it.id}',this.value)" class="w-20 border rounded px-2 py-1">
            <div class="font-semibold">${formatVND(it.price * it.qty)}</div>
            <button class="text-red-600" onclick="removeFromCart('${it.id}')">Xóa</button>
          </div>
        </div>
      `).join('');
      const subtotal = CART.reduce((s,i)=> s + i.price * i.qty, 0);
      document.getElementById('cart-subtotal').textContent = formatVND(subtotal);
    }
    function updateCartQty(id, qty){
      const item = CART.find(i=>i.id===id);
      if(item) item.qty = Math.max(1, Number(qty));
      renderCart();
    }
    function removeFromCart(id){
      CART = CART.filter(i=>i.id!==id);
      renderCart();
    }

    /* ---------- Checkout ---------- */
    function handleCheckout(e){
      e.preventDefault();
      const name = document.getElementById('chk-name').value;
      const phone = document.getElementById('chk-phone').value;
      const address = document.getElementById('chk-address').value;
      const payment = document.getElementById('chk-payment').value;
      if(CART.length===0){ toast('Giỏ hàng rỗng'); return; }
      const orderId = 'ORD-' + Date.now();
      const order = { id: orderId, items: JSON.parse(JSON.stringify(CART)), name, phone, address, payment, status: 'Đang xử lý', tracking: 'TRK' + Math.floor(Math.random()*1000000) };
      ORDERS.push(order);
      CART = [];
      renderCart(); renderOrders();
      toast('Đặt hàng thành công: ' + orderId);
      showSection('orders');
    }

    /* ---------- Orders ---------- */
    function renderOrders(){
      const el = document.getElementById('orders-list');
      if(!el) return;
      if(ORDERS.length===0) el.innerHTML = '<div class="text-gray-500">Bạn chưa có đơn hàng</div>';
      else el.innerHTML = ORDERS.map(o=>`
        <div class="p-3 border rounded flex justify-between items-center">
          <div>
            <div class="font-medium">${o.id}</div>
            <div class="text-sm text-gray-500">${o.items.length} sản phẩm • ${o.name}</div>
          </div>
          <div class="flex items-center space-x-3">
            <div class="text-sm text-gray-700">${o.status}</div>
            <button class="px-3 py-1 border rounded" onclick="openOrderDetail('${o.id}')">Chi tiết</button>
          </div>
        </div>
      `).join('');
    }
    function openOrderDetail(id){
      const o = ORDERS.find(x=>x.id===id); if(!o) return;
      document.getElementById('order-id').textContent = o.id;
      document.getElementById('order-status').textContent = 'Trạng thái: ' + o.status;
      document.getElementById('tracking-code').textContent = o.tracking;
      const items = document.getElementById('order-items');
      items.innerHTML = o.items.map(i=>`<div class="flex justify-between"><div>${i.title} x ${i.qty}</div><div>${formatVND(i.price*i.qty)}</div></div>`).join('');
      showSection('order_detail');
    }

    /* ---------- Profile ---------- */
    function updateProfile(e){
      e.preventDefault();
      toast('Cập nhật thông tin thành công');
    }
    function changePassword(e){
      e.preventDefault();
      const a = document.getElementById('new-pass').value;
      const b = document.getElementById('confirm-pass').value;
      if(a!==b){ toast('Mật khẩu xác nhận không khớp'); return; }
      toast('Đổi mật khẩu thành công');
      showSection('profile');
    }

    /* ---------- Reviews ---------- */
    function submitReview(e){
      e.preventDefault();
      const pid = document.getElementById('review-product-id').value;
      const rating = Number(document.getElementById('review-rating').value);
      const text = document.getElementById('review-text').value;
      const p = PRODUCTS.find(x=>x.id===pid);
      if(!p) { toast('Sản phẩm không tồn tại'); return; }
      p.reviews = p.reviews || [];
      p.reviews.unshift({ r: rating, text });
      toast('Cảm ơn đánh giá của bạn!');
      showSection('product_detail');
      openProductDetail(pid);
    }
    function renderReviewsList(){
      const el = document.getElementById('reviews-list');
      if(!el) return;
      const all = PRODUCTS.flatMap(p=> (p.reviews || []).map(r=> ({ product:p.title, r: r.r, text:r.text })) );
      if(all.length===0) el.innerHTML = '<div class="text-gray-500">Chưa có đánh giá nào</div>';
      else el.innerHTML = all.map(a=>`<div class="p-2 border rounded"><div class="font-medium">${a.product}</div><div class="text-sm">${'★'.repeat(a.r)}</div><div class="text-sm text-gray-700">${a.text}</div></div>`).join('');
    }

    /* ---------- Support ---------- */
    function sendLiveMessage(){
      const txt = document.getElementById('live-msg').value;
      if(!txt) return;
      const win = document.getElementById('live-chat-window');
      const el = document.createElement('div');
      el.className = 'mb-2 text-sm';
      el.innerHTML = `<div class="bg-blue-600 text-white inline-block p-2 rounded">${txt}</div>`;
      win.appendChild(el); win.scrollTop = win.scrollHeight;
      document.getElementById('live-msg').value = '';
      setTimeout(()=> {
        const rep = document.createElement('div');
        rep.className = 'mb-2 text-sm';
        rep.innerHTML = `<div class="bg-gray-200 inline-block p-2 rounded">Cảm ơn bạn! Hỗ trợ sẽ liên hệ sớm.</div>`;
        win.appendChild(rep); win.scrollTop = win.scrollHeight;
      }, 900);
    }
    function submitTicket(e){ e.preventDefault(); toast('Yêu cầu hỗ trợ đã gửi'); }

    /* ---------- Auth (frontend mock) ---------- */
    function login(e){ e.preventDefault(); toast('Đăng nhập thành công (mô phỏng)'); showSection('store_home'); }
    function register(e){ e.preventDefault(); toast('Đăng ký thành công (mô phỏng)'); showSection('store_home'); }
    function forgotPassword(e){ e.preventDefault(); toast('Link đặt lại mật khẩu đã gửi đến email (mô phỏng)'); showSection('auth'); }

    /* ---------- Live: section show/hide ---------- */
    window.currentSection = 'dashboard';
    function hideAllSections(){
      document.querySelectorAll('.section').forEach(el=> el.classList.add('hidden'));
      // also hide potential modal-like areas
    }
    function showSection(id){
      hideAllSections();
      const sec = document.getElementById(id);
      if(sec) sec.classList.remove('hidden');
      window.currentSection = id;
      // render relevant views
      if(id === 'store_home') { renderFeatured(); renderPromos(); renderStoreProducts(); }
      if(id === 'store_products') { renderStoreProducts(); }
      if(id === 'product_detail') { /* already set by openProductDetail */ }
      if(id === 'cart') { renderCart(); }
      if(id === 'checkout') { renderCart(); }
      if(id === 'orders') { renderOrders(); }
      if(id === 'promotions') { renderPromos(); }
      if(id === 'view_reviews') { renderReviewsList(); }
    }

    /* ---------- Init ---------- */
    document.addEventListener('DOMContentLoaded', ()=>{
      populateFilters();
      renderFeatured();
      renderPromos();
      renderStoreProducts();
      renderCart();
      renderOrders();
      // default view - admin dashboard
      showSection('dashboard');
    });
  </script>

</body>
</html>
