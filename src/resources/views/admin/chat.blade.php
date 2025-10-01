<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hỗ trợ trực tuyến</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body class="bg-gray-100 p-6">

<div id="chat" class="section">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Hỗ trợ trực tuyến</h2>
            <p class="text-gray-600 mt-1">Quản lý các cuộc trò chuyện với khách hàng</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md flex h-[700px]">
        <!-- Danh sách chat -->
        <div id="chat-list" class="w-1/3 border-r overflow-y-auto p-4">
            <!-- Danh sách các cuộc trò chuyện sẽ được hiển thị ở đây -->
            <div class="text-gray-500 text-center mt-4">Chưa có cuộc trò chuyện</div>
        </div>

        <!-- Cửa sổ chat -->
        <div id="chat-window" class="w-2/3 flex flex-col p-4 bg-gray-50">
            <div id="chat-placeholder" class="text-center text-gray-400 mt-20">
                <i class="fas fa-comments text-6xl mb-4"></i>
                <p class="text-lg">Chọn một cuộc trò chuyện để bắt đầu</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
