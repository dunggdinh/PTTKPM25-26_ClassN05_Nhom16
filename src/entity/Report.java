import java.text.SimpleDateFormat;
import java.util.Date;

public class Report {
    // ===== Attributes =====
    private int reportID;             // Mã báo cáo
    private String name;              // Tên báo cáo
    private String reportType;        // Loại báo cáo: Sales, Stock, Order, Customer, Discount
    private Date generatedAt;         // Thời điểm báo cáo được tạo
    private String timeRange;         // Khoảng thời gian báo cáo (VD: "01/09/2025 - 30/09/2025")
    private Date scheduledTime;       // Thời gian báo cáo sẽ được tạo nếu lên lịch định kỳ

    // ===== Constructor =====
    public Report(int reportID, String name, String reportType, Date generatedAt, String timeRange) {
        this.reportID = reportID;
        this.name = name;
        this.reportType = reportType;
        this.generatedAt = generatedAt;
        this.timeRange = timeRange;
    }

    // ===== Getters & Setters =====
    public int getReportID() {
        return reportID;
    }

    public void setReportID(int reportID) {
        this.reportID = reportID;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getReportType() {
        return reportType;
    }

    public void setReportType(String reportType) {
        this.reportType = reportType;
    }

    public Date getGeneratedAt() {
        return generatedAt;
    }

    public void setGeneratedAt(Date generatedAt) {
        this.generatedAt = generatedAt;
    }

    public String getTimeRange() {
        return timeRange;
    }

    public void setTimeRange(String timeRange) {
        this.timeRange = timeRange;
    }

    public Date getScheduledTime() {
        return scheduledTime;
    }

    public void setScheduledTime(Date scheduledTime) {
        this.scheduledTime = scheduledTime;
    }

    // ===== Methods =====

    /**
     * Xuất báo cáo ra file
     * @param format Định dạng file: "PDF", "Excel", "CSV"
     * @return Đường dẫn file đã xuất
     */
    public String export(String format) {
        String filePath = "reports/" + name + "_" + reportID + "." + format.toLowerCase();
        System.out.println("Báo cáo đã được xuất ra file: " + filePath);
        return filePath;
    }

    /**
     * Lên lịch tạo báo cáo định kỳ
     * @param frequency Tần suất: "Daily", "Weekly", "Monthly"
     * @param startTime Thời điểm bắt đầu tạo báo cáo
     */
    public void schedule(String frequency, Date startTime) {
        this.scheduledTime = startTime;
        System.out.println("Đã lên lịch báo cáo [" + name + "] với tần suất: " + frequency +
                " bắt đầu từ: " + formatDate(startTime));
    }

    /**
     * Lấy thông tin chi tiết báo cáo
     * @return Chuỗi chứa thông tin báo cáo
     */
    public String getDetails() {
        return "===== Chi tiết báo cáo =====" +
                "\nMã báo cáo: " + reportID +
                "\nTên báo cáo: " + name +
                "\nLoại báo cáo: " + reportType +
                "\nThời điểm tạo: " + formatDate(generatedAt) +
                "\nKhoảng thời gian: " + timeRange +
                (scheduledTime != null ? "\nLịch tạo định kỳ: " + formatDate(scheduledTime) : "");
    }

    /**
     * Hàm định dạng ngày giờ
     */
    private String formatDate(Date date) {
        if (date == null) return "N/A";
        SimpleDateFormat sdf = new SimpleDateFormat("dd/MM/yyyy HH:mm:ss");
        return sdf.format(date);
    }
}
