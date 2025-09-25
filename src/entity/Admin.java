package entity;

import java.util.Date;

public class Admin extends User {
    private int adminID;

    public Admin(int adminID, String name, String email, String password, String phone, String address, boolean status, Date createdAt) {
        super(name, email, password, phone, address, status, createdAt, "Admin");
        this.adminID = adminID;
    }

    @Override
    public void createUser(Object userInfo) {
        // Logic
    }

    @Override
    public String getRole() { return "Admin"; }

    @Override
    public void updateProfile(String name, String phone, String address) {
        setName(name);
        setPhone(phone);
        setAddress(address);
    }

    @Override
    public void logout() {
        setStatus(false);
    }

    @Override
    public void changePassword(String oldPassword, String newPassword) {
        if (getPassword().equals(oldPassword)) {
            setPassword(newPassword);
        }
    }

    @Override
    public boolean login(String email, String password) {
        return getEmail().equals(email) && getPassword().equals(password) && isStatus();
    }

    public int getAdminID() { return adminID; }
    public void setAdminID(int adminID) { this.adminID = adminID; }
}