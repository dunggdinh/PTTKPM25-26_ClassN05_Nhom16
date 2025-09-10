package entity;

import java.util.UUID;

public class Inventory {
    private UUID id;
    private UUID productId;
    private int quantityOnHand;
    private int quantityReserved;

    public Inventory(UUID productId, int quantityOnHand, int quantityReserved) {
        this.id = UUID.randomUUID();
        this.productId = productId;
        this.quantityOnHand = quantityOnHand;
        this.quantityReserved = quantityReserved;
    }

    public UUID getId() { return id; }
    public UUID getProductId() { return productId; }
    public int getQuantityOnHand() { return quantityOnHand; }
    public void setQuantityOnHand(int quantityOnHand) { this.quantityOnHand = quantityOnHand; }
    public int getQuantityReserved() { return quantityReserved; }
    public void setQuantityReserved(int quantityReserved) { this.quantityReserved = quantityReserved; }
    public void adjustStock(int delta) { this.quantityOnHand += delta; }
}