package service;

import entity.Product;

import java.util.ArrayList;
import java.util.List;
import entity.Category;

public class ProductManagement {
    private List<Product> products = new ArrayList<>();
    private List<Category> categories = new ArrayList<>();

    public void addProduct(Object productInfo) {}
    public void updateProduct(String productID, Object newInfo) {}
    public void deleteProduct(String productID) {}
    public Product getProduct(String productID) { return null; }
    public void searchProduct(Object criteria) {}
}