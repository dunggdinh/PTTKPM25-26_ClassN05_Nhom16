public class PaymentMethod {
    // ===== Thuộc tính =====
    private String methodID;      // Mã phương thức thanh toán
    private String methodName;    // Tên phương thức thanh toán
    private boolean isActive;     // Trạng thái: Đang hoạt động hoặc đã tắt

    // ===== Constructor =====
    public PaymentMethod(String methodID, String methodName) {
        this.methodID = methodID;
        this.methodName = methodName;
        this.isActive = true; // Mặc định là đang hoạt động khi tạo
    }

    // ===== Getter & Setter =====
    public String getMethodID() {
        return methodID;
    }

    public void setMethodID(String methodID) {
        this.methodID = methodID;
    }

    public String getMethodName() {
        return methodName;
    }

    public void setMethodName(String methodName) {
        this.methodName = methodName;
    }

    public boolean isActive() {
        return isActive;
    }

    // ===== Phương thức nghiệp vụ =====

    /**
     * Kích hoạt phương thức thanh toán
     */
    public void activate() {
        if (!isActive) {
            this.isActive = true;
            System.out.println("Phương thức thanh toán '" + methodName + "' đã được kích hoạt.");
        } else {
            System.out.println("Phương thức thanh toán '" + methodName + "' đã đang hoạt động.");
        }
    }

    /**
     * Vô hiệu hóa phương thức thanh toán
     */
    public void deactivate() {
        if (isActive) {
            this.isActive = false;
            System.out.println("Phương thức thanh toán '" + methodName + "' đã bị vô hiệu hóa.");
        } else {
            System.out.println("Phương thức thanh toán '" + methodName + "' đã bị tắt trước đó.");
        }
    }

    /**
     * Lấy thông tin phương thức thanh toán
     */
    public void getDetails() {
        System.out.println("\n=== Thông tin phương thức thanh toán ===");
        System.out.println("Mã phương thức: " + methodID);
        System.out.println("Tên phương thức: " + methodName);
        System.out.println("Trạng thái: " + (isActive ? "Đang hoạt động" : "Đã tắt"));
    }
}
