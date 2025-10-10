<!-- Giỏ hàng -->
            <div id="cart" class="section hidden">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Giỏ hàng</h2>
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div id="cartItems" class="space-y-4 mb-6">
                        <!-- Items sẽ được load động -->
                    </div>
                    
                    <div class="border-t pt-4">
                        <div class="flex justify-between items-center text-xl font-bold text-gray-800 mb-4">
                            <span>Tổng cộng:</span>
                            <span id="cartTotal">0₫</span>
                        </div>
                        <button onclick="proceedToCheckout()" class="w-full btn-primary text-white py-3 rounded-lg text-lg font-semibold">
                            Tiến hành thanh toán
                        </button>
                    </div>
                </div>
            </div>