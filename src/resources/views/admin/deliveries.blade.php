<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhập hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
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
                    <!-- Placeholder khi chưa có dữ liệu -->
                    <tr>
                        <td colspan="7" class="text-center text-gray-400 py-4">Chưa có lô hàng nào</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
