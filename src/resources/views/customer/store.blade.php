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