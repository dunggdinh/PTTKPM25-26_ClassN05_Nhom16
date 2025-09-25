package entity;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class Notification {
    private int notificationID;
    private int userID;
    private String message;
    private String type;
    private boolean status;
    private String priority;
    private Date createdAt;
    private Date expiredAt;

    public Notification(int notificationID, int userID, String message, String type, String priority, Date expiredAt) {
        this.notificationID = notificationID;
        this.userID = userID;
        this.message = message;
        this.type = type;
        this.status = false;
        this.priority = priority;
        this.createdAt = new Date();
        this.expiredAt = expiredAt != null ? new Date(expiredAt.getTime()) : null;
    }

    public void sendNotification(int userID, String message, String type, String priority) {}
    public void markAsRead(int notificationID) {}
    public void deleteNotification(int notificationID) {}
    public List<Notification> listUserNotifications(int userID) { return new ArrayList<>(); }

    public int getNotificationID() { return notificationID; }
    public void setNotificationID(int notificationID) { this.notificationID = notificationID; }
    public int getUserID() { return userID; }
    public void setUserID(int userID) { this.userID = userID; }
    public String getMessage() { return message; }
    public void setMessage(String message) { this.message = message; }
    public String getType() { return type; }
    public void setType(String type) { this.type = type; }
    public boolean isStatus() { return status; }
    public void setStatus(boolean status) { this.status = status; }
    public String getPriority() { return priority; }
    public void setPriority(String priority) { this.priority = priority; }
    public Date getCreatedAt() { return new Date(createdAt.getTime()); }
    public void setCreatedAt(Date createdAt) { this.createdAt = createdAt != null ? new Date(createdAt.getTime()) : new Date(); }
    public Date getExpiredAt() { return expiredAt != null ? new Date(expiredAt.getTime()) : null; }
    public void setExpiredAt(Date expiredAt) { this.expiredAt = expiredAt != null ? new Date(expiredAt.getTime()) : null; }
}