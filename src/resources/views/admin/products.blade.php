<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
</head>
<body class="bg-gray-100 p-6">
    <div id="products" class="section">
        <div id="product-list-view">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Danh sách sản phẩm</h2>
                    <p class="text-gray-600 mt-1">Quản lý và cập nhật thông tin sản phẩm</p>
                </div>
                <div class="flex space-x-2">
                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:opacity-90 transition-all duration-200" onclick="exportExcel()">
                        <i class="fas fa-file-excel mr-2"></i>Xuất Excel
                    </button>
                    <button class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:opacity-90 transition-all duration-200" onclick="printProducts()">
                        <i class="fas fa-print mr-2"></i>In
                    </button>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:opacity-90 transition-all duration-200" onclick="openProductModal()">
                        <i class="fas fa-plus mr-2"></i>Thêm sản phẩm
                    </button>
                </div>
            </div>

            <!-- Bộ lọc & tìm kiếm -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between space-y-4 md:space-y-0 mb-6">
                    <div class="flex flex-col md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-4">
                        <!-- Tìm kiếm -->
                        <div class="relative w-full md:w-64">
                            <input type="text" placeholder="Tìm kiếm sản phẩm..." class="pl-10 pr-4 py-2 border rounded-lg w-full" id="product-search-input" onkeyup="filterProducts()">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <!-- Lọc theo danh mục -->
                        <select id="product-category-filter" class="border rounded-lg px-4 py-2 w-full md:w-auto" onchange="filterProducts()">
                            <option value="all">Tất cả danh mục</option>
                            <option value="laptop">Laptop</option>
                            <option value="phone">Điện thoại</option>
                        </select>
                    </div>
                </div>

                <!-- Bảng sản phẩm -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left" id="products-table">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Tên sản phẩm</th>
                                <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">SKU</th>
                                <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Danh mục</th>
                                <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Tồn kho</th>
                                <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Giá bán</th>
                                <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="product-table-body">
                            <!-- JS render -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal thêm/sửa sản phẩm -->
    <div id="product-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
            <h3 class="text-xl font-bold mb-4" id="modal-title">Thêm sản phẩm</h3>
            <form id="product-form" onsubmit="saveProduct(event)">
                <input type="hidden" id="edit-index">
                <div class="space-y-3">
                    <input type="text" id="product-name" class="w-full border rounded p-2" placeholder="Tên sản phẩm" required>
                    <input type="text" id="product-sku" class="w-full border rounded p-2" placeholder="Mã SKU" required>
                    <select id="product-category" class="w-full border rounded p-2" required>
                        <option value="laptop">Laptop</option>
                        <option value="phone">Điện thoại</option>
                    </select>
                    <input type="number" id="product-stock" class="w-full border rounded p-2" placeholder="Số lượng tồn" required>
                    <input type="number" id="product-price" class="w-full border rounded p-2" placeholder="Giá bán" required>
                </div>
                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" onclick="closeProductModal()" class="px-4 py-2 bg-gray-200 rounded">Hủy</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Lưu</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    let products = [
        {name: "MacBook Pro 16", sku: "MBP16", category: "laptop", stock: 12, price: 52000000},
        {name: "iPhone 14 Pro", sku: "IP14P", category: "phone", stock: 8, price: 28000000},
        {name: "Dell XPS 13", sku: "DX13", category: "laptop", stock: 5, price: 34000000},
    ];

    function renderProducts(list = products) {
        const tbody = document.getElementById("product-table-body");
        tbody.innerHTML = "";
        list.forEach((p, index) => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td class="px-4 py-2 font-bold">${p.name}</td>
                <td class="px-4 py-2">${p.sku}</td>
                <td class="px-4 py-2 capitalize">${p.category}</td>
                <td class="px-4 py-2">${p.stock}</td>
                <td class="px-4 py-2">₫${p.price.toLocaleString()}</td>
                <td class="px-4 py-2">
                    <button class="text-blue-600 hover:underline mr-2" onclick="editProduct(${index})">Sửa</button>
                    <button class="text-red-600 hover:underline" onclick="deleteProduct(${index})">Xóa</button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    function filterProducts() {
        const keyword = document.getElementById("product-search-input").value.toLowerCase();
        const category = document.getElementById("product-category-filter").value;
        const filtered = products.filter(p => {
            const matchKeyword = p.name.toLowerCase().includes(keyword) || p.sku.toLowerCase().includes(keyword);
            const matchCategory = category === "all" || p.category === category;
            return matchKeyword && matchCategory;
        });
        renderProducts(filtered);
    }

    // Modal
    function openProductModal(isEdit = false) {
        document.getElementById("product-modal").classList.remove("hidden");
        document.getElementById("modal-title").textContent = isEdit ? "Sửa sản phẩm" : "Thêm sản phẩm";
    }
    function closeProductModal() {
        document.getElementById("product-modal").classList.add("hidden");
        document.getElementById("product-form").reset();
        document.getElementById("edit-index").value = "";
    }

    function saveProduct(e) {
        e.preventDefault();
        const index = document.getElementById("edit-index").value;
        const newProduct = {
            name: document.getElementById("product-name").value,
            sku: document.getElementById("product-sku").value,
            category: document.getElementById("product-category").value,
            stock: parseInt(document.getElementById("product-stock").value),
            price: parseInt(document.getElementById("product-price").value),
        };

        if (index === "") products.push(newProduct);
        else products[index] = newProduct;

        renderProducts();
        closeProductModal();
    }

    function editProduct(index) {
        const p = products[index];
        document.getElementById("product-name").value = p.name;
        document.getElementById("product-sku").value = p.sku;
        document.getElementById("product-category").value = p.category;
        document.getElementById("product-stock").value = p.stock;
        document.getElementById("product-price").value = p.price;
        document.getElementById("edit-index").value = index;
        openProductModal(true);
    }

    function deleteProduct(index) {
        if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
            products.splice(index, 1);
            renderProducts();
        }
    }

    // Xuất Excel
    function exportExcel() {
        const ws_data = [["Tên sản phẩm","SKU","Danh mục","Tồn kho","Giá bán"]];
        products.forEach(p => ws_data.push([p.name,p.sku,p.category,p.stock,p.price]));
        const ws = XLSX.utils.aoa_to_sheet(ws_data);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Sản phẩm");
        XLSX.writeFile(wb, "san_pham.xlsx");
    }

    // In danh sách sản phẩm (tên sản phẩm in đậm)
    function printProducts() {
        let html = `<table border="1" cellpadding="8" cellspacing="0" style="border-collapse:collapse;width:100%">
            <tr>
                <th>Tên sản phẩm</th>
                <th>SKU</th>
                <th>Danh mục</th>
                <th>Tồn kho</th>
                <th>Giá bán</th>
            </tr>`;
        products.forEach(p => {
            html += `<tr>
                <td><b>${p.name}</b></td>
                <td>${p.sku}</td>
                <td>${p.category}</td>
                <td>${p.stock}</td>
                <td>₫${p.price.toLocaleString()}</td>
            </tr>`;
        });
        html += `</table>`;
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>In danh sách sản phẩm</title></head><body>');
        printWindow.document.write(html);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }

    renderProducts();
    </script>
</body>
</html>
