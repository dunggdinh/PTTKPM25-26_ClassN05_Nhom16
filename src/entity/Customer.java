package entity;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class Customer extends User {
    private int customerID;
    private List<String> addresses;
    private List<String> paymentMethods;

    @Override
    public void updateProfile(String name, String email, String phone) {
        // Logic
        setName(name);
        setEmail(email);
        setPhone(phone);
    }

    @Override
    public void logout() {
        // Logic
        setStatus(false);
    }

    @Override
    public void changePassword(String oldPassword, String newPassword) {
        // Logic
        if (getPassword().equals(oldPassword)) {
            setPassword(newPassword);
        }
    }

    @Override
    public void createUser(Object userInfo) {
        // Logic
    }

    @Override
    public boolean login(String email, String password) {

        return getEmail().equals(email) && getPassword().equals(password);
    }

    public Customer(int customerID, String name, String email, String password, String phone, String address, boolean status, Date createdAt) {
        super(name, email, password, phone, address, status, createdAt, "Customer");
        this.customerID = customerID;
        this.addresses = new ArrayList<>();
        this.paymentMethods = new ArrayList<>();
        if (address != null) this.addresses.add(address);
    }

    public void searchProduct(Object filters) {}
    public void viewProductDetail(String productID) {}
    public void manageCart(String action, String productID, int quantity) {}
    public void placeOrder(Object orderInfo) {}
    public void trackOrder(String orderID) {}
    public void viewOrderHistory() {}
    public void requestSupport(Object issueInfo) {}
    public void rateProduct(String productID, int rating, String comment) {}
    public void receiveNotification(Object notification) {}
    public void applyDiscountCode(String code) {}

    public int getCustomerID() { return customerID; }
    public void setCustomerID(int customerID) { this.customerID = customerID; }
    public List<String> getAddresses() { return new ArrayList<>(addresses); }
    public void setAddresses(List<String> addresses) { this.addresses = new ArrayList<>(addresses); }
    public void addAddress(String address) { if (address != null) this.addresses.add(address); }
    public List<String> getPaymentMethods() { return new ArrayList<>(paymentMethods); }
    public void setPaymentMethods(List<String> paymentMethods) { this.paymentMethods = new ArrayList<>(paymentMethods); }
    public void addPaymentMethod(String method) { if (method != null) this.paymentMethods.add(method); }
}