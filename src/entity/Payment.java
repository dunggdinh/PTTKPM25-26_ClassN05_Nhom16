package entity;

import java.time.LocalDateTime;

public class Payment {
    private String paymentID;
    private String orderID;
    private String customerID;
    private double amount;
    private PaymentMethod method;
    private String transactionID;
    private LocalDateTime transactionDate;
    private String status;

    public Payment(String paymentID, String orderID, String customerID, double amount, PaymentMethod method) {
        this.paymentID = paymentID;
        this.orderID = orderID;
        this.customerID = customerID;
        this.amount = amount;
        this.method = method;
        this.transactionDate = LocalDateTime.now();
        this.status = "Pending";
    }

    public void processPayment() {}
    public void refundPayment(String reason) {}
    public String getPaymentDetails() { return ""; }

    public String getPaymentID() { return paymentID; }
    public void setPaymentID(String paymentID) { this.paymentID = paymentID; }
    public String getOrderID() { return orderID; }
    public void setOrderID(String orderID) { this.orderID = orderID; }
    public String getCustomerID() { return customerID; }
    public void setCustomerID(String customerID) { this.customerID = customerID; }
    public double getAmount() { return amount; }
    public void setAmount(double amount) { this.amount = amount; }
    public PaymentMethod getMethod() { return method; }
    public void setMethod(PaymentMethod method) { this.method = method; }
    public String getTransactionID() { return transactionID; }
    public void setTransactionID(String transactionID) { this.transactionID = transactionID; }
    public LocalDateTime getTransactionDate() { return transactionDate; }
    public void setTransactionDate(LocalDateTime transactionDate) { this.transactionDate = transactionDate; }
    public String getStatus() { return status; }
    public void setStatus(String status) { this.status = status; }
}