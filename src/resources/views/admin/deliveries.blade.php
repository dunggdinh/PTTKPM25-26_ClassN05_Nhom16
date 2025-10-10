<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhập hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

<div id="deliveries" class="section">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Quản lý nhập hàng</h2>
            <p class="text-gray-600 mt-1">Theo dõi các lô hàng đang chờ nhập kho</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left" id="deliveries-table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Mã đơn hàng</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Nhà cung cấp</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Sản phẩm</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Số lượng</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Ngày dự kiến nhận</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="deliveries-table-body">
                    <tr>
                        <td colspan="7" class="text-center text-gray-400 py-4">Chưa có lô hàng nào</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Dữ liệu tạm thời
    let pendingDeliveries = [
        { id: 1, orderCode: "DH001", supplier: "Công ty ABC", product: "Laptop Dell", quantity: 20, expectedDate: "2025-10-05" },
        { id: 2, orderCode: "DH002", supplier: "Công ty XYZ", product: "Điện thoại iPhone", quantity: 15, expectedDate: "2025-10-06" }
    ];

    let inventory = [
        { name: "Laptop Dell", currentStock: 50 },
        { name: "Điện thoại iPhone", currentStock: 30 }
    ];

    const showToast = (message) => alert(message);

    const renderDeliveries = () => {
        const tbody = document.getElementById('deliveries-table-body');
        tbody.innerHTML = '';

        if (pendingDeliveries.length === 0) {
            tbody.innerHTML = `<tr>
                <td colspan="7" class="text-center text-gray-400 py-4">Chưa có lô hàng nào</td>
            </tr>`;
            return;
        }

        pendingDeliveries.forEach(delivery => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-4 py-3">${delivery.orderCode}</td>
                <td class="px-4 py-3">${delivery.supplier}</td>
                <td class="px-4 py-3">${delivery.product}</td>
                <td class="px-4 py-3">${delivery.quantity}</td>
                <td class="px-4 py-3">${delivery.expectedDate}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-600">Chờ xử lý</span>
                </td>
                <td class="px-4 py-3 flex space-x-2">
                    <button onclick="handleConfirmDelivery(${delivery.id})" class="flex items-center px-3 py-1 bg-green-100 text-green-700 rounded hover:bg-green-200">
                        <i class="fas fa-check mr-1"></i> Xác nhận
                    </button>
                    <button onclick="handleRejectDelivery(${delivery.id})" class="flex items-center px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200">
                        <i class="fas fa-times mr-1"></i> Từ chối
                    </button>
                </td>
            `;
            tbody.appendChild(row);
        });
    };

    const handleConfirmDelivery = (id) => {
        const index = pendingDeliveries.findIndex(d => d.id === id);
        if (index !== -1) {
            const delivery = pendingDeliveries[index];
            const product = inventory.find(p => p.name === delivery.product);
            if (product) {
                product.currentStock += delivery.quantity;
                pendingDeliveries.splice(index, 1);
                showToast(`Đã nhập thành công ${delivery.quantity} sản phẩm ${delivery.product} vào kho.`);
            } else {
                showToast('Lỗi: Sản phẩm không tồn tại trong kho.');
            }
            renderDeliveries();
        }
    };

    const handleRejectDelivery = (id) => {
        const index = pendingDeliveries.findIndex(d => d.id === id);
        if (index !== -1) {
            pendingDeliveries.splice(index, 1);
            showToast('Đã từ chối lô hàng thành công.');
            renderDeliveries();
        }
    };

    renderDeliveries();
</script>

</body>
</html>
