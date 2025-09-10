package entity;

public class Admin extends User {
    private String role;

    public Admin(String email, String password, String fullName, String phone, String status, String role) {
        super(email, password, fullName, phone, status);
        this.role = role;
    }

    public String getRole() { return role; }
    public void setRole(String role) { this.role = role; }
}