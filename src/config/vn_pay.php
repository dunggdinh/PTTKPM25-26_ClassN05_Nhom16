<?php

return [
    // Mã định danh merchant kết nối (Terminal Id)
    'tmn_code' => env('VNP_TMN_CODE', 'LOY9Q7Y6'),

    // Secret key
    'hash_secret' => env('VNP_HASH_SECRET', 'KOBHXRERD46GVYP7Q38VNGPH87P7X1O6'),

    // URL thanh toán
    'vnp_url' => env('VNP_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),

    // URL callback sau khi thanh toán
    'return_url' => env('VNP_RETURN_URL', 'http://localhost/vnpay_php/vnpay_return.php'),

    // API VNPAY
    'api_url' => env('VNP_API_URL', 'https://sandbox.vnpayment.vn/merchant_webapi/api/transaction'),

    // Thời gian hết hạn thanh toán (phút)
    'expire_time' => 15,
];
