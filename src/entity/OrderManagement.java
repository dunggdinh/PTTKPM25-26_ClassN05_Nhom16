package entity;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class OrderManagement {
    // ===== Thuộc tính =====
    private List<Order> orders;           // Danh sách tất cả đơn hàng
    private List<Order> completedOrders;  // Danh sách đơn hàng đã hoàn tất
    private List<Order> canceledOrders;   // Danh sách đơn hàng đã hủy

    // ===== Constructor =====
    public OrderManagement() {
        this.orders = new ArrayList<>();
        this.completedOrders = new ArrayList<>();
        this.canceledOrders = new ArrayList<>();
    }

    // ===== Getter =====
    public List<Order> getOrders() {
        return orders;
    }

    public List<Order> getCompletedOrders() {
        return completedOrders;
    }

    public List<Order> getCanceledOrders() {
        return canceledOrders;
    }

    // ===== Các phương thức nghiệp vụ =====

    /**
     * Thêm đơn hàng mới vào hệ thống
     */
    public void addOrder(Order order) {
        orders.add(order);
        System.out.println("Đã thêm đơn hàng mới với ID: " + order.getOrderID());
    }

    /**
     * Xem danh sách đơn hàng theo trạng thái
     * @param status: "Chờ xác nhận", "Đang giao", "Hoàn thành", "Đã hủy"
     */
    public void viewOrders(String status) {
        System.out.println("=== Danh sách đơn hàng trạng thái: " + status + " ===");
        for (Order order : orders) {
            if (order.getStatus().equalsIgnoreCase(status)) {
                System.out.println(order.getOrderDetails());
            }
        }
    }

    /**
     * Xác nhận đơn hàng
     */
    public void confirmOrder(String orderID) {
        Order order = findOrderByID(orderID);
        if (order != null && order.getStatus().equalsIgnoreCase("Chờ xác nhận")) {
            order.updateStatus("Đang giao");
            System.out.println("Đơn hàng " + orderID + " đã được xác nhận và đang giao.");
        } else {
            System.out.println("Không thể xác nhận. Đơn hàng không tồn tại hoặc đã được xử lý trước đó.");
        }
    }

    /**
     * Cập nhật trạng thái đơn hàng
     */
    public void updateOrderStatus(String orderID, String newStatus) {
        Order order = findOrderByID(orderID);
        if (order != null) {
            order.updateStatus(newStatus);
            if (newStatus.equalsIgnoreCase("Hoàn thành")) {
                completedOrders.add(order);
            }
        } else {
            System.out.println("Không tìm thấy đơn hàng với ID: " + orderID);
        }
    }

    /**
     * Hủy đơn hàng
     */
    public void cancelOrder(String orderID) {
        Order order = findOrderByID(orderID);
        if (order != null) {
            order.cancelOrder();
            canceledOrders.add(order);
        } else {
            System.out.println("Không tìm thấy đơn hàng để hủy với ID: " + orderID);
        }
    }

    /**
     * Xử lý trả hàng
     */
    public void processReturnOrder(String orderID) {
        Order order = findOrderByID(orderID);
        if (order != null && order.getStatus().equalsIgnoreCase("Hoàn thành")) {
            order.updateStatus("Trả hàng");
            System.out.println("Đơn hàng " + orderID + " đã được xử lý trả hàng.");
        } else {
            System.out.println("Không thể trả hàng. Đơn hàng chưa hoàn thành hoặc không tồn tại.");
        }
    }

    /**
     * Xem chi tiết đơn hàng
     */
    public void getOrderDetail(String orderID) {
        Order order = findOrderByID(orderID);
        if (order != null) {
            order.generateInvoice();
        } else {
            System.out.println("Không tìm thấy đơn hàng với ID: " + orderID);
        }
    }

    /**
     * Tìm kiếm/lọc đơn hàng theo tiêu chí
     * @param criteria: Có thể là ngày, trạng thái, ID khách hàng...
     */
    public List<Order> searchOrders(String keyword) {
        List<Order> result = new ArrayList<>();
        for (Order order : orders) {
            if (String.valueOf(order.getCustomerID()).contains(keyword) ||
                order.getStatus().toLowerCase().contains(keyword.toLowerCase()) ||
                order.getOrderID().equalsIgnoreCase(keyword)) {
                result.add(order);
            }
        }

        System.out.println("Kết quả tìm kiếm với từ khóa '" + keyword + "':");
        for (Order o : result) {
            System.out.println(o.getOrderDetails());
        }
        return result;
    }

    /**
     * Gán thông tin vận chuyển cho đơn hàng
     * Ở đây giả lập Shipment bằng String shipmentInfo
     */
    public void assignShipment(String orderID, String shipmentInfo) {
        Order order = findOrderByID(orderID);
        if (order != null) {
            System.out.println("Gán thông tin vận chuyển cho đơn hàng " + orderID + ": " + shipmentInfo);
            order.updateStatus("Đang giao");
        } else {
            System.out.println("Không tìm thấy đơn hàng để gán thông tin vận chuyển.");
        }
    }

    /**
     * Theo dõi trạng thái vận chuyển
     */
    public void trackOrder(String orderID) {
        Order order = findOrderByID(orderID);
        if (order != null) {
            order.trackShipment();
        } else {
            System.out.println("Không tìm thấy đơn hàng với ID: " + orderID);
        }
    }

    /**
     * Hoàn tiền cho đơn hàng thông qua Payment Gateway (giả lập)
     */
    public void refundOrder(String orderID) {
        Order order = findOrderByID(orderID);
        if (order != null) {
            order.refundOrder();
        } else {
            System.out.println("Không tìm thấy đơn hàng để hoàn tiền với ID: " + orderID);
        }
    }

    /**
     * In hóa đơn
     */
    public void printInvoice(String orderID) {
        Order order = findOrderByID(orderID);
        if (order != null) {
            order.generateInvoice();
        } else {
            System.out.println("Không tìm thấy đơn hàng để in hóa đơn với ID: " + orderID);
        }
    }

    /**
     * Tìm đơn hàng theo ID
     */
    private Order findOrderByID(String orderID) {
        for (Order order : orders) {
            if (order.getOrderID().equalsIgnoreCase(orderID)) {
                return order;
            }
        }
        return null;
    }

    /**
     * Hiển thị toàn bộ danh sách đơn hàng
     */
    public void displayAllOrders() {
        System.out.println("=== Danh sách tất cả đơn hàng ===");
        for (Order order : orders) {
            System.out.println(order.getOrderDetails());
        }
    }
}
