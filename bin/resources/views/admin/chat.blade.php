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

<script>
document.addEventListener('DOMContentLoaded', () => {
    let selectedChat = null;

    const activeChats = [
        { id: 1, customerName: 'Nguyễn Văn Minh', status: 'active', lastMessage: 'Cho em hỏi sản phẩm này có bảo hành bao lâu ạ?', timestamp: '14:30', unread: 2, phone: '0901234567', email: 'minh.nv@email.com', messages: [
            { id: 1, sender: 'customer', message: 'Chào anh/chị!', time: '14:25' },
            { id: 2, sender: 'support', message: 'Chào bạn! Tôi có thể hỗ trợ gì cho bạn?', time: '14:26' },
            { id: 3, sender: 'customer', message: 'Em muốn hỏi về MacBook Pro M3 14" có sẵn không ạ?', time: '14:28' },
            { id: 4, sender: 'support', message: 'Dạ hiện tại chúng tôi có sẵn 15 máy trong kho. Bạn có muốn đặt hàng không?', time: '14:29' },
            { id: 5, sender: 'customer', message: 'Cho em hỏi sản phẩm này có bảo hành bao lâu ạ?', time: '14:30' }
        ]},
        { id: 2, customerName: 'Trần Thị Lan', status: 'waiting', lastMessage: 'Em cần hỗ trợ về việc trả hàng', timestamp: '14:15', unread: 1, phone: '0912345678', email: 'lan.tt@email.com', messages: [
            { id: 1, sender: 'customer', message: 'Chào shop!', time: '14:15' },
            { id: 2, sender: 'customer', message: 'Em cần hỗ trợ về việc trả hàng', time: '14:15' }
        ]},
        { id: 3, customerName: 'Lê Hoàng Nam', status: 'resolved', lastMessage: 'Cảm ơn anh đã hỗ trợ!', timestamp: '13:45', unread: 0, phone: '0923456789', email: 'nam.lh@email.com', messages: [
            { id: 1, sender: 'customer', message: 'Máy em mua hôm qua bị lỗi màn hình', time: '13:30' },
            { id: 2, sender: 'support', message: 'Bạn có thể mang máy đến cửa hàng để kiểm tra không?', time: '13:32' },
            { id: 3, sender: 'customer', message: 'Cảm ơn anh đã hỗ trợ!', time: '13:45' }
        ]}
    ];

    const renderChatList = () => {
        const chatList = document.getElementById('chat-list');
        if(activeChats.length === 0){
            chatList.innerHTML = '<div class="text-gray-500 text-center mt-4">Chưa có cuộc trò chuyện</div>';
            return;
        }
        chatList.innerHTML = activeChats.map(chat => `
            <div class="flex items-center p-3 my-2 cursor-pointer rounded-lg hover:bg-gray-200 transition-colors ${selectedChat && selectedChat.id === chat.id ? 'bg-gray-200' : ''}" onclick="selectChat(${chat.id})">
                <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-gray-700 font-bold text-lg mr-3">
                    ${chat.customerName.charAt(0)}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-center">
                        <h4 class="font-semibold truncate-text">${chat.customerName}</h4>
                        <span class="text-xs text-gray-500">${chat.timestamp}</span>
                    </div>
                    <p class="text-sm text-gray-600 truncate-text">${chat.lastMessage}</p>
                </div>
                ${chat.unread > 0 ? `<span class="bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center ml-2">${chat.unread}</span>` : ''}
            </div>
        `).join('');
    };

    const renderChatWindow = (chat) => {
        const chatWindow = document.getElementById('chat-window');
        if(!chat){
            chatWindow.innerHTML = `
                <div id="chat-placeholder" class="text-center text-gray-400 mt-20">
                    <i class="fas fa-comments text-6xl mb-4"></i>
                    <p class="text-lg">Chọn một cuộc trò chuyện để bắt đầu</p>
                </div>
            `;
            return;
        }
        chatWindow.innerHTML = `
            <div class="flex-shrink-0 border-b pb-4 mb-4">
                <h3 class="text-xl font-bold">${chat.customerName}</h3>
                <p class="text-sm text-gray-600">
                    <span class="mr-4"><i class="fas fa-phone mr-1"></i> ${chat.phone}</span>
                    <span><i class="fas fa-envelope mr-1"></i> ${chat.email}</span>
                </p>
            </div>
            <div id="messages-container" class="flex-1 overflow-y-auto space-y-4 mb-4">
                ${chat.messages.map(msg => `
                    <div class="flex ${msg.sender === 'support' ? 'justify-end' : 'justify-start'}">
                        <div class="px-4 py-2 rounded-lg ${msg.sender === 'support' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800'}">
                            ${msg.message}
                            <div class="text-right text-xs mt-1 opacity-70">${msg.time}</div>
                        </div>
                    </div>
                `).join('')}
            </div>
            <div class="flex-shrink-0 mt-4">
                <div class="flex items-center space-x-2">
                    <input type="text" id="chat-input" placeholder="Nhập tin nhắn..." class="flex-1 border rounded-full px-4 py-2">
                    <button id="send-btn" class="bg-blue-600 text-white rounded-full h-10 w-10 flex items-center justify-center hover:bg-blue-700">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        `;
        const container = document.getElementById('messages-container');
        container.scrollTop = container.scrollHeight;

        document.getElementById('send-btn').addEventListener('click', sendMessage);
        document.getElementById('chat-input').addEventListener('keypress', (e) => {
            if(e.key === 'Enter') sendMessage();
        });
    };

    window.selectChat = (chatId) => {
        selectedChat = activeChats.find(c => c.id === chatId);
        if(selectedChat) selectedChat.unread = 0;
        renderChatList();
        renderChatWindow(selectedChat);
    };

    const sendMessage = () => {
        const input = document.getElementById('chat-input');
        const messageText = input.value.trim();
        if(!messageText || !selectedChat) return;
        const now = new Date();
        const timeStr = now.getHours().toString().padStart(2,'0') + ':' + now.getMinutes().toString().padStart(2,'0');
        selectedChat.messages.push({ id: selectedChat.messages.length + 1, sender: 'support', message: messageText, time: timeStr });
        selectedChat.lastMessage = messageText;
        selectedChat.timestamp = timeStr;
        input.value = '';
        renderChatList();
        renderChatWindow(selectedChat);
    };

    renderChatList();
    renderChatWindow(selectedChat);
});
</script>

</body>
</html>
