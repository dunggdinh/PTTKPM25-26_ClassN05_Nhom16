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