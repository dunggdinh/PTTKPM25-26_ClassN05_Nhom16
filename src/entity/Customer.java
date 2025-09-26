import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class Customer extends User {
    // ===== Thuộc tính riêng của Customer =====
    private int customerID;                       // Mã định danh khách hàng
    private List<String> addresses;               // Danh sách địa chỉ giao hàng
    private List<String> paymentMethods;          // Danh sách phương thức thanh toán đã lưu
    private List<String> cart;                    // Giỏ hàng (tạm thời lưu danh sách productID)
    private List<String> orderHistory;            // Lịch sử đơn hàng

    // ===== Constructor =====
    public Customer(int customerID, String name, String email, String password, 
                    String phone, String address, String role) {
        super(name, email, password, phone, address, role); // Kế thừa từ User
        this.customerID = customerID;
        this.addresses = new ArrayList<>();
        this.paymentMethods = new ArrayList<>();
        this.cart = new ArrayList<>();
        this.orderHistory = new ArrayList<>();

        // Địa chỉ mặc định từ thông tin User
        this.addresses.add(address);
    }

    // ===== Getter & Setter =====
    public int getCustomerID() {
        return customerID;
    }

    public void setCustomerID(int customerID) {
        this.customerID = customerID;
    }

    public List<String> getAddresses() {
        return addresses;
    }

    public void addAddress(String newAddress) {
        this.addresses.add(newAddress);
    }

    public List<String> getPaymentMethods() {
        return paymentMethods;
    }

    public void addPaymentMethod(String method) {
        this.paymentMethods.add(method);
    }

    // ===== Các phương thức nghiệp vụ =====

    // 1. Tìm kiếm sản phẩm
    public void searchProduct(Object filters) {
        System.out.println("Đang tìm kiếm sản phẩm với bộ lọc: " + filters);
        // Logic tìm kiếm sản phẩm trong database
    }

    // 2. Xem chi tiết sản phẩm
    public void viewProductDetail(String productID) {
        System.out.println("Xem chi tiết sản phẩm có ID: " + productID);
    }

    // 3. Quản lý giỏ hàng (thêm, sửa, xóa)
    public void manageCart(String action, String productID, int quantity) {
        switch (action.toLowerCase()) {
            case "add":
                for (int i = 0; i < quantity; i++) {
                    cart.add(productID);
                }
                System.out.println("Đã thêm sản phẩm " + productID + " với số lượng: " + quantity + " vào giỏ hàng.");
                break;

            case "remove":
                if (cart.contains(productID)) {
                    cart.remove(productID);
                    System.out.println("Đã xóa sản phẩm " + productID + " khỏi giỏ hàng.");
                } else {
                    System.out.println("Không tìm thấy sản phẩm trong giỏ hàng!");
                }
                break;

            case "update":
                // Đơn giản hóa: Xóa tất cả rồi thêm mới với số lượng cập nhật
                cart.removeIf(item -> item.equals(productID));
                for (int i = 0; i < quantity; i++) {
                    cart.add(productID);
                }
                System.out.println("Đã cập nhật số lượng sản phẩm " + productID + " thành: " + quantity);
                break;

            default:
                System.out.println("Hành động không hợp lệ! (add/update/remove)");
        }
    }

    // 4. Đặt hàng
    public void placeOrder(Object orderInfo) {
        String orderID = "ORD" + new Date().getTime(); // Sinh mã đơn hàng dựa trên thời gian
        orderHistory.add(orderID);
        cart.clear(); // Sau khi đặt hàng, làm trống giỏ
        System.out.println("Đơn hàng đã được đặt thành công! Mã đơn hàng: " + orderID);
    }

    // 5. Theo dõi đơn hàng
    public void trackOrder(String orderID) {
        if (orderHistory.contains(orderID)) {
            System.out.println("Đơn hàng " + orderID + " hiện đang được giao.");
        } else {
            System.out.println("Không tìm thấy thông tin đơn hàng: " + orderID);
        }
    }

    // 6. Xem lịch sử mua hàng
    public void viewOrderHistory() {
        System.out.println("=== Lịch sử đơn hàng của khách hàng ID: " + customerID + " ===");
        if (orderHistory.isEmpty()) {
            System.out.println("Chưa có đơn hàng nào!");
        } else {
            for (String order : orderHistory) {
                System.out.println("- Đơn hàng: " + order);
            }
        }
    }

    // 7. Gửi yêu cầu hỗ trợ
    public void requestSupport(Object issueInfo) {
        System.out.println("Gửi yêu cầu hỗ trợ với thông tin: " + issueInfo);
    }

    // 8. Đánh giá sản phẩm
    public void rateProduct(String productID, int rating, String comment) {
        System.out.println("Đánh giá sản phẩm " + productID + " với số sao: " + rating + " - Bình luận: " + comment);
    }

    // 9. Nhận thông báo hệ thống
    public void receiveNotification(Object notification) {
        System.out.println("Thông báo mới: " + notification.toString());
    }

    // 10. Áp dụng mã giảm giá
    public void applyDiscountCode(String code) {
        System.out.println("Đã áp dụng mã giảm giá: " + code);
    }

    // 11. Hiển thị thông tin khách hàng
    public void displayCustomerInfo() {
        super.displayInfo();
        System.out.println("Customer ID: " + customerID);
        System.out.println("Địa chỉ: " + addresses);
        System.out.println("Phương thức thanh toán: " + paymentMethods);
    }
}
