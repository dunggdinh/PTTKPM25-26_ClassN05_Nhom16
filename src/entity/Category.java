package entity;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class Category {
    private int categoryID;
    private String name;
    private String description;
    private int parentCategoryID;
    private String status;
    private String imageURL;
    private Date createdDate;
    private Date updatedDate;

    public Category(int categoryID, String name, String description, int parentCategoryID, String status, String imageURL) {
        this.categoryID = categoryID;
        this.name = name;
        this.description = description;
        this.parentCategoryID = parentCategoryID;
        this.status = status;
        this.imageURL = imageURL;
        this.createdDate = new Date();
        this.updatedDate = new Date();
    }

    public void createCategory(String name, String description, int parentCategoryID, String imageURL) {}
    public void updateCategory(int categoryID, String name, String description, int parentCategoryID, String status, String imageURL) {}
    public void deleteCategory(int categoryID) {}
    public Category getCategoryInfo(int categoryID) { return null; }
    public List<Category> listSubCategories(int parentCategoryID) { return new ArrayList<>(); }
    public List<Category> searchCategory(String keyword) { return new ArrayList<>(); }
    public List<Product> listProducts(int categoryID) { return new ArrayList<>(); }

    public int getCategoryID() { return categoryID; }
    public void setCategoryID(int categoryID) { this.categoryID = categoryID; }
    public String getName() { return name; }
    public void setName(String name) { this.name = name; }
    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }
    public int getParentCategoryID() { return parentCategoryID; }
    public void setParentCategoryID(int parentCategoryID) { this.parentCategoryID = parentCategoryID; }
    public String getStatus() { return status; }
    public void setStatus(String status) { this.status = status; }
    public String getImageURL() { return imageURL; }
    public void setImageURL(String imageURL) { this.imageURL = imageURL; }
    public Date getCreatedDate() { return new Date(createdDate.getTime()); }
    public void setCreatedDate(Date createdDate) { this.createdDate = createdDate != null ? new Date(createdDate.getTime()) : new Date(); }
    public Date getUpdatedDate() { return new Date(updatedDate.getTime()); }
    public void setUpdatedDate(Date updatedDate) { this.updatedDate = updatedDate != null ? new Date(updatedDate.getTime()) : new Date(); }
}