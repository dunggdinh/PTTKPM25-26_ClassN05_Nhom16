import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class ReportManagement {

    // ===== Thuộc tính =====
    private List<Report> reportsHistory; // Lưu trữ lịch sử các báo cáo đã tạo
    private int nextReportID;            // Sinh ID tự động cho báo cáo

    // ===== Constructor =====
    public ReportManagement() {
        this.reportsHistory = new ArrayList<>();
        this.nextReportID = 1;
    }

    // ===== Phương thức hỗ trợ =====

    /**
     * Sinh ID tự động
     */
    private int generateReportID() {
        return nextReportID++;
    }

    /**
     * Lưu báo cáo vào lịch sử
     */
    private void saveReport(Report report) {
        reportsHistory.add(report);
        System.out.println("Đã lưu báo cáo: " + report.getName());
    }

    /**
     * Tạo báo cáo chung
     */
    private Report createReport(String name, String type, String timeRange) {
        Report report = new Report(generateReportID(), name, type, new Date(), timeRange);
        saveReport(report);
        return report;
    }

    // ===== Các phương thức chính =====

    /**
     * 1. Báo cáo doanh thu theo khoảng thời gian
     */
    public Report generateSalesReport(String timeRange) {
        System.out.println("Đang tạo báo cáo doanh thu cho khoảng: " + timeRange);

        // Logic giả lập: tính doanh thu từ DB hoặc hệ thống bán hàng
        double totalRevenue = Math.random() * 1_000_000;
        System.out.println("Doanh thu trong kỳ: " + totalRevenue + " VND");

        return createReport("Báo cáo Doanh thu", "Sales", timeRange);
    }

    /**
     * 2. Báo cáo tồn kho
     */
    public Report generateStockReport() {
        System.out.println("Đang tạo báo cáo tồn kho...");

        // Logic giả lập: tính số lượng hàng tồn
        int totalProducts = (int) (Math.random() * 5000);
        System.out.println("Số lượng sản phẩm tồn kho: " + totalProducts);

        return createReport("Báo cáo Tồn kho", "Stock", "Hiện tại");
    }

    /**
     * 3. Báo cáo tỷ lệ đơn hàng thành công hoặc bị hủy
     */
    public Report generateOrderReport() {
        System.out.println("Đang tạo báo cáo đơn hàng...");

        // Logic giả lập
        int totalOrders = 1000;
        int successfulOrders = 920;
        int cancelledOrders = 80;
        double successRate = (successfulOrders * 100.0) / totalOrders;

        System.out.println("Tổng đơn hàng: " + totalOrders);
        System.out.println("Thành công: " + successfulOrders + " | Hủy: " + cancelledOrders);
        System.out.println("Tỷ lệ thành công: " + successRate + "%");

        return createReport("Báo cáo Đơn hàng", "Order", "Hiện tại");
    }

    /**
     * 4. Báo cáo khách hàng
     * Bao gồm: khách hàng mới, trung thành, tần suất mua hàng
     */
    public Report generateCustomerReport(String timeRange) {
        System.out.println("Đang tạo báo cáo khách hàng cho khoảng: " + timeRange);

        // Logic giả lập
        int newCustomers = 120;
        int loyalCustomers = 300;
        double avgOrdersPerCustomer = 2.5;

        System.out.println("Khách hàng mới: " + newCustomers);
        System.out.println("Khách hàng trung thành: " + loyalCustomers);
        System.out.println("Tần suất mua hàng trung bình: " + avgOrdersPerCustomer + " đơn/người");

        return createReport("Báo cáo Khách hàng", "Customer", timeRange);
    }

    /**
     * 5. Báo cáo hiệu quả khuyến mãi
     */
    public Report generateDiscountReport(String timeRange) {
        System.out.println("Đang tạo báo cáo hiệu quả khuyến mãi cho khoảng: " + timeRange);

        // Logic giả lập
        int totalDiscountCodes = 50;
        int usedCodes = 35;
        double totalDiscountAmount = 150_000_000;

        System.out.println("Số mã phát hành: " + totalDiscountCodes);
        System.out.println("Số mã đã sử dụng: " + usedCodes);
        System.out.println("Tổng giá trị giảm: " + totalDiscountAmount + " VND");

        return createReport("Báo cáo Khuyến mãi", "Discount", timeRange);
    }

    /**
     * 6. Xuất báo cáo ra các định dạng
     * @param reportID Mã báo cáo
     * @param format PDF, Excel, CSV
     */
    public void exportReport(int reportID, String format) {
        for (Report report : reportsHistory) {
            if (report.getReportID() == reportID) {
                report.export(format);
                return;
            }
        }
        System.out.println("Không tìm thấy báo cáo với ID: " + reportID);
    }

    /**
     * 7. Lên lịch tạo báo cáo định kỳ
     * @param type Loại báo cáo
     * @param frequency Daily, Weekly, Monthly
     */
    public void scheduleReport(String type, String frequency) {
        Date startTime = new Date();
        Report scheduledReport = new Report(
                generateReportID(),
                "Lịch báo cáo - " + type,
                type,
                new Date(),
                "Tự động theo lịch"
        );
        scheduledReport.schedule(frequency, startTime);
        saveReport(scheduledReport);
    }

    /**
     * 8. Hiển thị lịch sử báo cáo
     */
    public void showReportsHistory() {
        System.out.println("===== Lịch sử các báo cáo đã tạo =====");
        if (reportsHistory.isEmpty()) {
            System.out.println("Chưa có báo cáo nào được tạo.");
            return;
        }

        for (Report report : reportsHistory) {
            System.out.println(report.getDetails());
            System.out.println("------------------------------");
        }
    }
}
