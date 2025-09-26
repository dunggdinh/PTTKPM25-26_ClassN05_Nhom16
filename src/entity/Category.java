import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class Category {
    // ===== Attributes =====
    private int categoryID;               // Mã danh mục
    private String name;                  // Tên danh mục
    private String description;           // Mô tả danh mục
    private int parentCategoryID;         // Mã danh mục cha (0 nếu là root)
    private String status;                // Trạng thái: ACTIVE / INACTIVE
    private String imageURL;              // Đường dẫn ảnh đại diện
    private Date createdDate;             // Ngày tạo
    private Date updatedDate;             // Ngày cập nhật

    // Danh sách danh mục (giả lập cơ sở dữ liệu)
    private static List<Category> categoryList = new ArrayList<>();

    // ===== Constructor =====
    public Category(int categoryID, String name, String description, int parentCategoryID, 
                    String status, String imageURL, Date createdDate, Date updatedDate) {
        this.categoryID = categoryID;
        this.name = name;
        this.description = description;
        this.parentCategoryID = parentCategoryID;
        this.status = status;
        this.imageURL = imageURL;
        this.createdDate = createdDate;
        this.updatedDate = updatedDate;
    }

    // ===== Getters & Setters =====
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

    public Date getCreatedDate() { return createdDate; }
    public void setCreatedDate(Date createdDate) { this.createdDate = createdDate; }

    public Date getUpdatedDate() { return updatedDate; }
    public void setUpdatedDate(Date updatedDate) { this.updatedDate = updatedDate; }

    // ===== Methods =====

    /**
     * Tạo danh mục mới
     */
    public static Category createCategory(String name, String description, int parentCategoryID, String imageURL) {
        int newID = categoryList.size() + 1;
        Date now = new Date();
        Category newCategory = new Category(newID, name, description, parentCategoryID, 
                                            "ACTIVE", imageURL, now, now);
        categoryList.add(newCategory);
        System.out.println("Đã tạo danh mục mới: " + name + " (ID: " + newID + ")");
        return newCategory;
    }

    /**
     * Cập nhật thông tin danh mục
     */
    public static void updateCategory(int categoryID, String name, String description, 
                                      int parentCategoryID, String status, String imageURL) {
        for (Category cat : categoryList) {
            if (cat.getCategoryID() == categoryID) {
                cat.setName(name);
                cat.setDescription(description);
                cat.setParentCategoryID(parentCategoryID);
                cat.setStatus(status);
                cat.setImageURL(imageURL);
                cat.setUpdatedDate(new Date());
                System.out.println("Đã cập nhật danh mục ID: " + categoryID);
                return;
            }
        }
        System.out.println("Không tìm thấy danh mục ID: " + categoryID);
    }

    /**
     * Xóa danh mục
     */
    public static void deleteCategory(int categoryID) {
        categoryList.removeIf(cat -> cat.getCategoryID() == categoryID);
        System.out.println("Đã xóa danh mục ID: " + categoryID);
    }

    /**
     * Lấy thông tin chi tiết danh mục
     */
    public static Category getCategoryInfo(int categoryID) {
        for (Category cat : categoryList) {
            if (cat.getCategoryID() == categoryID) {
                System.out.println("===== Thông tin danh mục =====");
                System.out.println("ID: " + cat.getCategoryID());
                System.out.println("Tên: " + cat.getName());
                System.out.println("Mô tả: " + cat.getDescription());
                System.out.println("Danh mục cha: " + cat.getParentCategoryID());
                System.out.println("Trạng thái: " + cat.getStatus());
                System.out.println("Ảnh đại diện: " + cat.getImageURL());
                System.out.println("Ngày tạo: " + cat.getCreatedDate());
                System.out.println("Ngày cập nhật: " + cat.getUpdatedDate());
                return cat;
            }
        }
        System.out.println("Không tìm thấy danh mục ID: " + categoryID);
        return null;
    }

    /**
     * Liệt kê các danh mục con theo danh mục cha
     */
    public static List<Category> listSubCategories(int parentCategoryID) {
        List<Category> subCategories = new ArrayList<>();
        for (Category cat : categoryList) {
            if (cat.getParentCategoryID() == parentCategoryID) {
                subCategories.add(cat);
            }
        }
        System.out.println("Danh sách danh mục con của parentID " + parentCategoryID + ":");
        for (Category sub : subCategories) {
            System.out.println("- " + sub.getName() + " (ID: " + sub.getCategoryID() + ")");
        }
        return subCategories;
    }

    /**
     * Tìm kiếm danh mục theo từ khóa
     */
    public static List<Category> searchCategory(String keyword) {
        List<Category> results = new ArrayList<>();
        for (Category cat : categoryList) {
            if (cat.getName().toLowerCase().contains(keyword.toLowerCase()) ||
                cat.getDescription().toLowerCase().contains(keyword.toLowerCase())) {
                results.add(cat);
            }
        }
        System.out.println("Kết quả tìm kiếm cho từ khóa '" + keyword + "':");
        for (Category result : results) {
            System.out.println("- " + result.getName() + " (ID: " + result.getCategoryID() + ")");
        }
        return results;
    }

    /**
     * Liệt kê sản phẩm thuộc danh mục (giả lập)
     */
    public static void listProducts(int categoryID) {
        // Trong thực tế sẽ truy vấn từ DB, ở đây giả lập dữ liệu
        System.out.println("Danh sách sản phẩm trong danh mục ID: " + categoryID);
        System.out.println("- Sản phẩm A");
        System.out.println("- Sản phẩm B");
        System.out.println("- Sản phẩm C");
    }
}
