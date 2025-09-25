package entity;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class Review {
    private int reviewID;
    private String productID;
    private int customerID;
    private int rating;
    private String title;
    private String comment;
    private List<String> images;
    private String status;
    private Date date;

    public Review(int reviewID, String productID, int customerID, int rating, String title, String comment, List<String> images) {
        this.reviewID = reviewID;
        this.productID = productID;
        this.customerID = customerID;
        this.rating = Math.min(5, Math.max(1, rating));
        this.title = title;
        this.comment = comment;
        this.images = new ArrayList<>(images != null ? images : new ArrayList<>());
        this.status = "Pending";
        this.date = new Date();
    }

    public void addReview(String productID, int customerID, int rating, String title, String comment, List<String> images) {}
    public void editReview(int reviewID, int newRating, String newTitle, String newComment, List<String> newImages) {}
    public void deleteReview(int reviewID) {}
    public void approveReview(int reviewID) {}
    public void reportReview(int reviewID) {}

    public int getReviewID() { return reviewID; }
    public void setReviewID(int reviewID) { this.reviewID = reviewID; }
    public String getProductID() { return productID; }
    public void setProductID(String productID) { this.productID = productID; }
    public int getCustomerID() { return customerID; }
    public void setCustomerID(int customerID) { this.customerID = customerID; }
    public int getRating() { return rating; }
    public void setRating(int rating) { this.rating = Math.min(5, Math.max(1, rating)); }
    public String getTitle() { return title; }
    public void setTitle(String title) { this.title = title; }
    public String getComment() { return comment; }
    public void setComment(String comment) { this.comment = comment; }
    public List<String> getImages() { return new ArrayList<>(images); }
    public void setImages(List<String> images) { this.images = new ArrayList<>(images); }
    public String getStatus() { return status; }
    public void setStatus(String status) { this.status = status; }
    public Date getDate() { return new Date(date.getTime()); }
    public void setDate(Date date) { this.date = date != null ? new Date(date.getTime()) : new Date(); }
}