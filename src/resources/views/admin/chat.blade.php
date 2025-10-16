<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Quản Lý Khách Hàng - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body class="bg-gray-50 h-full">

    <div class="flex h-full">
        <!-- Sidebar danh sách khách hàng -->
        <div class="w-80 bg-white border-r border-gray-200 flex flex-col">
            <!-- Header sidebar -->
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-3">Tin Nhắn Khách Hàng</h2>
                <div class="relative">
                    <input type="text" placeholder="Tìm kiếm khách hàng..." 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Danh sách khách hàng -->
            <div class="flex-1 overflow-y-auto chat-scroll" id="customerList">
                <!-- Khách hàng đang hoạt động -->
                <div class="customer-item p-4 border-b border-gray-100 cursor-pointer hover:bg-blue-50 bg-blue-50" onclick="selectCustomer(\'nguyen-van-a\')">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-medium">
                                NA
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full online-indicator"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-medium text-gray-900 truncate">Nguyễn Văn A</p>
                                <span class="text-xs text-gray-500">2 phút</span>
                            </div>
                            <p class="text-sm text-gray-500 truncate">Tôi muốn hỏi về sản phẩm...</p>
                            <div class="flex items-center mt-1">
                                <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full">Chưa trả lời</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="customer-item p-4 border-b border-gray-100 cursor-pointer hover:bg-gray-50" onclick="selectCustomer(\'tran-thi-b\')">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-medium">
                                TB
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-gray-400 border-2 border-white rounded-full"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-medium text-gray-900 truncate">Trần Thị B</p>
                                <span class="text-xs text-gray-500">1 giờ</span>
                            </div>
                            <p class="text-sm text-gray-500 truncate">Cảm ơn bạn đã hỗ trợ!</p>
                            <div class="flex items-center mt-1">
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Đã xử lý</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="customer-item p-4 border-b border-gray-100 cursor-pointer hover:bg-gray-50" onclick="selectCustomer(\'le-van-c\')">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-medium">
                                LC
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-yellow-400 border-2 border-white rounded-full"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-medium text-gray-900 truncate">Lê Văn C</p>
                                <span class="text-xs text-gray-500">3 giờ</span>
                            </div>
                            <p class="text-sm text-gray-500 truncate">Đơn hàng của tôi thế nào rồi?</p>
                            <div class="flex items-center mt-1">
                                <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">Đang xử lý</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Khu vực chat chính -->
        <div class="flex-1 flex flex-col">
            <!-- Header chat -->
            <div class="bg-white border-b border-gray-200 p-4" id="chatHeader">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-medium">
                                NA
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Nguyễn Văn A</h3>
                            <p class="text-sm text-green-600">Đang hoạt động</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100" onclick="showCustomerDetails()" title="Thông tin chi tiết">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                        <div class="relative">
                            <button class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100" onclick="toggleMenu()" title="Tùy chọn">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                </svg>
                            </button>
                            <!-- Menu dropdown -->
                            <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                                <div class="py-1">
                                    <button onclick="archiveChat()" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8l6 6 6-6"></path>
                                        </svg>
                                        Lưu trữ cuộc trò chuyện
                                    </button>
                                    <button onclick="blockCustomer()" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                        </svg>
                                        Chặn khách hàng
                                    </button>
                                    <button onclick="exportChat()" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Xuất cuộc trò chuyện
                                    </button>
                                    <hr class="my-1">
                                    <button onclick="clearChat()" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Xóa cuộc trò chuyện
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Khu vực tin nhắn -->
            <div class="flex-1 overflow-y-auto chat-scroll p-4 space-y-4" id="messagesArea">
                <!-- Tin nhắn từ khách hàng -->
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-medium">
                        NA
                    </div>
                    <div class="flex-1">
                        <div class="bg-gray-100 rounded-lg p-3 max-w-md">
                            <p class="text-gray-800">Xin chào! Tôi muốn hỏi về sản phẩm iPhone 15 Pro Max có còn hàng không ạ?</p>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">14:30</p>
                    </div>
                </div>

                <!-- Tin nhắn từ admin -->
                <div class="flex items-start space-x-3 justify-end">
                    <div class="flex-1 flex justify-end">
                        <div class="bg-blue-600 text-white rounded-lg p-3 max-w-md">
                            <p>Xin chào! Hiện tại shop vẫn còn hàng iPhone 15 Pro Max các màu. Bạn quan tâm màu nào ạ?</p>
                        </div>
                    </div>
                    <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center text-white text-sm font-medium">
                        AD
                    </div>
                </div>
                <div class="flex justify-end">
                    <p class="text-xs text-gray-500">14:32 ✓✓</p>
                </div>

                <!-- Tin nhắn từ khách hàng -->
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-medium">
                        NA
                    </div>
                    <div class="flex-1">
                        <div class="bg-gray-100 rounded-lg p-3 max-w-md">
                            <p class="text-gray-800">Tôi muốn màu Titan Tự Nhiên ạ. Giá bao nhiêu và có khuyến mãi gì không?</p>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">14:33</p>
                    </div>
                </div>
            </div>

            <!-- Khu vực nhập tin nhắn -->
            <div class="bg-white border-t border-gray-200 p-4">
                <!-- Thanh công cụ -->
                <div class="flex items-center space-x-2 mb-3">
                    <button class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100" onclick="insertQuickReply(\'greeting\')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2M7 4h10M7 4l-2 16h14L17 4M9 9v6m6-6v6"></path>
                        </svg>
                    </button>
                    <select class="text-sm border border-gray-300 rounded px-3 py-1" onchange="insertQuickReply(this.value)">
                        <option value="">Tin nhắn mẫu</option>
                        <option value="greeting">Chào mừng khách hàng</option>
                        <option value="product-info">Thông tin sản phẩm</option>
                        <option value="shipping">Thông tin vận chuyển</option>
                        <option value="thanks">Cảm ơn khách hàng</option>
                    </select>
                </div>

                <!-- Khung nhập tin nhắn -->
                <form onsubmit="sendMessage(event)" class="flex items-end space-x-3">
                    <div class="flex-1">
                        <textarea id="messageInput" 
                                  placeholder="Nhập tin nhắn..." 
                                  rows="2"
                                  class="w-full p-3 border border-gray-300 rounded-lg resize-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  onkeydown="handleKeyDown(event)"></textarea>
                    </div>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar thông tin khách hàng -->
        <div class="w-80 bg-white border-l border-gray-200 p-4" id="customerInfo">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Thông Tin Khách Hàng</h3>
            
            <div class="space-y-4">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white text-xl font-medium mx-auto mb-2">
                        NA
                    </div>
                    <h4 class="font-medium text-gray-900">Nguyễn Văn A</h4>
                    <p class="text-sm text-gray-500">Khách hàng VIP</p>
                </div>

                <div class="border-t pt-4">
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Email</label>
                            <p class="text-sm text-gray-600">nguyenvana@email.com</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Số điện thoại</label>
                            <p class="text-sm text-gray-600">0123 456 789</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Tổng đơn hàng</label>
                            <p class="text-sm text-gray-600">15 đơn hàng</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Tổng chi tiêu</label>
                            <p class="text-sm font-green-600 font-medium">45,500,000 VNĐ</p>
                        </div>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <h5 class="font-medium text-gray-700 mb-2">Đơn hàng gần đây</h5>
                    <div class="space-y-2">
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium">#DH001234</span>
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Hoàn thành</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">iPhone 15 Pro Max</p>
                            <p class="text-sm text-gray-500">29,990,000 VNĐ</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium">#DH001235</span>
                                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Đang giao</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">AirPods Pro 2</p>
                            <p class="text-sm text-gray-500">6,990,000 VNĐ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Dữ liệu tin nhắn mẫu
        const quickReplies = {
            greeting: "Xin chào! Cảm ơn bạn đã liên hệ với chúng tôi. Tôi có thể hỗ trợ gì cho bạn?",
            \'product-info\': "Sản phẩm này hiện đang có sẵn với đầy đủ các màu sắc. Bạn có muốn tôi gửi thông tin chi tiết không?",
            shipping: "Chúng tôi hỗ trợ giao hàng toàn quốc với thời gian 1-3 ngày làm việc. Phí ship chỉ từ 30,000 VNĐ.",
            thanks: "Cảm ơn bạn đã tin tưởng và mua sắm tại cửa hàng. Chúc bạn một ngày tốt lành!"
        };

        // Dữ liệu khách hàng
        const customers = {
            \'nguyen-van-a\': {
                name: \'Nguyễn Văn A\',
                avatar: \'NA\',
                color: \'bg-blue-500\',
                status: \'online\',
                email: \'nguyenvana@email.com\',
                phone: \'0123 456 789\',
                orders: 15,
                spent: \'45,500,000 VNĐ\',
                messages: [
                    { sender: \'customer\', text: \'Xin chào! Tôi muốn hỏi về sản phẩm iPhone 15 Pro Max có còn hàng không ạ?\', time: \'14:30\' },
                    { sender: \'admin\', text: \'Xin chào! Hiện tại shop vẫn còn hàng iPhone 15 Pro Max các màu. Bạn quan tâm màu nào ạ?\', time: \'14:32\' },
                    { sender: \'customer\', text: \'Tôi muốn màu Titan Tự Nhiên ạ. Giá bao nhiêu và có khuyến mãi gì không?\', time: \'14:33\' }
                ]
            },
            \'tran-thi-b\': {
                name: \'Trần Thị B\',
                avatar: \'TB\',
                color: \'bg-purple-500\',
                status: \'offline\',
                email: \'tranthib@email.com\',
                phone: \'0987 654 321\',
                orders: 8,
                spent: \'22,300,000 VNĐ\',
                messages: [
                    { sender: \'customer\', text: \'Chào shop! Tôi muốn đổi sản phẩm đã mua hôm qua được không?\', time: \'13:15\' },
                    { sender: \'admin\', text: \'Chào bạn! Shop hỗ trợ đổi trả trong 7 ngày. Bạn có thể mang sản phẩm và hóa đơn đến shop nhé.\', time: \'13:20\' },
                    { sender: \'customer\', text: \'Cảm ơn bạn đã hỗ trợ!\', time: \'13:25\' }
                ]
            },
            \'le-van-c\': {
                name: \'Lê Văn C\',
                avatar: \'LC\',
                color: \'bg-green-500\',
                status: \'away\',
                email: \'levanc@email.com\',
                phone: \'0369 258 147\',
                orders: 3,
                spent: \'8,900,000 VNĐ\',
                messages: [
                    { sender: \'customer\', text: \'Đơn hàng của tôi thế nào rồi?\', time: \'11:45\' },
                    { sender: \'admin\', text: \'Đơn hàng #DH001235 của bạn đang được giao. Dự kiến nhận hàng trong hôm nay.\', time: \'11:50\' },
                    { sender: \'customer\', text: \'Ok cảm ơn bạn!\', time: \'11:52\' }
                ]
            }
        };

        let currentCustomer = \'nguyen-van-a\';

        // Chọn khách hàng
        function selectCustomer(customerId) {
            // Xóa highlight cũ
            document.querySelectorAll(\'.customer-item\').forEach(item => {
                item.classList.remove(\'bg-blue-50\');
            });
            
            // Highlight khách hàng được chọn
            event.currentTarget.classList.add(\'bg-blue-50\');
            
            // Cập nhật khách hàng hiện tại
            currentCustomer = customerId;
            
            // Cập nhật giao diện
            updateChatInterface(customerId);
        }

        // Cập nhật giao diện chat
        function updateChatInterface(customerId) {
            const customer = customers[customerId];
            if (!customer) return;

            // Cập nhật header chat
            const chatHeader = document.getElementById(\'chatHeader\');
            const statusText = customer.status === \'online\' ? \'Đang hoạt động\' : 
                              customer.status === \'away\' ? \'Vắng mặt\' : \'Không hoạt động\';
            const statusColor = customer.status === \'online\' ? \'text-green-600\' : 
                               customer.status === \'away\' ? \'text-yellow-600\' : \'text-gray-500\';
            
            chatHeader.innerHTML = `
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="w-10 h-10 ${customer.color} rounded-full flex items-center justify-center text-white font-medium">
                                ${customer.avatar}
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-3 h-3 ${customer.status === \'online\' ? \'bg-green-500\' : customer.status === \'away\' ? \'bg-yellow-400\' : \'bg-gray-400\'} border-2 border-white rounded-full"></div>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">${customer.name}</h3>
                            <p class="text-sm ${statusColor}">${statusText}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100" onclick="showCustomerDetails()" title="Thông tin chi tiết">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                        <div class="relative">
                            <button class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100" onclick="toggleMenu()" title="Tùy chọn">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                </svg>
                            </button>
                            <!-- Menu dropdown -->
                            <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                                <div class="py-1">
                                    <button onclick="archiveChat()" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8l6 6 6-6"></path>
                                        </svg>
                                        Lưu trữ cuộc trò chuyện
                                    </button>
                                    <button onclick="blockCustomer()" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                        </svg>
                                        Chặn khách hàng
                                    </button>
                                    <button onclick="exportChat()" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Xuất cuộc trò chuyện
                                    </button>
                                    <hr class="my-1">
                                    <button onclick="clearChat()" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Xóa cuộc trò chuyện
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Cập nhật tin nhắn
            const messagesArea = document.getElementById(\'messagesArea\');
            messagesArea.innerHTML = \'\';
            
            customer.messages.forEach(message => {
                const messageDiv = document.createElement(\'div\');
                
                if (message.sender === \'admin\') {
                    messageDiv.innerHTML = `
                        <div class="flex items-start space-x-3 justify-end">
                            <div class="flex-1 flex justify-end">
                                <div class="bg-blue-600 text-white rounded-lg p-3 max-w-md">
                                    <p>${message.text}</p>
                                </div>
                            </div>
                            <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center text-white text-sm font-medium">
                                AD
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <p class="text-xs text-gray-500">${message.time} ✓✓</p>
                        </div>
                    `;
                } else {
                    messageDiv.innerHTML = `
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 ${customer.color} rounded-full flex items-center justify-center text-white text-sm font-medium">
                                ${customer.avatar}
                            </div>
                            <div class="flex-1">
                                <div class="bg-gray-100 rounded-lg p-3 max-w-md">
                                    <p class="text-gray-800">${message.text}</p>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">${message.time}</p>
                            </div>
                        </div>
                    `;
                }
                
                messagesArea.appendChild(messageDiv);
            });

            // Cập nhật thông tin khách hàng
            const customerInfo = document.getElementById(\'customerInfo\');
            customerInfo.innerHTML = `
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Thông Tin Khách Hàng</h3>
                
                <div class="space-y-4">
                    <div class="text-center">
                        <div class="w-16 h-16 ${customer.color} rounded-full flex items-center justify-center text-white text-xl font-medium mx-auto mb-2">
                            ${customer.avatar}
                        </div>
                        <h4 class="font-medium text-gray-900">${customer.name}</h4>
                        <p class="text-sm text-gray-500">Khách hàng ${customer.orders > 10 ? \'VIP\' : \'Thường\'}</p>
                    </div>

                    <div class="border-t pt-4">
                        <div class="space-y-3">
                            <div>
                                <label class="text-sm font-medium text-gray-700">Email</label>
                                <p class="text-sm text-gray-600">${customer.email}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Số điện thoại</label>
                                <p class="text-sm text-gray-600">${customer.phone}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Tổng đơn hàng</label>
                                <p class="text-sm text-gray-600">${customer.orders} đơn hàng</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Tổng chi tiêu</label>
                                <p class="text-sm font-green-600 font-medium">${customer.spent}</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <h5 class="font-medium text-gray-700 mb-2">Đơn hàng gần đây</h5>
                        <div class="space-y-2">
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium">#DH001234</span>
                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Hoàn thành</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">iPhone 15 Pro Max</p>
                                <p class="text-sm text-gray-500">29,990,000 VNĐ</p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium">#DH001235</span>
                                    <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Đang giao</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">AirPods Pro 2</p>
                                <p class="text-sm text-gray-500">6,990,000 VNĐ</p>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Cuộn xuống cuối tin nhắn
            messagesArea.scrollTop = messagesArea.scrollHeight;
        }

        // Gửi tin nhắn
        function sendMessage(event) {
            event.preventDefault();
            
            const messageInput = document.getElementById(\'messageInput\');
            const message = messageInput.value.trim();
            
            if (!message) return;
            
            // Thêm tin nhắn vào dữ liệu khách hàng
            const currentTime = new Date().toLocaleTimeString(\'vi-VN\', {
                hour: \'2-digit\',
                minute: \'2-digit\'
            });
            
            customers[currentCustomer].messages.push({
                sender: \'admin\',
                text: message,
                time: currentTime
            });
            
            // Thêm tin nhắn vào giao diện
            addMessage(message, \'admin\');
            
            // Xóa nội dung input
            messageInput.value = \'\';
            
            // Mô phỏng phản hồi tự động (demo)
            setTimeout(() => {
                const responses = [
                    "Cảm ơn bạn! Tôi sẽ kiểm tra và phản hồi ngay.",
                    "Ok, tôi hiểu rồi. Cảm ơn bạn!",
                    "Được rồi, tôi sẽ làm theo hướng dẫn của bạn.",
                    "Cảm ơn bạn đã hỗ trợ nhiệt tình!"
                ];
                const randomResponse = responses[Math.floor(Math.random() * responses.length)];
                
                const responseTime = new Date().toLocaleTimeString(\'vi-VN\', {
                    hour: \'2-digit\',
                    minute: \'2-digit\'
                });
                
                customers[currentCustomer].messages.push({
                    sender: \'customer\',
                    text: randomResponse,
                    time: responseTime
                });
                
                addMessage(randomResponse, \'customer\');
            }, 1500);
        }

        // Thêm tin nhắn vào giao diện
        function addMessage(text, sender) {
            const messagesArea = document.getElementById(\'messagesArea\');
            const messageDiv = document.createElement(\'div\');
            messageDiv.className = \'message-animation\';
            
            const currentTime = new Date().toLocaleTimeString(\'vi-VN\', {
                hour: \'2-digit\',
                minute: \'2-digit\'
            });
            
            const customer = customers[currentCustomer];
            
            if (sender === \'admin\') {
                messageDiv.innerHTML = `
                    <div class="flex items-start space-x-3 justify-end">
                        <div class="flex-1 flex justify-end">
                            <div class="bg-blue-600 text-white rounded-lg p-3 max-w-md">
                                <p>${text}</p>
                            </div>
                        </div>
                        <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center text-white text-sm font-medium">
                            AD
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <p class="text-xs text-gray-500">${currentTime} ✓✓</p>
                    </div>
                `;
            } else {
                messageDiv.innerHTML = `
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 ${customer.color} rounded-full flex items-center justify-center text-white text-sm font-medium">
                            ${customer.avatar}
                        </div>
                        <div class="flex-1">
                            <div class="bg-gray-100 rounded-lg p-3 max-w-md">
                                <p class="text-gray-800">${text}</p>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">${currentTime}</p>
                        </div>
                    </div>
                `;
            }
            
            messagesArea.appendChild(messageDiv);
            messagesArea.scrollTop = messagesArea.scrollHeight;
        }

        // Chèn tin nhắn mẫu
        function insertQuickReply(type) {
            if (type && quickReplies[type]) {
                document.getElementById(\'messageInput\').value = quickReplies[type];
            }
        }

        // Xử lý phím tắt
        function handleKeyDown(event) {
            if (event.key === \'Enter\' && !event.shiftKey) {
                event.preventDefault();
                sendMessage(event);
            }
        }

        // Hiển thị thông tin chi tiết khách hàng
        function showCustomerDetails() {
            const customer = customers[currentCustomer];
            
            // Tạo modal popup
            const modal = document.createElement(\'div\');
            modal.className = \'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50\';
            modal.innerHTML = `
                <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Thông tin chi tiết</h3>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="text-center mb-4">
                        <div class="w-20 h-20 ${customer.color} rounded-full flex items-center justify-center text-white text-2xl font-medium mx-auto mb-3">
                            ${customer.avatar}
                        </div>
                        <h4 class="text-xl font-medium text-gray-900">${customer.name}</h4>
                        <p class="text-sm text-gray-500">Khách hàng ${customer.orders > 10 ? \'VIP\' : \'Thường\'}</p>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-700">Email:</span>
                            <span class="text-sm text-gray-600">${customer.email}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-700">Số điện thoại:</span>
                            <span class="text-sm text-gray-600">${customer.phone}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-700">Tổng đơn hàng:</span>
                            <span class="text-sm text-gray-600">${customer.orders} đơn</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-700">Tổng chi tiêu:</span>
                            <span class="text-sm font-medium text-green-600">${customer.spent}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-700">Trạng thái:</span>
                            <span class="text-sm ${customer.status === \'online\' ? \'text-green-600\' : customer.status === \'away\' ? \'text-yellow-600\' : \'text-gray-500\'}">
                                ${customer.status === \'online\' ? \'Đang hoạt động\' : customer.status === \'away\' ? \'Vắng mặt\' : \'Không hoạt động\'}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex space-x-3">
                        <button onclick="callCustomer()" class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Gọi điện
                        </button>
                        <button onclick="emailCustomer()" class="flex-1 bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Gửi email
                        </button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            
            // Đóng modal khi click bên ngoài
            modal.addEventListener(\'click\', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
        }
        
        // Đóng modal
        function closeModal() {
            const modal = document.querySelector(\'.fixed.inset-0\');
            if (modal) {
                document.body.removeChild(modal);
            }
        }
        
        // Gọi điện cho khách hàng
        function callCustomer() {
            const customer = customers[currentCustomer];
            alert(`Đang gọi điện cho ${customer.name} - ${customer.phone}`);
            closeModal();
        }
        
        // Gửi email cho khách hàng
        function emailCustomer() {
            const customer = customers[currentCustomer];
            window.open(`mailto:${customer.email}?subject=Liên hệ từ cửa hàng&body=Xin chào ${customer.name},`, \'_blank\');
            closeModal();
        }

        // Toggle menu dropdown
        function toggleMenu() {
            const menu = document.getElementById(\'dropdownMenu\');
            if (menu) {
                menu.classList.toggle(\'hidden\');
            }
        }

        // Đóng menu khi click bên ngoài
        document.addEventListener(\'click\', function(event) {
            const menu = document.getElementById(\'dropdownMenu\');
            if (!menu) return;
            
            const menuButton = event.target.closest(\'[onclick*="toggleMenu"]\');
            
            if (!menuButton && !menu.contains(event.target)) {
                menu.classList.add(\'hidden\');
            }
        });

        // Lưu trữ cuộc trò chuyện
        function archiveChat() {
            const customer = customers[currentCustomer];
            
            // Hiển thị thông báo thành công
            showNotification(`Đã lưu trữ cuộc trò chuyện với ${customer.name}`, \'success\');
            
            // Đánh dấu cuộc trò chuyện đã được lưu trữ
            customer.archived = true;
            
            // Đóng menu
            const menu = document.getElementById(\'dropdownMenu\');
            if (menu) menu.classList.add(\'hidden\');
        }

        // Chặn khách hàng
        function blockCustomer() {
            const customer = customers[currentCustomer];
            
            // Hiển thị modal xác nhận
            const confirmModal = document.createElement(\'div\');
            confirmModal.className = \'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50\';
            confirmModal.innerHTML = `
                <div class="bg-white rounded-lg p-6 max-w-sm w-full mx-4">
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Chặn khách hàng</h3>
                        <p class="text-sm text-gray-500 mb-6">Bạn có chắc chắn muốn chặn khách hàng <strong>${customer.name}</strong>? Họ sẽ không thể gửi tin nhắn nữa.</p>
                        <div class="flex space-x-3">
                            <button onclick="cancelBlock()" class="flex-1 bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400">
                                Hủy
                            </button>
                            <button onclick="confirmBlock()" class="flex-1 bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700">
                                Chặn
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(confirmModal);
            
            // Đóng menu
            const menu = document.getElementById(\'dropdownMenu\');
            if (menu) menu.classList.add(\'hidden\');
        }

        // Hủy chặn khách hàng
        function cancelBlock() {
            const modal = document.querySelector(\'.fixed.inset-0\');
            if (modal) document.body.removeChild(modal);
        }

        // Xác nhận chặn khách hàng
        function confirmBlock() {
            const customer = customers[currentCustomer];
            customer.blocked = true;
            
            showNotification(`Đã chặn khách hàng ${customer.name}`, \'error\');
            
            // Đóng modal
            const modal = document.querySelector(\'.fixed.inset-0\');
            if (modal) document.body.removeChild(modal);
        }

        // Xuất cuộc trò chuyện
        function exportChat() {
            const customer = customers[currentCustomer];
            
            try {
                let chatContent = `CUỘC TRÒ CHUYỆN VỚI KHÁCH HÀNG\n`;
                chatContent += `=====================================\n\n`;
                chatContent += `Tên khách hàng: ${customer.name}\n`;
                chatContent += `Email: ${customer.email}\n`;
                chatContent += `Số điện thoại: ${customer.phone}\n`;
                chatContent += `Tổng đơn hàng: ${customer.orders}\n`;
                chatContent += `Tổng chi tiêu: ${customer.spent}\n`;
                chatContent += `Thời gian xuất: ${new Date().toLocaleString(\'vi-VN\')}\n\n`;
                chatContent += `NỘI DUNG TIN NHẮN:\n`;
                chatContent += `=====================================\n\n`;
                
                customer.messages.forEach((message, index) => {
                    const sender = message.sender === \'admin\' ? \'ADMIN\' : customer.name.toUpperCase();
                    chatContent += `${index + 1}. [${message.time}] ${sender}:\n`;
                    chatContent += `   ${message.text}\n\n`;
                });
                
                // Tạo file và download
                const blob = new Blob([chatContent], { type: \'text/plain;charset=utf-8\' });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement(\'a\');
                a.href = url;
                a.download = `Chat_${customer.name.replace(/\s+/g, \'_\')}_${new Date().toISOString().split(\'T\')[0]}.txt`;
                a.style.display = \'none\';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
                
                showNotification(\'Đã xuất cuộc trò chuyện thành công!\', \'success\');
                
            } catch (error) {
                showNotification(\'Có lỗi khi xuất cuộc trò chuyện!\', \'error\');
            }
            
            // Đóng menu
            const menu = document.getElementById(\'dropdownMenu\');
            if (menu) menu.classList.add(\'hidden\');
        }

        // Xóa cuộc trò chuyện
        function clearChat() {
            const customer = customers[currentCustomer];
            
            // Hiển thị modal xác nhận
            const confirmModal = document.createElement(\'div\');
            confirmModal.className = \'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50\';
            confirmModal.innerHTML = `
                <div class="bg-white rounded-lg p-6 max-w-sm w-full mx-4">
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Xóa cuộc trò chuyện</h3>
                        <p class="text-sm text-gray-500 mb-6">Bạn có chắc chắn muốn xóa toàn bộ cuộc trò chuyện với <strong>${customer.name}</strong>? Hành động này không thể hoàn tác.</p>
                        <div class="flex space-x-3">
                            <button onclick="cancelClear()" class="flex-1 bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400">
                                Hủy
                            </button>
                            <button onclick="confirmClear()" class="flex-1 bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700">
                                Xóa
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(confirmModal);
            
            // Đóng menu
            const menu = document.getElementById(\'dropdownMenu\');
            if (menu) menu.classList.add(\'hidden\');
        }

        // Hủy xóa cuộc trò chuyện
        function cancelClear() {
            const modal = document.querySelector(\'.fixed.inset-0\');
            if (modal) document.body.removeChild(modal);
        }

        // Xác nhận xóa cuộc trò chuyện
        function confirmClear() {
            customers[currentCustomer].messages = [];
            document.getElementById(\'messagesArea\').innerHTML = `
                <div class="text-center py-8">
                    <div class="text-gray-400 mb-2">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.959 8.959 0 01-4.906-1.436L3 21l2.436-5.094A8.959 8.959 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500">Cuộc trò chuyện đã được xóa</p>
                    <p class="text-sm text-gray-400 mt-1">Bắt đầu cuộc trò chuyện mới bằng cách gửi tin nhắn</p>
                </div>
            `;
            
            showNotification(\'Đã xóa cuộc trò chuyện\', \'success\');
            
            // Đóng modal
            const modal = document.querySelector(\'.fixed.inset-0\');
            if (modal) document.body.removeChild(modal);
        }

        // Hiển thị thông báo
        function showNotification(message, type = \'info\') {
            const notification = document.createElement(\'div\');
            const bgColor = type === \'success\' ? \'bg-green-500\' : type === \'error\' ? \'bg-red-500\' : \'bg-blue-500\';
            
            notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
            notification.innerHTML = `
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        ${type === \'success\' ? 
                            \'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>\' :
                            type === \'error\' ?
                            \'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>\' :
                            \'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>\'
                        }
                    </svg>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Hiển thị thông báo
            setTimeout(() => {
                notification.classList.remove(\'translate-x-full\');
            }, 100);
            
            // Ẩn thông báo sau 3 giây
            setTimeout(() => {
                notification.classList.add(\'translate-x-full\');
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        // Khởi tạo
        document.addEventListener(\'DOMContentLoaded\', function() {
            // Tự động focus vào ô nhập tin nhắn
            document.getElementById(\'messageInput\').focus();
            
            // Cuộn xuống cuối khu vực tin nhắn
            const messagesArea = document.getElementById(\'messagesArea\');
            messagesArea.scrollTop = messagesArea.scrollHeight;
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement(\'script\');d.innerHTML="window.__CF$cv$params={r:\'98c7d32c5580ddc3\',t:\'MTc2MDExNzIxMC4wMDAwMDA=\'};var a=document.createElement(\'script\');a.nonce=\'\';a.src=\'/cdn-cgi/challenge-platform/scripts/jsd/main.js\';document.getElementsByTagName(\'head\')[0].appendChild(a);";b.getElementsByTagName(\'head\')[0].appendChild(d)}}if(document.body){var a=document.createElement(\'iframe\');a.height=1;a.width=1;a.style.position=\'absolute\';a.style.top=0;a.style.left=0;a.style.border=\'none\';a.style.visibility=\'hidden\';document.body.appendChild(a);if(\'loading\'!==document.readyState)c();else if(window.addEventListener)document.addEventListener(\'DOMContentLoaded\',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);\'loading\'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
