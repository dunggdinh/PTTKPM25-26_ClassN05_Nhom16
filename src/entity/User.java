package entity;

import java.util.Date;

public abstract class User {
    protected String name;
    protected String email;
    protected String password;
    protected String phone;
    protected String address;
    protected boolean status;
    protected Date createdAt;
    protected String role;

    public User(String name, String email, String password, String phone, String address, boolean status, Date createdAt, String role) {
        this.name = name;
        this.email = email;
        this.password = password;
        this.phone = phone;
        this.address = address;
        this.status = status;
        this.createdAt = createdAt != null ? new Date(createdAt.getTime()) : new Date();
        this.role = role != null ? role : "Customer";
    }

    public abstract void createUser(Object userInfo);
    public abstract boolean login(String email, String password);
    public abstract void logout();
    public abstract void changePassword(String password, String newPassword);
    public abstract void updateProfile(String name, String phone, String address);

    public String getName() { return name; }
    public void setName(String name) { this.name = name; }
    public String getEmail() { return email; }
    public void setEmail(String email) { this.email = email; }
    public String getPassword() { return password; }
    public void setPassword(String password) { this.password = password; }
    public String getPhone() { return phone; }
    public void setPhone(String phone) { this.phone = phone; }
    public String getAddress() { return address; }
    public void setAddress(String address) { this.address = address; }
    public boolean isStatus() { return status; }
    public void setStatus(boolean status) { this.status = status; }
    public Date getCreatedAt() { return new Date(createdAt.getTime()); }
    public void setCreatedAt(Date createdAt) { this.createdAt = createdAt != null ? new Date(createdAt.getTime()) : new Date(); }
    public String getRole() { return role; }
    public void setRole(String role) { this.role = role; }
}