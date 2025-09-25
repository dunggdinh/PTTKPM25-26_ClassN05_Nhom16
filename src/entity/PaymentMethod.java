package entity;

public class PaymentMethod {
    private String methodID;
    private String methodName;

    public PaymentMethod(String methodID, String methodName) {
        this.methodID = methodID;
        this.methodName = methodName;
    }

    public void activate() {}
    public void deactivate() {}
    public String getDetails() { return ""; }

    public String getMethodID() { return methodID; }
    public void setMethodID(String methodID) { this.methodID = methodID; }
    public String getMethodName() { return methodName; }
    public void setMethodName(String methodName) { this.methodName = methodName; }
}