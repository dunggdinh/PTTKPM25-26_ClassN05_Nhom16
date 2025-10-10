<!-- Tài khoản -->
            <div id="account" class="section hidden">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Tài khoản của tôi</h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Thông tin cá nhân -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Thông tin cá nhân</h3>
                        <form onsubmit="updateProfile(event)" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Họ và tên</label>
                                <input type="text" id="fullName" value="Nguyễn Văn A" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" value="nguyenvana@email.com" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại</label>
                                <input type="tel" id="phone" value="0123456789" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Địa chỉ</label>
                                <textarea id="address" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">123 Đường ABC, Quận 1, TP.HCM</textarea>
                            </div>
                            <div class="flex space-x-3">
                                <button type="submit" class="btn-primary text-white px-6 py-2 rounded-lg flex-1">
                                    <i class="fas fa-check mr-2"></i>Xác nhận cập nhật
                                </button>
                                <button type="button" onclick="cancelProfileUpdate()" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                    <i class="fas fa-times mr-2"></i>Hủy
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Đổi mật khẩu -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Đổi mật khẩu</h3>
                        <form onsubmit="changePassword(event)" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu hiện tại</label>
                                <input type="password" id="currentPassword" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu mới</label>
                                <input type="password" id="newPassword" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Xác nhận mật khẩu mới</label>
                                <input type="password" id="confirmPassword" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                            <div class="flex space-x-3">
                                <button type="submit" class="btn-primary text-white px-6 py-2 rounded-lg flex-1">
                                    <i class="fas fa-key mr-2"></i>Xác nhận đổi mật khẩu
                                </button>
                                <button type="button" onclick="cancelPasswordChange()" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                    <i class="fas fa-times mr-2"></i>Hủy
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
