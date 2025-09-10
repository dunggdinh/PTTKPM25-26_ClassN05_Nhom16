package entity;

import java.util.UUID;
import java.time.LocalDateTime;

public class Payment {
    private UUID id;
    private UUID orderId;
    private double amount;
    private String status;
    private LocalDateTime paidAt;
    private String transactionId;

    public Payment(UUID orderId, double amount, String status, String transactionId) {
        this.id = UUID.randomUUID();
        this.orderId = orderId;
        this.amount = amount;
        this.status = status;
        this.paidAt = LocalDateTime.now();
        this.transactionId = transactionId;
    }

    public UUID getId() { return id; }
    public UUID getOrderId() { return orderId; }
    public double getAmount() { return amount; }
    public String getStatus() { return status; }
    public void setStatus(String status) { this.status = status; }
    public LocalDateTime getPaidAt() { return paidAt; }
    public String getTransactionId() { return transactionId; }
}