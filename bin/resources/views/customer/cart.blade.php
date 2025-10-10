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