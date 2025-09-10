package service;

import entity.Product;
import entity.Review;
import java.util.ArrayList;
import java.util.List;
import java.util.stream.Collectors;
import java.util.UUID;

public class ProductService {
    private List<Product> products = new ArrayList<>();
    private List<Review> reviews = new ArrayList<>();

    public ProductService() {
        products.add(new Product("Laptop Dell", "Laptop 15 inch", 1500.0, 10));
        products.add(new Product("Smartphone Samsung", "Phone 5G", 800.0, 20));
    }

    public void addProduct(Product product) {
        products.add(product);
    }

    public List<Product> getAllProducts() {
        return new ArrayList<>(products); 
    }

    public Product getProductById(UUID id) {
        return products.stream().filter(p -> p.getId().equals(id)).findFirst().orElse(null);
    }

    public List<Product> searchProducts(String keyword) {
        return products.stream()
                .filter(p -> p.getName().toLowerCase().contains(keyword.toLowerCase()))
                .collect(Collectors.toList());
    }

    public void addReview(Review review) {
        reviews.add(review);
        Product product = getProductById(review.getProductId());
        if (product != null) {
            product.addReview(review);
        }
    }

    public List<Review> getReviewsForProduct(UUID productId) {
        return reviews.stream()
                .filter(r -> r.getProductId().equals(productId))
                .collect(Collectors.toList());
    }

    public boolean updateStock(UUID productId, int delta) {
        Product product = getProductById(productId);
        if (product != null) {
            product.setStock(product.getStock() + delta);
            return true;
        }
        return false;
    }
}