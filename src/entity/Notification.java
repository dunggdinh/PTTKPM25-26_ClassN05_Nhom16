import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class Notification {
    // ===== Attributes =====
    private int notificationID;    // Mã thông báo
    private int userID;            // Người nhận thông báo
    private String message;        // Nội dung thông báo
    private String type;           // Loại thông báo (Đơn hàng, Thanh toán, Khuyến mãi, Hệ thống)
    private boolean status;        // Trạng thái (true = Đã đọc, false = Chưa đọc)
    private String priority;       // Mức ưu tiên (Normal, High)
    private Date createdAt;        // Thời gian tạo thông báo
    private Date expiredAt;        // Thời gian hết hạn thông báo

    // ===== Danh sách thông báo lưu trữ tạm =====
    private static List<Notification> notificationList = new ArrayList<>();

    // ===== Constructor =====
    public Notification(int notificationID, int userID, String message, String type, 
                        String priority, Date createdAt, Date expiredAt) {
        this.notificationID = notificationID;
        this.userID = userID;
        this.message = message;
        this.type = type;
        this.status = false; // Mặc định là chưa đọc
        this.priority = priority;
        this.createdAt = createdAt;
        this.expiredAt = expiredAt;
    }

    // ===== Getters & Setters =====
    public int getNotificationID() { return notificationID; }
    public int getUserID() { return userID; }
    public String getMessage() { return message; }
    public String getType() { return type; }
    public boolean isRead() { return status; }
    public String getPriority() { return priority; }
    public Date getCreatedAt() { return createdAt; }
    public Date getExpiredAt() { return expiredAt; }

    public void setMessage(String message) { this.message = message; }
    public void setType(String type) { this.type = type; }
    public void setPriority(String priority) { this.priority = priority; }
    public void setExpiredAt(Date expiredAt) { this.expiredAt = expiredAt; }

    // ================= Methods =================

    /**
     * Gửi thông báo đến người dùng
     */
    public static Notification sendNotification(int notificationID, int userID, String message, String type, String priority) {
        Notification notification = new Notification(notificationID, userID, message, type, priority, new Date(), null);
        notificationList.add(notification);
        System.out.println("Đã gửi thông báo đến UserID: " + userID + " | Nội dung: " + message);
        return notification;
    }

    /**
     * Đánh dấu thông báo là đã đọc
     */
    public static void markAsRead(int notificationID) {
        for (Notification n : notificationList) {
            if (n.getNotificationID() == notificationID) {
                n.status = true;
                System.out.println("Thông báo ID " + notificationID + " đã được đánh dấu là ĐÃ ĐỌC.");
                return;
            }
        }
        System.out.println("Không tìm thấy thông báo với ID: " + notificationID);
    }

    /**
     * Xóa thông báo khỏi danh sách
     */
    public static void deleteNotification(int notificationID) {
        notificationList.removeIf(n -> n.getNotificationID() == notificationID);
        System.out.println("Thông báo ID " + notificationID + " đã được xóa.");
    }

    /**
     * Liệt kê tất cả thông báo của một người dùng
     */
    public static List<Notification> listUserNotifications(int userID) {
        List<Notification> userNotifications = new ArrayList<>();
        for (Notification n : notificationList) {
            if (n.getUserID() == userID) {
                userNotifications.add(n);
            }
        }
        return userNotifications;
    }

    /**
     * Hiển thị thông tin chi tiết thông báo
     */
    public String getNotificationInfo() {
        return "NotificationID: " + notificationID +
                " | UserID: " + userID +
                " | Message: " + message +
                " | Type: " + type +
                " | Status: " + (status ? "Đã đọc" : "Chưa đọc") +
                " | Priority: " + priority +
                " | CreatedAt: " + createdAt +
                (expiredAt != null ? " | ExpiredAt: " + expiredAt : "");
    }
}
