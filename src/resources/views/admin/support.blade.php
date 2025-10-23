@extends('admin.layout')
@section('title', 'Hỗ trợ khách hàng')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="chat-context"
    data-user-id="{{ auth()->user()->user_id }}"
    data-user-role="{{ auth()->user()->role ?? 'admin' }}">
</div>

<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">

        <!-- Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Trung Tâm Hỗ Trợ Khách Hàng</h1>
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
                            <h3 class="font-bold text-lg">Tư Vấn Viên</h3>
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
            <aside class="w-full lg:w-80 bg-white rounded-xl shadow-xl border border-gray-100 p-6 flex flex-col">
                <h4 class="font-bold text-gray-800 mb-6 text-lg">Yêu Cầu Hỗ Trợ</h4>

                <div class="space-y-3 overflow-y-auto flex-1">
                    @foreach ($tickets as $ticket)
                        <div class="p-4 bg-blue-50 rounded-xl border border-blue-100 flex justify-between items-center hover:bg-blue-100 transition-all">
                            <div>
                                <p class="font-semibold">{{ $ticket->ticket_id }} - {{ $ticket->name }}</p>
                                <p class="text-sm text-gray-600">
                                    {{ $ticket->issue_type }} - {{ $ticket->priority }}
                                </p>
                            </div>
                        </div>
                    @endforeach

                    @if($tickets->isEmpty())
                        <p class="text-gray-500 text-sm text-center">Chưa có yêu cầu hỗ trợ nào.</p>
                    @endif
                </div>
            </aside>
        </div>
    </main>
</div>

{{-- ✅ SCRIPT CHAT --}}
<script>
const CTX = document.getElementById('chat-context').dataset;
// const CONV_ID = Number(CTX.conversationId);
const CUR_USER_ID = String(CTX.userId);
const CUR_ROLE = CTX.userRole || 'admin';
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

const chatForm = document.getElementById('adminChatForm');
const chatInput = document.getElementById('adminChatInput');
const messagesContainer = document.getElementById('messagesContainer');

function escapeHTML(str) {
    return str.replaceAll('&','&amp;').replaceAll('<','&lt;')
              .replaceAll('>','&gt;').replaceAll('"','&quot;')
              .replaceAll("'","&#039;");
}

function bubbleHtml(msg) {
    // const isMine = String(msg.sender_id) === CUR_USER_ID;
    const isMine = msg.sender_role === 'admin';
    const side = isMine ? 'flex-row-reverse space-x-reverse' : '';
    const bg = isMine ? 'bg-green-500' : 'bg-blue-500';
    // const avatar = isMine ? '👨‍💼' : (msg.sender_role === 'customer' ? '👤' : '👨‍💼');
    const avatar = isMine ? '👨‍💼' : '👤';
    const time = new Date(msg.sent_at || Date.now()).toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' });

    return `
        <div class="chat-bubble flex items-start space-x-3 ${side}">
            <div class="w-8 h-8 ${bg} rounded-full flex items-center justify-center text-white text-sm">${avatar}</div>
            <p class="text-xs text-gray-500 mb-1 font-semibold">
                ${isMine ? 'Bạn' : (msg.sender?.name || 'Khách hàng')}
            </p>
            <div class="bg-white p-3 rounded-lg shadow-sm max-w-xs">
                <p class="text-gray-800 whitespace-pre-line">${escapeHTML(msg.content || '')}</p>
                <span class="text-xs text-gray-500 mt-1 block">${time}</span>
            </div>
        </div>
    `;
}
let lastMessageId = null;
async function loadMessages() {
    try {
        // const res = await fetch(`/admin/conversations/${CONV_ID}/messages`, {
        const res = await fetch(`/admin/support/messages`, {
            headers: { 'Accept': 'application/json' }
        });
        if (!res.ok) throw new Error(await res.text());
        const data = await res.json();

        if (!lastMessageId) {
            // lần đầu: tải toàn bộ
            data.forEach(m => messagesContainer.insertAdjacentHTML('beforeend', bubbleHtml(m)));
        } else {
            // newMessages.forEach(m => messagesContainer.insertAdjacentHTML('beforeend', bubbleHtml(m)));
            const newMessages = data.filter(m => 
                m.message_id > lastMessageId && String(m.sender_id) !== CUR_USER_ID
            );
            newMessages.forEach(m => messagesContainer.insertAdjacentHTML('beforeend', bubbleHtml(m)));
        }

        if (data.length > 0) {
            lastMessageId = data[data.length - 1].message_id;
        }

        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    } catch (err) {
        console.error('Load messages failed:', err);
    }
}
async function sendMessage(content) {
    try {
        // const res = await fetch(`/admin/conversations/${CONV_ID}/messages`, {
        const res = await fetch(`/admin/support/messages`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': CSRF
            },
            body: JSON.stringify({ content })
        });

        if (!res.ok) throw new Error(await res.text());
        const msg = await res.json();
        // ✅ Thêm dòng này để ngăn loadMessages() chèn lại cùng tin
        lastMessageId = msg.message_id;

        // ✅ Hiển thị tin nhắn mới ngay lập tức
        messagesContainer.insertAdjacentHTML('beforeend', bubbleHtml(msg));
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // ✅ Đồng bộ với bên customer (nếu có)
        // await loadMessages();

        return msg;
    } catch (err) {
        console.error('Send message failed:', err);
        throw err;
    }
}

chatForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const message = chatInput.value.trim();
    if (!message) return;
    chatInput.value = '';
    try { await sendMessage(message); } catch(err) { alert('Gửi thất bại'); }
});

document.addEventListener('DOMContentLoaded', () => {
    loadMessages();
    setInterval(loadMessages, 3000); // tự reload mỗi 3s
});


</script>
@endsection
