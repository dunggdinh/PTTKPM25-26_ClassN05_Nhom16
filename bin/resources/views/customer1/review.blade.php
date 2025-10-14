<!-- Modal chi tiết sản phẩm -->
    <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 modal-overlay hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-8 w-full max-w-4xl mx-4 max-h-[90vh] overflow-y-auto modal-content">
            <div class="flex justify-between items-center mb-6">
                <h3 id="productTitle" class="text-2xl font-bold text-gray-800"></h3>
                <button onclick="closeProductModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div>
                    <div id="productImage" class="w-full h-64 bg-gray-200 rounded-lg mb-4 flex items-center justify-center">
                        <i class="fas fa-image text-4xl text-gray-400"></i>
                    </div>
                    <div class="grid grid-cols-4 gap-2">
                        <div class="w-full h-16 bg-gray-200 rounded flex items-center justify-center">
                            <i class="fas fa-image text-gray-400"></i>
                        </div>
                        <div class="w-full h-16 bg-gray-200 rounded flex items-center justify-center">
                            <i class="fas fa-image text-gray-400"></i>
                        </div>
                        <div class="w-full h-16 bg-gray-200 rounded flex items-center justify-center">
                            <i class="fas fa-image text-gray-400"></i>
                        </div>
                        <div class="w-full h-16 bg-gray-200 rounded flex items-center justify-center">
                            <i class="fas fa-image text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div id="productPrice" class="text-3xl font-bold text-purple-600 mb-4"></div>
                    <div id="productDescription" class="text-gray-600 mb-6"></div>
                    
                    <div class="mb-6">
                        <h4 class="font-semibold mb-2">Đánh giá:</h4>
                        <div class="flex items-center space-x-2">
                            <div class="star-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-gray-600">(4.5/5 - 128 đánh giá)</span>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Số lượng:</label>
                        <div class="flex items-center space-x-3">
                            <button onclick="decreaseQuantity()" class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center hover:bg-gray-300">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" id="productQuantity" value="1" min="1" class="w-20 text-center border border-gray-300 rounded-lg py-2">
                            <button onclick="increaseQuantity()" class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center hover:bg-gray-300">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <button onclick="addToCartFromModal()" class="w-full btn-primary text-white py-3 rounded-lg font-semibold">
                            <i class="fas fa-cart-plus mr-2"></i>Thêm vào giỏ hàng
                        </button>
                        <button onclick="buyNow()" class="w-full bg-orange-600 hover:bg-orange-700 text-white py-3 rounded-lg font-semibold transition-colors">
                            <i class="fas fa-bolt mr-2"></i>Mua ngay
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Đánh giá sản phẩm -->
            <div class="mt-8 border-t pt-8">
                <h4 class="text-xl font-semibold mb-4">Đánh giá sản phẩm</h4>
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-2">
                                <span class="font-medium">Nguyễn Văn B</span>
                                <div class="star-rating text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <span class="text-sm text-gray-500">2 ngày trước</span>
                        </div>
                        <p class="text-gray-600">Sản phẩm rất tốt, chất lượng như mô tả. Giao hàng nhanh!</p>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-2">
                                <span class="font-medium">Trần Thị C</span>
                                <div class="star-rating text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <span class="text-sm text-gray-500">1 tuần trước</span>
                        </div>
                        <p class="text-gray-600">Sản phẩm ổn, đóng gói cẩn thận. Sẽ mua lại!</p>
                    </div>
                </div>
                
                <button onclick="showReviewForm()" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                    Viết đánh giá
                </button>
            </div>