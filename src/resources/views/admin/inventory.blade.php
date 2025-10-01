<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiểm tra tồn kho</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body class="bg-gray-100 p-6">

<div id="inventory" class="section">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Kiểm tra tồn kho</h2>
            <p class="text-gray-600 mt-1">Quản lý số lượng tồn kho sản phẩm</p>
        </div>
        <button class="gradient-bg text-white px-4 py-2 rounded-lg hover:opacity-90 transition-all duration-200" onclick="showSection('deliveries')">
            <i class="fas fa-truck-loading mr-2"></i>Quản lý nhập hàng
        </button>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <!-- Bộ lọc & Xuất Excel -->
        <div class="flex flex-col md:flex-row md:items-center justify-between space-y-4 md:space-y-0 mb-6">
            <div class="flex flex-col md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-4">
                <div class="relative w-full md:w-64">
                    <input type="text" placeholder="Tìm kiếm sản phẩm..." class="pl-10 pr-4 py-2 border rounded-lg w-full" id="inventory-search">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <select id="inventory-category-filter" class="border rounded-lg px-4 py-2 w-full md:w-auto">
                    <option value="all">Tất cả danh mục</option>
                    <option value="laptop">Laptop</option>
                    <option value="phone">Điện thoại</option>
                </select>
                <select id="inventory-status-filter" class="border rounded-lg px-4 py-2 w-full md:w-auto">
                    <option value="all">Tất cả trạng thái</option>
                    <option value="instock">Còn hàng</option>
                    <option value="lowstock">Sắp hết</option>
                    <option value="outofstock">Hết hàng</option>
                </select>
            </div>
            <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-download mr-2"></i>Xuất Excel
            </button>
        </div>

        <!-- Bảng tồn kho -->
        <div class="overflow-x-auto">
            <table class="w-full text-left" id="inventory-table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Tên sản phẩm</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">SKU</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Danh mục</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Tồn kho hiện tại</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Tồn kho tối thiểu</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="inventory-table-body">
                    <!-- Placeholder khi chưa có dữ liệu -->
                    <tr>
                        <td colspan="7" class="text-center text-gray-400 py-4">Chưa có sản phẩm nào</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
