import java.util.ArrayList;
import java.util.List;

public class InventoryManagement {
    // ===== Thuộc tính =====
    private List<Product> products;        // Danh sách tất cả sản phẩm trong hệ thống
    private List<Inventory> inventoryList; // Danh sách tồn kho cho từng sản phẩm

    // ===== Constructor =====
    public InventoryManagement() {
        this.products = new ArrayList<>();
        this.inventoryList = new ArrayList<>();
    }

    // ===== Getter & Setter =====
    public List<Product> getProducts() {
        return products;
    }

    public List<Inventory> getInventoryList() {
        return inventoryList;
    }

    // ===== Các phương thức nghiệp vụ =====

    /**
     * Thêm sản phẩm mới vào hệ thống và kho.
     */
    public void addProductToInventory(Product product, int initialQuantity) {
        products.add(product);
        Inventory inventory = new Inventory("INV-" + product.getProductID(), product, initialQuantity);
        inventoryList.add(inventory);
        System.out.println("Đã thêm sản phẩm '" + product.getName() + "' vào kho với số lượng: " + initialQuantity);
    }

    /**
     * Lấy danh sách các sản phẩm có số lượng tồn kho thấp (mặc định < 10).
     */
    public List<Inventory> getLowStockProducts() {
        List<Inventory> lowStockList = new ArrayList<>();
        for (Inventory inv : inventoryList) {
            if (inv.getQuantity() < 10) {
                lowStockList.add(inv);
            }
        }
        if (lowStockList.isEmpty()) {
            System.out.println("Không có sản phẩm nào sắp hết hàng.");
        } else {
            System.out.println("Danh sách sản phẩm tồn kho thấp:");
            for (Inventory inv : lowStockList) {
                System.out.println("- " + inv.getProduct().getName() + " | Còn lại: " + inv.getQuantity());
            }
        }
        return lowStockList;
    }

    /**
     * Kiểm tra sản phẩm còn hàng hay hết hàng.
     * @param productID Mã sản phẩm cần kiểm tra.
     * @return true nếu còn hàng, false nếu hết.
     */
    public boolean checkProductAvailability(String productID) {
        for (Inventory inv : inventoryList) {
            if (inv.getProduct().getProductID().equals(productID)) {
                boolean available = inv.getQuantity() > 0;
                System.out.println("Sản phẩm '" + inv.getProduct().getName() + "' còn hàng: " + available);
                return available;
            }
        }
        System.out.println("Không tìm thấy sản phẩm với ID: " + productID);
        return false;
    }

    /**
     * Gửi cảnh báo các sản phẩm có tồn kho thấp.
     */
    public void alertLowStock() {
        System.out.println("=== Cảnh báo sản phẩm sắp hết hàng ===");
        boolean hasAlert = false;
        for (Inventory inv : inventoryList) {
            if (inv.getQuantity() < 10) {
                System.out.println("Cảnh báo: " + inv.getProduct().getName() + " (Còn: " + inv.getQuantity() + ")");
                hasAlert = true;
            }
        }
        if (!hasAlert) {
            System.out.println("Tất cả sản phẩm đều có tồn kho an toàn.");
        }
    }

    /**
     * Tìm sản phẩm trong kho theo ID.
     */
    public Inventory findInventoryByProductID(String productID) {
        for (Inventory inv : inventoryList) {
            if (inv.getProduct().getProductID().equals(productID)) {
                return inv;
            }
        }
        System.out.println("Không tìm thấy sản phẩm trong kho với ID: " + productID);
        return null;
    }

    /**
     * Hiển thị toàn bộ thông tin kho hàng.
     */
    public void displayAllInventory() {
        System.out.println("=== Danh sách tồn kho ===");
        for (Inventory inv : inventoryList) {
            inv.displayInventoryInfo();
            System.out.println("-----------------------------");
        }
    }
}
