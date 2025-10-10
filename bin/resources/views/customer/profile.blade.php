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