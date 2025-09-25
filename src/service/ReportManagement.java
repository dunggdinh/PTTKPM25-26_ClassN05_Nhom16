package service;

import java.util.ArrayList;
import java.util.List;


class Report {
    
}

public class ReportManagement {
    private List<Report> reportsHistory = new ArrayList<>();

    public void generateSalesReport(String timeRange) {}
    public void generateStockReport() {}
    public void generateOrderReport() {}
    public void generateCustomerReport(String timeRange) {}
    public void generateDiscountReport(String timeRange) {}
    public String exportReport(String reportID, String format) { return null; }
    public void scheduleReport(String type, String frequency) {}
}