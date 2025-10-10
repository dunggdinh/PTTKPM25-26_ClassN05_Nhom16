<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý kho</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    .gradient-bg {
      background: linear-gradient(to right, #4f46e5, #6366f1);
    }
  </style>
</head>
<body class="bg-gray-100 p-6">

<!-- Giao diện tồn kho -->
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
    <!-- Bộ lọc -->
    <div class="flex flex-col md:flex-row md:items-center justify-between space-y-4 md:space-y-0 mb-6">
      <div class="flex flex-col md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-4">
        <div class="relative w-full md:w-64">
          <input type="text" placeholder="Tìm kiếm sản phẩm..." class="pl-10 pr-4 py-2 border rounded-lg w-full" id="inventory-search" onkeyup="renderInventory()">
          <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
        <select id="inventory-category-filter" class="border rounded-lg px-4 py-2 w-full md:w-auto" onchange="renderInventory()">
          <option value="all">Tất cả danh mục</option>
          <option value="laptop">Laptop</option>
          <option value="phone">Điện thoại</option>
        </select>
        <select id="inventory-status-filter" class="border rounded-lg px-4 py-2 w-full md:w-auto" onchange="renderInventory()">
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
        </tbody>
      </table>
    </div>

    <!-- Cảnh báo tồn kho -->
    <div id="stock-alerts" class="mt-6"></div>
  </div>
</div>

<!-- Giao diện nhập hàng -->
<div id="deliveries" class="section hidden">
  <div class="flex justify-between items-center mb-6">
    <div>
      <h2 class="text-2xl font-bold text-gray-800">Quản lý nhập hàng</h2>
      <p class="text-gray-600 mt-1">Theo dõi các lô hàng đang chờ nhập kho</p>
    </div>
    <button class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition" onclick="showSection('inventory')">
      <i class="fas fa-box mr-2"></i> Quay lại tồn kho
    </button>
  </div>

  <div class="bg-white rounded-lg shadow-md p-6">
    <p class="text-gray-500">👉 Đây là giao diện nhập hàng (bảng lô hàng sẽ đặt ở đây).</p>
  </div>
</div>

<script>
  let inventory = [
    {name: "MacBook Pro 16", sku: "MBP16", category: "laptop", stock: 12, minStock: 5},
    {name: "iPhone 14 Pro", sku: "IP14P", category: "phone", stock: 2, minStock: 5},
    {name: "Dell XPS 13", sku: "DX13", category: "laptop", stock: 0, minStock: 3},
  ];

  function renderInventory() {
    const tbody = document.getElementById("inventory-table-body");
    tbody.innerHTML = "";

    const keyword = document.getElementById("inventory-search").value.toLowerCase();
    const category = document.getElementById("inventory-category-filter").value;
    const status = document.getElementById("inventory-status-filter").value;

    const filtered = inventory.filter(p => {
      const matchKeyword = p.name.toLowerCase().includes(keyword) || p.sku.toLowerCase().includes(keyword);
      const matchCategory = category === "all" || p.category === category;

      let matchStatus = true;
      if (status === "instock") matchStatus = p.stock > p.minStock;
      if (status === "lowstock") matchStatus = p.stock > 0 && p.stock <= p.minStock;
      if (status === "outofstock") matchStatus = p.stock === 0;

      return matchKeyword && matchCategory && matchStatus;
    });

    if (filtered.length === 0) {
      tbody.innerHTML = `<tr><td colspan="7" class="text-center text-gray-400 py-4">Không tìm thấy sản phẩm</td></tr>`;
      return;
    }

    filtered.forEach((p, index) => {
      let statusText = "";
      let statusClass = "";
      if (p.stock === 0) {
        statusText = "Hết hàng"; statusClass = "text-red-600";
      } else if (p.stock <= p.minStock) {
        statusText = "Sắp hết"; statusClass = "text-yellow-600";
      } else {
        statusText = "Còn hàng"; statusClass = "text-green-600";
      }

      const tr = document.createElement("tr");
      tr.innerHTML = `
        <td class="px-4 py-2">${p.name}</td>
        <td class="px-4 py-2">${p.sku}</td>
        <td class="px-4 py-2">${p.category}</td>
        <td class="px-4 py-2">${p.stock}</td>
        <td class="px-4 py-2">${p.minStock}</td>
        <td class="px-4 py-2 font-semibold ${statusClass}">${statusText}</td>
        <td class="px-4 py-2">
          <button class="text-blue-600 hover:underline mr-2" onclick="adjustStock(${index}, 1)">+ Nhập</button>
          <button class="text-red-600 hover:underline" onclick="adjustStock(${index}, -1)">- Xuất</button>
        </td>
      `;
      tbody.appendChild(tr);
    });

    renderStockAlerts();
  }

  function adjustStock(index, delta) {
    inventory[index].stock = Math.max(0, inventory[index].stock + delta);
    renderInventory();
  }

  function renderStockAlerts() {
    const alertsDiv = document.getElementById("stock-alerts");
    alertsDiv.innerHTML = "";

    const lowStockItems = inventory.filter(p => p.stock <= p.minStock);

    if (lowStockItems.length > 0) {
      alertsDiv.innerHTML = `
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
          <h4 class="font-semibold text-yellow-700 mb-2">⚠️ Cảnh báo tồn kho thấp:</h4>
          <ul class="list-disc pl-5 text-yellow-800">
            ${lowStockItems.map(p => `<li>${p.name} (${p.sku}) - còn ${p.stock} sản phẩm</li>`).join("")}
          </ul>
        </div>
      `;
    }
  }

  function showSection(sectionId) {
    document.querySelectorAll(".section").forEach(sec => sec.classList.add("hidden"));
    document.getElementById(sectionId).classList.remove("hidden");
  }

  renderInventory();
</script>

</body>
</html>
