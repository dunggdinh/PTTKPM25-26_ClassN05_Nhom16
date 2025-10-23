@extends('customer.layout')
@section('title', 'Hồ sơ cá nhân')

@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Hồ sơ của tôi</h1>
            <p class="text-gray-600">Thông tin cá nhân</p>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Sidebar Navigation -->
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white text-xl font-bold">
                            {{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 1) . (str_contains(Auth::user()->name, ' ') ? substr(Auth::user()->name, strrpos(Auth::user()->name, ' ') + 1, 1) : '')) : 'N' }}
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800">{{ Auth::user()->name ?? 'Người dùng' }}</h3>
                        </div>
                    </div>
                    
                    <nav class="space-y-2">
                        <a href="#" data-tab="profile" class="tab-button active w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Hồ Sơ Cá Nhân
                        </a>

                        <a href="#" data-tab="orders" class="tab-button w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Đơn Hàng
                        </a>

                        <a href="#" data-tab="addresses" class="tab-button w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Địa Chỉ
                        </a>
                    </nav>

                </div>
            </aside>


            
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- TAB PROFILE -->
                <div id="profile" class="tab-content">
                    <!-- Thông Tin Cá Nhân -->
                    @php
                        $bdRaw = old('birth_date', Auth::user()->birth_date ?? null);
                        $bdVal = $bdRaw ? \Carbon\Carbon::parse($bdRaw)->format('Y-m-d') : '';
                    @endphp

                    <form method="POST" action="{{ route('customer.profile.update') }}" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Họ & Tên</label>
                                <input name="name" type="text"
                                    value="{{ old('name', Auth::user()->name) }}"
                                    class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input name="email" type="email"
                                    value="{{ old('email', Auth::user()->email) }}"
                                    class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại</label>
                                <input name="phone" type="text"
                                    value="{{ old('phone', Auth::user()->phone) }}"
                                    class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Ngày sinh</label>
                                <input name="birth_date" type="date"
                                    value="{{ $bdVal }}"
                                    class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Giới tính</label>
                                <select name="gender" class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @php $g = old('gender', Auth::user()->gender); @endphp
                                    <option value="">-- Chọn --</option>
                                    <option value="male"   {{ $g==='male'?'selected':'' }}>Nam</option>
                                    <option value="female" {{ $g==='female'?'selected':'' }}>Nữ</option>
                                    <option value="other"  {{ $g==='other'?'selected':'' }}>Khác</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Địa chỉ</label>
                                <input name="address" type="text"
                                    value="{{ old('address', Auth::user()->address) }}"
                                    class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                    class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                                Lưu thay đổi
                            </button>
                        </div>
                    </form>

                    <!-- Password (giữ chung tab profile) -->
                    <form method="POST" action="{{ route('customer.profile.password') }}" class="space-y-6 mt-10">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu hiện tại</label>
                            <input type="password" name="current_password"
                                class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('current_password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu mới</label>
                            <input type="password" name="password"
                                class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Xác nhận mật khẩu mới</label>
                            <input type="password" name="password_confirmation"
                                class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                    class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                                Đổi mật khẩu
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Orders Tab -->
                <div id="orders" class="tab-content">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Đơn Hàng Của Tôi</h2>
                        
                        <div class="space-y-4">
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h3 class="font-semibold text-gray-800">#DH001234</h3>
                                        <p class="text-sm text-gray-600">Đặt ngày: 15/12/2023</p>
                                    </div>
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Đã giao</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-700">iPhone 15 Pro Max, AirPods Pro</p>
                                    <p class="font-semibold text-lg">35.990.000₫</p>
                                </div>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h3 class="font-semibold text-gray-800">#DH001235</h3>
                                        <p class="text-sm text-gray-600">Đặt ngày: 20/12/2023</p>
                                    </div>
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Đang giao</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-700">MacBook Air M2, Magic Mouse</p>
                                    <p class="font-semibold text-lg">28.990.000₫</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Addresses Tab -->
                <div id="addresses" class="tab-content">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">Địa Chỉ Giao Hàng</h2>
                            <button onclick="showAddressForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                + Thêm Địa Chỉ
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-semibold text-gray-800 mb-1">Địa chỉ nhà</h3>
                                        <p class="text-gray-600">123 Đường ABC, Phường XYZ</p>
                                        <p class="text-gray-600">Quận 1, TP. Hồ Chí Minh</p>
                                        <p class="text-gray-600">SĐT: 0123456789</p>
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium mt-2 inline-block">Mặc định</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800 text-sm">Sửa</button>
                                        <button class="text-red-600 hover:text-red-800 text-sm">Xóa</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-semibold text-gray-800 mb-1">Địa chỉ công ty</h3>
                                        <p class="text-gray-600">456 Đường DEF, Phường UVW</p>
                                        <p class="text-gray-600">Quận 3, TP. Hồ Chí Minh</p>
                                        <p class="text-gray-600">SĐT: 0987654321</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800 text-sm">Sửa</button>
                                        <button class="text-red-600 hover:text-red-800 text-sm">Xóa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const contents = document.querySelectorAll('.tab-content');
            const buttons  = document.querySelectorAll('.tab-button');

            function hideAll() { contents.forEach(c => c.style.display = 'none'); }
            function clearActive() { buttons.forEach(b => b.classList.remove('active')); }

            function showTab(tabId) {
                const target = document.getElementById(tabId);
                if (!target) return;
                hideAll(); clearActive();
                target.style.display = 'block';
                const btn = Array.from(buttons).find(b => b.dataset.tab === tabId);
                if (btn) btn.classList.add('active');
            }

            // Gắn click cho nút tab
            buttons.forEach(b => {
                b.addEventListener('click', e => {
                    // chỉ xử lý tab nội bộ
                    if (b.dataset.tab) {
                        e.preventDefault();
                        showTab(b.dataset.tab);
                    }
                });
            });

            // Ẩn hết & mở mặc định tab 'profile'
            hideAll();
            if (document.getElementById('profile')) showTab('profile');

            // Nếu URL là /customer/order => mở tab orders
            if (window.location.pathname === '/customer/order' && document.getElementById('orders')) {
                showTab('orders');
            }
        });

        function showTab(tabId) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.style.display = 'none';
            });
            
            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active');
            });
            
            // Show selected tab
            document.getElementById(tabId).style.display = 'block';
            
            // Add active class to selected tab button
            document.querySelector(`[onclick*="${tabId}"]`).classList.add('active');
        }

        function showAddressForm(existingAddress = null) {
            // Create modal for address form
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            modal.id = 'addressModal';
            
            modal.innerHTML = `
                <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Thêm Địa Chỉ Mới</h3>
                        <button onclick="closeAddressModal()" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form onsubmit="saveAddress(event)" class="space-y-4">
                        <input type="hidden" name="id" value="${existingAddress ? existingAddress.id : ''}">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tên địa chỉ</label>
                            <input type="text" name="address_name" required placeholder="Ví dụ: Nhà riêng, Công ty" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" ${existingAddress ? `value="${existingAddress.address_name}"` : ''}>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ chi tiết</label>
                            <input type="text" name="address_detail" required placeholder="Số nhà, tên đường" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" ${existingAddress ? `value="${existingAddress.address_detail}"` : ''}>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Quận/Huyện</label>
                                <input type="text" name="district" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" ${existingAddress ? `value="${existingAddress.district}"` : ''}>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tỉnh/Thành phố</label>
                                <input type="text" name="city" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" ${existingAddress ? `value="${existingAddress.city}"` : ''}>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                            <input type="tel" name="phone" required pattern="[0-9]{10}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" ${existingAddress ? `value="${existingAddress.phone}"` : ''}>
                            <p class="text-sm text-gray-500 mt-1">Vui lòng nhập số điện thoại 10 chữ số</p>
                        </div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_default" class="form-checkbox h-4 w-4 text-blue-600" ${existingAddress && existingAddress.is_default ? 'checked' : ''}>
                            <span class="ml-2 text-sm text-gray-600">Đặt làm địa chỉ mặc định</span>
                        </label>
                        <!-- Hidden lat/lng -->
                        <input type="hidden" name="latitude" value="${existingAddress?.latitude || ''}">
                        <input type="hidden" name="longitude" value="${existingAddress?.longitude || ''}">
                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button" onclick="closeAddressModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Hủy</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Lưu địa chỉ</button>
                        </div>
                    </form>
                </div>
            `;
            
            // Remove existing modal if any
            const existingModal = document.getElementById('addressModal');
            if (existingModal) {
                existingModal.remove();
            }
            
            document.body.appendChild(modal);
        }

        function closeAddressModal() {
            const modal = document.getElementById('addressModal');
            if (modal) {
                modal.remove();
            }
        }

        function saveAddress(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            
            // Create a new address element
            const addressesContainer = document.querySelector('#addresses .space-y-4');
            const newAddress = document.createElement('div');
            newAddress.className = 'border border-gray-200 rounded-lg p-4';
            
            newAddress.innerHTML = `
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">${formData.get('address_name')}</h3>
                        <p class="text-gray-600">${formData.get('address_detail')}</p>
                        <p class="text-gray-600">${formData.get('district')}, ${formData.get('city')}</p>
                        <p class="text-gray-600">SĐT: ${formData.get('phone')}</p>
                        ${formData.get('is_default') ? '<span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium mt-2 inline-block">Mặc định</span>' : ''}
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="editAddress(this)" class="text-blue-600 hover:text-blue-800 text-sm">Sửa</button>
                        <button onclick="deleteAddress(this)" class="text-red-600 hover:text-red-800 text-sm">Xóa</button>
                    </div>
                </div>
            `;
            
            // If this is the default address, remove default status from other addresses
            if (formData.get('is_default')) {
                const defaultLabels = addressesContainer.querySelectorAll('.bg-green-100');
                defaultLabels.forEach(label => label.remove());
            }
            
            // Add the new address to the container
            addressesContainer.insertBefore(newAddress, addressesContainer.firstChild);
            
            // Here you would typically send this data to your backend
            showNotification('Địa chỉ đã được lưu thành công!', 'success');
            closeAddressModal();
        }

        function editAddress(button) {
            const addressDiv = button.closest('.border');
            const addressName = addressDiv.querySelector('h3').textContent;
            const [addressDetail, location, phone] = addressDiv.querySelectorAll('p');
            const [district, city] = location.textContent.split(', ');
            const isDefault = addressDiv.querySelector('.bg-green-100') !== null;
            
            // Show the form with pre-filled data
            showAddressForm({
                address_name: addressName,
                address_detail: addressDetail.textContent,
                district: district,
                city: city,
                phone: phone.textContent.replace('SĐT: ', ''),
                is_default: isDefault
            });
            
            // Remove the old address
            addressDiv.remove();
        }

        function deleteAddress(button) {
            if (confirm('Bạn có chắc chắn muốn xóa địa chỉ này không?')) {
                const addressDiv = button.closest('.border');
                addressDiv.remove();
                showNotification('Đã xóa địa chỉ thành công!', 'success');
            }
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-4 rounded-lg shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500 text-white' :
                type === 'error' ? 'bg-red-500 text-white' :
                'bg-blue-500 text-white'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>

    <script>
    /** ===== LocalStorage Address Store ===== */
    const ADDRESS_KEY = 'electrostore_addresses_v1';

    function loadAddresses() {
        try { return JSON.parse(localStorage.getItem(ADDRESS_KEY)) || []; }
        catch { return []; }
    }
    function saveAddresses(list) { localStorage.setItem(ADDRESS_KEY, JSON.stringify(list)); }
    function newId() { return 'adr_' + Math.random().toString(36).slice(2, 10); }

    function addOrUpdateAddress(addr) {
        const list = loadAddresses();
        if (!addr.id) { addr.id = newId(); }
        if (addr.is_default) {
            list.forEach(a => a.is_default = false);
        }
        const i = list.findIndex(a => a.id === addr.id);
        if (i >= 0) list[i] = addr; else list.unshift(addr);
        saveAddresses(list);
        return addr.id;
    }
    function deleteAddressById(id) {
        const list = loadAddresses().filter(a => a.id !== id);
        saveAddresses(list);
    }
    function setDefaultAddress(id) {
        const list = loadAddresses();
        list.forEach(a => a.is_default = (a.id === id));
        saveAddresses(list);
    }

    /** ===== Render vào tab #addresses (profile page) ===== */
    function renderAddressesToProfile() {
        const wrap = document.querySelector('#addresses .space-y-4');
        if (!wrap) return;
        wrap.innerHTML = '';
        const list = loadAddresses();
        if (!list.length) {
            wrap.innerHTML = `<div class="border border-dashed rounded-lg p-6 text-gray-500">Chưa có địa chỉ nào. Nhấn "Thêm Địa Chỉ".</div>`;
            return;
        }
        list.forEach(a => {
            const el = document.createElement('div');
            el.className = 'border border-gray-200 rounded-lg p-4';
            el.innerHTML = `
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">${a.address_name || 'Địa chỉ'}</h3>
                        <p class="text-gray-600">${a.address_detail || ''}</p>
                        <p class="text-gray-600">${a.district || ''}${a.city ? (a.district?', ':'') + a.city : ''}</p>
                        ${a.phone ? `<p class="text-gray-600">SĐT: ${a.phone}</p>` : ''}
                        ${a.is_default ? '<span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium mt-2 inline-block">Mặc định</span>' : ''}
                    </div>
                    <div class="flex gap-2">
                        ${!a.is_default ? `<button class="text-emerald-600 hover:text-emerald-800 text-sm" onclick="onSetDefaultAddress('${a.id}')">Đặt mặc định</button>` : ''}
                        <button class="text-blue-600 hover:text-blue-800 text-sm" onclick="onEditAddress('${a.id}')">Sửa</button>
                        <button class="text-red-600 hover:text-red-800 text-sm" onclick="onDeleteAddress('${a.id}')">Xóa</button>
                    </div>
                </div>
            `;
            wrap.appendChild(el);
        });
    }

    /** ===== Hooks cho nút trong UI ===== */
    function onSetDefaultAddress(id){
        setDefaultAddress(id);
        showNotification('Đã đặt địa chỉ mặc định', 'success');
        renderAddressesToProfile();
    }
    function onDeleteAddress(id){
        if (!confirm('Xóa địa chỉ này?')) return;
        deleteAddressById(id);
        showNotification('Đã xóa địa chỉ', 'success');
        renderAddressesToProfile();
    }
    function onEditAddress(id){
        const list = loadAddresses();
        const a = list.find(x => x.id === id);
        if (!a) return;
        showAddressForm(a); // tái dùng modal form của bạn
    }

    /** ===== Gắn với modal form sẵn có của bạn ===== */
    function saveAddress(event) {
        event.preventDefault();
        const fd = new FormData(event.target);
        const addr = {
            id: fd.get('id') || null,
            address_name: fd.get('address_name')?.trim(),
            address_detail: fd.get('address_detail')?.trim(),
            district: fd.get('district')?.trim(),
            city: fd.get('city')?.trim(),
            phone: fd.get('phone')?.trim(),
            is_default: fd.get('is_default') === 'on'
        };
        addOrUpdateAddress(addr);
        showNotification('Lưu địa chỉ thành công!', 'success');
        closeAddressModal();
        renderAddressesToProfile();
    }

    /** ===== Khởi tạo khi vào trang profile ===== */
    document.addEventListener('DOMContentLoaded', () => {
        renderAddressesToProfile();
    });
    </script>

</div>
@endsection