package entity;

import java.util.UUID;
import util.SecurityUtil;
import java.time.LocalDateTime;

public abstract class User {
    private UUID id;
    private String email;
    private String passwordHash;
    private String fullName;
    private String phone;
    private String status;
    private LocalDateTime createdAt;
    // private LocalDateTime lastLoginAt;

    public User(String email, String password, String fullName, String phone, String status) {
        this.id = UUID.randomUUID();
        this.email = email;
        this.passwordHash = SecurityUtil.hashPassword(password);
        this.fullName = fullName;
        this.phone = phone;
        this.status = status;
        this.createdAt = LocalDateTime.now();
        // this.lastLoginAt = lastLoginAt;
    }

    public UUID getId() { return id; }
    public String getEmail() { return email; }
    public String getPasswordHash() { return passwordHash; }
    public String getFullName() { return fullName; }
    public String getPhone() { return phone; }
    public String getStatus() { return status; }
    public void setStatus(String status) { this.status = status; }
    public boolean verifyPassword(String password) {
        return SecurityUtil.verifyPassword(password, this.passwordHash);
    }
    public LocalDateTime getCreatedAt() { return createdAt; }
    // public LocalDateTime getLastLoginAt() { return lastLoginAt; }
}