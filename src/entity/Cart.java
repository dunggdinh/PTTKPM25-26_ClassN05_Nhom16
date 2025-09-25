package entity;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class Cart {
    private int cartID;
    private int customerID;
    private List<CartItem> items;

    public Cart(int cartID, int customerID) {
        this.cartID = cartID;
        this.customerID = customerID;
        this.items = new ArrayList<>();
    }

    public void addItem(int productID, int quantity) {}
    public void removeItem(int productID) {}
    public void updateItem(int productID, int quantity) {}
    public List<CartItem> getCartItems() { return new ArrayList<>(items); }
    public int getItemCount() { return items.size(); }
    public double calculateTotal() { return 0.0; }
    public void applyPromotion(String promoID) {}
    public void clearCart() {}
    public void saveCart() {}
    public void restoreCart(int cartID) {}

    public int getCartID() { return cartID; }
    public void setCartID(int cartID) { this.cartID = cartID; }
    public int getCustomerID() { return customerID; }
    public void setCustomerID(int customerID) { this.customerID = customerID; }
    public List<CartItem> getItems() { return new ArrayList<>(items); }
    public void setItems(List<CartItem> items) { this.items = new ArrayList<>(items); }
}