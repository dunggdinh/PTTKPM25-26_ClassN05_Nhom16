<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Hỗ Trợ Khách Hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen font-sans">
<main class="container mx-auto px-4 py-8 max-w-7xl">

    <!-- Header -->
    <header class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Admin - Trung Tâm Hỗ Trợ Khách Hàng</h1>
        <p class="text-gray-600">Quản lý chat và yêu cầu hỗ trợ khách hàng</p>
    </header>

    <!-- Main Layout -->
    <div class="flex flex-col lg:flex-row gap-6">

        <!-- Left Column: Chat -->
        <section class="flex-1 bg-white rounded-xl shadow-xl border border-gray-100 flex flex-col h-[700px]">
            <!-- Chat Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6 rounded-t-xl flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        👨‍💼
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">Tư Vấn Viên Minh</h3>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <p class="text-sm text-blue-100">Đang trực tuyến</p>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-sm text-blue-100">Thời gian phản hồi</div>
                    <div class="text-lg font-semibold">~2 phút</div>
                </div>
            </div>

            <!-- Messages -->
            <div id="messagesContainer" class="flex-1 p-6 overflow-y-auto bg-gray-50 space-y-4">
                <div class="chat-bubble flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm">
                        👨‍💼
                    </div>
                    <div class="bg-white p-3 rounded-lg shadow-sm max-w-xs">
                        <p class="text-gray-800">Xin chào! Đây là giao diện quản lý chat cho Admin.</p>
                        <span class="text-xs text-gray-500 mt-1 block">10:30</span>
                    </div>
                </div>
            </div>

            <!-- Chat Input -->
            <div class="p-6 border-t border-gray-200 bg-white rounded-b-xl">
                <form id="adminChatForm" class="flex space-x-4">
                    <input type="text" id="adminChatInput" placeholder="Nhập tin nhắn..."
                           class="flex-1 p-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                    <button type="submit"
                            class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-4 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                        Gửi
                    </button>
                </form>
            </div>
        </section>

        <!-- Right Column: Support Requests / Quick Actions -->
        <aside class="w-full lg:w-80 bg-white rounded-xl shadow-xl border border-gray-100 p-6 flex flex-col">
            <h4 class="font-bold text-gray-800 mb-6 text-lg">Yêu Cầu Hỗ Trợ</h4>
            <div class="space-y-3 overflow-y-auto flex-1">
                <div class="p-4 bg-blue-50 rounded-xl border border-blue-100 flex justify-between items-center">
                    <div>
                        <p class="font-semibold">SP123456 - Nguyễn Văn A</p>
                        <p class="text-sm text-gray-600">Đơn hàng - Trung bình</p>
                    </div>
                    <button class="text-blue-600 font-semibold hover:underline">Xem</button>
                </div>
                <div class="p-4 bg-blue-50 rounded-xl border border-blue-100 flex justify-between items-center">
                    <div>
                        <p class="font-semibold">SP123457 - Trần Thị B</p>
                        <p class="text-sm text-gray-600">Thanh toán - Cao</p>
                    </div>
                    <button class="text-blue-600 font-semibold hover:underline">Xem</button>
                </div>
                <!-- Thêm yêu cầu khác tại đây -->
            </div>

            <div class="mt-6">
                <h4 class="font-bold text-gray-800 mb-3 text-lg">Hành Động Nhanh</h4>
                <button class="w-full text-left p-3 bg-white rounded-xl shadow-sm hover:shadow-lg hover:scale-105 transition-all duration-200 border border-gray-100 mb-2" data-message="Xử lý đơn hàng mới">
                    📦 Xử lý đơn hàng
                </button>
                <button class="w-full text-left p-3 bg-white rounded-xl shadow-sm hover:shadow-lg hover:scale-105 transition-all duration-200 border border-gray-100 mb-2" data-message="Hỗ trợ thanh toán">
                    💳 Hỗ trợ thanh toán
                </button>
                <button class="w-full text-left p-3 bg-white rounded-xl shadow-sm hover:shadow-lg hover:scale-105 transition-all duration-200 border border-gray-100 mb-2" data-message="Hỗ trợ kỹ thuật">
                    🔧 Hỗ trợ kỹ thuật
                </button>
            </div>
        </aside>
    </div>

</main>

<script>
    const adminChatForm = document.getElementById('adminChatForm');
    const adminChatInput = document.getElementById('adminChatInput');
    const messagesContainer = document.getElementById('messagesContainer');

    function addMessage(message, isAdmin = true) {
        const div = document.createElement('div');
        div.className = 'chat-bubble flex items-start space-x-3';
        if(isAdmin) div.classList.add('flex-row-reverse', 'space-x-reverse');

        const currentTime = new Date().toLocaleTimeString('vi-VN',{hour:'2-digit',minute:'2-digit'});

        div.innerHTML = `
            <div class="w-8 h-8 ${isAdmin?'bg-green-500':'bg-blue-500'} rounded-full flex items-center justify-center text-white text-sm">
                ${isAdmin?'👤':'👨‍💼'}
            </div>
            <div class="bg-white p-3 rounded-lg shadow-sm max-w-xs">
                <p class="text-gray-800">${message}</p>
                <span class="text-xs text-gray-500 mt-1 block">${currentTime}</span>
            </div>
        `;
        messagesContainer.appendChild(div);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    adminChatForm.addEventListener('submit', e => {
        e.preventDefault();
        const msg = adminChatInput.value.trim();
        if(msg){
            addMessage(msg, true);
            adminChatInput.value = '';
            // Auto-response demo
            setTimeout(() => {
                addMessage("Đây là phản hồi tự động từ khách hàng.", false);
            }, 1000 + Math.random()*1000);
        }
    });

    document.querySelectorAll('.quick-action').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            const msg = btn.getAttribute('data-message');
            adminChatInput.value = msg;
            adminChatForm.dispatchEvent(new Event('submit'));
        });
    });
</script>
</body>
</html>
