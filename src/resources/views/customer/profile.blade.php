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
                            NV
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800">Nguyễn Văn A</h3>
                        </div>
                    </div>
                    
                    <nav class="space-y-2">
                        <a href="/customer/profile" class="tab-button active w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Hồ Sơ Cá Nhân
                        </a>
                        <a href="/auth/reset_password" class="tab-button w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Đổi Mật Khẩu
                        </a>
                        <a href="/customer/order" class="tab-button w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Đơn Hàng
                        </a>
                        <a href="#" onclick="showTab('addresses'); return false;" class="tab-button w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
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
                <!-- Thông Tin Cá Nhân -->
                <form method="POST" action="{{ route('customer.profile.update') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Họ & Tên</label>
                            <input name="name" type="text"
                                value="{{ old('name', $user->name) }}"
                                class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input name="email" type="email"
                                value="{{ old('email', $user->email) }}"
                                class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại</label>
                            <input name="phone" type="text"
                                value="{{ old('phone', $user->phone) }}"
                                class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ngày sinh</label>
                            <input name="birth_date" type="date"
                                value="{{ old('birth_date', optional($user->birth_date)->format('Y-m-d')) }}"
                                class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Giới tính</label>
                            <select name="gender" class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @php $g = old('gender', $user->gender); @endphp
                                <option value="">-- Chọn --</option>
                                <option value="male"   {{ $g==='male'?'selected':'' }}>Nam</option>
                                <option value="female" {{ $g==='female'?'selected':'' }}>Nữ</option>
                                <option value="other"  {{ $g==='other'?'selected':'' }}>Khác</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Địa chỉ</label>
                            <input name="address" type="text"
                                value="{{ old('address', $user->address) }}"
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


                <!-- Password Tab -->
                <form method="POST" action="{{ route('customer.profile.password') }}" class="space-y-6">
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
        document.addEventListener('DOMContentLoaded', function() {
            // Hide all tab contents except profile by default
            document.querySelectorAll('.tab-content').forEach(content => {
                content.style.display = 'none';
            });
            
            // Show profile tab by default
            document.getElementById('profile').style.display = 'block';
            
            // Handle URL path to show orders if on orders page
            if (window.location.pathname === '/customer/order') {
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
                            <a href="/map?return={{ urlencode('/customer/profile') }}" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 inline-flex items-center">Chọn từ bản đồ</a>
                        </div>
                    </form>
                </div>
                <!-- Modal Google Map -->
                <div id="mapModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50" style="display:none;">
                    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-2xl mx-4">
                        <h2 class="text-lg font-bold mb-2">Chọn vị trí trên bản đồ</h2>
                        <div id="googleMap" style="width:100%;height:400px;"></div>
                        <div class="mt-4 flex gap-2">
                            <button type="button" onclick="confirmMapAddress()" class="bg-blue-500 text-white px-4 py-2 rounded">Chọn vị trí này</button>
                            <button type="button" onclick="closeMapModal()" class="bg-gray-300 px-4 py-2 rounded">Đóng</button>
                        </div>
                        <div id="mapAddressInfo" class="mt-2 text-sm text-gray-700"></div>
                    </div>
                </div>
            `;
        // Google Maps API Key từ .env
        const GOOGLE_MAPS_API_KEY = "AIzaSyBjuZAOnShMXxAsAy6xUcq-gEKGV9ebd5k";

        // Biến lưu vị trí chọn từ map
        let selectedMapLocation = null;

        function openMapModal() {
            document.getElementById('mapModal').style.display = 'flex';
            // Xóa nội dung cũ của googleMap để tránh lỗi khi mở lại
            const mapDiv = document.getElementById('googleMap');
            if (mapDiv) mapDiv.innerHTML = '';
            // Nếu Google Maps đã có thì gọi initMap luôn
            if (window.google && window.google.maps) {
                setTimeout(initMap, 100);
            } else {
                // Nếu chưa có thì tải script và gọi initMap khi đã tải xong
                if (!document.getElementById('google-maps-script')) {
                    const script = document.createElement('script');
                    script.id = 'google-maps-script';
                    script.src = `https://maps.googleapis.com/maps/api/js?key=${GOOGLE_MAPS_API_KEY}`;
                    script.async = true;
                    script.defer = true;
                    script.onload = function() {
                        setTimeout(initMap, 100);
                    };
                    document.body.appendChild(script);
                } else {
                    // Nếu script đang tải, chờ 500ms rồi thử lại
                    setTimeout(openMapModal, 500);
                }
            }
        }

        function closeMapModal() {
            document.getElementById('mapModal').style.display = 'none';
        }

        function initMap() {
            if (window.google && window.google.maps) {
                const defaultLatLng = { lat: 10.762622, lng: 106.660172 }; // Hồ Chí Minh
                const map = new google.maps.Map(document.getElementById('googleMap'), {
                    center: defaultLatLng,
                    zoom: 13
                });
                let marker = new google.maps.Marker({
                    position: defaultLatLng,
                    map: map,
                    draggable: true
                });
                // Sự kiện click map
                map.addListener('click', function(e) {
                    marker.setPosition(e.latLng);
                    fetchAddressFromLatLng(e.latLng.lat(), e.latLng.lng());
                });
                // Sự kiện kéo marker
                marker.addListener('dragend', function(e) {
                    fetchAddressFromLatLng(e.latLng.lat(), e.latLng.lng());
                });
                // Lấy địa chỉ ban đầu
                fetchAddressFromLatLng(defaultLatLng.lat, defaultLatLng.lng);
            }
        }

        function fetchAddressFromLatLng(lat, lng) {
            selectedMapLocation = { lat, lng };
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({ location: { lat, lng } }, function(results, status) {
                if (status === 'OK' && results[0]) {
                    document.getElementById('mapAddressInfo').textContent = results[0].formatted_address;
                    selectedMapLocation.address = results[0].formatted_address;
                    // Phân tích quận/huyện, thành phố
                    let district = '', city = '';
                    results[0].address_components.forEach(comp => {
                        if (comp.types.includes('administrative_area_level_2')) district = comp.long_name;
                        if (comp.types.includes('administrative_area_level_1')) city = comp.long_name;
                    });
                    selectedMapLocation.district = district;
                    selectedMapLocation.city = city;
                } else {
                    document.getElementById('mapAddressInfo').textContent = 'Không tìm thấy địa chỉ.';
                }
            });
        }

        function confirmMapAddress() {
            if (!selectedMapLocation) return;
            // Điền vào form
            document.querySelector('input[name="address_detail"]').value = selectedMapLocation.address || '';
            document.querySelector('input[name="district"]').value = selectedMapLocation.district || '';
            document.querySelector('input[name="city"]').value = selectedMapLocation.city || '';
            document.querySelector('input[name="latitude"]').value = selectedMapLocation.lat || '';
            document.querySelector('input[name="longitude"]').value = selectedMapLocation.lng || '';
            closeMapModal();
        }

        // Tải Google Maps script
        if (!window.google || !window.google.maps) {
            const script = document.createElement('script');
            script.src = `https://maps.googleapis.com/maps/api/js?key=${GOOGLE_MAPS_API_KEY}`;
            script.async = true;
            script.defer = true;
            document.body.appendChild(script);
        }
            
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
</div>
</html>
@endsection