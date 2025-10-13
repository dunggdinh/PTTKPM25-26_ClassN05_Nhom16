<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Chuyển hướng người dùng đến cổng thanh toán VNPAY
     */
    public function createPayment(Request $request)
    {
        // Lấy tổng tiền từ form hoặc session
        // Ví dụ: $vnp_Amount = $request->input('total_amount');
        $vnp_Amount = 150000 * 100; // Số tiền thanh toán. NHÂN 100 VÌ VNPAY TÍNH THEO ĐƠN VỊ ĐỒNG

        $vnp_TxnRef = date('YmdHis'); // Mã đơn hàng. Phải duy nhất.
        $vnp_OrderInfo = "Thanh toan don hang PTTKPM";
        $vnp_OrderType = 'billpayment';
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        // Lấy thông tin cấu hình từ file .env
        $vnp_TmnCode = env('VNPAY_TMNCODE');
        $vnp_HashSecret = env('VNPAY_HASHSECRET');
        $vnp_Url = env('VNPAY_URL');
        $vnp_Returnurl = env('VNPAY_RETURN_URL');

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // Chuyển hướng người dùng đến URL thanh toán của VNPAY
        return redirect($vnp_Url);
    }

    /**
     * Xử lý kết quả trả về từ VNPAY
     */
    public function returnPayment(Request $request)
    {
        $vnp_HashSecret = env('VNPAY_HASHSECRET');
        $vnp_SecureHash = $request->query('vnp_SecureHash');
        $inputData = $request->except('vnp_SecureHash');

        ksort($inputData);
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= '&' . urlencode($key) . "=" . urlencode(strval($value));
        }
        $hashData = ltrim($hashData, '&');

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash == $vnp_SecureHash) {
            if ($request->query('vnp_ResponseCode') == '00') {
                // **GIAO DỊCH THÀNH CÔNG**
                // TODO: Cập nhật trạng thái đơn hàng trong database của bạn tại đây
                // Ví dụ: Order::where('id', $request->query('vnp_TxnRef'))->update(['status' => 'completed']);
                return "<h1>Giao dịch thành công!</h1><p>Cảm ơn bạn đã mua hàng.</p>";
            } else {
                // **GIAO DỊCH THẤT BẠI**
                return "<h1>Giao dịch không thành công!</h1><p>Đã có lỗi xảy ra trong quá trình thanh toán.</p>";
            }
        } else {
            // **SAI CHỮ KÝ**
            return "<h1>Chữ ký không hợp lệ!</h1>";
        }
    }
}
