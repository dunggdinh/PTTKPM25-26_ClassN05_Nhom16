package entity;

import java.util.ArrayList;
import java.util.List;

public class Customer extends User {
    private int loyaltyPoint;
    private List<Address> addresses = new ArrayList<>();
    private List<Order> orders = new ArrayList<>();

    public Customer(String email, String password, String fullName, String phone, String status, int loyaltyPoint) {
        super(email, password, fullName, phone, status);
        this.loyaltyPoint = loyaltyPoint;
    }

    public int getLoyaltyPoint() { return loyaltyPoint; }
    public void setLoyaltyPoint(int loyaltyPoint) { this.loyaltyPoint = loyaltyPoint; }
    public List<Address> getAddresses() { return addresses; }
    public void addAddress(Address address) { addresses.add(address); }
    public List<Order> getOrders() { return orders; }
    public void addOrder(Order order) { orders.add(order); }
}