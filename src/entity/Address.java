package entity;

import java.util.UUID;

public class Address {
    private UUID id;
    private String recipientName;
    private String phone;
    private String line1;
    private String line2;
    private String city;
    private String district;
    private String province;
    private String country;
    private String zipCode;
    private boolean isDefault;

    public Address(String recipientName, String phone, String line1, String line2, String city, String district,
                   String province, String country, String zipCode, boolean isDefault) {
        this.id = UUID.randomUUID();
        this.recipientName = recipientName;
        this.phone = phone;
        this.line1 = line1;
        this.line2 = line2;
        this.city = city;
        this.district = district;
        this.province = province;
        this.country = country;
        this.zipCode = zipCode;
        this.isDefault = isDefault;
    }

    public UUID getId() { return id; }
    public String getRecipientName() { return recipientName; }
    public String getPhone() { return phone; }
    public String getLine1() { return line1; }
    public String getLine2() { return line2; }
    public String getCity() { return city; }
    public String getDistrict() { return district; }
    public String getProvince() { return province; }
    public String getCountry() { return country; }
    public String getZipCode() { return zipCode; }
    public boolean isDefault() { return isDefault; }
}