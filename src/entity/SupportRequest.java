import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class SupportRequest {
    // ===== Thuộc tính =====
    private String requestID;       // Mã yêu cầu hỗ trợ
    private String customerID;      // Mã khách hàng
    private String title;           // Tiêu đề yêu cầu
    private String description;     // Mô tả chi tiết vấn đề
    private String status;          // Trạng thái: Pending, Active, Resolved
    private Date createdAt;         // Thời điểm gửi yêu cầu
    private Date resolvedAt;        // Thời điểm giải quyết yêu cầu

    private List<String> responses; // Lưu các phản hồi từ CSKH

    // ===== Constructor =====
    public SupportRequest(String requestID, String customerID, String title, String description) {
        this.requestID = requestID;
        this.customerID = customerID;
        this.title = title;
        this.description = description;
        this.status = "Pending"; // Mặc định khi tạo là "Chờ xử lý"
        this.createdAt = new Date();
        this.responses = new ArrayList<>();
    }

    // ===== Getter & Setter =====
    public String getRequestID() {
        return requestID;
    }

    public void setRequestID(String requestID) {
        this.requestID = requestID;
    }

    public String getCustomerID() {
        return customerID;
    }

    public void setCustomerID(String customerID) {
        this.customerID = customerID;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getStatus() {
        return status;
    }

    public Date getCreatedAt() {
        return createdAt;
    }

    public Date getResolvedAt() {
        return resolvedAt;
    }

    public List<String> getResponses() {
        return responses;
    }

    // ===== Các phương thức nghiệp vụ =====

    /**
     * Xem thông tin khách hàng (giả lập - thực tế sẽ kết nối DB)
     */
    public void viewCustomerProfile(int customerID) {
        System.out.println("=== Thông tin khách hàng ===");
        System.out.println("Customer ID: " + customerID);
        System.out.println("Tên khách hàng: Nguyễn Văn A (Giả lập)");
        System.out.println("Email: nguyenvana@example.com");
        System.out.println("SĐT: 0901234567");
    }

    /**
     * Cập nhật trạng thái yêu cầu: Pending → Active → Resolved
     */
    public void updateStatus(String newStatus) {
        if (newStatus.equalsIgnoreCase("Active") || newStatus.equalsIgnoreCase("Resolved")) {
            this.status = newStatus;
            if (newStatus.equalsIgnoreCase("Resolved")) {
                this.resolvedAt = new Date();
            }
            System.out.println("Trạng thái yêu cầu đã được cập nhật thành: " + newStatus);
        } else {
            System.out.println("Trạng thái không hợp lệ! Chỉ cho phép: Pending, Active, Resolved.");
        }
    }

    /**
     * Gửi phản hồi cho khách hàng
     */
    public void addResponse(String response) {
        responses.add(response);
        System.out.println("Đã thêm phản hồi: " + response);
    }

    /**
     * Lấy thông tin chi tiết yêu cầu hỗ trợ
     */
    public void getRequest() {
        System.out.println("\n=== Thông tin yêu cầu hỗ trợ ===");
        System.out.println("Request ID: " + requestID);
        System.out.println("Customer ID: " + customerID);
        System.out.println("Tiêu đề: " + title);
        System.out.println("Mô tả: " + description);
        System.out.println("Trạng thái: " + status);
        System.out.println("Ngày gửi: " + createdAt);
        if (resolvedAt != null) {
            System.out.println("Ngày giải quyết: " + resolvedAt);
        }
        if (!responses.isEmpty()) {
            System.out.println("Phản hồi:");
            for (String res : responses) {
                System.out.println("- " + res);
            }
        }
    }
}
