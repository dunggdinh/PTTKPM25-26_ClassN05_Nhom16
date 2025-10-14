<!-- Sản phẩm -->
            <div id="products" class="section hidden">
                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Sản phẩm</h2>
                    
                    <!-- Thanh tìm kiếm -->
                    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <input type="text" id="searchInput" placeholder="Tìm kiếm sản phẩm..." class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input">
                            </div>
                            <button onclick="searchProducts()" class="btn-primary text-white px-6 py-3 rounded-lg">
                                <i class="fas fa-search mr-2"></i>Tìm kiếm
                            </button>
                        </div>
                    </div>

                    <!-- Bộ lọc -->
                    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Bộ lọc</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Danh mục</label>
                                <select id="categoryFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                                    <option value="">Tất cả</option>
                                    <option value="laptop">Laptop</option>
                                    <option value="phone">Điện thoại</option>
                                    <option value="tablet">Tablet</option>
                                    <option value="accessories">Phụ kiện</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Thương hiệu</label>
                                <select id="brandFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                                    <option value="">Tất cả</option>
                                    <option value="apple">Apple</option>
                                    <option value="samsung">Samsung</option>
                                    <option value="dell">Dell</option>
                                    <option value="hp">HP</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Giá từ</label>
                                <input type="number" id="minPrice" placeholder="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Giá đến</label>
                                <input type="number" id="maxPrice" placeholder="100000000" class="w-full px-3 py-2 border border-gray-300 rounded-lg form-input">
                            </div>
                        </div>
                        <button onclick="applyFilters()" class="mt-4 btn-primary text-white px-6 py-2 rounded-lg">
                            Áp dụng bộ lọc
                        </button>
                    </div>

                    <!-- Danh sách sản phẩm -->
                    <div id="productList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <!-- Sản phẩm sẽ được load động -->
                    </div>
                </div>
            </div>