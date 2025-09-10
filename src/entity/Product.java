package entity;

import java.util.UUID;
import java.util.ArrayList;
import java.util.List;

public class Product {
    private UUID id;
    private String name;
    private String description;
    private double price;
    private int stock;
    private List<Review> reviews = new ArrayList<>();

    public Product(String name, String description, double price, int stock) {
        this.id = UUID.randomUUID();
        this.name = name;
        this.description = description;
        this.price = price;
        this.stock = stock;
    }

    public UUID getId() { return id; }
    public String getName() { return name; }
    public String getDescription() { return description; }
    public double getPrice() { return price; }
    public int getStock() { return stock; }
    public void setStock(int stock) { this.stock = stock; }
    public List<Review> getReviews() { return reviews; }
    public void addReview(Review review) { reviews.add(review); }
}