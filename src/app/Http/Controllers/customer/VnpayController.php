<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VnpayController extends Controller
{
    public function createPayment(Request $request)
    {
        $vnp_TxnRef = rand(10000, 99999); // Mã đơn hàng tạm
        $orderAmount = DB::table('cart_items')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->whereIn('cart_items.product_id', $request->items)
            ->sum(DB::raw('products.price * cart_items.quantity'));

        $vnp_Amount = $orderAmount*100; // Số tiền thanh toán (đơn vị: VND)

        $vnp_Locale = $request->language ?? 'vn';
        $vnp_BankCode = $request->bankCode;
        $vnp_IpAddr = $request->ip();

        $vnp_TmnCode = config('vnpay.tmn_code');
        $vnp_HashSecret = config('vnpay.hash_secret');
        $vnp_Returnurl = route('customer.vnpay.callback'); // callback URL
        $vnp_Url = config('vnpay.vnp_url');
        $expire = date('YmdHis', strtotime('+'.config('vnpay.expire_time').' minutes'));

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $expire
        ];

        if ($vnp_BankCode) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $hashdata .= ($i == 0 ? '' : '&') . $key . '=' . $value; // không urlencode
        $query .= urlencode($key) . '=' . urlencode($value) . '&';   // chỉ query URL

        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= "?" . $query . "vnp_SecureHash=" . $vnpSecureHash;

        $user = DB::table('users')->where('id', $request->user_id)->first();
        $shippingAddress = $user->shipping_address ?? '';
        // Lưu đơn hàng vào DB với trạng thái "chưa thanh toán"
        \DB::table('orders')->insert([
            'order_id' => $vnp_TxnRef,
            'user_id' => auth()->id(),
            'total_amount' => $vnp_Amount,
            'status' => "Đang xử lý",
            'payment_status' => 0, // Chưa thanh toán
            'shipping_address' => $shippingAddress,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'payment_url' => $vnp_Url
        ]);
    }


    public function callback(Request $request)
    {
        $inputData = [];
        $returnData = [];

        foreach ($request->query() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? '';
        unset($inputData['vnp_SecureHash']);

        ksort($inputData);
        $i = 0;
        $hashdata .= '&' . $key . '=' . $value;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $vnp_HashSecret = config('vnpay.hash_secret');
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        $vnpTranId = $inputData['vnp_TransactionNo'] ?? '';
        $vnp_BankCode = $inputData['vnp_BankCode'] ?? '';
        $vnp_Amount = ($inputData['vnp_Amount'] ?? 0) ;
        $orderId = $inputData['vnp_TxnRef'] ?? '';

        $Status = 0; // 0 = chưa thanh toán

        try {
            if ($secureHash == $vnp_SecureHash) {
                // Lấy thông tin đơn hàng từ DB
                $order = \DB::table('orders')->where('id', $orderId)->first();

                if ($order) {
                    if ($order->amount*100 == $vnp_Amount) {
                        if ($order->status == 0) {
                            if (($inputData['vnp_ResponseCode'] ?? '') == '00' && ($inputData['vnp_TransactionStatus'] ?? '') == '00') {
                                $Status = 1; // thành công
                            } else {
                                $Status = 2; // thất bại
                            }
                            // Cập nhật đơn hàng vào DB
                            \DB::table('orders')->where('id', $orderId)->update([
                                'payment_status' => $Status,
                                'vnpay_transaction_id' => $vnpTranId,
                                'vnpay_bank_code' => $vnp_BankCode,
                            ]);

                            $returnData['RspCode'] = '00';
                            $returnData['Message'] = 'Confirm Success';
                        } else {
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = 'Order already confirmed';
                        }
                    } else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'Invalid amount';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Invalid signature';
            }
        } catch (\Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknown error';
        }

        return response()->json($returnData);
    }

}
