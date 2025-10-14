<!-- Đơn hàng -->
            <div id="orders" class="section hidden">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Đơn hàng của tôi</h2>
                
                <div class="space-y-4">
                    <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-semibold text-lg">#DH001</h3>
                                <p class="text-gray-600">Ngày đặt: 15/12/2024</p>
                            </div>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                Đã giao
                            </span>
                        </div>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span>Laptop Gaming x1</span>
                                <span>25.990.000₫</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Phí vận chuyển</span>
                                <span>0₫</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center border-t pt-4">
                            <span class="font-bold text-lg">Tổng: 25.990.000₫</span>
                            <div class="space-x-2">
                                <button onclick="viewOrderDetail('DH001')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                    Chi tiết
                                </button>
                                <button onclick="trackOrder('DH001')" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                                    Theo dõi
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-semibold text-lg">#DH002</h3>
                                <p class="text-gray-600">Ngày đặt: 18/12/2024</p>
                            </div>
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                Đang giao
                            </span>
                        </div>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span>Smartphone Pro x1</span>
                                <span>15.990.000₫</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Tai nghe Bluetooth x1</span>
                                <span>2.990.000₫</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center border-t pt-4">
                            <span class="font-bold text-lg">Tổng: 18.980.000₫</span>
                            <div class="space-x-2">
                                <button onclick="viewOrderDetail('DH002')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                    Chi tiết
                                </button>
                                <button onclick="trackOrder('DH002')" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                                    Theo dõi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>