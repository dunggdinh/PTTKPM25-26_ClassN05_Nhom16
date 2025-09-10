package entity;

import java.util.UUID;
import java.time.LocalDateTime;

public class Voucher {
    private UUID id;
    private String code;
    private double value;
    private double minOrderValue;
    private LocalDateTime expiryDate;
    private boolean isActive;

    public Voucher(String code, double value, double minOrderValue, LocalDateTime expiryDate) {
        this.id = UUID.randomUUID();
        this.code = code;
        this.value = value;
        this.minOrderValue = minOrderValue;
        this.expiryDate = expiryDate;
        this.isActive = true;
    }

    public UUID getId() { return id; }
    public String getCode() { return code; }
    public double getValue() { return value; }
    public double getMinOrderValue() { return minOrderValue; }
    public LocalDateTime getExpiryDate() { return expiryDate; }
    public boolean isActive() { return isActive && LocalDateTime.now().isBefore(expiryDate); }
    public void deactivate() { this.isActive = false; }
}