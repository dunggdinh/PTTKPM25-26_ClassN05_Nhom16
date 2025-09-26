package entity;

import java.util.Date;

public class Payment {
    // ===== Thuộc tính =====
    private String paymentID;          // Mã thanh toán (nội bộ hệ thống)
    private String orderID;            // Mã đơn hàng liên quan đến thanh toán
    private String customerID;         // Mã khách hàng thanh toán
    private double amount;             // Số tiền thanh toán
    private PaymentMethod method;      // Phương thức thanh toán (COD, Credit Card, E-Wallet, ...)
    private Date transactionDate;      // Ngày giờ thực hiện giao dịch
    private String status;             // Trạng thái: Thành công / Thất bại / Đang xử lý
    private String transactionID;      // Mã giao dịch từ cổng thanh toán bên thứ 3

    // ===== Constructor =====
    public Payment(String paymentID, String orderID, String customerID, double amount, PaymentMethod method) {
        this.paymentID = paymentID;
        this.orderID = orderID;
        this.customerID = customerID;
        this.amount = amount;
        this.method = method;
        this.transactionDate = new Date(); // Tự động gán thời điểm hiện tại khi tạo Payment
        this.status = "Đang xử lý";
    }

    // ===== Getter & Setter =====
    public String getPaymentID() {
        return paymentID;
    }

    public void setPaymentID(String paymentID) {
        this.paymentID = paymentID;
    }

    public String getOrderID() {
        return orderID;
    }

    public void setOrderID(String orderID) {
        this.orderID = orderID;
    }

    public String getCustomerID() {
        return customerID;
    }

    public void setCustomerID(String customerID) {
        this.customerID = customerID;
    }

    public double getAmount() {
        return amount;
    }

    public void setAmount(double amount) {
        this.amount = amount;
    }

    public PaymentMethod getMethod() {
        return method;
    }

    public void setMethod(PaymentMethod method) {
        this.method = method;
    }

    public Date getTransactionDate() {
        return transactionDate;
    }

    public String getStatus() {
        return status;
    }

    public String getTransactionID() {
        return transactionID;
    }

    public void setTransactionID(String transactionID) {
        this.transactionID = transactionID;
    }

    // ===== Phương thức nghiệp vụ =====

    /**
     * Xử lý thanh toán
     * Giả lập việc kết nối với cổng thanh toán và cập nhật trạng thái
     */
    public boolean processPayment() {
        System.out.println("Đang xử lý thanh toán cho đơn hàng: " + orderID);
        System.out.println("Phương thức: " + method.getMethodName() + " | Số tiền: " + amount + " VND");

        // Giả lập kết nối với cổng thanh toán
        boolean isSuccessful = Math.random() > 0.2; // 80% thành công

        if (isSuccessful) {
            this.status = "Thành công";
            this.transactionID = "TXN-" + System.currentTimeMillis();
            System.out.println("Thanh toán thành công! Mã giao dịch: " + transactionID);
        } else {
            this.status = "Thất bại";
            System.out.println("Thanh toán thất bại! Vui lòng thử lại.");
        }

        return isSuccessful;
    }

    /**
     * Hoàn tiền giao dịch
     */
    public boolean refundPayment(String reason) {
        if (!this.status.equals("Thành công")) {
            System.out.println("Không thể hoàn tiền vì giao dịch chưa thành công.");
            return false;
        }
        this.status = "Hoàn tiền";
        System.out.println("Đã hoàn tiền giao dịch: " + transactionID + " | Lý do: " + reason);
        return true;
    }

    /**
     * Lấy thông tin chi tiết thanh toán
     */
    public void getPaymentDetails() {
        System.out.println("\n=== Thông tin thanh toán ===");
        System.out.println("Payment ID: " + paymentID);
        System.out.println("Order ID: " + orderID);
        System.out.println("Customer ID: " + customerID);
        System.out.println("Số tiền: " + amount + " VND");
        System.out.println("Phương thức: " + method.getMethodName());
        System.out.println("Ngày giao dịch: " + transactionDate);
        System.out.println("Trạng thái: " + status);
        if (transactionID != null) {
            System.out.println("Mã giao dịch cổng thanh toán: " + transactionID);
        }
    }
}
