@extends('customer.layout')
@section('title', 'Hỗ trợ khách hàng')

<!-- @section('content') -->
<!-- <div class="bg-gradient-to-br from-blue-50 to-indigo-100"> -->
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="chat-context"
    data-conversation-id="{{ $conversation->conversation_id }}"
    data-user-id="{{ auth()->user()->user_id }}"
    data-user-role="{{ auth()->user()->role ?? 'customer' }}">
</div>
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header -->
        <header class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Trung Tâm Hỗ Trợ Khách Hàng</h1>
            <p class="text-gray-600">Chúng tôi luôn sẵn sàng hỗ trợ bạn 24/7</p>
            <p class="text-gray-600 font-bold">Hotline: 0852541711</p>
        </header>

        <!-- Tabs -->
        <div class="flex items-center gap-2 mb-6">
            <button id="chatTab" type="button"
                class="px-4 py-2 rounded-lg bg-blue-600 text-white font-medium shadow-sm">
                💬 Chat trực tuyến
            </button>
            <button id="requestTab" type="button"
                class="px-4 py-2 rounded-lg bg-gray-50 text-gray-700 border">
                📝 Gửi yêu cầu hỗ trợ
            </button>
        </div>

        <!-- Chat Section -->
        <section id="chatSection" class="bg-white rounded-xl shadow-xl border border-gray-100">
            <div class="flex h-[700px]">
                <div class="flex-1 flex flex-col">
                    <!-- Chat Header (ĐÃ BỎ Quick Actions trong header) -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6 rounded-t-xl">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                                    <span class="text-xl">👨‍💼</span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg">Tư vấn viên Minh</h3>
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
                    </div>

                    <!-- Messages -->
                    <div id="messagesContainer" class="flex-1 p-6 overflow-y-auto bg-gradient-to-b from-gray-50 to-white space-y-4">
                    </div>

                    <!-- Quick Actions (ĐÃ DI CHUYỂN XUỐNG ĐÂY) -->
                    <div id="quickActions" class="px-4 pb-2">
                        <div class="flex flex-wrap gap-2">
                            <button class="quick-action px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-full text-sm"
                                    data-message="Mình muốn kiểm tra tình trạng đơn DH123456">Kiểm tra đơn</button>
                            <button class="quick-action px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-full text-sm"
                                    data-message="Cho mình hỏi chính sách đổi trả như thế nào?">Đổi trả</button>
                            <button class="quick-action px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-full text-sm"
                                    data-message="Tư vấn giúp mình chọn điện thoại phù hợp">Tư vấn sản phẩm</button>
                            <button class="quick-action px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-full text-sm"
                                    data-message="Mình gặp lỗi kỹ thuật khi sử dụng sản phẩm">Lỗi kỹ thuật</button>
                        </div>
                    </div>

                    <!-- Chat Input -->
                    <div class="p-4 border-t border-gray-200 bg-white rounded-b-xl">
                        <form id="chatForm" class="flex items-center space-x-3">
                            <input 
                                type="text" 
                                id="chatInput" 
                                placeholder="Nhập tin nhắn của bạn... (Enter để gửi)"
                                class="flex-1 p-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                required autocomplete="off">
                            <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                                Gửi
                            </button>
                        </form>
                        <div class="text-xs text-gray-500 mt-2">Mẹo: Nhấn <span class="font-semibold">Shift + Enter</span> để xuống dòng.</div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Request Form Section -->
        <section id="requestSection" class="bg-white rounded-xl shadow-xl border border-gray-100 p-8 hidden">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">📝 Gửi Yêu Cầu Hỗ Trợ</h2>
                
                <form id="supportForm" class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="customerName" class="block text-sm font-medium text-gray-700 mb-2">Họ và tên *</label>
                            <input 
                                type="text" 
                                id="customerName" 
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required
                            >
                        </div>
                        <div>
                            <label for="customerEmail" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input 
                                type="email" 
                                id="customerEmail" 
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required
                            >
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="customerPhone" class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại</label>
                            <input 
                                type="tel" 
                                id="customerPhone" 
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                        </div>
                        <div>
                            <label for="orderNumber" class="block text-sm font-medium text-gray-700 mb-2">Mã đơn hàng (nếu có)</label>
                            <input 
                                type="text" 
                                id="orderNumber" 
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="VD: DH123456"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="issueType" class="block text-sm font-medium text-gray-700 mb-2">Loại vấn đề *</label>
                        <select 
                            id="issueType" 
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required
                        >
                            <option value="">Chọn loại vấn đề</option>
                            <option value="order">Vấn đề về đơn hàng</option>
                            <option value="product">Vấn đề về sản phẩm</option>
                            <option value="payment">Vấn đề thanh toán</option>
                            <option value="shipping">Vấn đề vận chuyển</option>
                            <option value="return">Đổi trả sản phẩm</option>
                            <option value="technical">Hỗ trợ kỹ thuật</option>
                            <option value="other">Khác</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mức độ ưu tiên *</label>
                        <div class="grid grid-cols-3 gap-3">
                            <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="priority" value="low" class="mr-2" required>
                                <span class="text-green-600">🟢 Thấp</span>
                            </label>
                            <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="priority" value="medium" class="mr-2" required>
                                <span class="text-yellow-600">🟡 Trung bình</span>
                            </label>
                            <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="priority" value="high" class="mr-2" required>
                                <span class="text-red-600">🔴 Cao</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Mô tả chi tiết vấn đề *</label>
                        <textarea 
                            id="description" 
                            rows="5" 
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Vui lòng mô tả chi tiết vấn đề bạn gặp phải..."
                            required
                        ></textarea>
                    </div>

                    <div class="flex justify-center">
                        <button 
                            type="submit" 
                            class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium text-lg"
                        >
                            📤 Gửi Yêu Cầu Hỗ Trợ
                        </button>
                    </div>
                </form>

                <!-- Success Message -->
                <div id="successMessage" class="hidden mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center">
                        <div class="text-green-600 text-2xl mr-3">✅</div>
                        <div>
                            <h3 class="text-green-800 font-semibold">Yêu cầu đã được gửi thành công!</h3>
                            <p class="text-green-700 mt-1">Chúng tôi sẽ phản hồi trong vòng 24 giờ. Mã yêu cầu của bạn: <span id="ticketId" class="font-mono font-bold"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        // ---------- Helpers ----------
        const escapeHTML = (str) => str
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');

        // ---------- Tabs ----------
        const chatTab = document.getElementById('chatTab');
        const requestTab = document.getElementById('requestTab');
        const chatSection = document.getElementById('chatSection');
        const requestSection = document.getElementById('requestSection');

        function switchTo(tab) {
            if (tab === 'chat') {
                chatTab.classList.add('bg-blue-600','text-white');
                chatTab.classList.remove('bg-gray-50','text-gray-700','border');
                requestTab.classList.add('bg-gray-50','text-gray-700','border');
                requestTab.classList.remove('bg-blue-600','text-white');
                chatSection.classList.remove('hidden');
                requestSection.classList.add('hidden');
            } else {
                requestTab.classList.add('bg-blue-600','text-white');
                requestTab.classList.remove('bg-gray-50','text-gray-700','border');
                chatTab.classList.add('bg-gray-50','text-gray-700','border');
                chatTab.classList.remove('bg-blue-600','text-white');
                requestSection.classList.remove('hidden');
                chatSection.classList.add('hidden');
            }
        }
        chatTab.addEventListener('click', () => switchTo('chat'));
        requestTab.addEventListener('click', () => switchTo('request'));

        // ---------- Chat ----------
        // const chatForm = document.getElementById('chatForm');
        // const chatInput = document.getElementById('chatInput');
        // const messagesContainer = document.getElementById('messagesContainer');

        // const LS_KEY = 'support_chat_messages_v1';

        // function addMessage(message, isUser = false, timeStr = null, save = true) {
        //     const msg = message.trim();
        //     if (!msg) return;

        //     const currentTime = timeStr || new Date().toLocaleTimeString('vi-VN',{hour:'2-digit',minute:'2-digit'});
        //     const wrapper = document.createElement('div');
        //     wrapper.className = 'chat-bubble flex items-start space-x-3 fade-in ' + (isUser ? 'flex-row-reverse space-x-reverse' : '');

        //     wrapper.innerHTML = `
        //         <div class="w-8 h-8 ${isUser ? 'bg-green-500' : 'bg-blue-500'} rounded-full flex items-center justify-center text-white text-sm"> ${isUser ? '👤' : '👨‍💼'} </div>
        //         <div class="bg-white p-3 rounded-lg shadow-sm max-w-xs">
        //             <p class="text-gray-800">${escapeHTML(msg)}</p>
        //             <span class="text-xs text-gray-500 mt-1 block">${currentTime}</span>
        //         </div>
        //     `;
        //     messagesContainer.appendChild(wrapper);
        //     messagesContainer.scrollTop = messagesContainer.scrollHeight;

        //     if (save) {
        //         const history = JSON.parse(localStorage.getItem(LS_KEY) || '[]');
        //         history.push({ message: msg, isUser, time: currentTime });
        //         localStorage.setItem(LS_KEY, JSON.stringify(history));
        //     }
        // }

        // function showTypingIndicator() {
        //     removeTypingIndicator();
        //     const typingDiv = document.createElement('div');
        //     typingDiv.className = 'typing-indicator flex items-start space-x-3';
        //     typingDiv.id = 'typingIndicator';
        //     typingDiv.innerHTML = `
        //         <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm">👨‍💼</div>
        //         <div class="bg-white p-3 rounded-lg shadow-sm">
        //             <p class="text-gray-500">Đang nhập...</p>
        //         </div>
        //     `;
        //     messagesContainer.appendChild(typingDiv);
        //     messagesContainer.scrollTop = messagesContainer.scrollHeight;
        // }
        // function removeTypingIndicator() {
        //     const el = document.getElementById('typingIndicator');
        //     if (el) el.remove();
        // }

        // // Auto-responder with DH pattern
        // function getAutoResponse(userMessage) {
        //     const message = userMessage.toLowerCase();

        //     // Detect order code DHxxxxxx
        //     const dhMatch = userMessage.toUpperCase().match(/DH(\d{6,})/);
        //     if (dhMatch) {
        //         const code = dhMatch[0];
        //         // Mock statuses
        //         const statuses = [
        //             'Đã tiếp nhận',
        //             'Đang xử lý tại kho',
        //             'Đã bàn giao cho đơn vị vận chuyển',
        //             'Đang vận chuyển',
        //             'Đang giao',
        //             'Giao thành công'
        //         ];
        //         const idx = parseInt(code.slice(-1)) % statuses.length;
        //         return `Tình trạng đơn ${code}: ${statuses[idx]}. Dự kiến giao trong 1-3 ngày làm việc. Bạn cần hỗ trợ gì thêm không?`;
        //     }

        //     if (message.includes('đơn hàng') || message.includes('kiểm tra')) {
        //         return 'Để kiểm tra tình trạng đơn hàng, bạn vui lòng cung cấp mã đơn hàng. Mã đơn thường có dạng DH + 6 số (VD: DH123456).';
        //     } else if (message.includes('đổi') || message.includes('trả')) {
        //         return 'Chính sách đổi trả: trong 7 ngày, còn nguyên tem mác & phụ kiện. Có thể mang tới cửa hàng hoặc gửi bưu điện.';
        //     } else if (message.includes('thanh toán') || message.includes('payment')) {
        //         return 'Hỗ trợ: Thẻ tín dụng/ghi nợ, chuyển khoản, ví MoMo/ZaloPay, và COD khi nhận hàng.';
        //     } else if (message.includes('tư vấn') || message.includes('sản phẩm')) {
        //         return 'Mình tư vấn ngay! Bạn quan tâm danh mục nào: điện thoại, laptop, phụ kiện hay gia dụng?';
        //     } else if (message.includes('kỹ thuật') || message.includes('lỗi')) {
        //         return 'Bạn mô tả chi tiết lỗi + model sản phẩm giúp mình nhé. Mình sẽ hướng dẫn từng bước khắc phục.';
        //     } else {
        //         return 'Cảm ơn bạn đã liên hệ! Bạn có thể cung cấp thêm chi tiết để mình hỗ trợ chính xác hơn không?';
        //     }
        // }

        // // Load history or seed greeting
        // function loadHistory() {
        //     messagesContainer.innerHTML = '';
        //     const history = JSON.parse(localStorage.getItem(LS_KEY) || '[]');
        //     if (history.length) {
        //         history.forEach(h => addMessage(h.message, h.isUser, h.time, false));
        //     } else {
        //         addMessage('Xin chào! Mình là Minh, tư vấn viên của cửa hàng. Mình có thể hỗ trợ gì cho bạn hôm nay?', false);
        //     }
        // }

        // // Submit handler
        // chatForm.addEventListener('submit', (e) => {
        //     e.preventDefault();
        //     const message = chatInput.value.trim();
        //     if (!message) return;

        //     addMessage(message, true);
        //     chatInput.value = '';

        //     showTypingIndicator();
        //     setTimeout(() => {
        //         removeTypingIndicator();
        //         const response = getAutoResponse(message);
        //         addMessage(response, false);
        //     }, 900 + Math.random() * 900);
        // });

        // // Shift+Enter newline; Enter submit
        // chatInput.addEventListener('keydown', (e) => {
        //     if (e.key === 'Enter' && !e.shiftKey) {
        //         e.preventDefault();
        //         chatForm.dispatchEvent(new Event('submit'));
        //     }
        // });

        // // Quick action buttons
        // document.querySelectorAll('.quick-action').forEach(btn => {
        //     btn.addEventListener('click', () => {
        //         const msg = btn.getAttribute('data-message') || '';
        //         chatInput.value = msg;
        //         chatForm.dispatchEvent(new Event('submit'));
        //     });
        // });
        const CTX = document.getElementById('chat-context').dataset;
        const CONV_ID = Number(CTX.conversationId);
        const CUR_USER_ID = String(CTX.userId);
        const CUR_ROLE = CTX.userRole || 'customer';
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;

        const chatForm = document.getElementById('chatForm');
        const chatInput = document.getElementById('chatInput');
        const messagesContainer = document.getElementById('messagesContainer');
        
        // function bubbleHtml(msg) {
        //     const isMine = String(msg.sender_id) === CUR_USER_ID;
        //     const side = isMine ? 'flex-row-reverse space-x-reverse' : '';
        //     const bg = isMine ? 'bg-green-500' : 'bg-blue-500';
        //     const avatar = isMine ? '👤' : (msg.sender_role === 'admin' ? '👨‍💼' : '👤');
        //     const time = new Date(msg.sent_at || Date.now()).toLocaleTimeString('vi-VN',{hour:'2-digit',minute:'2-digit'});
        //     return 
        //         <div class="chat-bubble flex items-start space-x-3 ${side}">
        //             <div class="w-8 h-8 ${bg} rounded-full flex items-center justify-center text-white text-sm">${avatar}</div>
        //             <div class="bg-white p-3 rounded-lg shadow-sm max-w-xs">
        //                 <p class="text-gray-800 whitespace-pre-line">${escapeHTML(msg.content || '')}</p>
        //                 <div class="bg-white p-3 rounded-lg shadow-sm max-w-xs">
        //             </div>
        //         </div>`;
        // }
        function bubbleHtml(msg) {
        // const isMine = String(msg.sender_id) === CUR_USER_ID;
        const isMine = msg.sender_role === 'customer';
        const side = isMine ? 'flex-row-reverse space-x-reverse' : '';
        const bg = isMine ? 'bg-green-500' : 'bg-blue-500';
        // const avatar = isMine ? '👤' : (msg.sender_role === 'admin' ? '👨‍💼' : '👤');
        const avatar = isMine ? '👤' : '👨‍💼';
        const time = new Date(msg.sent_at || Date.now()).toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' });
        return `
            <div class="chat-bubble flex items-start space-x-3 ${side}">
                <div class="w-8 h-8 ${bg} rounded-full flex items-center justify-center text-white text-sm">${avatar}</div>
                <div class="bg-white p-3 rounded-lg shadow-sm max-w-xs">
                    <p class="text-gray-800 whitespace-pre-line">${escapeHTML(msg.content || '')}</p>
                    <span class="text-xs text-gray-500 mt-1 block">${time}</span>
                </div>
            </div>`;
        }
        let lastMessageId = null;
        // async function loadMessages() {
        //     try {
        //         const res = await fetch(`/conversations/${CONV_ID}/messages`, { headers: { 'Accept':'application/json' }});
        //         if (!res.ok) throw new Error(await res.text());
        //         const data = await res.json();
        //         messagesContainer.innerHTML = '';
        //         data.forEach(m => messagesContainer.insertAdjacentHTML('beforeend', bubbleHtml(m)));
        //         messagesContainer.scrollTop = messagesContainer.scrollHeight;
        //     } catch (err) {
        //         console.error('Load failed', err);
        //     }
        // }
        async function loadMessages() {
            try {
                const res = await fetch(`/conversations/${CONV_ID}/messages`, {
                    headers: { 'Accept': 'application/json' }
                });
                if (!res.ok) throw new Error(await res.text());
                const data = await res.json();

        // Nếu chưa có message_id cuối cùng → hiển thị toàn bộ
                if (!lastMessageId) {
                    data.forEach(m => messagesContainer.insertAdjacentHTML('beforeend', bubbleHtml(m)));
                } else {
            // Nếu đã có, chỉ thêm tin mới thôi
                    const newMessages = data.filter(m => m.message_id > lastMessageId);
                    newMessages.forEach(m => messagesContainer.insertAdjacentHTML('beforeend', bubbleHtml(m)));
                }

        // Cập nhật message_id cuối cùng
                if (data.length > 0) {
                    lastMessageId = data[data.length - 1].message_id;
                }

                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            } catch (err) {
                console.error('Load messages failed:', err);
            }
        }

        // async function sendMessage(content) {
        //     const res = await fetch(`/conversations/${CONV_ID}/messages`, {
        //         method: 'POST',
        //         headers: {
        //             'Content-Type':'application/json',
        //             'Accept':'application/json',
        //             'X-CSRF-TOKEN': CSRF,
        //         },
        //         body: JSON.stringify({ content }),
        //     });
        //     if (!res.ok) throw new Error(await res.text());
        //     const msg = await res.json();
        //     messagesContainer.insertAdjacentHTML('beforeend', bubbleHtml(msg));
        //     messagesContainer.scrollTop = messagesContainer.scrollHeight;
        //     return msg;
        // }
        async function sendMessage(content) {
            const res = await fetch(`/conversations/${CONV_ID}/messages`, {
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

            messagesContainer.insertAdjacentHTML('beforeend', bubbleHtml(msg));
            messagesContainer.scrollTop = messagesContainer.scrollHeight;

    // ✅ đồng bộ ngay thay vì chờ 3s
            // await loadMessages();

            return msg;
        }
        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const message = chatInput.value.trim();
            if (!message) return;
            chatInput.value = '';
            try { await sendMessage(message); } catch (err) { alert('Gửi thất bại'); }
        });
        document.querySelectorAll('.quick-action').forEach(btn => {
            btn.addEventListener('click', async () => {
            const msg = btn.getAttribute('data-message');
            if (!msg) return;
            try { await sendMessage(msg); } catch (err) { alert('Gửi thất bại'); }
            });
        });
        // ---------- Support form ----------
        const supportForm = document.getElementById('supportForm');
        const successMessage = document.getElementById('successMessage');
        const ticketId = document.getElementById('ticketId');

        // supportForm.addEventListener('submit', (e) => {
        //     e.preventDefault();
            
        //     // Generate ticket ID
        //     const ticketNumber = 'SP' + Date.now().toString().slice(-6);
        //     ticketId.textContent = ticketNumber;
            
        //     // Show success message
        //     successMessage.classList.remove('hidden');
        //     supportForm.style.display = 'none';
            
        //     // Scroll to success message
        //     successMessage.scrollIntoView({ behavior: 'smooth' });

        //     // (Optional) push a chat note
        //     addMessage(`Mình đã tạo phiếu hỗ trợ ${ticketNumber} cho bạn. Bộ phận CSKH sẽ phản hồi trong 24h.`, false);

        //     // Reset form after 5 seconds
        //     setTimeout(() => {
        //         supportForm.reset();
        //         successMessage.classList.add('hidden');
        //         supportForm.style.display = 'block';
        //     }, 5000);
        // });
        supportForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const ticketNumber = 'SP' + Date.now().toString().slice(-6);
            ticketId.textContent = ticketNumber;

            successMessage.classList.remove('hidden');
            supportForm.style.display = 'none';
            successMessage.scrollIntoView({ behavior: 'smooth' });

            // Hiển thị 1 note tại client (không ghi DB)
            const note = {
                sender_id: 'system',
                sender_role: 'system',
                content: `Mình đã tạo phiếu hỗ trợ ${ticketNumber} cho bạn. Bộ phận CSKH sẽ phản hồi trong 24h.`,
                sent_at: new Date().toISOString()
            };
            messagesContainer.insertAdjacentHTML('beforeend', bubbleHtml(note));
            messagesContainer.scrollTop = messagesContainer.scrollHeight;

            setTimeout(() => {
                supportForm.reset();
                successMessage.classList.add('hidden');
                supportForm.style.display = 'block';
            }, 5000);
        });


        // ---------- Init ----------
        document.addEventListener('DOMContentLoaded', () => {
            // loadHistory();
            loadMessages();
            switchTo('chat');
        });
        document.addEventListener('DOMContentLoaded', () => {
            loadMessages();
            setInterval(loadMessages, 3000); // ✅ mỗi 3 giây tự cập nhật
        });
    </script>
</div>
@endsection
