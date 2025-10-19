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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nhà cung cấp</th>
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
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $product->supplier->name ?? '—' }}
                                    </td>
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


</div>
@endsection