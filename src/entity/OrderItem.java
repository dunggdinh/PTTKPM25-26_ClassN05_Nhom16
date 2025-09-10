package entity;

import java.util.UUID;

public class OrderItem {
    private UUID id;
    private UUID productId;
    private int quantity;
    private double unitPrice;
    private double discount;

    public OrderItem(UUID productId, int quantity, double unitPrice, double discount) {
        this.id = UUID.randomUUID();
        this.productId = productId;
        this.quantity = quantity;
        this.unitPrice = unitPrice;
        this.discount = discount;
    }

    public UUID getId() { return id; }
    public UUID getProductId() { return productId; }
    public int getQuantity() { return quantity; }
    public double getUnitPrice() { return unitPrice; }
    public double getDiscount() { return discount; }
    public double getSubtotal() { return (unitPrice - discount) * quantity; }
}