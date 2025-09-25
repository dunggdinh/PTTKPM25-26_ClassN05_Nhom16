package entity;

import java.util.Date;

public class CartItem {
    private int cartItemID;
    private int cartID;
    private Product product;
    private Date addedAt;

    public CartItem(int cartItemID, int cartID, Product product, Date addedAt) {
        this.cartItemID = cartItemID;
        this.cartID = cartID;
        this.product = product;
        this.addedAt = addedAt != null ? new Date(addedAt.getTime()) : new Date();
    }

    public void updateQuantity(int newQuantity) {}
    public double calculateSubtotal() { return 0.0; }
    public String getCartItemInfo() { return ""; }

    public int getCartItemID() { return cartItemID; }
    public void setCartItemID(int cartItemID) { this.cartItemID = cartItemID; }
    public int getCartID() { return cartID; }
    public void setCartID(int cartID) { this.cartID = cartID; }
    public Product getProduct() { return product; }
    public void setProduct(Product product) { this.product = product; }
    public Date getAddedAt() { return new Date(addedAt.getTime()); }
    public void setAddedAt(Date addedAt) { this.addedAt = addedAt != null ? new Date(addedAt.getTime()) : new Date(); }
}