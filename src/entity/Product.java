package entity;

import java.util.ArrayList;
import java.util.List;

public class Product {
    // ===== Thuộc tính =====
    private String productID;           // Mã sản phẩm
    private String name;                // Tên sản phẩm
    private String description;         // Mô tả sản phẩm
    private double price;               // Giá bán gốc
    private String brand;               // Thương hiệu
    private String category;            // Danh mục sản phẩm
    private int stockQuantity;          // Số lượng tồn kho
    private int discount;               // Phần trăm giảm giá (%)
    private List<String> images;        // Danh sách hình ảnh sản phẩm
    private String status;              // Trạng thái (Đang bán / Ngừng bán)
    private String warranty;            // Thông tin bảo hành

    // ===== Constructor =====
    public Product(String productID, String name, String description, double price, String brand,
                   String category, int stockQuantity, int discount, String status, String warranty) {
        this.productID = productID;
        this.name = name;
        this.description = description;
        this.price = price;
        this.brand = brand;
        this.category = category;
        this.stockQuantity = stockQuantity;
        this.discount = discount;
        this.images = new ArrayList<>();
        this.status = status;
        this.warranty = warranty;
    }

    // ===== Getter & Setter =====
    public String getProductID() {
        return productID;
    }

    public void setProductID(String productID) {
        this.productID = productID;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public double getPrice() {
        return price;
    }

    public void setPrice(double price) {
        this.price = price;
    }

    public String getBrand() {
        return brand;
    }

    public void setBrand(String brand) {
        this.brand = brand;
    }

    public String getCategory() {
        return category;
    }

    public void setCategory(String category) {
        this.category = category;
    }

    public int getStockQuantity() {
        return stockQuantity;
    }

    public void setStockQuantity(int stockQuantity) {
        this.stockQuantity = stockQuantity;
    }

    public int getDiscount() {
        return discount;
    }

    public void setDiscount(int discount) {
        this.discount = discount;
    }

    public List<String> getImages() {
        return images;
    }

    public void setImages(List<String> images) {
        this.images = images;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public String getWarranty() {
        return warranty;
    }

    public void setWarranty(String warranty) {
        this.warranty = warranty;
    }

    // ===== Các phương thức nghiệp vụ =====

    /** 1. Lấy thông tin sản phẩm */
    public void getProductInfo() {
        System.out.println("=== Thông tin sản phẩm ===");
        System.out.println("Mã sản phẩm: " + productID);
        System.out.println("Tên sản phẩm: " + name);
        System.out.println("Mô tả: " + description);
        System.out.println("Thương hiệu: " + brand);
        System.out.println("Danh mục: " + category);
        System.out.println("Giá gốc: " + price + " VND");
        System.out.println("Giảm giá: " + discount + "%");
        System.out.println("Giá cuối cùng: " + calculateFinalPrice() + " VND");
        System.out.println("Số lượng tồn kho: " + stockQuantity);
        System.out.println("Trạng thái: " + status);
        System.out.println("Bảo hành: " + warranty);
        System.out.println("Danh sách hình ảnh: " + images);
    }

    /** 2. Cập nhật tồn kho */
    public void updateStock(int quantity) {
        if (quantity < 0 && Math.abs(quantity) > stockQuantity) {
            System.out.println("Không đủ hàng để giảm số lượng!");
        } else {
            this.stockQuantity += quantity;
            System.out.println("Cập nhật tồn kho thành công. Số lượng hiện tại: " + this.stockQuantity);
        }
    }

    /** 3. Áp dụng giảm giá */
    public void applyDiscount(int discountPercent) {
        if (discountPercent >= 0 && discountPercent <= 100) {
            this.discount = discountPercent;
            System.out.println("Đã áp dụng giảm giá " + discountPercent + "% cho sản phẩm " + name);
        } else {
            System.out.println("Phần trăm giảm giá không hợp lệ!");
        }
    }

    /** 4. Cập nhật thông tin sản phẩm */
    public void updateProductInfo(Product newInfo) {
        this.name = newInfo.name;
        this.description = newInfo.description;
        this.price = newInfo.price;
        this.brand = newInfo.brand;
        this.category = newInfo.category;
        this.status = newInfo.status;
        this.warranty = newInfo.warranty;
        System.out.println("Cập nhật thông tin sản phẩm thành công!");
    }

    /** 5. Kiểm tra hàng còn hay không */
    public boolean checkAvailability() {
        return stockQuantity > 0 && status.equalsIgnoreCase("Đang bán");
    }

    /** 6. Tính giá sau giảm giá */
    public double calculateFinalPrice() {
        return price - (price * discount / 100.0);
    }

    /** 7. Thêm ảnh sản phẩm */
    public void addImage(String imageURL) {
        images.add(imageURL);
        System.out.println("Đã thêm ảnh sản phẩm: " + imageURL);
    }

    /** 8. Xóa ảnh sản phẩm */
    public void removeImage(String imageURL) {
        if (images.remove(imageURL)) {
            System.out.println("Đã xóa ảnh sản phẩm: " + imageURL);
        } else {
            System.out.println("Không tìm thấy ảnh sản phẩm trong danh sách!");
        }
    }
}
