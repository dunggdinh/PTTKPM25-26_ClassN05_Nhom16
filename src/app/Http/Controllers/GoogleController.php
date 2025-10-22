<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
   
class GoogleController extends Controller
{
    /**
     * Hiển thị trang test map
     *
     * @return response()
     */
    public function index()
    {
        return view('googleAutocomplete');
    }

    /**
     * Lấy địa chỉ từ tọa độ (Reverse Geocoding)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAddressFromLatLng(Request $request)
    {
        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);

        $lat = $request->lat;
        $lng = $request->lng;
        $key = env('GOOGLE_MAPS_API_KEY');

        try {
            $response = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
                'latlng' => "$lat,$lng",
                'key' => $key
            ]);

            $data = $response->json();

            if ($data['status'] === 'OK' && !empty($data['results'])) {
                $result = $data['results'][0];
                $address = [
                    'formatted_address' => $result['formatted_address'],
                    'district' => '',
                    'city' => ''
                ];

                // Phân tích components để lấy quận/huyện và thành phố
                foreach ($result['address_components'] as $component) {
                    if (in_array('administrative_area_level_2', $component['types'])) {
                        $address['district'] = $component['long_name'];
                    }
                    if (in_array('administrative_area_level_1', $component['types'])) {
                        $address['city'] = $component['long_name'];
                    }
                }

                return response()->json([
                    'success' => true,
                    'data' => $address
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy địa chỉ'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi lấy thông tin địa chỉ'
            ], 500);
        }
    }

    /**
     * Tìm kiếm địa chỉ từ text (Geocoding)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255'
        ]);

        $address = $request->address;
        $key = env('GOOGLE_MAPS_API_KEY');

        try {
            $response = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
                'address' => $address,
                'key' => $key,
                'region' => 'vn' // Ưu tiên kết quả ở Việt Nam
            ]);

            $data = $response->json();

            if ($data['status'] === 'OK' && !empty($data['results'])) {
                $result = $data['results'][0];
                return response()->json([
                    'success' => true,
                    'data' => [
                        'formatted_address' => $result['formatted_address'],
                        'lat' => $result['geometry']['location']['lat'],
                        'lng' => $result['geometry']['location']['lng']
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy địa chỉ'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi tìm kiếm địa chỉ'
            ], 500);
        }
    }
}