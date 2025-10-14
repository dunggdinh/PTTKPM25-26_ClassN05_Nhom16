<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yêu cầu trả hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body class="bg-gray-100 p-6">

<div id="returns" class="section">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Yêu cầu trả hàng</h2>
            <p class="text-gray-600 mt-1">Quản lý các yêu cầu trả hàng từ khách hàng</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mã đơn hàng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tên khách hàng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sản phẩm</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lý do</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ngày yêu cầu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="returns-table-body">
                    <!-- Bảng sẽ được render bởi JS -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Toast thông báo -->
<div id="toast-notification" class="fixed bottom-6 right-6 bg-gray-800 text-white px-4 py-2 rounded shadow opacity-0 transition-opacity duration-300 z-50">
    <span id="toast-message"></span>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Dữ liệu mẫu cho yêu cầu trả hàng
    const returnRequests = [
        { id: 1, orderId: 'ORD-2025-0108-001', customerName: 'Phạm Văn Đức', product: 'iPhone 15 Pro Max 256GB', reason: 'Sản phẩm bị lỗi màn hình', requestDate: '2025-01-08', status: 'pending', refundAmount: 34000000 },
        { id: 2, orderId: 'ORD-2025-0107-003', customerName: 'Nguyễn Thị Mai', product: 'Dell XPS 13 Plus', reason: 'Không đúng mô tả', requestDate: '2025-01-07', status: 'approved', refundAmount: 28000000 },
        { id: 3, orderId: 'ORD-2025-0106-005', customerName: 'Hoàng Văn Tùng', product: 'Samsung Galaxy S24 Ultra', reason: 'Đổi ý không muốn mua', requestDate: '2025-01-06', status: 'rejected', refundAmount: 0 }
    ];

    const showToast = (message, duration = 3000) => {
        const toast = document.getElementById('toast-notification');
        document.getElementById('toast-message').textContent = message;
        toast.classList.add('opacity-100');
        setTimeout(() => toast.classList.remove('opacity-100'), duration);
    };

    const renderReturns = () => {
        const tableBody = document.getElementById('returns-table-body');
        tableBody.innerHTML = returnRequests.map(req => {
            let statusClass = '';
            let statusText = '';
            if (req.status === 'pending') { statusClass = 'bg-yellow-100 text-yellow-800'; statusText = 'Đang chờ'; }
            else if (req.status === 'approved') { statusClass = 'bg-green-100 text-green-800'; statusText = 'Đã duyệt'; }
            else { statusClass = 'bg-red-100 text-red-800'; statusText = 'Từ chối'; }

            return `
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">${req.orderId}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${req.customerName}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${req.product}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${req.reason}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${req.requestDate}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold ${statusClass}">${statusText}</span>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium">
                        ${req.status === 'pending' ? `
                            <button class="text-blue-600 hover:text-blue-900 mr-2 action-btn" data-id="${req.id}" data-action="approved">Duyệt</button>
                            <button class="text-red-600 hover:text-red-900 action-btn" data-id="${req.id}" data-action="rejected">Từ chối</button>
                        ` : ''}
                    </td>
                </tr>
            `;
        }).join('');

        document.querySelectorAll('.action-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const id = parseInt(e.currentTarget.dataset.id);
                const action = e.currentTarget.dataset.action;
                const req = returnRequests.find(r => r.id === id);
                if (req) {
                    req.status = action;
                    showToast(`Yêu cầu đã được ${action === 'approved' ? 'chấp nhận' : 'từ chối'}!`);
                    renderReturns();
                }
            });
        });
    };

    renderReturns();
});
</script>

</body>
</html>
