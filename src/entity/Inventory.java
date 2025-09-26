import java.util.Date;

public class Inventory {
    // ===== Thuộc tính =====
    private String inventoryID;    // Mã kho
    private Product product;       // Sản phẩm trong kho
    private int quantity;          // Số lượng sản phẩm tồn kho
    private Date lastUpdated;      // Ngày cập nhật kho

    // ===== Constructor =====
    public Inventory(String inventoryID, Product product, int quantity) {
        this.inventoryID = inventoryID;
        this.product = product;
        this.quantity = quantity;
        this.lastUpdated = new Date(); // Mặc định thời gian tạo là hiện tại
    }

    // ===== Getter & Setter =====
    public String getInventoryID() {
        return inventoryID;
    }

    public void setInventoryID(String inventoryID) {
        this.inventoryID = inventoryID;
    }

    public Product getProduct() {
        return product;
    }

    public void setProduct(Product product) {
        this.product = product;
    }

    public int getQuantity() {
        return quantity;
    }

    public void setQuantity(int quantity) {
        this.quantity = quantity;
        updateLastUpdated();
    }

    public Date getLastUpdated() {
        return lastUpdated;
    }

    private void updateLastUpdated() {
        this.lastUpdated = new Date();
    }

    // ===== Các phương thức nghiệp vụ =====

    /**
     * Tăng số lượng sản phẩm vào kho.
     * @param product Sản phẩm cần thêm.
     * @param quantity Số lượng cần tăng.
     */
    public void increaseStock(Product product, int quantity) {
        if (this.product.getProductID().equals(product.getProductID())) {
            this.quantity += quantity;
            updateLastUpdated();
            System.out.println("Đã thêm " + quantity + " sản phẩm " + product.getName() + " vào kho.");
        } else {
            System.out.println("Sản phẩm không khớp với kho này!");
        }
    }

    /**
     * Giảm số lượng sản phẩm trong kho.
     * @param product Sản phẩm cần giảm.
     * @param quantity Số lượng cần giảm.
     */
    public void decreaseStock(Product product, int quantity) {
        if (this.product.getProductID().equals(product.getProductID())) {
            if (this.quantity >= quantity) {
                this.quantity -= quantity;
                updateLastUpdated();
                System.out.println("Đã xuất " + quantity + " sản phẩm " + product.getName() + " ra khỏi kho.");
            } else {
                System.out.println("Không đủ sản phẩm trong kho để xuất!");
            }
        } else {
            System.out.println("Sản phẩm không khớp với kho này!");
        }
    }

    /**
     * Cảnh báo khi tồn kho dưới mức an toàn (ví dụ < 10 sản phẩm).
     */
    public void alertLowStock(String productID) {
        if (this.product.getProductID().equals(productID) && this.quantity < 10) {
            System.out.println("Cảnh báo: Sản phẩm '" + product.getName() + "' sắp hết hàng! (Còn: " + this.quantity + ")");
        }
    }

    /**
     * Kiểm tra số lượng tồn kho hiện tại.
     * @return Số lượng tồn kho.
     */
    public int checkStock(String productID) {
        if (this.product.getProductID().equals(productID)) {
            return this.quantity;
        }
        System.out.println("Không tìm thấy sản phẩm với ID: " + productID);
        return -1;
    }

    /**
     * Hiển thị thông tin kho hàng.
     */
    public void displayInventoryInfo() {
        System.out.println("=== Thông tin kho hàng ===");
        System.out.println("Mã kho: " + inventoryID);
        System.out.println("Sản phẩm: " + product.getName() + " (ID: " + product.getProductID() + ")");
        System.out.println("Số lượng tồn kho: " + quantity);
        System.out.println("Ngày cập nhật: " + lastUpdated);
    }
}
