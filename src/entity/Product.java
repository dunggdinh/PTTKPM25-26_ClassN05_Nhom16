package entity;

import java.util.ArrayList;
import java.util.List;

public class Product {
    private String productID;
    private String name;
    private String description;
    private double price;
    private String brand;
    private String category;
    private int stockQuantity;
    private int discount;
    private List<String> images;
    private String status;
    private String warranty;

    public Product(String productID, String name, String description, double price, String brand, String category,
                   int stockQuantity, int discount, List<String> images, String status, String warranty) {
        this.productID = productID;
        this.name = name;
        this.description = description;
        this.price = price;
        this.brand = brand;
        this.category = category;
        this.stockQuantity = stockQuantity;
        this.discount = discount;
        this.images = new ArrayList<>(images != null ? images : new ArrayList<>());
        this.status = status;
        this.warranty = warranty;
    }

    public String getProductInfo() { return ""; }
    public void updateStock(int quantity) {}
    public void applyDiscount(int discountPercent) {}
    public void updateProductInfo(Object newInfo) {}
    public boolean checkAvailability() { return false; }
    public double calculateFinalPrice() { return 0.0; }
    public void addImage(String imageURL) {}
    public void removeImage(String imageURL) {}

    public String getProductID() { return productID; }
    public void setProductID(String productID) { this.productID = productID; }
    public String getName() { return name; }
    public void setName(String name) { this.name = name; }
    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }
    public double getPrice() { return price; }
    public void setPrice(double price) { this.price = price; }
    public String getBrand() { return brand; }
    public void setBrand(String brand) { this.brand = brand; }
    public String getCategory() { return category; }
    public void setCategory(String category) { this.category = category; }
    public int getStockQuantity() { return stockQuantity; }
    public void setStockQuantity(int stockQuantity) { this.stockQuantity = stockQuantity; }
    public int getDiscount() { return discount; }
    public void setDiscount(int discount) { this.discount = discount; }
    public List<String> getImages() { return new ArrayList<>(images); }
    public void setImages(List<String> images) { this.images = new ArrayList<>(images); }
    public String getStatus() { return status; }
    public void setStatus(String status) { this.status = status; }
    public String getWarranty() { return warranty; }
    public void setWarranty(String warranty) { this.warranty = warranty; }
}