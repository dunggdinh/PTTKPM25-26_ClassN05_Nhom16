@extends('customer.layout')

@section('title', 'Bản đồ')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-4">Bản đồ</h1>
        
        <!-- Hướng dẫn: click vào bản đồ hoặc kéo marker để chọn vị trí -->
        <div class="mb-4">
            <p class="text-sm text-gray-600">Click vào bản đồ hoặc kéo marker để chọn vị trí, sau đó nhấn "Chọn địa điểm này" để lưu.</p>
        </div>

        <!-- Map container -->
        <div id="map" class="w-full h-[500px] rounded-lg"></div>

        <!-- Location info -->
        <div id="locationInfo" class="mt-4 p-4 bg-gray-50 rounded-lg hidden">
            <h3 class="font-semibold mb-2">Thông tin địa điểm</h3>
            <p id="addressInfo" class="text-gray-600"></p>
            <div class="mt-2">
                <span class="text-sm text-gray-500" id="coordinatesInfo"></span>
            </div>
            <div class="mt-4">
                <form id="saveLocationForm" action="{{ route('save-address') }}" method="POST">
                    @csrf
                    <input type="hidden" name="address" id="selectedAddress">
                    <input type="hidden" name="latitude" id="selectedLat">
                    <input type="hidden" name="longitude" id="selectedLng">
                    <input type="hidden" name="redirect_to" id="redirectToInput" value="{{ request()->get('return', '') }}">
                    <button type="submit" 
                        class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Chọn địa điểm này
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let map;
let marker;

// Khởi tạo map
function initMap() {
    const defaultLocation = { lat: 10.762622, lng: 106.660172 }; // Ho Chi Minh City
    map = new google.maps.Map(document.getElementById("map"), {
        center: defaultLocation,
        zoom: 13,
    });

    // Tạo marker có thể kéo
    marker = new google.maps.Marker({
        position: defaultLocation,
        map: map,
        draggable: true,
    });

    // Sự kiện khi kéo marker xong
    marker.addListener("dragend", function() {
        const position = marker.getPosition();
        updateLocationInfo(position.lat(), position.lng());
    });

    // Sự kiện click trên map
    map.addListener("click", function(e) {
        marker.setPosition(e.latLng);
        updateLocationInfo(e.latLng.lat(), e.latLng.lng());
    });
}

// Cập nhật thông tin địa điểm
function updateLocationInfo(lat, lng) {
    document.getElementById('locationInfo').classList.remove('hidden');
    document.getElementById('coordinatesInfo').textContent = `Tọa độ: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
    
    // Update hidden form fields
    document.getElementById('selectedLat').value = lat;
    document.getElementById('selectedLng').value = lng;
    
    // Gọi API để lấy thông tin địa chỉ
    fetch(`/api/map/address-from-latlng?lat=${lat}&lng=${lng}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const address = data.data.formatted_address;
                document.getElementById('addressInfo').textContent = address;
                document.getElementById('selectedAddress').value = address;
            }
        })
        .catch(error => {
            console.error('Error fetching address:', error);
        });
}

// Tìm kiếm bị tắt trên trang map này (sử dụng profile -> map redirect flow)

// Tải Google Maps script
document.addEventListener('DOMContentLoaded', function() {
    if (!window.google || !window.google.maps) {
        const script = document.createElement('script');
        script.src = `https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap`;
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    } else {
        initMap();
    }
});
</script>
@endsection