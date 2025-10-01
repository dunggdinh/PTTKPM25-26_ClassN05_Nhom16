package entity;

import java.util.ArrayList;
import java.util.List;

public class ProductManagement extends Admin {
    // ===== Thuộc tính =====
    private List<Product> products;     // Danh sách sản phẩm trong hệ thống
    private List<Category> categories;  // Danh mục sản phẩm

    // ===== Constructor =====
    public ProductManagement(int adminID, String name, String email, String password,
                             String phone, String address, String role) {
        super(adminID, name, email, password, phone, address, role);
        this.products = new ArrayList<>();
        this.categories = new ArrayList<>();
    }

    // ================== QUẢN LÝ SẢN PHẨM ==================

    /** 1. Thêm sản phẩm mới */
    public void addProduct(Product productInfo) {
        for (Product p : products) {
            if (p.getProductID().equals(productInfo.getProductID())) {
                System.out.println("❌ Sản phẩm với ID này đã tồn tại!");
                return;
            }
        }
        products.add(productInfo);
        System.out.println("✅ Đã thêm sản phẩm thành công: " + productInfo.getName());
    }

    /** 2. Cập nhật thông tin sản phẩm */
    public void updateProduct(String productID, Product newInfo) {
        for (Product p : products) {
            if (p.getProductID().equals(productID)) {
                p.updateProductInfo(newInfo);
                System.out.println("✅ Đã cập nhật thông tin sản phẩm có ID: " + productID);
                return;
            }
        }
        System.out.println("❌ Không tìm thấy sản phẩm với ID: " + productID);
    }

    /** 3. Xóa sản phẩm */
    public void deleteProduct(String productID) {
        for (Product p : products) {
            if (p.getProductID().equals(productID)) {
                products.remove(p);
                System.out.println("✅ Đã xóa sản phẩm có ID: " + productID);
                return;
            }
        }
        System.out.println("❌ Không tìm thấy sản phẩm với ID: " + productID);
    }

    /** 4. Lấy thông tin chi tiết sản phẩm */
    public Product getProduct(String productID) {
        for (Product p : products) {
            if (p.getProductID().equals(productID)) {
                p.getProductInfo();
                return p;
            }
        }
        System.out.println("❌ Không tìm thấy sản phẩm với ID: " + productID);
        return null;
    }

    /** 5. Tìm kiếm sản phẩm theo tên hoặc danh mục */
    public List<Product> searchProduct(String keyword) {
        List<Product> result = new ArrayList<>();
        for (Product p : products) {
            if (p.getName().toLowerCase().contains(keyword.toLowerCase()) ||
                p.getCategory().toLowerCase().contains(keyword.toLowerCase())) {
                result.add(p);
            }
        }

        if (result.isEmpty()) {
            System.out.println("❌ Không tìm thấy sản phẩm nào với từ khóa: " + keyword);
        } else {
            System.out.println("🔍 Kết quả tìm kiếm cho từ khóa '" + keyword + "':");
            for (Product p : result) {
                System.out.println("- " + p.getName() + " (ID: " + p.getProductID() + ")");
            }
        }

        return result;
    }

    /** 6. Liệt kê tất cả sản phẩm */
    public void displayAllProducts() {
        if (products.isEmpty()) {
            System.out.println("⚠ Không có sản phẩm nào trong hệ thống.");
            return;
        }
        System.out.println("=== Danh sách sản phẩm ===");
        for (Product p : products) {
            p.getProductInfo();
            System.out.println("-------------------------");
        }
    }

    // ================== QUẢN LÝ DANH MỤC ==================

    /** Thêm danh mục vào danh sách */
    public void addCategory(Category category) {
        for (Category c : categories) {
            if (c.getCategoryID() == category.getCategoryID()) {
                System.out.println("❌ Danh mục với ID này đã tồn tại!");
                return;
            }
        }
        categories.add(category);
        System.out.println("✅ Đã thêm danh mục mới: " + category.getName());
    }

    /** Lấy danh sách tất cả danh mục */
    public List<Category> getCategories() {
        return categories;
    }

    /** Liệt kê tất cả danh mục */
    public void displayAllCategories() {
        if (categories.isEmpty()) {
            System.out.println("⚠ Không có danh mục nào.");
            return;
        }
        System.out.println("=== Danh sách danh mục ===");
        for (Category c : categories) {
            System.out.println("ID: " + c.getCategoryID() + " | Tên: " + c.getName() + " | Trạng thái: " + c.getStatus());
        }
    }

    /** Tìm danh mục theo ID */
    public Category findCategoryByID(int categoryID) {
        for (Category c : categories) {
            if (c.getCategoryID() == categoryID) {
                return c;
            }
        }
        System.out.println("❌ Không tìm thấy danh mục với ID: " + categoryID);
        return null;
    }
}
