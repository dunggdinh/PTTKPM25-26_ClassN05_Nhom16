package entity;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class Discount {
    private String discountID;
    private String code;
    private String discountType;
    private double discountValue;
    private double maxDiscount;
    private double minOrderValue;
    private int usageLimit;
    private int usedCount;
    private Date startDate;
    private Date endDate;
    private List<String> applicableCategories;
    private String status;
    private String description;

    public Discount(String discountID, String code, String discountType, double discountValue, double maxDiscount,
                    double minOrderValue, int usageLimit, Date startDate, Date endDate, String status, String description) {
        this.discountID = discountID;
        this.code = code;
        this.discountType = discountType;
        this.discountValue = discountValue;
        this.maxDiscount = maxDiscount;
        this.minOrderValue = minOrderValue;
        this.usageLimit = usageLimit;
        this.usedCount = 0;
        this.startDate = startDate != null ? new Date(startDate.getTime()) : null;
        this.endDate = endDate != null ? new Date(endDate.getTime()) : null;
        this.applicableCategories = new ArrayList<>();
        this.status = status;
        this.description = description;
    }

    public boolean validatePromotion(String code) { return false; }
    public boolean isExpired() { return false; }
    public boolean isApplicable(String orderID) { return false; }
    public double calculateDiscount(double orderAmount) { return 0.0; }
    public String getDiscountDetail(String codeID) { return null; }
    public boolean validateDiscountCode(String codeID, Object orderInfo) { return false; }

    public String getDiscountID() { return discountID; }
    public void setDiscountID(String discountID) { this.discountID = discountID; }
    public String getCode() { return code; }
    public void setCode(String code) { this.code = code; }
    public String getDiscountType() { return discountType; }
    public void setDiscountType(String discountType) { this.discountType = discountType; }
    public double getDiscountValue() { return discountValue; }
    public void setDiscountValue(double discountValue) { this.discountValue = discountValue; }
    public double getMaxDiscount() { return maxDiscount; }
    public void setMaxDiscount(double maxDiscount) { this.maxDiscount = maxDiscount; }
    public double getMinOrderValue() { return minOrderValue; }
    public void setMinOrderValue(double minOrderValue) { this.minOrderValue = minOrderValue; }
    public int getUsageLimit() { return usageLimit; }
    public void setUsageLimit(int usageLimit) { this.usageLimit = usageLimit; }
    public int getUsedCount() { return usedCount; }
    public void setUsedCount(int usedCount) { this.usedCount = usedCount; }
    public void incrementUsedCount() { this.usedCount++; }
    public Date getStartDate() { return startDate != null ? new Date(startDate.getTime()) : null; }
    public void setStartDate(Date startDate) { this.startDate = startDate != null ? new Date(startDate.getTime()) : null; }
    public Date getEndDate() { return endDate != null ? new Date(endDate.getTime()) : null; }
    public void setEndDate(Date endDate) { this.endDate = endDate != null ? new Date(endDate.getTime()) : null; }
    public List<String> getApplicableCategories() { return new ArrayList<>(applicableCategories); }
    public void setApplicableCategories(List<String> applicableCategories) { this.applicableCategories = new ArrayList<>(applicableCategories); }
    public String getStatus() { return status; }
    public void setStatus(String status) { this.status = status; }
    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }
}