public class PaymentGateway {
    // ===== Thuộc tính =====
    private String gatewayName;      // Tên cổng thanh toán (VNPay, PayPal, Stripe)
    private String apiKey;           // API key để kết nối
    private String endpointURL;      // URL endpoint của cổng thanh toán
    private String transactionID;    // Mã giao dịch từ cổng thanh toán

    // ===== Constructor =====
    public PaymentGateway(String gatewayName, String apiKey, String endpointURL) {
        this.gatewayName = gatewayName;
        this.apiKey = apiKey;
        this.endpointURL = endpointURL;
    }

    // ===== Getter & Setter =====
    public String getGatewayName() {
        return gatewayName;
    }

    public void setGatewayName(String gatewayName) {
        this.gatewayName = gatewayName;
    }

    public String getApiKey() {
        return apiKey;
    }

    public void setApiKey(String apiKey) {
        this.apiKey = apiKey;
    }

    public String getEndpointURL() {
        return endpointURL;
    }

    public void setEndpointURL(String endpointURL) {
        this.endpointURL = endpointURL;
    }

    public String getTransactionID() {
        return transactionID;
    }

    public void setTransactionID(String transactionID) {
        this.transactionID = transactionID;
    }

    // ===== Phương thức nghiệp vụ =====

    /**
     * Kết nối đến cổng thanh toán
     */
    public boolean connect() {
        System.out.println("Đang kết nối tới cổng thanh toán: " + gatewayName);
        if (apiKey == null || apiKey.isEmpty()) {
            System.out.println("Kết nối thất bại! API Key không hợp lệ.");
            return false;
        }
        System.out.println("Kết nối thành công với endpoint: " + endpointURL);
        return true;
    }

    /**
     * Gửi yêu cầu thanh toán đến cổng thanh toán
     */
    public boolean sendPayment(Payment payment) {
        System.out.println("\n=== Gửi yêu cầu thanh toán ===");
        System.out.println("Cổng thanh toán: " + gatewayName);
        System.out.println("Mã đơn hàng: " + payment.getOrderID());
        System.out.println("Số tiền: " + payment.getAmount() + " VND");

        if (!connect()) {
            System.out.println("Thanh toán thất bại do lỗi kết nối.");
            return false;
        }

        // Giả lập giao dịch thành công
        this.transactionID = "GTW-" + System.currentTimeMillis();
        payment.setTransactionID(this.transactionID);
        System.out.println("Thanh toán thành công! Mã giao dịch: " + this.transactionID);
        return true;
    }

    /**
     * Xác minh giao dịch
     */
    public boolean verifyTransaction(String transactionID) {
        System.out.println("\n=== Xác minh giao dịch ===");
        if (transactionID == null || transactionID.isEmpty()) {
            System.out.println("Mã giao dịch không hợp lệ!");
            return false;
        }
        System.out.println("Đang xác minh giao dịch " + transactionID + " qua cổng " + gatewayName + "...");
        // Giả lập xác minh thành công
        System.out.println("Giao dịch hợp lệ.");
        return true;
    }

    /**
     * Hoàn tiền qua cổng thanh toán
     */
    public boolean refundTransaction(String transactionID) {
        System.out.println("\n=== Hoàn tiền giao dịch ===");
        if (!verifyTransaction(transactionID)) {
            System.out.println("Hoàn tiền thất bại do giao dịch không hợp lệ.");
            return false;
        }
        System.out.println("Đã hoàn tiền giao dịch: " + transactionID + " qua cổng " + gatewayName);
        return true;
    }
}
