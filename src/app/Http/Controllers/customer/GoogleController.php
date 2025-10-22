<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\customer\Address;

class GoogleController extends Controller
{
    /**
     * Hiển thị trang test Google Maps
     */
    public function index()
    {
        return view('googleAutocomplete');
    }

    /**
     * Hiển thị trang bản đồ chính
     */
    public function showMap()
    {
        return view('map');
    }

    /**
     * Lấy địa chỉ từ tọa độ
     */
    public function getAddressFromLatLng(Request $request)
    {
        try {
            $lat = $request->get('lat');
            $lng = $request->get('lng');
            
            if (!$lat || !$lng) {
                return response()->json([
                    'success' => false,
                    'message' => 'Missing latitude or longitude'
                ], 400);
            }

            $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                'latlng' => "{$lat},{$lng}",
                'key' => env('GOOGLE_MAPS_API_KEY')
            ]);

            $data = $response->json();

            if ($response->successful() && isset($data['results'][0])) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'formatted_address' => $data['results'][0]['formatted_address']
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Could not find address'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error processing request'
            ], 500);
        }
    }

    /**
     * Tìm kiếm địa chỉ
     */
    public function searchAddress(Request $request)
    {
        try {
            $address = $request->get('address');
            
            if (!$address) {
                return response()->json([
                    'success' => false,
                    'message' => 'Address is required'
                ], 400);
            }

            $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                'address' => $address,
                'key' => env('GOOGLE_MAPS_API_KEY')
            ]);

            $data = $response->json();

            if ($response->successful() && isset($data['results'][0])) {
                $location = $data['results'][0]['geometry']['location'];
                return response()->json([
                    'success' => true,
                    'data' => [
                        'lat' => $location['lat'],
                        'lng' => $location['lng'],
                        'formatted_address' => $data['results'][0]['formatted_address']
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Could not find location'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error processing request'
            ], 500);
        }
    }

    /**
     * Lưu địa chỉ đã chọn
     */
    public function saveAddress(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Lấy user hiện tại (nếu đã đăng nhập)
        $user = auth()->user();
        
        if ($user) {
            // Kiểm tra xem user có địa chỉ nào chưa
            $hasAddresses = Address::where('user_id', $user->id)->exists();
            
            // Tạo địa chỉ mới
            Address::create([
                'user_id' => $user->id,
                'address' => $validated['address'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'is_default' => !$hasAddresses // Nếu là địa chỉ đầu tiên, đặt làm mặc định
            ]);

            // Cập nhật luôn thông tin địa chỉ trên hồ sơ user (nếu có các cột tương ứng)
            try {
                $user->update([
                    'address' => $validated['address'],
                    'latitude' => $validated['latitude'],
                    'longitude' => $validated['longitude'],
                ]);
            } catch (\Exception $e) {
                // Nếu cập nhật user thất bại, tiếp tục bình thường (không block lưu địa chỉ)
                // Bạn có thể log lỗi nếu muốn
            }

            // Nếu client gửi redirect_to, chỉ cho phép redirect tới các đường dẫn nội bộ
            $redirectTo = $request->input('redirect_to');
            if ($redirectTo && is_string($redirectTo)) {
                // Chỉ chấp nhận đường dẫn bắt đầu với '/'
                if (str_starts_with($redirectTo, '/')) {
                    return redirect($redirectTo)->with('success', 'Đã lưu địa chỉ thành công!');
                }
            }

            return redirect()->back()->with('success', 'Đã lưu địa chỉ thành công!');
        }

        return redirect()->back()->with('error', 'Bạn cần đăng nhập để lưu địa chỉ!');
    }
}