package entity;

import java.time.LocalDateTime;

public class Report {
    private int reportID;
    private String name;
    private String reportType;
    private LocalDateTime generatedAt;
    private String timeRange;
    private LocalDateTime scheduledTime;

    public Report(int reportID, String name, String reportType, String timeRange) {
        this.reportID = reportID;
        this.name = name;
        this.reportType = reportType;
        this.generatedAt = LocalDateTime.now();
        this.timeRange = timeRange;
        this.scheduledTime = null;
    }

    public String export(String format) { return null; }
    public void schedule(String frequency, LocalDateTime startTime) {}
    public String getDetails() { return ""; }

    public int getReportID() { return reportID; }
    public void setReportID(int reportID) { this.reportID = reportID; }
    public String getName() { return name; }
    public void setName(String name) { this.name = name; }
    public String getReportType() { return reportType; }
    public void setReportType(String reportType) { this.reportType = reportType; }
    public LocalDateTime getGeneratedAt() { return generatedAt; }
    public void setGeneratedAt(LocalDateTime generatedAt) { this.generatedAt = generatedAt; }
    public String getTimeRange() { return timeRange; }
    public void setTimeRange(String timeRange) { this.timeRange = timeRange; }
    public LocalDateTime getScheduledTime() { return scheduledTime; }
    public void setScheduledTime(LocalDateTime scheduledTime) { this.scheduledTime = scheduledTime; }
}