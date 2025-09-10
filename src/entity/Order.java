package entity;

import java.util.UUID;
import java.util.ArrayList;
import java.util.List;
import java.time.LocalDateTime;

public class Order {
    private UUID id;
    private UUID customerId;
    private List<OrderItem> items = new ArrayList<>();
    private double total;
    private String status;
    private LocalDateTime createdAt;
    private Address shippingAddress;

    public Order(UUID customerId, List<OrderItem> items, Address shippingAddress) {
        this.id = UUID.randomUUID();
        this.customerId = customerId;
        this.items = items;
        this.total = items.stream().mapToDouble(OrderItem::getSubtotal).sum();
        this.status = "PENDING";
        this.createdAt = LocalDateTime.now();
        this.shippingAddress = shippingAddress;
    }

    public UUID getId() { return id; }
    public UUID getCustomerId() { return customerId; }
    public List<OrderItem> getItems() { return items; }
    public double getTotal() { return total; }
    public String getStatus() { return status; }
    public void setStatus(String status) { this.status = status; }
    public LocalDateTime getCreatedAt() { return createdAt; }
    public Address getShippingAddress() { return shippingAddress; }
}