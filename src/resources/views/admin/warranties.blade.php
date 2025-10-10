<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch hẹn bảo hành</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body class="bg-gray-100 p-6">

    <!-- Thông báo toast -->
    <div id="toast-notification" class="fixed bottom-6 right-6 bg-gray-800 text-white px-4 py-2 rounded shadow-lg opacity-0 transition-opacity duration-300 z-50">
        <span id="toast-message"></span>
    </div>

    <div id="warranties" class="section">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Lịch hẹn bảo hành</h2>
                <p class="text-gray-600 mt-1">Quản lý lịch hẹn bảo hành và sửa chữa sản phẩm</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tên khách hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sản phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vấn đề</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ngày hẹn</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kỹ thuật viên</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="warranties-table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const warrantySchedule = [
                { id: 1, customerName: 'Võ Thành Long', phone: '0967890123', product: 'MacBook Pro M3 14"', issue: 'Máy chạy chậm, quạt kêu to', appointmentDate: '2025-01-10', appointmentTime: '09:00', status: 'scheduled', technician: 'Nguyễn Văn Khoa' },
                { id: 2, customerName: 'Đặng Thị Hương', phone: '0978901234', product: 'iPhone 15 Pro Max', issue: 'Màn hình bị sọc', appointmentDate: '2025-01-12', appointmentTime: '14:00', status: 'completed', technician: 'Trần Văn Kiên' }
            ];

            const showToast = (message, duration = 3000) => {
                const toast = document.getElementById('toast-notification');
                document.getElementById('toast-message').textContent = message;
                toast.classList.remove('opacity-0');
                toast.classList.add('opacity-100');
                setTimeout(() => {
                    toast.classList.remove('opacity-100');
                    toast.classList.add('opacity-0');
                }, duration);
            };

            const renderWarranties = () => {
                const tableBody = document.getElementById('warranties-table-body');
                tableBody.innerHTML = warrantySchedule.map(req => {
                    const statusClass = req.status === 'scheduled' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800';
                    const statusText = req.status === 'scheduled' ? 'Đã lên lịch' : 'Đã hoàn thành';
                    return `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.customerName}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.product}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.issue}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.appointmentDate} ${req.appointmentTime}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${req.technician}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold ${statusClass}">${statusText}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 complete-btn" data-id="${req.id}" ${req.status === 'completed' ? 'disabled' : ''}>Hoàn thành</button>
                            </td>
                        </tr>
                    `;
                }).join('');

                document.querySelectorAll('.complete-btn').forEach(button => {
                    button.addEventListener('click', (e) => {
                        const id = parseInt(e.currentTarget.dataset.id);
                        const item = warrantySchedule.find(r => r.id === id);
                        if (item) {
                            item.status = 'completed';
                            showToast('Lịch hẹn đã được đánh dấu hoàn thành!');
                            renderWarranties();
                        }
                    });
                });
            };

            renderWarranties();

        });
    </script>

</body>
</html>
