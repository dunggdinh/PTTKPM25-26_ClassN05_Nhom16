<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments Gateway</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    {{-- Gọi CSS riêng --}}
    <link rel="stylesheet" href="{{ asset('css/payments_gateway.css') }}">
</head>
<body class="bg-gray-50 font-sans">

    {{-- Nội dung giao diện --}}
    <div id="payments" class="section">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Cổng thanh toán</h2>
                <p class="text-gray-600 mt-1">Quản lý các giao dịch thanh toán của khách hàng</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mã giao dịch</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Khách hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Số tiền</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phương thức</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ngày thanh toán</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="payments-table-body">
                        {{-- dữ liệu sẽ được JS render --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Gọi JS riêng --}}
    <script src="{{ asset('js/payments_gateway.js') }}"></script>
</body>
</html>
