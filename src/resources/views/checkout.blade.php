<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card" style="width: 25rem; margin: auto;">
            <div class="card-header bg-primary text-white">
                <h3>Chi tiết đơn hàng</h3>
            </div>
            <div class="card-body">
                <p><strong>Mã đơn hàng:</strong> #{{ date('YmdHis') }}</p>
                <p><strong>Tổng tiền:</strong> 150,000 VND</p>
                {{-- Form này sẽ gửi yêu cầu thanh toán đến route của chúng ta --}}
                <form action="/vnpay-payment" method="POST">
                    @csrf 
                    <button type="submit" class="btn btn-success w-100">Thanh toán qua VNPAY</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
