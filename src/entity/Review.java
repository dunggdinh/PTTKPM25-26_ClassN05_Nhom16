import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class Review {
    // ===== Attributes =====
    private int reviewID;                  // Mã định danh đánh giá
    private String productID;              // Mã sản phẩm được đánh giá
    private int customerID;                // Mã khách hàng đánh giá
    private int rating;                    // Điểm số (1–5)
    private String title;                  // Tiêu đề đánh giá
    private String comment;                // Nội dung đánh giá
    private List<String> images;           // Danh sách hình ảnh kèm theo
    private String status;                 // Trạng thái (Hiển thị/Ẩn/Đang duyệt)
    private Date date;                     // Ngày đăng

    // ===== Constructor =====
    public Review(int reviewID, String productID, int customerID, int rating,
                  String title, String comment, List<String> images, String status, Date date) {
        this.reviewID = reviewID;
        this.productID = productID;
        this.customerID = customerID;
        this.rating = rating;
        this.title = title;
        this.comment = comment;
        this.images = images != null ? images : new ArrayList<>();
        this.status = status;
        this.date = date;
    }

    // ===== Getters & Setters =====
    public int getReviewID() { return reviewID; }
    public String getProductID() { return productID; }
    public int getCustomerID() { return customerID; }
    public int getRating() { return rating; }
    public String getTitle() { return title; }
    public String getComment() { return comment; }
    public List<String> getImages() { return images; }
    public String getStatus() { return status; }
    public Date getDate() { return date; }

    public void setRating(int rating) { this.rating = rating; }
    public void setTitle(String title) { this.title = title; }
    public void setComment(String comment) { this.comment = comment; }
    public void setImages(List<String> images) { this.images = images; }
    public void setStatus(String status) { this.status = status; }

    // ================= Methods =================

    /**
     * Tạo đánh giá mới
     */
    public static Review addReview(int reviewID, String productID, int customerID, int rating,
                                   String title, String comment, List<String> images) {
        return new Review(reviewID, productID, customerID, rating, title, comment, images, "Đang duyệt", new Date());
    }

    /**
     * Sửa đánh giá
     */
    public void editReview(int newRating, String newTitle, String newComment, List<String> newImages) {
        this.rating = newRating;
        this.title = newTitle;
        this.comment = newComment;
        this.images = newImages != null ? newImages : new ArrayList<>();
        this.date = new Date(); // Cập nhật ngày chỉnh sửa
    }

    /**
     * Xóa đánh giá (thực tế có thể chuyển trạng thái sang "Ẩn")
     */
    public void deleteReview() {
        this.status = "Ẩn";
    }

    /**
     * Admin duyệt đánh giá
     */
    public void approveReview() {
        this.status = "Hiển thị";
    }

    /**
     * Báo cáo đánh giá vi phạm
     */
    public void reportReview() {
        this.status = "Bị báo cáo";
    }

    /**
     * Lấy thông tin chi tiết đánh giá
     */
    public String getReviewDetails() {
        return "ReviewID: " + reviewID +
                " | ProductID: " + productID +
                " | CustomerID: " + customerID +
                " | Rating: " + rating +
                " | Title: " + title +
                " | Comment: " + comment +
                " | Images: " + (images.isEmpty() ? "Không có" : images) +
                " | Status: " + status +
                " | Date: " + date;
    }
}
