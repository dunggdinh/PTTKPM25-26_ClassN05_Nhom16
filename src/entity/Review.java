package entity;

import java.util.UUID;
import java.time.LocalDateTime;

public class Review {
    private UUID id;
    private UUID customerId;
    private UUID productId;
    private int rating;
    private String comment;
    private LocalDateTime createdAt;

    public Review(UUID customerId, UUID productId, int rating, String comment) {
        this.id = UUID.randomUUID();
        this.customerId = customerId;
        this.productId = productId;
        this.rating = rating;
        this.comment = comment;
        this.createdAt = LocalDateTime.now();
    }

    public UUID getId() { return id; }
    public UUID getCustomerId() { return customerId; }
    public UUID getProductId() { return productId; }
    public int getRating() { return rating; }
    public String getComment() { return comment; }
    public LocalDateTime getCreatedAt() { return createdAt; }
}