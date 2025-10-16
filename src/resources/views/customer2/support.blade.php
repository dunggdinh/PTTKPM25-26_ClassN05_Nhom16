<?php
echo '
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hỗ Trợ Khách Hàng - Cửa Hàng Điện Tử</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            box-sizing: border-box;
        }
        .chat-bubble {
            animation: slideIn 0.3s ease-out;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .typing-indicator {
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 1; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen font-sans">
    <main class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Trung Tâm Hỗ Trợ Khách Hàng</h1>
            <p class="text-gray-600">Chúng tôi luôn sẵn sàng hỗ trợ bạn 24/7</p>
        </header>

        <!-- Tab Navigation -->
        <nav class="flex bg-white rounded-xl shadow-lg mb-8 overflow-hidden border border-gray-100">
            <button id="chatTab" class="flex-1 py-5 px-8 bg-blue-600 text-white font-semibold transition-all duration-300 hover:bg-blue-700 relative">
                <span class="flex items-center justify-center space-x-2">
                    <span>💬</span>
                    <span>Chat Trực Tiếp</span>
                </span>
            </button>
            <button id="requestTab" class="flex-1 py-5 px-8 bg-gray-50 text-gray-700 font-semibold hover:bg-gray-100 transition-all duration-300 relative">
                <span class="flex items-center justify-center space-x-2">
                    <span>📝</span>
                    <span>Gửi Yêu Cầu</span>
                </span>
            </button>
        </nav>

        <!-- Chat Section -->
        <section id="chatSection" class="bg-white rounded-xl shadow-xl border border-gray-100">
            <div class="flex h-[700px]">
                <!-- Chat Area -->
                <div class="flex-1 flex flex-col">
                    <!-- Chat Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6 rounded-t-xl">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                                    <span class="text-xl">👨‍💼</span>
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
                    </div>

                    <!-- Messages Container -->
                    <div id="messagesContainer" class="flex-1 p-6 overflow-y-auto bg-gradient-to-b from-gray-50 to-white space-y-4">
                        <div class="chat-bubble flex items-start space-x-3">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm">
                                👨‍💼
                            </div>
                            <div class="bg-white p-3 rounded-lg shadow-sm max-w-xs">
                                <p class="text-gray-800">Xin chào! Tôi là Minh, tư vấn viên của cửa hàng. Tôi có thể hỗ trợ gì cho bạn hôm nay?</p>
                                <span class="text-xs text-gray-500 mt-1 block">10:30</span>
                            </div>
                        </div>
                    </div>

                    <!-- Chat Input -->
                    <div class="p-6 border-t border-gray-200 bg-white rounded-b-xl">
                        <form id="chatForm" class="flex space-x-4">
                            <input 
                                type="text" 
                                id="chatInput" 
                                placeholder="Nhập tin nhắn của bạn..."
                                class="flex-1 p-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                required
                            >
                            <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-4 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                                Gửi
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Quick Actions Sidebar -->
                <aside class="w-80 bg-gradient-to-b from-gray-50 to-gray-100 border-l border-gray-200 p-6">
                    <h4 class="font-bold text-gray-800 mb-6 text-lg">Hỗ Trợ Nhanh</h4>
                    <div class="space-y-3">
                        <button class="quick-action w-full text-left p-4 bg-white rounded-xl shadow-sm hover:shadow-lg hover:scale-105 transition-all duration-200 border border-gray-100" data-message="Tôi muốn kiểm tra tình trạng đơn hàng">
                            <div class="flex items-center space-x-3">
                                <span class="text-2xl">📦</span>
                                <span class="font-medium">Kiểm tra đơn hàng</span>
                            </div>
                        </button>
                        <button class="quick-action w-full text-left p-4 bg-white rounded-xl shadow-sm hover:shadow-lg hover:scale-105 transition-all duration-200 border border-gray-100" data-message="Tôi cần hỗ trợ đổi trả sản phẩm">
                            <div class="flex items-center space-x-3">
                                <span class="text-2xl">🔄</span>
                                <span class="font-medium">Đổi trả sản phẩm</span>
                            </div>
                        </button>
                        <button class="quick-action w-full text-left p-4 bg-white rounded-xl shadow-sm hover:shadow-lg hover:scale-105 transition-all duration-200 border border-gray-100" data-message="Tôi có vấn đề với thanh toán">
                            <div class="flex items-center space-x-3">
                                <span class="text-2xl">💳</span>
                                <span class="font-medium">Vấn đề thanh toán</span>
                            </div>
                        </button>
                        <button class="quick-action w-full text-left p-4 bg-white rounded-xl shadow-sm hover:shadow-lg hover:scale-105 transition-all duration-200 border border-gray-100" data-message="Tôi cần tư vấn sản phẩm">
                            <div class="flex items-center space-x-3">
                                <span class="text-2xl">🛍️</span>
                                <span class="font-medium">Tư vấn sản phẩm</span>
                            </div>
                        </button>
                        <button class="quick-action w-full text-left p-4 bg-white rounded-xl shadow-sm hover:shadow-lg hover:scale-105 transition-all duration-200 border border-gray-100" data-message="Tôi cần hỗ trợ kỹ thuật">
                            <div class="flex items-center space-x-3">
                                <span class="text-2xl">🔧</span>
                                <span class="font-medium">Hỗ trợ kỹ thuật</span>
                            </div>
                        </button>
                    </div>

                    <div class="mt-8 p-5 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                        <h5 class="font-bold text-blue-800 mb-4 text-lg">Liên Hệ Khác</h5>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center space-x-3 text-blue-700">
                                <span class="text-lg">☎️</span>
                                <span class="font-medium">Hotline: 1900-1234</span>
                            </div>
                            <div class="flex items-center space-x-3 text-blue-700">
                                <span class="text-lg">📧</span>
                                <span class="font-medium">Email: support@shop.com</span>
                            </div>
                            <div class="flex items-center space-x-3 text-blue-700">
                                <span class="text-lg">🕒</span>
                                <span class="font-medium">Giờ làm việc: 8:00 - 22:00</span>
                            </div>
                        </div>
                    </div>
                </aside>
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
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Mức độ ưu tiên *</label>
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
        // Tab switching functionality
        const chatTab = document.getElementById(\'chatTab\');
        const requestTab = document.getElementById(\'requestTab\');
        const chatSection = document.getElementById(\'chatSection\');
        const requestSection = document.getElementById(\'requestSection\');

        chatTab.addEventListener(\'click\', () => {
            chatTab.classList.add(\'bg-blue-600\', \'text-white\');
            chatTab.classList.remove(\'bg-gray-50\', \'text-gray-700\');
            requestTab.classList.add(\'bg-gray-50\', \'text-gray-700\');
            requestTab.classList.remove(\'bg-blue-600\', \'text-white\');
            
            chatSection.classList.remove(\'hidden\');
            requestSection.classList.add(\'hidden\');
        });

        requestTab.addEventListener(\'click\', () => {
            requestTab.classList.add(\'bg-blue-600\', \'text-white\');
            requestTab.classList.remove(\'bg-gray-50\', \'text-gray-700\');
            chatTab.classList.add(\'bg-gray-50\', \'text-gray-700\');
            chatTab.classList.remove(\'bg-blue-600\', \'text-white\');
            
            requestSection.classList.remove(\'hidden\');
            chatSection.classList.add(\'hidden\');
        });

        // Chat functionality
        const chatForm = document.getElementById(\'chatForm\');
        const chatInput = document.getElementById(\'chatInput\');
        const messagesContainer = document.getElementById(\'messagesContainer\');

        function addMessage(message, isUser = false) {
            const messageDiv = document.createElement(\'div\');
            messageDiv.className = \'chat-bubble flex items-start space-x-3\';
            
            if (isUser) {
                messageDiv.classList.add(\'flex-row-reverse\', \'space-x-reverse\');
            }

            const currentTime = new Date().toLocaleTimeString(\'vi-VN\', { 
                hour: \'2-digit\', 
                minute: \'2-digit\' 
            });

            messageDiv.innerHTML = `
                <div class="w-8 h-8 ${isUser ? \'bg-green-500\' : \'bg-blue-500\'} rounded-full flex items-center justify-center text-white text-sm">
                    ${isUser ? \'👤\' : \'👨‍💼\'}
                </div>
                <div class="bg-white p-3 rounded-lg shadow-sm max-w-xs">
                    <p class="text-gray-800">${message}</p>
                    <span class="text-xs text-gray-500 mt-1 block">${currentTime}</span>
                </div>
            `;

            messagesContainer.appendChild(messageDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function showTypingIndicator() {
            const typingDiv = document.createElement(\'div\');
            typingDiv.className = \'typing-indicator flex items-start space-x-3\';
            typingDiv.id = \'typingIndicator\';
            
            typingDiv.innerHTML = `
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm">
                    👨‍💼
                </div>
                <div class="bg-white p-3 rounded-lg shadow-sm">
                    <p class="text-gray-500">Đang nhập...</p>
                </div>
            `;

            messagesContainer.appendChild(typingDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function removeTypingIndicator() {
            const typingIndicator = document.getElementById(\'typingIndicator\');
            if (typingIndicator) {
                typingIndicator.remove();
            }
        }

        function getAutoResponse(userMessage) {
            const message = userMessage.toLowerCase();
            
            if (message.includes(\'đơn hàng\') || message.includes(\'kiểm tra\')) {
                return \'Để kiểm tra tình trạng đơn hàng, bạn vui lòng cung cấp mã đơn hàng. Mã đơn hàng thường có dạng DH + 6 số (VD: DH123456).\';
            } else if (message.includes(\'đổi\') || message.includes(\'trả\')) {
                return \'Chính sách đổi trả của chúng tôi: Sản phẩm có thể đổi trả trong 7 ngày, còn nguyên tem mác. Bạn có thể mang sản phẩm đến cửa hàng hoặc gửi qua đường bưu điện.\';
            } else if (message.includes(\'thanh toán\') || message.includes(\'payment\')) {
                return \'Chúng tôi hỗ trợ các hình thức thanh toán: Thẻ tín dụng, chuyển khoản ngân hàng, ví điện tử (MoMo, ZaloPay), và thanh toán khi nhận hàng (COD).\';
            } else if (message.includes(\'tư vấn\') || message.includes(\'sản phẩm\')) {
                return \'Tôi sẵn sàng tư vấn sản phẩm cho bạn! Bạn đang quan tâm đến loại sản phẩm nào? Điện thoại, laptop, phụ kiện hay thiết bị gia dụng?\';
            } else if (message.includes(\'kỹ thuật\') || message.includes(\'lỗi\')) {
                return \'Để hỗ trợ kỹ thuật tốt nhất, bạn vui lòng mô tả chi tiết vấn đề gặp phải và model sản phẩm. Tôi sẽ hướng dẫn bạn từng bước.\';
            } else {
                return \'Cảm ơn bạn đã liên hệ! Tôi đã ghi nhận thông tin và sẽ hỗ trợ bạn ngay. Bạn có thể cung cấp thêm chi tiết để tôi hỗ trợ tốt hơn không?\';
            }
        }

        chatForm.addEventListener(\'submit\', (e) => {
            e.preventDefault();
            const message = chatInput.value.trim();
            
            if (message) {
                addMessage(message, true);
                chatInput.value = \'\';
                
                showTypingIndicator();
                
                setTimeout(() => {
                    removeTypingIndicator();
                    const response = getAutoResponse(message);
                    addMessage(response);
                }, 1500 + Math.random() * 1000);
            }
        });

        // Quick action buttons
        document.querySelectorAll(\'.quick-action\').forEach(button => {
            button.addEventListener(\'click\', () => {
                const message = button.getAttribute(\'data-message\');
                chatInput.value = message;
                chatForm.dispatchEvent(new Event(\'submit\'));
            });
        });

        // Support form functionality
        const supportForm = document.getElementById(\'supportForm\');
        const successMessage = document.getElementById(\'successMessage\');
        const ticketId = document.getElementById(\'ticketId\');

        supportForm.addEventListener(\'submit\', (e) => {
            e.preventDefault();
            
            // Generate ticket ID
            const ticketNumber = \'SP\' + Date.now().toString().slice(-6);
            ticketId.textContent = ticketNumber;
            
            // Show success message
            successMessage.classList.remove(\'hidden\');
            supportForm.style.display = \'none\';
            
            // Scroll to success message
            successMessage.scrollIntoView({ behavior: \'smooth\' });
            
            // Reset form after 5 seconds
            setTimeout(() => {
                supportForm.reset();
                successMessage.classList.add(\'hidden\');
                supportForm.style.display = \'block\';
            }, 5000);
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement(\'script\');d.innerHTML="window.__CF$cv$params={r:\'98f5f8bce2160eeb\',t:\'MTc2MDYwMTA5Mi4wMDAwMDA=\'};var a=document.createElement(\'script\');a.nonce=\'\';a.src=\'/cdn-cgi/challenge-platform/scripts/jsd/main.js\';document.getElementsByTagName(\'head\')[0].appendChild(a);";b.getElementsByTagName(\'head\')[0].appendChild(d)}}if(document.body){var a=document.createElement(\'iframe\');a.height=1;a.width=1;a.style.position=\'absolute\';a.style.top=0;a.style.left=0;a.style.border=\'none\';a.style.visibility=\'hidden\';document.body.appendChild(a);if(\'loading\'!==document.readyState)c();else if(window.addEventListener)document.addEventListener(\'DOMContentLoaded\',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);\'loading\'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>

';
?>