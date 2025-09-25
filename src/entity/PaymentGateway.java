package entity;

public class PaymentGateway {
    private String gatewayName;
    private String apiKey;
    private String endpointURL;
    private String transactionID;

    public PaymentGateway(String gatewayName, String apiKey, String endpointURL) {
        this.gatewayName = gatewayName;
        this.apiKey = apiKey;
        this.endpointURL = endpointURL;
        this.transactionID = null;
    }

    public boolean connect() { return false; }
    public boolean sendPayment(Payment payment) { return false; }
    public boolean verifyTransaction(String transactionID) { return false; }
    public boolean refundTransaction(String transactionID) { return false; }

    public String getGatewayName() { return gatewayName; }
    public void setGatewayName(String gatewayName) { this.gatewayName = gatewayName; }
    public String getApiKey() { return apiKey; }
    public void setApiKey(String apiKey) { this.apiKey = apiKey; }
    public String getEndpointURL() { return endpointURL; }
    public void setEndpointURL(String endpointURL) { this.endpointURL = endpointURL; }
    public String getTransactionID() { return transactionID; }
    public void setTransactionID(String transactionID) { this.transactionID = transactionID; }
}