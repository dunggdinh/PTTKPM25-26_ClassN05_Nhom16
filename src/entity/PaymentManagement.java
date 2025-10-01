package entity;

import java.util.ArrayList;
import java.util.List;
import java.util.UUID;

public class PaymentManagement {
    // ===== Thuộc tính =====
    private List<Payment> payments;               // Danh sách giao dịch thanh toán
    private PaymentGateway gateway;               // Cổng thanh toán
    private List<PaymentMethod> availableMethods; // Danh sách phương thức thanh toán

    // ===== Constructor =====
    public PaymentManagement(PaymentGateway gateway) {
        this.gateway = gateway;
        this.payments = new ArrayList<>();
        this.availableMethods = new ArrayList<>();
    }

    // ===== Getter & Setter =====
    public List<Payment> getPayments() {
        return payments;
    }

    public PaymentGateway getGateway() {
        return gateway;
    }

    public void setGateway(PaymentGateway gateway) {
        this.gateway = gateway;
    }

    public List<PaymentMethod> getAvailableMethods() {
        return availableMethods;
    }

    // ===== Phương thức nghiệp vụ =====

    /**
     * Thêm phương thức thanh toán mới
     */
    public void addPaymentMethod(PaymentMethod method) {
        availableMethods.add(method);
        System.out.println("Đã thêm phương thức thanh toán: " + method.getMethodName());
    }

    /**
     * Liệt kê tất cả phương thức thanh toán có sẵn
     */
    public void listAvailableMethods() {
        System.out.println("\n=== Danh sách phương thức thanh toán ===");
        for (PaymentMethod method : availableMethods) {
            method.getDetails();
        }
    }

    /**
     * Tạo thanh toán mới
     * @param orderID   Mã đơn hàng
     * @param customerID Mã khách hàng
     * @param amount    Số tiền thanh toán
     * @param methodID  Mã phương thức thanh toán
     * @return Payment mới được tạo
     */
    public Payment createPayment(String orderID, String customerID, double amount, String methodID) {
        PaymentMethod method = findMethodByID(methodID);

        if (method == null || !method.isActive()) {
            System.out.println("Phương thức thanh toán không hợp lệ hoặc đang bị vô hiệu hóa.");
            return null;
        }

        String paymentID = UUID.randomUUID().toString();
        Payment payment = new Payment(paymentID, orderID, customerID, amount, method);
        payments.add(payment);

        System.out.println("Đã tạo thanh toán mới với Payment ID: " + paymentID);
        return payment;
    }

    /**
     * Xử lý thanh toán qua cổng thanh toán
     * @param paymentID Mã thanh toán
     */
    public void processPayment(String paymentID) {
        Payment payment = findPaymentByID(paymentID);

        if (payment == null) {
            System.out.println("Không tìm thấy thanh toán với ID: " + paymentID);
            return;
        }

        System.out.println("\n=== Xử lý thanh toán ===");
        if (gateway.sendPayment(payment)) {
            payment.processPayment(); // Cập nhật trạng thái ở lớp Payment
        } else {
            System.out.println("Xử lý thanh toán thất bại qua cổng thanh toán.");
        }
    }

    /**
     * Hoàn tiền giao dịch
     * @param paymentID Mã thanh toán
     * @param reason    Lý do hoàn tiền
     */
    public void refundPayment(String paymentID, String reason) {
        Payment payment = findPaymentByID(paymentID);

        if (payment == null) {
            System.out.println("Không tìm thấy thanh toán với ID: " + paymentID);
            return;
        }

        System.out.println("\n=== Hoàn tiền ===");
        if (gateway.refundTransaction(payment.getTransactionID())) {
            payment.refundPayment(reason);
        } else {
            System.out.println("Hoàn tiền thất bại qua cổng thanh toán.");
        }
    }

    /**
     * Lấy lịch sử thanh toán của khách hàng
     * @param customerID Mã khách hàng
     */
    public void getPaymentHistory(String customerID) {
        System.out.println("\n=== Lịch sử thanh toán của khách hàng: " + customerID + " ===");
        boolean hasHistory = false;

        for (Payment payment : payments) {
            if (payment.getCustomerID().equals(customerID)) {
                payment.getPaymentDetails();
                hasHistory = true;
            }
        }

        if (!hasHistory) {
            System.out.println("Không có lịch sử thanh toán nào cho khách hàng này.");
        }
    }

    // ===== Phương thức tiện ích nội bộ =====

    /**
     * Tìm PaymentMethod theo ID
     */
    private PaymentMethod findMethodByID(String methodID) {
        for (PaymentMethod method : availableMethods) {
            if (method.getMethodID().equals(methodID)) {
                return method;
            }
        }
        return null;
    }

    /**
     * Tìm Payment theo ID
     */
    private Payment findPaymentByID(String paymentID) {
        for (Payment payment : payments) {
            if (payment.getPaymentID().equals(paymentID)) {
                return payment;
            }
        }
        return null;
    }
}
