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