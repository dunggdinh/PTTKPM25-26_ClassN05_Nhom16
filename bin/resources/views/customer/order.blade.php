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