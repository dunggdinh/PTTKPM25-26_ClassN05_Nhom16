<!-- Hỗ trợ -->
            <div id="support" class="section hidden">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Hỗ trợ khách hàng</h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Live Chat -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">💬 Live Chat</h3>
                        <div id="chatMessages" class="h-64 bg-gray-50 rounded-lg p-4 mb-4 overflow-y-auto">
                            <div class="mb-3">
                                <div class="bg-blue-100 text-blue-800 p-3 rounded-lg inline-block">
                                    Xin chào! Tôi có thể giúp gì cho bạn?
                                </div>
                                <div class="text-xs text-gray-500 mt-1">Hỗ trợ viên - 10:30</div>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <input type="text" id="chatInput" placeholder="Nhập tin nhắn..." class="flex-1 px-3 py-2 border border-gray-300 rounded-lg form-input">
                            <button onclick="sendMessage()" class="btn-primary text-white px-4 py-2 rounded-lg">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Gửi yêu cầu hỗ trợ -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">📧 Gửi yêu cầu hỗ trợ</h3>
                        <form onsubmit="submitSupportRequest(event)" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Loại vấn đề</label>
                                <select id="issueType" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                                    <option value="">Chọn loại vấn đề</option>
                                    <option value="order">Vấn đề đơn hàng</option>
                                    <option value="payment">Vấn đề thanh toán</option>
                                    <option value="product">Vấn đề sản phẩm</option>
                                    <option value="account">Vấn đề tài khoản</option>
                                    <option value="other">Khác</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tiêu đề</label>
                                <input type="text" id="issueTitle" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Mô tả chi tiết</label>
                                <textarea id="issueDescription" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input"></textarea>
                            </div>
                            <div class="flex space-x-3">
                                <button type="submit" class="btn-primary text-white px-6 py-2 rounded-lg flex-1">
                                    <i class="fas fa-paper-plane mr-2"></i>Xác nhận gửi yêu cầu
                                </button>
                                <button type="button" onclick="clearSupportForm()" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                    <i class="fas fa-eraser mr-2"></i>Xóa form
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- FAQ -->
                <div class="mt-6 bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">❓ Câu hỏi thường gặp</h3>
                    <div class="space-y-4">
                        <div class="border-b pb-4">
                            <button onclick="toggleFAQ(1)" class="flex justify-between items-center w-full text-left">
                                <span class="font-medium">Làm thế nào để theo dõi đơn hàng?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div id="faq1" class="hidden mt-2 text-gray-600">
                                Bạn có thể theo dõi đơn hàng trong mục "Đơn hàng của tôi" hoặc sử dụng mã đơn hàng để tra cứu.
                            </div>
                        </div>
                        <div class="border-b pb-4">
                            <button onclick="toggleFAQ(2)" class="flex justify-between items-center w-full text-left">
                                <span class="font-medium">Chính sách đổi trả như thế nào?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div id="faq2" class="hidden mt-2 text-gray-600">
                                Chúng tôi hỗ trợ đổi trả trong vòng 7 ngày với điều kiện sản phẩm còn nguyên vẹn.
                            </div>
                        </div>
                        <div class="border-b pb-4">
                            <button onclick="toggleFAQ(3)" class="flex justify-between items-center w-full text-left">
                                <span class="font-medium">Các phương thức thanh toán được hỗ trợ?</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div id="faq3" class="hidden mt-2 text-gray-600">
                                Chúng tôi hỗ trợ thanh toán qua thẻ tín dụng, chuyển khoản ngân hàng và COD.
                            </div>
                        </div>
                    </div>
                </div>
            </div>