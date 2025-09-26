import java.util.*;

public class OrderItem {
    // ===== Attributes =====
    private int orderItemID;       // Mã chi tiết đơn hàng
    private String orderID;        // Mã đơn hàng liên kết
    private Product product;       // Sản phẩm
    private int quantity;          // Số lượng sản phẩm
    private double discountValue;  // Mức giảm giá trên sản phẩm (nếu có)

    // ===== Constructor =====
    public OrderItem(int orderItemID, String orderID, Product product, int quantity, double discountValue) {
        this.orderItemID = orderItemID;
        this.orderID = orderID;
        this.product = product;
        this.quantity = quantity;
        this.discountValue = discountValue;
    }

    // ===== Getters & Setters =====
    public int getOrderItemID() { return orderItemID; }
    public String getOrderID() { return orderID; }
    public Product getProduct() { return product; }
    public int getQuantity() { return quantity; }
    public double getDiscountValue() { return discountValue; }

    public void setQuantity(int quantity) { this.quantity = quantity; }
    public void setDiscountValue(double discountValue) { this.discountValue = discountValue; }

    // ================= Methods =================

    /**
     * Tính thành tiền sau khi áp dụng giảm giá cho sản phẩm
     * @return Thành tiền cuối cùng
     */
    public double calculateSubtotal() {
        double originalPrice = product.getPrice() * quantity;
        double finalPrice = originalPrice - discountValue;
        return finalPrice < 0 ? 0 : finalPrice; // Không để giá âm
    }

    /**
     * Lấy thông tin chi tiết sản phẩm trong đơn hàng
     * @return Chuỗi thông tin sản phẩm
     */
    public String getOrderItemInfo() {
        return "OrderItemID: " + orderItemID +
               " | OrderID: " + orderID +
               " | Product: " + product.getName() +
               " | Đơn giá: " + product.getPrice() +
               " | Số lượng: " + quantity +
               " | Giảm giá: " + discountValue +
               " | Thành tiền: " + calculateSubtotal();
    }
}
