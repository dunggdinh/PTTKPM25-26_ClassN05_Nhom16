import java.util.Date;
import java.util.List;

public class Discount {
    // ===== Thuộc tính =====
    private String discountID;              // Mã khuyến mãi
    private String code;                    // Mã code khách hàng nhập
    private String discountType;            // Percent (theo %) hoặc Fixed (giảm tiền cố định)
    private double discountValue;           // Giá trị giảm
    private double maxDiscount;             // Giảm tối đa
    private double minOrderValue;           // Giá trị đơn hàng tối thiểu
    private int usageLimit;                 // Giới hạn số lần sử dụng
    private int usedCount;                  // Số lần đã sử dụng
    private Date startDate;                 // Ngày bắt đầu
    private Date endDate;                   // Ngày kết thúc
    private List<String> applicableCategories; // Danh mục sản phẩm áp dụng
    private String status;                  // Hoạt động / Hết hạn / Ngưng hiệu lực
    private String description;             // Mô tả chi tiết

    // ===== Constructor =====
    public Discount(String discountID, String code, String discountType, double discountValue,
                    double maxDiscount, double minOrderValue, int usageLimit, Date startDate,
                    Date endDate, List<String> applicableCategories, String description) {
        this.discountID = discountID;
        this.code = code;
        this.discountType = discountType;
        this.discountValue = discountValue;
        this.maxDiscount = maxDiscount;
        this.minOrderValue = minOrderValue;
        this.usageLimit = usageLimit;
        this.usedCount = 0; // Mặc định ban đầu là 0
        this.startDate = startDate;
        this.endDate = endDate;
        this.applicableCategories = applicableCategories;
        this.status = "Hoạt động";
        this.description = description;
    }

    // ===== Getter & Setter =====
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

    public Date getStartDate() { return startDate; }
    public void setStartDate(Date startDate) { this.startDate = startDate; }

    public Date getEndDate() { return endDate; }
    public void setEndDate(Date endDate) { this.endDate = endDate; }

    public List<String> getApplicableCategories() { return applicableCategories; }
    public void setApplicableCategories(List<String> applicableCategories) { this.applicableCategories = applicableCategories; }

    public String getStatus() { return status; }
    public void setStatus(String status) { this.status = status; }

    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }

    // ===== Phương thức nghiệp vụ =====

    /**
     * Kiểm tra xem mã giảm giá đã hết hạn chưa
     */
    public boolean isExpired() {
        Date now = new Date();
        return now.after(endDate);
    }

    /**
     * Kiểm tra tính hợp lệ của mã khuyến mãi
     */
    public boolean validatePromotion(String inputCode) {
        if (!this.code.equalsIgnoreCase(inputCode)) {
            System.out.println("Mã khuyến mãi không đúng!");
            return false;
        }
        if (isExpired()) {
            System.out.println("Mã khuyến mãi đã hết hạn!");
            return false;
        }
        if (usedCount >= usageLimit) {
            System.out.println("Mã khuyến mãi đã hết lượt sử dụng!");
            return false;
        }
        if (!status.equalsIgnoreCase("Hoạt động")) {
            System.out.println("Mã khuyến mãi không còn hiệu lực!");
            return false;
        }
        return true;
    }

    /**
     * Kiểm tra điều kiện áp dụng với đơn hàng
     */
    public boolean isApplicable(double orderAmount, List<String> orderCategories) {
        if (orderAmount < minOrderValue) {
            System.out.println("Đơn hàng chưa đủ giá trị tối thiểu để áp dụng mã khuyến mãi.");
            return false;
        }
        if (applicableCategories != null && !applicableCategories.isEmpty()) {
            boolean match = orderCategories.stream().anyMatch(applicableCategories::contains);
            if (!match) {
                System.out.println("Mã khuyến mãi không áp dụng cho danh mục sản phẩm này.");
                return false;
            }
        }
        return true;
    }

    /**
     * Tính số tiền được giảm
     */
    public double calculateDiscount(double orderAmount) {
        double discount = 0.0;

        if (discountType.equalsIgnoreCase("Percent")) {
            discount = (orderAmount * discountValue) / 100;
        } else if (discountType.equalsIgnoreCase("Fixed")) {
            discount = discountValue;
        }

        // Giới hạn số tiền giảm tối đa
        return Math.min(discount, maxDiscount);
    }

    /**
     * Lấy thông tin chi tiết của mã khuyến mãi
     */
    public void getDiscountDetail(String codeID) {
        if (!this.code.equalsIgnoreCase(codeID)) {
            System.out.println("Không tìm thấy mã khuyến mãi!");
            return;
        }
        System.out.println("===== Chi tiết khuyến mãi =====");
        System.out.println("Mã: " + code);
        System.out.println("Loại: " + discountType);
        System.out.println("Giá trị giảm: " + discountValue + (discountType.equals("Percent") ? "%" : " VND"));
        System.out.println("Giảm tối đa: " + maxDiscount + " VND");
        System.out.println("Trạng thái: " + status);
        System.out.println("Mô tả: " + description);
    }

    /**
     * Kiểm tra toàn diện mã khuyến mãi (hết hạn, còn lượt dùng, điều kiện áp dụng)
     */
    public boolean validateDiscountCode(String codeID, double orderAmount, List<String> orderCategories) {
        if (!validatePromotion(codeID)) return false;
        return isApplicable(orderAmount, orderCategories);
    }

    /**
     * Cập nhật số lần đã sử dụng khi áp dụng thành công
     */
    public void incrementUsedCount() {
        if (usedCount < usageLimit) {
            usedCount++;
        }
    }
}
