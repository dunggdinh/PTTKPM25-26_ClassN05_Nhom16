package entity;

import java.time.LocalDateTime;

public class SupportRequest {
    private String requestID;
    private String customerID;
    private String title;
    private String description;
    private String status;
    private LocalDateTime createdAt;
    private LocalDateTime resolvedAt;

    public SupportRequest(String requestID, String customerID, String title, String description) {
        this.requestID = requestID;
        this.customerID = customerID;
        this.title = title;
        this.description = description;
        this.status = "Pending";
        this.createdAt = LocalDateTime.now();
        this.resolvedAt = null;
    }

    public void viewCustomerProfile(int customerID) {}
    public void updateStatus(String newStatus) {}
    public void addResponse(String response) {}
    public String getRequest() { return ""; }

    public String getRequestID() { return requestID; }
    public void setRequestID(String requestID) { this.requestID = requestID; }
    public String getCustomerID() { return customerID; }
    public void setCustomerID(String customerID) { this.customerID = customerID; }
    public String getTitle() { return title; }
    public void setTitle(String title) { this.title = title; }
    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }
    public String getStatus() { return status; }
    public void setStatus(String status) { this.status = status; }
    public LocalDateTime getCreatedAt() { return createdAt; }
    public void setCreatedAt(LocalDateTime createdAt) { this.createdAt = createdAt; }
    public LocalDateTime getResolvedAt() { return resolvedAt; }
    public void setResolvedAt(LocalDateTime resolvedAt) { this.resolvedAt = resolvedAt; }
}