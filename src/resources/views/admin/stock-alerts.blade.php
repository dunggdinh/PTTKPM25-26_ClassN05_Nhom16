<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cảnh báo hết hàng</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

<!-- Bảng cảnh báo hết hàng -->
<div id="stock-alerts" class="section">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Cảnh báo hết hàng</h2>
            <p class="text-gray-600 mt-1">Danh sách các sản phẩm cần nhập thêm vào kho</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left" id="stock-alerts-table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Tên sản phẩm</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">SKU</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Tồn kho hiện tại</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Tồn kho tối thiểu</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="stock-alerts-table-body">
                    <!-- JS sẽ render tại đây -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Nhập thêm -->
<div id="restock-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white rounded-2xl shadow-2xl w-96 p-6 transform transition-all duration-300 scale-95 opacity-0" id="restock-modal-card">
    <div class="flex items-center gap-3 mb-4">
      <i class="fa-solid fa-box-open text-2xl text-blue-600"></i>
      <h3 class="text-2xl font-bold text-gray-800">Nhập thêm sản phẩm</h3>
    </div>
    <div class="space-y-3">
      <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
        <p class="text-gray-500 text-sm font-medium">Tên sản phẩm</p>
        <p class="text-gray-800 font-semibold" id="modal-product-name"></p>
      </div>
      <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
        <p class="text-gray-500 text-sm font-medium">SKU</p>
        <p class="text-gray-800 font-semibold" id="modal-product-sku"></p>
      </div>
      <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
        <p class="text-gray-500 text-sm font-medium">Tồn kho hiện tại</p>
        <p class="text-gray-800 font-semibold" id="modal-product-stock"></p>
      </div>
      <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
        <p class="text-gray-500 text-sm font-medium">Tồn kho tối thiểu</p>
        <p class="text-gray-800 font-semibold" id="modal-product-minstock"></p>
      </div>
    </div>
    <form id="restock-form" class="mt-4">
      <label for="restock-quantity" class="block mb-2 text-gray-700 font-medium">Số lượng nhập thêm:</label>
      <input type="number" id="restock-quantity" min="1" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none mb-4" required>
      <div class="flex justify-end gap-3">
        <button type="button" id="cancel-restock" class="px-5 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition font-medium">Hủy</button>
        <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">Xác nhận</button>
      </div>
    </form>
  </div>
</div>

<!-- Toast notification -->
<div id="toast-notification" class="fixed bottom-6 right-6 bg-gray-800 text-white px-4 py-2 rounded shadow-lg opacity-0 transition-opacity duration-300">
    <span id="toast-message"></span>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const inventory = [
        { id: 1, name: 'MacBook Pro M3 14"', sku: 'MBP14-001', currentStock: 15, minStock: 5 },
        { id: 2, name: 'iPhone 15 Pro Max 256GB', sku: 'IP15PM-256', currentStock: 3, minStock: 10 },
        { id: 3, name: 'Dell XPS 13 Plus', sku: 'DL-XPS13P', currentStock: 8, minStock: 5 },
        { id: 4, name: 'Samsung Galaxy S24 Ultra', sku: 'SGS24U-512', currentStock: 2, minStock: 8 },
        { id: 5, name: 'ASUS ROG Strix G16', sku: 'ASUS-ROG-G16', currentStock: 12, minStock: 6 }
    ];

    const toast = document.getElementById('toast-notification');
    const toastMessage = document.getElementById('toast-message');
    const restockModal = document.getElementById('restock-modal');
    const restockCard = document.getElementById('restock-modal-card');
    let restockProductId = null;

    const showToast = (msg, duration = 3000) => {
        toastMessage.textContent = msg;
        toast.classList.add('opacity-100');
        setTimeout(() => toast.classList.remove('opacity-100'), duration);
    };

    const openModal = () => {
        restockModal.classList.remove('hidden');
        setTimeout(() => restockCard.classList.remove('scale-95', 'opacity-0'), 10);
    };

    const closeModal = () => {
        restockCard.classList.add('scale-95', 'opacity-0');
        setTimeout(() => restockModal.classList.add('hidden'), 200);
        restockProductId = null;
    };

    document.getElementById('cancel-restock').addEventListener('click', closeModal);

    const renderStockAlerts = () => {
        const tableBody = document.getElementById('stock-alerts-table-body');
        const lowStockProducts = inventory.filter(p => p.currentStock <= p.minStock);
        tableBody.innerHTML = lowStockProducts.map(p => {
            const statusClass = p.currentStock === 0 ? 'bg-red-100 text-red-800' : 'bg-orange-100 text-orange-800';
            const statusText = p.currentStock === 0 ? 'Hết hàng' : 'Sắp hết';
            return `
                <tr>
                    <td class="px-4 py-3 text-sm font-medium text-gray-900">${p.name}</td>
                    <td class="px-4 py-3 text-sm text-gray-500">${p.sku}</td>
                    <td class="px-4 py-3 text-sm text-gray-900">${p.currentStock}</td>
                    <td class="px-4 py-3 text-sm text-gray-900">${p.minStock}</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded text-sm font-semibold ${statusClass}">${statusText}</span></td>
                    <td class="px-4 py-3 text-sm font-medium">
                        <button class="text-blue-600 hover:text-blue-900 restock-btn" data-id="${p.id}">Nhập thêm</button>
                    </td>
                </tr>
            `; 
        }).join('');

        // Gắn sự kiện cho nút Nhập thêm
        document.querySelectorAll('.restock-btn').forEach(btn => {
            btn.addEventListener('click', e => {
                const productId = parseInt(e.currentTarget.dataset.id);
                const product = inventory.find(p => p.id === productId);
                if (!product) return;
                restockProductId = productId;
                document.getElementById('modal-product-name').textContent = product.name;
                document.getElementById('modal-product-sku').textContent = product.sku;
                document.getElementById('modal-product-stock').textContent = product.currentStock;
                document.getElementById('modal-product-minstock').textContent = product.minStock;
                document.getElementById('restock-quantity').value = 1;
                openModal();
            });
        });
    };

    document.getElementById('restock-form').addEventListener('submit', e => {
        e.preventDefault();
        const qty = parseInt(document.getElementById('restock-quantity').value);
        if (restockProductId !== null && qty > 0) {
            const product = inventory.find(p => p.id === restockProductId);
            if (product) {
                product.currentStock += qty;
                showToast(`Đã nhập thêm ${qty} sản phẩm "${product.name}" vào kho.`);
                renderStockAlerts();
            }
        }
        closeModal();
    });

    renderStockAlerts();
});
</script>

</body>
</html>
