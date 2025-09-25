package service;

import entity.Inventory;
import entity.Product;

import java.util.ArrayList;
import java.util.List;

public class InventoryManagement {
    private List<Product> products = new ArrayList<>();
    private Inventory inventory;

    public List<Product> getLowStockProducts() { return new ArrayList<>(); }
    public boolean checkProductAvailability(String productID) { return false; }
    public void alertLowStock() {}
}