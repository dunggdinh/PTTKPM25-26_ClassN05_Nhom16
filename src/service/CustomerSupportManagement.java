package service;

import java.util.ArrayList;
import java.util.List;


class SupportRequest {
    
}

public class CustomerSupportManagement {
    private List<SupportRequest> supportRequests = new ArrayList<>();
    private List<SupportRequest> activeRequests = new ArrayList<>();
    private List<SupportRequest> resolvedRequests = new ArrayList<>();

    public List<SupportRequest> getRequest() { return new ArrayList<>(supportRequests); }
    public void removeSupportRequest(String requestID) {}
    public void moderateReview(int reviewID) {}
}