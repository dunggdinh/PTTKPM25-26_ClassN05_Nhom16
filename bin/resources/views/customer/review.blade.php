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