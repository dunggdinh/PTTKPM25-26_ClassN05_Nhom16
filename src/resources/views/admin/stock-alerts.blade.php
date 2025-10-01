<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cảnh báo hết hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body class="bg-gray-100 p-6">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>