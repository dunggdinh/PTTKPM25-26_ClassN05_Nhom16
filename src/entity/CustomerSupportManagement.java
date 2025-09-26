import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;

public class CustomerSupportManagement {

    // ===== Thuộc tính =====
    private List<SupportRequest> supportRequests;   // Danh sách tất cả yêu cầu hỗ trợ
    private List<SupportRequest> activeRequests;    // Danh sách yêu cầu đang xử lý
    private List<SupportRequest> resolvedRequests;  // Danh sách yêu cầu đã xử lý

    // ===== Constructor =====
    public CustomerSupportManagement() {
        this.supportRequests = new ArrayList<>();
        this.activeRequests = new ArrayList<>();
        this.resolvedRequests = new ArrayList<>();
    }

    // ===== Các phương thức chính =====

    /**
     * 1. Lấy tất cả yêu cầu hỗ trợ
     */
    public void getRequest() {
        System.out.println("===== DANH SÁCH YÊU CẦU HỖ TRỢ =====");
        if (supportRequests.isEmpty()) {
            System.out.println("Hiện không có yêu cầu hỗ trợ nào.");
            return;
        }
        for (SupportRequest req : supportRequests) {
            req.getRequest();
            System.out.println("------------------------------------");
        }
    }

    /**
     * 2. Thêm yêu cầu hỗ trợ mới
     */
    public void addSupportRequest(SupportRequest request) {
        supportRequests.add(request);
        System.out.println("Đã thêm yêu cầu hỗ trợ với ID: " + request.getRequestID());
    }

    /**
     * 3. Xóa yêu cầu hỗ trợ khỏi hệ thống
     */
    public void removeSupportRequest(String requestID) {
        boolean removed = false;

        // Duyệt và xóa trong supportRequests
        Iterator<SupportRequest> iterator = supportRequests.iterator();
        while (iterator.hasNext()) {
            SupportRequest req = iterator.next();
            if (req.getRequestID().equals(requestID)) {
                iterator.remove();
                removed = true;
                System.out.println("Đã xóa yêu cầu hỗ trợ với ID: " + requestID);
                break;
            }
        }

        // Xóa khỏi activeRequests
        activeRequests.removeIf(req -> req.getRequestID().equals(requestID));

        // Xóa khỏi resolvedRequests
        resolvedRequests.removeIf(req -> req.getRequestID().equals(requestID));

        if (!removed) {
            System.out.println("Không tìm thấy yêu cầu hỗ trợ với ID: " + requestID);
        }
    }

    /**
     * 4. Cập nhật trạng thái yêu cầu hỗ trợ
     * Pending → Active → Resolved
     */
    public void updateRequestStatus(String requestID, String newStatus) {
        for (SupportRequest req : supportRequests) {
            if (req.getRequestID().equals(requestID)) {
                req.updateStatus(newStatus);

                // Nếu là Active → thêm vào activeRequests
                if (newStatus.equalsIgnoreCase("Active")) {
                    if (!activeRequests.contains(req)) {
                        activeRequests.add(req);
                    }
                }

                // Nếu là Resolved → chuyển từ active sang resolved
                if (newStatus.equalsIgnoreCase("Resolved")) {
                    activeRequests.remove(req);
                    if (!resolvedRequests.contains(req)) {
                        resolvedRequests.add(req);
                    }
                }
                return;
            }
        }
        System.out.println("Không tìm thấy yêu cầu hỗ trợ với ID: " + requestID);
    }

    /**
     * 5. Duyệt hoặc xóa đánh giá vi phạm
     */
    public void moderateReview(int reviewID) {
        // Giả lập chức năng duyệt hoặc xóa đánh giá
        System.out.println("Đang kiểm tra đánh giá với ID: " + reviewID);

        boolean violationFound = (reviewID % 2 == 0); // Giả lập: nếu ID chẵn -> vi phạm
        if (violationFound) {
            System.out.println("Đánh giá ID " + reviewID + " vi phạm! Đã bị xóa khỏi hệ thống.");
        } else {
            System.out.println("Đánh giá ID " + reviewID + " hợp lệ. Đã được duyệt.");
        }
    }

    /**
     * 6. Hiển thị danh sách yêu cầu đang xử lý
     */
    public void showActiveRequests() {
        System.out.println("===== YÊU CẦU ĐANG XỬ LÝ =====");
        if (activeRequests.isEmpty()) {
            System.out.println("Không có yêu cầu nào đang xử lý.");
            return;
        }
        for (SupportRequest req : activeRequests) {
            req.getRequest();
            System.out.println("------------------------------------");
        }
    }

    /**
     * 7. Hiển thị danh sách yêu cầu đã xử lý
     */
    public void showResolvedRequests() {
        System.out.println("===== YÊU CẦU ĐÃ XỬ LÝ =====");
        if (resolvedRequests.isEmpty()) {
            System.out.println("Chưa có yêu cầu nào được xử lý.");
            return;
        }
        for (SupportRequest req : resolvedRequests) {
            req.getRequest();
            System.out.println("------------------------------------");
        }
    }
}
