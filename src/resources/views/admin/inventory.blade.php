@extends('admin.layout')
@section('title', 'Quản lý kho')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Page Title -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Quản Lý Kho</h1>
                <p class="text-gray-600 mt-2">Quản lý và theo dõi tình trạng tồn kho của tất cả sản phẩm.</p>
            </div>
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Tổng sản phẩm</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $totalProducts }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center">
                        <div class="bg-yellow-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Sắp hết hàng</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $lowStock }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center">
                        <div class="bg-red-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Hết hàng</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $outOfStock }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Còn hàng</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $inStock }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alerts Section -->
            <div class="bg-white rounded-xl shadow-md mb-8">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center">
                        <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        Cảnh báo tồn kho
                    </h2>
                </div>
                <div class="p-6">
                    <div id="alertsList" class="space-y-2">
                        @foreach($products as $product)
                            @if($product->quantity == 0)
                                <div class="p-3 rounded-md bg-red-100 text-red-800 font-semibold">
                                    {{ $product->name }} – Hết hàng
                                </div>
                            @elseif($product->quantity < 10)
                                <div class="p-3 rounded-md bg-yellow-100 text-yellow-800 font-semibold">
                                    {{ $product->name }} – Sắp hết hàng ({{ $product->quantity }} sp)
                                </div>
                            @endif
                        @endforeach
                        @if($products->where('quantity', '<', 10)->count() == 0)
                            <div class="text-gray-500">Không có sản phẩm sắp hết hoặc hết hàng</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Inventory Table -->
            <div class="bg-white rounded-xl shadow-md">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Danh sách tồn kho</h2>
                    <!-- Filters and Search -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                            <div class="relative">
                                <input type="text" id="searchInput" placeholder="Tìm kiếm sản phẩm..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent w-full md:w-64">
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            
                            <select id="categoryFilter" name="category" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                <option value="">Tất cả danh mục</option>
                                <option value="smartphone" {{ request('category') == 'smartphone' ? 'selected' : '' }}>Điện thoại</option>
                                <option value="laptop" {{ request('category') == 'laptop' ? 'selected' : '' }}>Laptop</option>
                            </select>

                            
                            <select id="statusFilter" name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                <option value="">Tất cả trạng thái</option>
                                <option value="in-stock" {{ request('status') == 'in-stock' ? 'selected' : '' }}>Còn hàng</option>
                                <option value="low-stock" {{ request('status') == 'low-stock' ? 'selected' : '' }}>Sắp hết</option>
                                <option value="out-of-stock" {{ request('status') == 'out-of-stock' ? 'selected' : '' }}>Hết hàng</option>
                            </select>

                        </div>
                        
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.inventory.export') }}" class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span>Xuất Excel</span>
                            </a>

                            <a href="{{ route('admin.inventory.reload') }}" 
                                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                <span>Làm mới</span>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" id="selectAll" class="text-green-600 focus:ring-green-500" onchange="toggleSelectAll()">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã sản phẩm</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hãng</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Danh mục</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số lượng</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giá</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bảo hành</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                            </tr>
                        </thead>

                        <tbody id="inventoryTable" class="bg-white divide-y divide-gray-200">
                            @forelse ($products as $product)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" name="selected[]" value="{{ $product->product_id }}" class="rowCheckbox text-green-600 focus:ring-green-500">
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $product->product_id }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $product->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $product->brand }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $product->category->name ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $product->quantity }}</td>

                                    {{-- Hiển thị trạng thái có màu --}}
                                    <td class="px-6 py-4 text-sm">
                                        @if($product->quantity == 0)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">Hết hàng</span>
                                        @elseif($product->quantity < 10)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">Sắp hết</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Còn hàng</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-900">{{ number_format($product->price, 0, ',', '.') }}₫</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $product->warranty }} tháng</td>

                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.inventory.update', $product->product_id) }}" 
                                            class="text-blue-600 hover:text-blue-800 font-medium">Sửa</a>
                                            <form action="{{ route('admin.inventory.destroy', $product->product_id) }}" method="POST" onsubmit="return confirm('Xóa sản phẩm này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Xóa</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="px-6 py-4 text-center text-gray-500 text-sm">
                                        Không có sản phẩm nào.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Product Details Modal -->
    <div id="detailsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg w-full max-w-2xl mx-4 max-h-5/6 overflow-y-auto">
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-900">Chi tiết sản phẩm</h3>
                <button onclick="closeDetailsModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <div id="productDetails" class="space-y-6">
                    <!-- Product details will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
            <div class="flex items-center mb-4">
                <div class="bg-red-100 p-3 rounded-full mr-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Xác nhận xóa</h3>
                    <p class="text-sm text-gray-600">Hành động này không thể hoàn tác</p>
                </div>
            </div>
            <div class="mb-6">
                <p class="text-gray-700">Bạn có chắc chắn muốn xóa sản phẩm:</p>
                <p id="deleteProductName" class="font-semibold text-gray-900 mt-2"></p>
            </div>
            <div class="flex space-x-3">
                <button onclick="deleteProduct()" class="flex-1 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
                    Xóa sản phẩm
                </button>
                <button onclick="closeDeleteModal()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded-lg transition-colors font-medium">
                    Hủy
                </button>
            </div>
        </div>
    </div>

    <!-- Update Stock Modal -->
    <div id="updateModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900">Cập nhật tồn kho</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sản phẩm</label>
                    <p id="modalProductName" class="text-gray-900 font-medium"></p>
                </div>
                <div>
                    <label for="newStock" class="block text-sm font-medium text-gray-700 mb-2">Số lượng mới</label>
                    <input type="number" id="newStock" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent" min="0">
                </div>
                <div>
                    <label for="minStock" class="block text-sm font-medium text-gray-700 mb-2">Tồn kho tối thiểu</label>
                    <input type="number" id="minStock" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent" min="0">
                </div>
                <div class="flex space-x-3 pt-4">
                    <button onclick="updateStock()" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg transition-colors">
                        Cập nhật
                    </button>
                    <button onclick="closeModal()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded-lg transition-colors">
                        Hủy
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- <script>
        // Sample data
        let selectedProducts = new Set();

        let inventoryData = [
            { 
                id: 1, 
                name: \'iPhone 15 Pro Max\', 
                category: \'smartphone\', 
                stock: 0, 
                minStock: 5, 
                price: \'29,990,000\', 
                status: \'out-of-stock\',
                sku: \'IP15PM-256-TI\',
                brand: \'Apple\',
                model: \'256GB Titanium\',
                supplier: \'Apple Vietnam\',
                location: \'Kho A - Kệ 1\',
                lastUpdated: \'2024-01-15\',
                description: \'iPhone 15 Pro Max với chip A17 Pro, camera 48MP, màn hình Super Retina XDR 6.7 inch\'
            },
            { 
                id: 2, 
                name: \'Samsung Galaxy S24 Ultra\', 
                category: \'smartphone\', 
                stock: 3, 
                minStock: 10, 
                price: \'26,990,000\', 
                status: \'low-stock\',
                sku: \'SGS24U-512-BK\',
                brand: \'Samsung\',
                model: \'512GB Black\',
                supplier: \'Samsung Vietnam\',
                location: \'Kho A - Kệ 2\',
                lastUpdated: \'2024-01-14\',
                description: \'Galaxy S24 Ultra với S Pen, camera 200MP, màn hình Dynamic AMOLED 6.8 inch\'
            },
            { 
                id: 3, 
                name: \'MacBook Pro M3\', 
                category: \'laptop\', 
                stock: 15, 
                minStock: 5, 
                price: \'52,990,000\', 
                status: \'in-stock\',
                sku: \'MBP-M3-16-SG\',
                brand: \'Apple\',
                model: \'16 inch Space Gray\',
                supplier: \'Apple Vietnam\',
                location: \'Kho B - Kệ 1\',
                lastUpdated: \'2024-01-13\',
                description: \'MacBook Pro 16 inch với chip M3, 16GB RAM, 512GB SSD, màn hình Liquid Retina XDR\'
            },
            { 
                id: 4, 
                name: \'iPad Air M2\', 
                category: \'tablet\', 
                stock: 2, 
                minStock: 8, 
                price: \'16,990,000\', 
                status: \'low-stock\',
                sku: \'IPA-M2-11-BL\',
                brand: \'Apple\',
                model: \'11 inch Blue\',
                supplier: \'Apple Vietnam\',
                location: \'Kho A - Kệ 3\',
                lastUpdated: \'2024-01-12\',
                description: \'iPad Air với chip M2, màn hình Liquid Retina 11 inch, hỗ trợ Apple Pencil\'
            },
            { 
                id: 5, 
                name: \'AirPods Pro 2\', 
                category: \'accessory\', 
                stock: 25, 
                minStock: 15, 
                price: \'6,490,000\', 
                status: \'in-stock\',
                sku: \'APP2-USBC-WH\',
                brand: \'Apple\',
                model: \'USB-C White\',
                supplier: \'Apple Vietnam\',
                location: \'Kho C - Kệ 1\',
                lastUpdated: \'2024-01-11\',
                description: \'AirPods Pro thế hệ 2 với chip H2, chống ồn chủ động, cổng USB-C\'
            },
            { 
                id: 6, 
                name: \'Dell XPS 13\', 
                category: \'laptop\', 
                stock: 0, 
                minStock: 3, 
                price: \'28,990,000\', 
                status: \'out-of-stock\',
                sku: \'DXS13-I7-16-SL\',
                brand: \'Dell\',
                model: \'i7 16GB Silver\',
                supplier: \'Dell Vietnam\',
                location: \'Kho B - Kệ 2\',
                lastUpdated: \'2024-01-10\',
                description: \'Dell XPS 13 với Intel Core i7, 16GB RAM, 512GB SSD, màn hình InfinityEdge\'
            },
            { 
                id: 7, 
                name: \'Xiaomi 14 Ultra\', 
                category: \'smartphone\', 
                stock: 8, 
                minStock: 12, 
                price: \'24,990,000\', 
                status: \'low-stock\',
                sku: \'XM14U-512-BK\',
                brand: \'Xiaomi\',
                model: \'512GB Black\',
                supplier: \'Xiaomi Vietnam\',
                location: \'Kho A - Kệ 4\',
                lastUpdated: \'2024-01-09\',
                description: \'Xiaomi 14 Ultra với camera Leica, Snapdragon 8 Gen 3, màn hình AMOLED 6.73 inch\'
            },
            { 
                id: 8, 
                name: \'Surface Pro 9\', 
                category: \'tablet\', 
                stock: 12, 
                minStock: 6, 
                price: \'22,990,000\', 
                status: \'in-stock\',
                sku: \'SP9-I5-8-GR\',
                brand: \'Microsoft\',
                model: \'i5 8GB Graphite\',
                supplier: \'Microsoft Vietnam\',
                location: \'Kho B - Kệ 3\',
                lastUpdated: \'2024-01-08\',
                description: \'Surface Pro 9 với Intel Core i5, 8GB RAM, 256GB SSD, màn hình PixelSense Flow\'
            }
        ];

        let currentEditId = null;
        let currentDeleteId = null;

        function toggleSelectAll() {
            const selectAllCheckbox = document.getElementById(\'selectAll\');
            const productCheckboxes = document.querySelectorAll(\'.product-checkbox\');
            
            // Only affect currently visible products
            productCheckboxes.forEach(checkbox => {
                const productId = parseInt(checkbox.dataset.id);
                if (selectAllCheckbox.checked) {
                    selectedProducts.add(productId);
                    checkbox.checked = true;
                } else {
                    selectedProducts.delete(productId);
                    checkbox.checked = false;
                }
            });
            
            updateSelectedCount();
        }

        function toggleProductSelection(productId) {
            if (selectedProducts.has(productId)) {
                selectedProducts.delete(productId);
            } else {
                selectedProducts.add(productId);
            }
            updateSelectedCount();
        }

        function updateSelectedCount() {
            const productCheckboxes = document.querySelectorAll(\'.product-checkbox\');
            const selectAllCheckbox = document.getElementById(\'selectAll\');
            
            // Update select all checkbox state based on currently visible items
            const checkedCount = document.querySelectorAll(\'.product-checkbox:checked\').length;
            const totalCount = productCheckboxes.length;
            
            if (checkedCount === 0) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = false;
            } else if (checkedCount === totalCount) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = true;
            } else {
                selectAllCheckbox.indeterminate = true;
                selectAllCheckbox.checked = false;
            }
            
            // Update count in export modal if open
            const selectedCountElement = document.getElementById(\'selectedCount\');
            if (selectedCountElement) {
                selectedCountElement.textContent = selectedProducts.size;
            }
        }

        function renderInventoryTable() {
            const tbody = document.getElementById(\'inventoryTable\');
            const searchTerm = document.getElementById(\'searchInput\').value.toLowerCase();
            const categoryFilter = document.getElementById(\'categoryFilter\').value;
            const statusFilter = document.getElementById(\'statusFilter\').value;

            let filteredData = inventoryData.filter(item => {
                const matchesSearch = item.name.toLowerCase().includes(searchTerm);
                const matchesCategory = !categoryFilter || item.category === categoryFilter;
                const matchesStatus = !statusFilter || item.status === statusFilter;
                return matchesSearch && matchesCategory && matchesStatus;
            });

            tbody.innerHTML = filteredData.map(item => {
                const statusClass = {
                    \'in-stock\': \'bg-green-100 text-green-800\',
                    \'low-stock\': \'bg-yellow-100 text-yellow-800\',
                    \'out-of-stock\': \'bg-red-100 text-red-800\'
                }[item.status];

                const statusText = {
                    \'in-stock\': \'Còn hàng\',
                    \'low-stock\': \'Sắp hết\',
                    \'out-of-stock\': \'Hết hàng\'
                }[item.status];

                const isSelected = selectedProducts.has(item.id);

                return `
                    <tr class="hover:bg-gray-50 fade-in">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="product-checkbox text-green-600 focus:ring-green-500" data-id="${item.id}" ${isSelected ? \'checked\' : \'\'} onchange="toggleProductSelection(${item.id})">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">${item.name}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">${getCategoryName(item.category)}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold ${item.stock === 0 ? \'text-red-600\' : item.stock <= item.minStock ? \'text-yellow-600\' : \'text-green-600\'}">${item.stock}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">${item.minStock}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
                                ${statusText}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">${item.price}₫</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button onclick="openUpdateModal(${item.id})" class="text-blue-600 hover:text-blue-900 mr-3">Cập nhật</button>
                            <button onclick="viewDetails(${item.id})" class="text-green-600 hover:text-green-900 mr-3">Chi tiết</button>
                            <button onclick="confirmDelete(${item.id})" class="text-red-600 hover:text-red-900">Xóa</button>
                        </td>
                    </tr>
                `;
            }).join(\'\');
            
            // Update selection state after rendering
            setTimeout(updateSelectedCount, 0);
        }

        function renderAlerts() {
            const alertsList = document.getElementById(\'alertsList\');
            const alerts = inventoryData.filter(item => item.status === \'out-of-stock\' || item.status === \'low-stock\');

            alertsList.innerHTML = alerts.map(item => {
                const isOutOfStock = item.status === \'out-of-stock\';
                const alertClass = isOutOfStock ? \'border-red-200 bg-red-50\' : \'border-yellow-200 bg-yellow-50\';
                const iconClass = isOutOfStock ? \'text-red-500\' : \'text-yellow-500\';
                const textClass = isOutOfStock ? \'text-red-800\' : \'text-yellow-800\';

                return `
                    <div class="flex items-center p-4 ${alertClass} border rounded-lg">
                        <svg class="w-5 h-5 ${iconClass} mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <div class="flex-1">
                            <p class="font-medium ${textClass}">${item.name}</p>
                            <p class="text-sm ${textClass}">
                                ${isOutOfStock ? \'Đã hết hàng\' : `Chỉ còn ${item.stock} sản phẩm (tối thiểu: ${item.minStock})`}
                            </p>
                        </div>
                        <button onclick="openUpdateModal(${item.id})" class="ml-4 bg-white px-3 py-1 rounded text-sm font-medium ${textClass} hover:bg-gray-100 transition-colors">
                            Cập nhật
                        </button>
                    </div>
                `;
            }).join(\'\');
        }

        function getCategoryName(category) {
            const categories = {
                \'smartphone\': \'Điện thoại\',
                \'laptop\': \'Laptop\',
                \'tablet\': \'Tablet\',
                \'accessory\': \'Phụ kiện\'
            };
            return categories[category] || category;
        }

        function openUpdateModal(id) {
            const item = inventoryData.find(item => item.id === id);
            if (item) {
                currentEditId = id;
                document.getElementById(\'modalProductName\').textContent = item.name;
                document.getElementById(\'newStock\').value = item.stock;
                document.getElementById(\'minStock\').value = item.minStock;
                document.getElementById(\'updateModal\').classList.remove(\'hidden\');
                document.getElementById(\'updateModal\').classList.add(\'flex\');
            }
        }

        function closeModal() {
            document.getElementById(\'updateModal\').classList.add(\'hidden\');
            document.getElementById(\'updateModal\').classList.remove(\'flex\');
            currentEditId = null;
        }

        function updateStock() {
            if (currentEditId) {
                const newStock = parseInt(document.getElementById(\'newStock\').value);
                const minStock = parseInt(document.getElementById(\'minStock\').value);
                
                const item = inventoryData.find(item => item.id === currentEditId);
                if (item) {
                    item.stock = newStock;
                    item.minStock = minStock;
                    
                    // Update status based on stock levels
                    if (newStock === 0) {
                        item.status = \'out-of-stock\';
                    } else if (newStock <= minStock) {
                        item.status = \'low-stock\';
                    } else {
                        item.status = \'in-stock\';
                    }
                    
                    renderInventoryTable();
                    renderAlerts();
                    closeModal();
                    
                    // Show success message
                    showNotification(\'Cập nhật tồn kho thành công!\', \'success\');
                }
            }
        }

        function viewDetails(id) {
            const item = inventoryData.find(item => item.id === id);
            if (item) {
                showProductDetails(item);
                document.getElementById(\'detailsModal\').classList.remove(\'hidden\');
                document.getElementById(\'detailsModal\').classList.add(\'flex\');
            }
        }

        function showProductDetails(item) {
            const statusClass = {
                \'in-stock\': \'bg-green-100 text-green-800\',
                \'low-stock\': \'bg-yellow-100 text-yellow-800\',
                \'out-of-stock\': \'bg-red-100 text-red-800\'
            }[item.status];

            const statusText = {
                \'in-stock\': \'Còn hàng\',
                \'low-stock\': \'Sắp hết\',
                \'out-of-stock\': \'Hết hàng\'
            }[item.status];

            const stockColor = item.stock === 0 ? \'text-red-600\' : item.stock <= item.minStock ? \'text-yellow-600\' : \'text-green-600\';

            const detailsHTML = `
                // Product Header 
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6 border border-blue-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">${item.name}</h2>
                            <p class="text-gray-600 mb-3">${item.description}</p>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full ${statusClass}">
                                ${statusText}
                            </span>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold ${stockColor} mb-1">${item.stock}</div>
                            <div class="text-sm text-gray-500">Tồn kho</div>
                        </div>
                    </div>
                </div>

                // Product Information Grid 
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    // Basic Information 
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Thông tin cơ bản
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Mã SKU:</span>
                                <span class="font-medium text-gray-900">${item.sku}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Thương hiệu:</span>
                                <span class="font-medium text-gray-900">${item.brand}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Model:</span>
                                <span class="font-medium text-gray-900">${item.model}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Danh mục:</span>
                                <span class="font-medium text-gray-900">${getCategoryName(item.category)}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Giá bán:</span>
                                <span class="font-bold text-blue-600 text-lg">${item.price}₫</span>
                            </div>
                        </div>
                    </div>

                    // Stock Information 
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Thông tin tồn kho
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Số lượng hiện tại:</span>
                                <span class="font-bold text-xl ${stockColor}">${item.stock}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tồn kho tối thiểu:</span>
                                <span class="font-medium text-gray-900">${item.minStock}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Vị trí kho:</span>
                                <span class="font-medium text-gray-900">${item.location}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nhà cung cấp:</span>
                                <span class="font-medium text-gray-900">${item.supplier}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Cập nhật cuối:</span>
                                <span class="font-medium text-gray-900">${new Date(item.lastUpdated).toLocaleDateString(\'vi-VN\')}</span>
                            </div>
                        </div>
                    </div>
                </div>

                // Stock Status Alert 
                ${item.status !== \'in-stock\' ? `
                <div class="bg-${item.status === \'out-of-stock\' ? \'red\' : \'yellow\'}-50 border border-${item.status === \'out-of-stock\' ? \'red\' : \'yellow\'}-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-${item.status === \'out-of-stock\' ? \'red\' : \'yellow\'}-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <div>
                            <h4 class="font-medium text-${item.status === \'out-of-stock\' ? \'red\' : \'yellow\'}-800">
                                ${item.status === \'out-of-stock\' ? \'Cảnh báo: Sản phẩm đã hết hàng!\' : \'Cảnh báo: Sản phẩm sắp hết hàng!\'}
                            </h4>
                            <p class="text-sm text-${item.status === \'out-of-stock\' ? \'red\' : \'yellow\'}-700 mt-1">
                                ${item.status === \'out-of-stock\' ? \'Cần nhập hàng ngay lập tức để đáp ứng nhu cầu khách hàng.\' : `Chỉ còn ${item.stock} sản phẩm, cần nhập thêm hàng sớm.`}
                            </p>
                        </div>
                    </div>
                </div>
                ` : \'\'}

                // Action Buttons 
                <div class="flex space-x-3 pt-4 border-t border-gray-200">
                    <button onclick="openUpdateModal(${item.id}); closeDetailsModal();" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white py-3 px-4 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        <span>Cập nhật tồn kho</span>
                    </button>
                    <button onclick="closeDetailsModal()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 py-3 px-4 rounded-lg font-medium transition-colors">
                        Đóng
                    </button>
                </div>
            `;

            document.getElementById(\'productDetails\').innerHTML = detailsHTML;
        }

        function closeDetailsModal() {
            document.getElementById(\'detailsModal\').classList.add(\'hidden\');
            document.getElementById(\'detailsModal\').classList.remove(\'flex\');
        }

        function confirmDelete(id) {
            const item = inventoryData.find(item => item.id === id);
            if (item) {
                currentDeleteId = id;
                document.getElementById(\'deleteProductName\').textContent = item.name;
                document.getElementById(\'deleteModal\').classList.remove(\'hidden\');
                document.getElementById(\'deleteModal\').classList.add(\'flex\');
            }
        }

        function closeDeleteModal() {
            document.getElementById(\'deleteModal\').classList.add(\'hidden\');
            document.getElementById(\'deleteModal\').classList.remove(\'flex\');
            currentDeleteId = null;
        }

        function deleteProduct() {
            if (currentDeleteId) {
                const item = inventoryData.find(item => item.id === currentDeleteId);
                if (item) {
                    // Remove from inventory data
                    inventoryData = inventoryData.filter(item => item.id !== currentDeleteId);
                    
                    // Remove from selected products if it was selected
                    selectedProducts.delete(currentDeleteId);
                    
                    // Re-render table and alerts
                    renderInventoryTable();
                    renderAlerts();
                    
                    // Close modal
                    closeDeleteModal();
                    
                    // Show success message
                    showNotification(`Đã xóa sản phẩm "${item.name}" thành công!`, \'success\');
                }
            }
        }

        function showExcelPreview() {
            updateExportSummary();
            document.getElementById(\'excelPreviewModal\').classList.remove(\'hidden\');
            document.getElementById(\'excelPreviewModal\').classList.add(\'flex\');
        }

        function closeExcelPreview() {
            document.getElementById(\'excelPreviewModal\').classList.add(\'hidden\');
            document.getElementById(\'excelPreviewModal\').classList.remove(\'flex\');
        }

        function selectAllColumns() {
            const checkboxes = document.querySelectorAll(\'[id^="col"]\');
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            updateExportSummary();
        }

        function deselectAllColumns() {
            const checkboxes = document.querySelectorAll(\'[id^="col"]\');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateExportSummary();
        }

        function updateExportSummary() {
            // Get selected range
            const selectedRange = document.querySelector(\'input[name="exportRange"]:checked\').value;
            let productCount = inventoryData.length;
            
            if (selectedRange === \'current\') {
                // Count filtered results
                const searchTerm = document.getElementById(\'searchInput\').value.toLowerCase();
                const categoryFilter = document.getElementById(\'categoryFilter\').value;
                const statusFilter = document.getElementById(\'statusFilter\').value;
                
                productCount = inventoryData.filter(item => {
                    const matchesSearch = item.name.toLowerCase().includes(searchTerm);
                    const matchesCategory = !categoryFilter || item.category === categoryFilter;
                    const matchesStatus = !statusFilter || item.status === statusFilter;
                    return matchesSearch && matchesCategory && matchesStatus;
                }).length;
            } else if (selectedRange === \'selected\') {
                productCount = selectedProducts.size;
            }
            
            // Count selected columns
            const selectedColumns = document.querySelectorAll(\'[id^="col"]:checked\').length;
            
            // Get file format
            const fileFormat = document.getElementById(\'fileFormat\').value;
            const formatText = fileFormat === \'xlsx\' ? \'Excel (.xlsx)\' : \'CSV (.csv)\';
            
            // Update summary
            document.getElementById(\'exportSummary\').innerHTML = `
                <p>Sẽ xuất: <span class="font-medium text-gray-900">${productCount} sản phẩm</span></p>
                <p>Định dạng: <span class="font-medium text-gray-900">${formatText}</span></p>
                <p>Cột: <span class="font-medium text-gray-900">${selectedColumns} cột</span></p>
            `;
            
            // Update counts in radio buttons
            document.getElementById(\'totalCount\').textContent = inventoryData.length;
            document.getElementById(\'currentCount\').textContent = document.querySelectorAll(\'.product-checkbox\').length;
            document.getElementById(\'selectedCount\').textContent = selectedProducts.size;
        }

        function downloadExcel() {
            showNotification(\'Đang tạo file Excel...\', \'info\');
            
            // Get export settings
            const selectedRange = document.querySelector(\'input[name="exportRange"]:checked\').value;
            const fileFormat = document.getElementById(\'fileFormat\').value;
            const fileName = document.getElementById(\'fileName\').value || \'bao-cao-ton-kho\';
            const includeHeaders = document.getElementById(\'includeHeaders\').checked;
            const includeTimestamp = document.getElementById(\'includeTimestamp\').checked;
            const includeStats = document.getElementById(\'includeStats\').checked;
            
            // Get status filters
            const statusFilters = {
                \'in-stock\': document.getElementById(\'statusInStock\').checked,
                \'low-stock\': document.getElementById(\'statusLowStock\').checked,
                \'out-of-stock\': document.getElementById(\'statusOutStock\').checked
            };
            
            // Get selected columns
            const selectedColumns = {
                id: document.getElementById(\'colId\').checked,
                name: document.getElementById(\'colName\').checked,
                sku: document.getElementById(\'colSku\').checked,
                category: document.getElementById(\'colCategory\').checked,
                brand: document.getElementById(\'colBrand\').checked,
                stock: document.getElementById(\'colStock\').checked,
                minStock: document.getElementById(\'colMinStock\').checked,
                status: document.getElementById(\'colStatus\').checked,
                price: document.getElementById(\'colPrice\').checked,
                supplier: document.getElementById(\'colSupplier\').checked,
                location: document.getElementById(\'colLocation\').checked
            };
            
            // Filter data based on settings
            let dataToExport = inventoryData;
            
            // Apply range filter
            if (selectedRange === \'current\') {
                const searchTerm = document.getElementById(\'searchInput\').value.toLowerCase();
                const categoryFilter = document.getElementById(\'categoryFilter\').value;
                const statusFilter = document.getElementById(\'statusFilter\').value;
                
                dataToExport = inventoryData.filter(item => {
                    const matchesSearch = item.name.toLowerCase().includes(searchTerm);
                    const matchesCategory = !categoryFilter || item.category === categoryFilter;
                    const matchesStatus = !statusFilter || item.status === statusFilter;
                    return matchesSearch && matchesCategory && matchesStatus;
                });
            } else if (selectedRange === \'selected\') {
                dataToExport = inventoryData.filter(item => selectedProducts.has(item.id));
            }
            
            // Apply status filter
            dataToExport = dataToExport.filter(item => statusFilters[item.status]);
            
            // Prepare export data with selected columns
            const exportData = dataToExport.map((item, index) => {
                const row = {};
                if (selectedColumns.id) row[\'ID\'] = item.id;
                if (selectedColumns.name) row[\'Tên sản phẩm\'] = item.name;
                if (selectedColumns.sku) row[\'Mã SKU\'] = item.sku;
                if (selectedColumns.category) row[\'Danh mục\'] = getCategoryName(item.category);
                if (selectedColumns.brand) row[\'Thương hiệu\'] = item.brand;
                if (selectedColumns.stock) row[\'Tồn kho\'] = item.stock;
                if (selectedColumns.minStock) row[\'Tối thiểu\'] = item.minStock;
                if (selectedColumns.status) row[\'Trạng thái\'] = {
                    \'in-stock\': \'Còn hàng\',
                    \'low-stock\': \'Sắp hết\',
                    \'out-of-stock\': \'Hết hàng\'
                }[item.status];
                if (selectedColumns.price) row[\'Giá (VNĐ)\'] = item.price;
                if (selectedColumns.supplier) row[\'Nhà cung cấp\'] = item.supplier;
                if (selectedColumns.location) row[\'Vị trí kho\'] = item.location;
                return row;
            });
            
            if (exportData.length === 0) {
                showNotification(\'Không có dữ liệu để xuất!\', \'error\');
                return;
            }
            
            // Create workbook and worksheet
            const wb = XLSX.utils.book_new();
            let ws;
            
            if (includeHeaders && (includeTimestamp || includeStats)) {
                // Create worksheet with headers
                ws = XLSX.utils.json_to_sheet([]);
                
                let currentRow = 0;
                
                // Add title and timestamp
                if (includeTimestamp) {
                    const now = new Date();
                    const dateStr = now.toLocaleDateString(\'vi-VN\');
                    const timeStr = now.toLocaleTimeString(\'vi-VN\');
                    
                    XLSX.utils.sheet_add_aoa(ws, [
                        [\'BÁO CÁO TỒN KHO\'],
                        [`Ngày xuất: ${dateStr} - ${timeStr}`],
                        [\'\']
                    ], { origin: `A${currentRow + 1}` });
                    currentRow += 3;
                }
                
                // Add statistics
                if (includeStats) {
                    const totalProducts = dataToExport.length;
                    const inStock = dataToExport.filter(item => item.status === \'in-stock\').length;
                    const lowStock = dataToExport.filter(item => item.status === \'low-stock\').length;
                    const outOfStock = dataToExport.filter(item => item.status === \'out-of-stock\').length;
                    
                    XLSX.utils.sheet_add_aoa(ws, [
                        [\'THỐNG KÊ TỔNG QUAN:\'],
                        [`Tổng sản phẩm: ${totalProducts}`],
                        [`Còn hàng: ${inStock}`],
                        [`Sắp hết: ${lowStock}`],
                        [`Hết hàng: ${outOfStock}`],
                        [\'\']
                    ], { origin: `A${currentRow + 1}` });
                    currentRow += 6;
                }
                
                // Add data
                XLSX.utils.sheet_add_json(ws, exportData, { origin: `A${currentRow + 1}` });
            } else {
                // Simple data export
                ws = XLSX.utils.json_to_sheet(exportData, { skipHeader: !includeHeaders });
            }
            
            // Add worksheet to workbook
            XLSX.utils.book_append_sheet(wb, ws, \'Báo cáo tồn kho\');
            
            // Generate filename with current date
            const now = new Date();
            const dateStr = now.toISOString().split(\'T\')[0];
            const extension = fileFormat === \'xlsx\' ? \'xlsx\' : \'csv\';
            const filename = `${fileName}-${dateStr}.${extension}`;
            
            // Write and download file
            if (fileFormat === \'csv\') {
                XLSX.writeFile(wb, filename, { bookType: \'csv\' });
            } else {
                XLSX.writeFile(wb, filename);
            }
            
            showNotification(`Tải ${fileFormat.toUpperCase()} thành công!`, \'success\');
            closeExcelPreview();
        }

        function refreshData() {
            showNotification(\'Đang làm mới dữ liệu...\', \'info\');
            // Simulate refresh
            setTimeout(() => {
                renderInventoryTable();
                renderAlerts();
                showNotification(\'Dữ liệu đã được cập nhật!\', \'success\');
            }, 1000);
        }



        function showNotification(message, type) {
            const notification = document.createElement(\'div\');
            const bgColor = type === \'success\' ? \'bg-green-500\' : type === \'error\' ? \'bg-red-500\' : \'bg-blue-500\';
            
            notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 fade-in`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Event listeners
        document.getElementById(\'searchInput\').addEventListener(\'input\', renderInventoryTable);
        document.getElementById(\'categoryFilter\').addEventListener(\'change\', renderInventoryTable);
        document.getElementById(\'statusFilter\').addEventListener(\'change\', renderInventoryTable);
        
        // Export form event listeners
        document.addEventListener(\'change\', function(e) {
            if (e.target.name === \'exportRange\' || 
                e.target.id === \'fileFormat\' || 
                e.target.id.startsWith(\'col\') || 
                e.target.id.startsWith(\'status\')) {
                updateExportSummary();
            }
        });

        // Close modal when clicking outside
        document.getElementById(\'updateModal\').addEventListener(\'click\', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close Excel preview modal when clicking outside
        document.getElementById(\'excelPreviewModal\').addEventListener(\'click\', function(e) {
            if (e.target === this) {
                closeExcelPreview();
            }
        });

        // Close details modal when clicking outside
        document.getElementById(\'detailsModal\').addEventListener(\'click\', function(e) {
            if (e.target === this) {
                closeDetailsModal();
            }
        });

        // Close delete modal when clicking outside
        document.getElementById(\'deleteModal\').addEventListener(\'click\', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });



        // Initialize the page
        renderInventoryTable();
        renderAlerts();
    </script> -->

<script>
// Thiết lập CSRF token cho các yêu cầu POST/PUT/DELETE
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

let selectedProducts = new Set();
let currentEditId = null;
let currentDeleteId = null;

// Hàm lấy danh sách sản phẩm
async function fetchProducts() {
    const search = document.getElementById('searchInput').value;
    const category = document.getElementById('categoryFilter').value;
    const status = document.getElementById('statusFilter').value;

    try {
        const response = await fetch(`/api/inventory/products?search=${encodeURIComponent(search)}&category=${category}&status=${status}`);
        if (!response.ok) throw new Error('Lỗi khi lấy danh sách sản phẩm');
        const products = await response.json();
        renderInventoryTable(products);
    } catch (error) {
        showNotification('Lỗi khi tải dữ liệu sản phẩm!', 'error');
    }
}

// Hàm lấy danh sách cảnh báo
async function fetchAlerts() {
    try {
        const response = await fetch('/api/inventory/alerts');
        if (!response.ok) throw new Error('Lỗi khi lấy danh sách cảnh báo');
        const alerts = await response.json();
        renderAlerts(alerts);
    } catch (error) {
        showNotification('Lỗi khi tải dữ liệu cảnh báo!', 'error');
    }
}

// Hàm render bảng sản phẩm
function renderInventoryTable(products) {
    const tbody = document.getElementById('inventoryTable');
    tbody.innerHTML = products.map(item => {
        const statusClass = {
            'in-stock': 'bg-green-100 text-green-800',
            'low-stock': 'bg-yellow-100 text-yellow-800',
            'out-of-stock': 'bg-red-100 text-red-800'
        }[item.status];

        const statusText = {
            'in-stock': 'Còn hàng',
            'low-stock': 'Sắp hết',
            'out-of-stock': 'Hết hàng'
        }[item.status];

        const isSelected = selectedProducts.has(item.id);

        return `
            <tr class="hover:bg-gray-50 fade-in">
                <td class="px-6 py-4 whitespace-nowrap">
                    <input type="checkbox" class="product-checkbox text-green-600 focus:ring-green-500" data-id="${item.id}" ${isSelected ? 'checked' : ''} onchange="toggleProductSelection(${item.id})">
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${item.name}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">${getCategoryName(item.category)}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-bold ${item.stock === 0 ? 'text-red-600' : item.stock <= item.min_stock ? 'text-yellow-600' : 'text-green-600'}">${item.stock}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">${item.min_stock}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
                        ${statusText}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(item.price)}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button onclick="openUpdateModal(${item.id})" class="text-blue-600 hover:text-blue-900 mr-3">Cập nhật</button>
                    <button onclick="viewDetails(${item.id})" class="text-green-600 hover:text-green-900 mr-3">Chi tiết</button>
                    <button onclick="confirmDelete(${item.id})" class="text-red-600 hover:text-red-900">Xóa</button>
                </td>
            </tr>
        `;
    }).join('');

    setTimeout(updateSelectedCount, 0);
}

// Hàm render cảnh báo
function renderAlerts(alerts) {
    const alertsList = document.getElementById('alertsList');
    alertsList.innerHTML = alerts.map(item => {
        const isOutOfStock = item.status === 'out-of-stock';
        const alertClass = isOutOfStock ? 'border-red-200 bg-red-50' : 'border-yellow-200 bg-yellow-50';
        const iconClass = isOutOfStock ? 'text-red-500' : 'text-yellow-500';
        const textClass = isOutOfStock ? 'text-red-800' : 'text-yellow-800';

        return `
            <div class="flex items-center p-4 ${alertClass} border rounded-lg">
                <svg class="w-5 h-5 ${iconClass} mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <div class="flex-1">
                    <p class="font-medium ${textClass}">${item.name}</p>
                    <p class="text-sm ${textClass}">
                        ${isOutOfStock ? 'Đã hết hàng' : `Chỉ còn ${item.stock} sản phẩm (tối thiểu: ${item.min_stock})`}
                    </p>
                </div>
                <button onclick="openUpdateModal(${item.id})" class="ml-4 bg-white px-3 py-1 rounded text-sm font-medium ${textClass} hover:bg-gray-100 transition-colors">
                    Cập nhật
                </button>
            </div>
        `;
    }).join('');
}

// Hàm chọn tất cả checkbox
function toggleSelectAll() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const productCheckboxes = document.querySelectorAll('.product-checkbox');

    productCheckboxes.forEach(checkbox => {
        const productId = parseInt(checkbox.dataset.id);
        if (selectAllCheckbox.checked) {
            selectedProducts.add(productId);
            checkbox.checked = true;
        } else {
            selectedProducts.delete(productId);
            checkbox.checked = false;
        }
    });

    updateSelectedCount();
}

// Hàm chọn/xóa sản phẩm
function toggleProductSelection(productId) {
    if (selectedProducts.has(productId)) {
        selectedProducts.delete(productId);
    } else {
        selectedProducts.add(productId);
    }
    updateSelectedCount();
}

// Cập nhật số lượng sản phẩm được chọn
function updateSelectedCount() {
    const productCheckboxes = document.querySelectorAll('.product-checkbox');
    const selectAllCheckbox = document.getElementById('selectAll');

    const checkedCount = document.querySelectorAll('.product-checkbox:checked').length;
    const totalCount = productCheckboxes.length;

    if (checkedCount === 0) {
        selectAllCheckbox.indeterminate = false;
        selectAllCheckbox.checked = false;
    } else if (checkedCount === totalCount) {
        selectAllCheckbox.indeterminate = false;
        selectAllCheckbox.checked = true;
    } else {
        selectAllCheckbox.indeterminate = true;
        selectAllCheckbox.checked = false;
    }

    const selectedCountElement = document.getElementById('selectedCount');
    if (selectedCountElement) {
        selectedCountElement.textContent = selectedProducts.size;
    }
}

// Hàm lấy tên danh mục
function getCategoryName(category) {
    const categories = {
        'smartphone': 'Điện thoại',
        'laptop': 'Laptop',
        'tablet': 'Tablet',
        'accessory': 'Phụ kiện'
    };
    return categories[category] || category;
}

// Mở modal cập nhật tồn kho
async function openUpdateModal(id) {
    try {
        const response = await fetch(`/api/inventory/product/${id}`);
        if (!response.ok) throw new Error('Lỗi khi lấy chi tiết sản phẩm');
        const item = await response.json();

        currentEditId = id;
        document.getElementById('modalProductName').textContent = item.name;
        document.getElementById('newStock').value = item.stock;
        document.getElementById('minStock').value = item.min_stock;
        document.getElementById('updateModal').classList.remove('hidden');
        document.getElementById('updateModal').classList.add('flex');
    } catch (error) {
        showNotification('Lỗi khi mở modal cập nhật!', 'error');
    }
}

// Đóng modal cập nhật
function closeModal() {
    document.getElementById('updateModal').classList.add('hidden');
    document.getElementById('updateModal').classList.remove('flex');
    currentEditId = null;
}

// Cập nhật tồn kho
async function updateStock() {
    if (currentEditId) {
        const newStock = parseInt(document.getElementById('newStock').value);
        const minStock = parseInt(document.getElementById('minStock').value);

        try {
            const response = await fetch(`/api/inventory/product/${currentEditId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ stock: newStock, min_stock: minStock })
            });

            if (response.ok) {
                await fetchProducts();
                await fetchAlerts();
                closeModal();
                showNotification('Cập nhật tồn kho thành công!', 'success');
            } else {
                throw new Error('Lỗi khi cập nhật');
            }
        } catch (error) {
            showNotification('Lỗi khi cập nhật tồn kho!', 'error');
        }
    }
}

// Xem chi tiết sản phẩm
async function viewDetails(id) {
    try {
        const response = await fetch(`/api/inventory/product/${id}`);
        if (!response.ok) throw new Error('Lỗi khi lấy chi tiết sản phẩm');
        const item = await response.json();
        showProductDetails(item);
        document.getElementById('detailsModal').classList.remove('hidden');
        document.getElementById('detailsModal').classList.add('flex');
    } catch (error) {
        showNotification('Lỗi khi xem chi tiết sản phẩm!', 'error');
    }
}

// Hiển thị chi tiết sản phẩm
function showProductDetails(item) {
    const statusClass = {
        'in-stock': 'bg-green-100 text-green-800',
        'low-stock': 'bg-yellow-100 text-yellow-800',
        'out-of-stock': 'bg-red-100 text-red-800'
    }[item.status];

    const statusText = {
        'in-stock': 'Còn hàng',
        'low-stock': 'Sắp hết',
        'out-of-stock': 'Hết hàng'
    }[item.status];

    const stockColor = item.stock === 0 ? 'text-red-600' : item.stock <= item.min_stock ? 'text-yellow-600' : 'text-green-600';

    const detailsHTML = `
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6 border border-blue-200">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">${item.name}</h2>
                    <p class="text-gray-600 mb-3">${item.description || 'Không có mô tả'}</p>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full ${statusClass}">
                        ${statusText}
                    </span>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold ${stockColor} mb-1">${item.stock}</div>
                    <div class="text-sm text-gray-500">Tồn kho</div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Thông tin cơ bản
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Mã SKU:</span>
                        <span class="font-medium text-gray-900">${item.sku}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Thương hiệu:</span>
                        <span class="font-medium text-gray-900">${item.brand || 'N/A'}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Model:</span>
                        <span class="font-medium text-gray-900">${item.model || 'N/A'}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Danh mục:</span>
                        <span class="font-medium text-gray-900">${getCategoryName(item.category)}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Giá bán:</span>
                        <span class="font-bold text-blue-600 text-lg">${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(item.price)}</span>
                    </div>
                </div>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Thông tin tồn kho
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Số lượng hiện tại:</span>
                        <span class="font-bold text-xl ${stockColor}">${item.stock}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tồn kho tối thiểu:</span>
                        <span class="font-medium text-gray-900">${item.min_stock}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Vị trí kho:</span>
                        <span class="font-medium text-gray-900">${item.location || 'N/A'}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Nhà cung cấp:</span>
                        <span class="font-medium text-gray-900">${item.supplier || 'N/A'}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Cập nhật cuối:</span>
                        <span class="font-medium text-gray-900">${new Date(item.last_updated).toLocaleDateString('vi-VN')}</span>
                    </div>
                </div>
            </div>
        </div>
        ${item.status !== 'in-stock' ? `
        <div class="bg-${item.status === 'out-of-stock' ? 'red' : 'yellow'}-50 border border-${item.status === 'out-of-stock' ? 'red' : 'yellow'}-200 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-${item.status === 'out-of-stock' ? 'red' : 'yellow'}-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <div>
                    <h4 class="font-medium text-${item.status === 'out-of-stock' ? 'red' : 'yellow'}-800">
                        ${item.status === 'out-of-stock' ? 'Cảnh báo: Sản phẩm đã hết hàng!' : 'Cảnh báo: Sản phẩm sắp hết hàng!'}
                    </h4>
                    <p class="text-sm text-${item.status === 'out-of-stock' ? 'red' : 'yellow'}-700 mt-1">
                        ${item.status === 'out-of-stock' ? 'Cần nhập hàng ngay lập tức để đáp ứng nhu cầu khách hàng.' : `Chỉ còn ${item.stock} sản phẩm, cần nhập thêm hàng sớm.`}
                    </p>
                </div>
            </div>
        </div>
        ` : ''}
        <div class="flex space-x-3 pt-4 border-t border-gray-200">
            <button onclick="openUpdateModal(${item.id}); closeDetailsModal();" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white py-3 px-4 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span>Cập nhật tồn kho</span>
            </button>
            <button onclick="closeDetailsModal()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 py-3 px-4 rounded-lg font-medium transition-colors">
                Đóng
            </button>
        </div>
    `;

    document.getElementById('productDetails').innerHTML = detailsHTML;
}

// Đóng modal chi tiết
function closeDetailsModal() {
    document.getElementById('detailsModal').classList.add('hidden');
    document.getElementById('detailsModal').classList.remove('flex');
}

// Xác nhận xóa sản phẩm
async function confirmDelete(id) {
    try {
        const response = await fetch(`/api/inventory/product/${id}`);
        if (!response.ok) throw new Error('Lỗi khi lấy chi tiết sản phẩm');
        const item = await response.json();

        currentDeleteId = id;
        document.getElementById('deleteProductName').textContent = item.name;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    } catch (error) {
        showNotification('Lỗi khi mở modal xóa!', 'error');
    }
}

// Đóng modal xóa
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
    currentDeleteId = null;
}

// Xóa sản phẩm
async function deleteProduct() {
    if (currentDeleteId) {
        try {
            const response = await fetch(`/api/inventory/product/${currentDeleteId}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrfToken }
            });

            if (response.ok) {
                selectedProducts.delete(currentDeleteId);
                await fetchProducts();
                await fetchAlerts();
                closeDeleteModal();
                showNotification(`Đã xóa sản phẩm thành công!`, 'success');
            } else {
                throw new Error('Lỗi khi xóa');
            }
        } catch (error) {
            showNotification('Lỗi khi xóa sản phẩm!', 'error');
        }
    }
}

// Mở modal xuất Excel
function showExcelPreview() {
    updateExportSummary();
    document.getElementById('excelPreviewModal').classList.remove('hidden');
    document.getElementById('excelPreviewModal').classList.add('flex');
}

// Đóng modal xuất Excel
function closeExcelPreview() {
    document.getElementById('excelPreviewModal').classList.add('hidden');
    document.getElementById('excelPreviewModal').classList.remove('flex');
}

// Chọn tất cả cột
function selectAllColumns() {
    const checkboxes = document.querySelectorAll('[id^="col"]');
    checkboxes.forEach(checkbox => checkbox.checked = true);
    updateExportSummary();
}

// Bỏ chọn tất cả cột
function deselectAllColumns() {
    const checkboxes = document.querySelectorAll('[id^="col"]');
    checkboxes.forEach(checkbox => checkbox.checked = false);
    updateExportSummary();
}

// Cập nhật tóm tắt xuất Excel
async function updateExportSummary() {
    const selectedRange = document.querySelector('input[name="exportRange"]:checked').value;
    const search = document.getElementById('searchInput').value;
    const category = document.getElementById('categoryFilter').value;
    const status = document.getElementById('statusFilter').value;

    let productCount = 0;
    try {
        if (selectedRange === 'all') {
            const response = await fetch('/api/inventory/products');
            const products = await response.json();
            productCount = products.length;
        } else if (selectedRange === 'current') {
            const response = await fetch(`/api/inventory/products?search=${encodeURIComponent(search)}&category=${category}&status=${status}`);
            const products = await response.json();
            productCount = products.length;
        } else if (selectedRange === 'selected') {
            productCount = selectedProducts.size;
        }
    } catch (error) {
        showNotification('Lỗi khi tính toán số lượng sản phẩm!', 'error');
    }

    const selectedColumns = document.querySelectorAll('[id^="col"]:checked').length;
    const fileFormat = document.getElementById('fileFormat').value;
    const formatText = fileFormat === 'xlsx' ? 'Excel (.xlsx)' : 'CSV (.csv)';

    document.getElementById('exportSummary').innerHTML = `
        <p>Sẽ xuất: <span class="font-medium text-gray-900">${productCount} sản phẩm</span></p>
        <p>Định dạng: <span class="font-medium text-gray-900">${formatText}</span></p>
        <p>Cột: <span class="font-medium text-gray-900">${selectedColumns} cột</span></p>
    `;

    document.getElementById('totalCount').textContent = productCount;
    document.getElementById('currentCount').textContent = document.querySelectorAll('.product-checkbox').length;
    document.getElementById('selectedCount').textContent = selectedProducts.size;
}

// Xuất Excel
async function downloadExcel() {
    showNotification('Đang tạo file Excel...', 'info');

    const selectedRange = document.querySelector('input[name="exportRange"]:checked').value;
    const fileFormat = document.getElementById('fileFormat').value;
    const fileName = document.getElementById('fileName').value;
    const includeHeaders = document.getElementById('includeHeaders').checked;
    const includeTimestamp = document.getElementById('includeTimestamp').checked;
    const includeStats = document.getElementById('includeStats').checked;
    const statuses = {
        'in-stock': document.getElementById('statusInStock').checked,
        'low-stock': document.getElementById('statusLowStock').checked,
        'out-of-stock': document.getElementById('statusOutStock').checked
    };
    const columns = {
        id: document.getElementById('colId').checked,
        name: document.getElementById('colName').checked,
        sku: document.getElementById('colSku').checked,
        category: document.getElementById('colCategory').checked,
        brand: document.getElementById('colBrand').checked,
        stock: document.getElementById('colStock').checked,
        minStock: document.getElementById('colMinStock').checked,
        status: document.getElementById('colStatus').checked,
        price: document.getElementById('colPrice').checked,
        supplier: document.getElementById('colSupplier').checked,
        location: document.getElementById('colLocation').checked
    };

    const payload = {
        range: selectedRange,
        format: fileFormat,
        file_name: fileName,
        include_headers: includeHeaders,
        include_timestamp: includeTimestamp,
        include_stats: includeStats,
        statuses: Object.keys(statuses).filter(key => statuses[key]),
        columns: Object.keys(columns).filter(key => columns[key]),
        selected_ids: Array.from(selectedProducts),
        search: document.getElementById('searchInput').value,
        category: document.getElementById('categoryFilter').value,
        status: document.getElementById('statusFilter').value
    };

    try {
        const response = await fetch('/api/inventory/export', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(payload)
        });

        if (response.ok) {
            const blob = await response.blob();
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `${fileName}-${new Date().toISOString().split('T')[0]}.${fileFormat}`;
            a.click();
            window.URL.revokeObjectURL(url);
            showNotification(`Tải ${fileFormat.toUpperCase()} thành công!`, 'success');
            closeExcelPreview();
        } else {
            throw new Error('Lỗi khi xuất file');
        }
    } catch (error) {
        showNotification('Lỗi khi xuất file!', 'error');
    }
}

// Làm mới dữ liệu
async function refreshData() {
    showNotification('Đang làm mới dữ liệu...', 'info');
    try {
        await Promise.all([fetchProducts(), fetchAlerts()]);
        showNotification('Dữ liệu đã được cập nhật!', 'success');
    } catch (error) {
        showNotification('Lỗi khi làm mới dữ liệu!', 'error');
    }
}

// Hiển thị thông báo
function showNotification(message, type) {
    const notification = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
    
    notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 fade-in`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Event listeners
document.getElementById('searchInput').addEventListener('input', fetchProducts);
document.getElementById('categoryFilter').addEventListener('change', fetchProducts);
document.getElementById('statusFilter').addEventListener('change', fetchProducts);

// Export form event listeners
document.addEventListener('change', function(e) {
    if (e.target.name === 'exportRange' || 
        e.target.id === 'fileFormat' || 
        e.target.id.startsWith('col') || 
        e.target.id.startsWith('status')) {
        updateExportSummary();
    }
});

// Đóng modal khi click bên ngoài
document.getElementById('updateModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
document.getElementById('excelPreviewModal').addEventListener('click', function(e) {
    if (e.target === this) closeExcelPreview();
});
document.getElementById('detailsModal').addEventListener('click', function(e) {
    if (e.target === this) closeDetailsModal();
});
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});

// Khởi tạo trang
fetchProducts();
fetchAlerts();
</script>
</div>
</html>
@endsection