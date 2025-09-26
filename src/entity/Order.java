package entity;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class Order {
    // ===== Attributes =====
    private String orderID;                  // Mã đơn hàng
    private int customerID;                  // Mã khách hàng đặt đơn
    private List<OrderItem> orderItems;      // Danh sách sản phẩm trong đơn
    private double totalAmount;              // Tổng tiền đơn hàng
    private String status;                   // Trạng thái: Chờ xác nhận, Đang giao, Hoàn thành, Đã hủy
    private String paymentMethod;            // Phương thức thanh toán
    private String shippingAddress;          // Địa chỉ giao hàng
    private Date createdAt;                  // Ngày đặt hàng
    private Date updatedAt;                  // Ngày cập nhật trạng thái

    // ===== Constructor =====
    public Order(String orderID, int customerID, String paymentMethod, String shippingAddress) {
        this.orderID = orderID;
        this.customerID = customerID;
        this.paymentMethod = paymentMethod;
        this.shippingAddress = shippingAddress;
        this.orderItems = new ArrayList<>();
        this.totalAmount = 0.0;
        this.status = "Chờ xác nhận";
        this.createdAt = new Date();
        this.updatedAt = new Date();
    }

    // ===== Getters =====
    public String getOrderID() { return orderID; }
    public int getCustomerID() { return customerID; }
    public List<OrderItem> getOrderItems() { return orderItems; }
    public double getTotalAmount() { return totalAmount; }
    public String getStatus() { return status; }
    public String getPaymentMethod() { return paymentMethod; }
    public String getShippingAddress() { return shippingAddress; }
    public Date getCreatedAt() { return createdAt; }
    public Date getUpdatedAt() { return updatedAt; }

    // ===== Methods =====

    /**
     * Cập nhật trạng thái đơn hàng
     */
    public void updateStatus(String newStatus) {
        this.status = newStatus;
        this.updatedAt = new Date();
        System.out.println("Đơn hàng " + orderID + " đã được cập nhật trạng thái thành: " + newStatus);
    }

    /**
     * Tính tổng tiền đơn hàng dựa trên danh sách sản phẩm
     */
    public double calculateTotal() {
        this.totalAmount = 0.0;
        for (OrderItem item : orderItems) {
            this.totalAmount += item.calculateSubtotal();
        }
        return this.totalAmount;
    }

    /**
     * Hủy đơn hàng
     */
    public void cancelOrder() {
        if (!this.status.equalsIgnoreCase("Đã hủy") && !this.status.equalsIgnoreCase("Hoàn thành")) {
            this.status = "Đã hủy";
            this.updatedAt = new Date();
            System.out.println("Đơn hàng " + orderID + " đã được hủy.");
        } else {
            System.out.println("Không thể hủy đơn hàng " + orderID + " vì đã hoàn thành hoặc đã hủy trước đó.");
        }
    }

    /**
     * Xuất hóa đơn đơn hàng
     */
    public void generateInvoice() {
        System.out.println("===== HÓA ĐƠN ĐƠN HÀNG =====");
        System.out.println("Mã đơn hàng: " + orderID);
        System.out.println("Khách hàng: " + customerID);
        System.out.println("Địa chỉ giao hàng: " + shippingAddress);
        System.out.println("Phương thức thanh toán: " + paymentMethod);
        System.out.println("Danh sách sản phẩm:");
        for (OrderItem item : orderItems) {
            System.out.println(" - " + item.getOrderItemInfo());
        }
        System.out.println("Tổng tiền: " + calculateTotal() + " VND");
        System.out.println("Trạng thái: " + status);
    }

    /**
     * Xử lý thanh toán đơn hàng
     */
    public void processPayment() {
        System.out.println("Xử lý thanh toán cho đơn hàng " + orderID + " bằng phương thức: " + paymentMethod);
        updateStatus("Đã thanh toán");
    }

    /**
     * Hoàn tiền cho đơn hàng
     */
    public void refundOrder() {
        if (this.status.equalsIgnoreCase("Đã hủy")) {
            System.out.println("Tiến hành hoàn tiền cho đơn hàng " + orderID);
            updateStatus("Hoàn tiền thành công");
        } else {
            System.out.println("Không thể hoàn tiền vì đơn hàng chưa bị hủy.");
        }
    }

    /**
     * Theo dõi tình trạng giao hàng
     */
    public void trackShipment() {
        System.out.println("Đang theo dõi đơn hàng " + orderID + "...");
        switch (status) {
            case "Chờ xác nhận":
                System.out.println("Đơn hàng đang chờ xác nhận.");
                break;
            case "Đang giao":
                System.out.println("Đơn hàng đang được vận chuyển.");
                break;
            case "Hoàn thành":
                System.out.println("Đơn hàng đã được giao thành công.");
                break;
            case "Đã hủy":
                System.out.println("Đơn hàng đã bị hủy.");
                break;
            default:
                System.out.println("Trạng thái đơn hàng không xác định.");
        }
    }

    /**
     * Thêm sản phẩm vào đơn hàng
     */
    public void addOrderItem(OrderItem item) {
        this.orderItems.add(item);
        calculateTotal();
    }

    /**
     * Hiển thị thông tin chi tiết đơn hàng
     */
    public String getOrderDetails() {
        return "OrderID: " + orderID +
                " | CustomerID: " + customerID +
                " | Total: " + totalAmount +
                " | Status: " + status +
                " | Payment: " + paymentMethod +
                " | CreatedAt: " + createdAt;
    }
}
