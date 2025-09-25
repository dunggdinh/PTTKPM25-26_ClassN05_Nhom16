package entity;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class Order {
    private String orderID;
    private int customerID;
    private List<OrderItem> orderItems;
    private double totalAmount;
    private String status;
    private String paymentMethod;
    private String shippingAddress;
    private Date createdAt;
    private Date updatedAt;

    public Order(String orderID, int customerID, List<OrderItem> orderItems, String shippingAddress) {
        this.orderID = orderID;
        this.customerID = customerID;
        this.orderItems = new ArrayList<>(orderItems != null ? orderItems : new ArrayList<>());
        this.shippingAddress = shippingAddress;
        this.status = "Pending";
        this.createdAt = new Date();
        this.updatedAt = new Date();
        calculateTotal();
    }

    public void updateStatus(String newStatus) {}
    public void calculateTotal() {}
    public void cancelOrder() {}
    public void generateInvoice() {}
    public void processPayment() {}
    public void refundOrder() {}
    public void trackShipment() {}

    public String getOrderID() { return orderID; }
    public void setOrderID(String orderID) { this.orderID = orderID; }
    public int getCustomerID() { return customerID; }
    public void setCustomerID(int customerID) { this.customerID = customerID; }
    public List<OrderItem> getOrderItems() { return new ArrayList<>(orderItems); }
    public void setOrderItems(List<OrderItem> orderItems) { this.orderItems = new ArrayList<>(orderItems); }
    public double getTotalAmount() { return totalAmount; }
    public void setTotalAmount(double totalAmount) { this.totalAmount = totalAmount; }
    public String getStatus() { return status; }
    public void setStatus(String status) { this.status = status; }
    public String getPaymentMethod() { return paymentMethod; }
    public void setPaymentMethod(String paymentMethod) { this.paymentMethod = paymentMethod; }
    public String getShippingAddress() { return shippingAddress; }
    public void setShippingAddress(String shippingAddress) { this.shippingAddress = shippingAddress; }
    public Date getCreatedAt() { return new Date(createdAt.getTime()); }
    public void setCreatedAt(Date createdAt) { this.createdAt = createdAt != null ? new Date(createdAt.getTime()) : new Date(); }
    public Date getUpdatedAt() { return new Date(updatedAt.getTime()); }
    public void setUpdatedAt(Date updatedAt) { this.updatedAt = updatedAt != null ? new Date(updatedAt.getTime()) : new Date(); }
}