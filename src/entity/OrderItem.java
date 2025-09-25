package entity;

public class OrderItem {
    private int orderItemID;
    private String orderID;
    private Product product;

    public OrderItem(int orderItemID, String orderID, Product product) {
        this.orderItemID = orderItemID;
        this.orderID = orderID;
        this.product = product;
    }

    public double calculateSubtotal() { return 0.0; }
    public String getOrderItemInfo() { return ""; }

    public int getOrderItemID() { return orderItemID; }
    public void setOrderItemID(int orderItemID) { this.orderItemID = orderItemID; }
    public String getOrderID() { return orderID; }
    public void setOrderID(String orderID) { this.orderID = orderID; }
    public Product getProduct() { return product; }
    public void setProduct(Product product) { this.product = product; }
}