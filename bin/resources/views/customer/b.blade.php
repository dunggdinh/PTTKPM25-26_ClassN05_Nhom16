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
