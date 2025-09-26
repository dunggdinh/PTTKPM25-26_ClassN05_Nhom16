import java.util.*;

public class Cart {
    // ===== Attributes =====
    private int cartID;                     // Mã giỏ hàng
    private int customerID;                 // Mã khách hàng
    private List<CartItem> cartItems;       // Danh sách sản phẩm trong giỏ
    private Discount appliedDiscount;       // Khuyến mãi áp dụng (nếu có)

    // Bộ nhớ giả lập Database để lưu giỏ hàng
    private static Map<Integer, Cart> savedCarts = new HashMap<>();

    // ===== Constructor =====
    public Cart(int cartID, int customerID) {
        this.cartID = cartID;
        this.customerID = customerID;
        this.cartItems = new ArrayList<>();
    }

    // ===== Getters =====
    public int getCartID() { return cartID; }
    public int getCustomerID() { return customerID; }
    public List<CartItem> getCartItems() { return cartItems; }

    // ================= Methods =================

    /**
     * 1. Thêm sản phẩm vào giỏ hàng
     */
    public void addItem(Product product, int quantity) {
        for (CartItem item : cartItems) {
            if (item.getProduct().getProductID().equals(product.getProductID())) {
                item.updateQuantity(item.getQuantity() + quantity);
                System.out.println("Đã tăng số lượng sản phẩm: " + product.getName());
                return;
            }
        }
        cartItems.add(new CartItem(cartItems.size() + 1, this.cartID, product, quantity, new Date()));
        System.out.println("Đã thêm sản phẩm vào giỏ: " + product.getName());
    }

    /**
     * 2. Xóa sản phẩm khỏi giỏ
     */
    public void removeItem(String productID) {
        Iterator<CartItem> iterator = cartItems.iterator();
        while (iterator.hasNext()) {
            CartItem item = iterator.next();
            if (item.getProduct().getProductID().equals(productID)) {
                iterator.remove();
                System.out.println("Đã xóa sản phẩm có ID: " + productID);
                return;
            }
        }
        System.out.println("Không tìm thấy sản phẩm để xóa!");
    }

    /**
     * 3. Cập nhật số lượng sản phẩm
     */
    public void updateItem(String productID, int quantity) {
        for (CartItem item : cartItems) {
            if (item.getProduct().getProductID().equals(productID)) {
                item.updateQuantity(quantity);
                System.out.println("Đã cập nhật số lượng sản phẩm: " + productID + " -> " + quantity);
                return;
            }
        }
        System.out.println("Không tìm thấy sản phẩm để cập nhật!");
    }

    /**
     * 4. Lấy danh sách sản phẩm trong giỏ
     */
    public List<CartItem> getCartItemsList() {
        return new ArrayList<>(cartItems);
    }

    /**
     * 5. Trả về tổng số lượng sản phẩm trong giỏ
     */
    public int getItemCount() {
        int count = 0;
        for (CartItem item : cartItems) {
            count += item.getQuantity();
        }
        return count;
    }

    /**
     * 6. Tính tổng tiền giỏ hàng
     */
    public double calculateTotal() {
        double total = 0;
        for (CartItem item : cartItems) {
            total += item.calculateSubtotal();
        }

        // Nếu có khuyến mãi
        if (appliedDiscount != null) {
            double discountAmount = appliedDiscount.calculateDiscount(total);
            total -= discountAmount;
            System.out.println("Khuyến mãi áp dụng: -" + discountAmount + " VND");
        }

        return total;
    }

    /**
     * 7. Áp dụng khuyến mãi
     */
    public void applyPromotion(Discount discount) {
        if (discount.isExpired()) {
            System.out.println("Mã khuyến mãi đã hết hạn!");
            return;
        }
        this.appliedDiscount = discount;
        System.out.println("Đã áp dụng mã khuyến mãi: " + discount.getCode());
    }

    /**
     * 8. Xóa toàn bộ giỏ hàng
     */
    public void clearCart() {
        cartItems.clear();
        appliedDiscount = null;
        System.out.println("Giỏ hàng đã được làm trống.");
    }

    /**
     * 9. Lưu giỏ hàng vào bộ nhớ (giả lập DB)
     */
    public void saveCart() {
        savedCarts.put(this.cartID, this);
        System.out.println("Đã lưu giỏ hàng với ID: " + cartID);
    }

    /**
     * 10. Khôi phục giỏ hàng từ bộ nhớ (giả lập DB)
     */
    public static Cart restoreCart(int cartID) {
        if (savedCarts.containsKey(cartID)) {
            System.out.println("Đã khôi phục giỏ hàng ID: " + cartID);
            return savedCarts.get(cartID);
        } else {
            System.out.println("Không tìm thấy giỏ hàng với ID: " + cartID);
            return null;
        }
    }

    /**
     * Hiển thị thông tin giỏ hàng
     */
    public void displayCart() {
        System.out.println("\n===== Giỏ hàng ID: " + cartID + " | Khách hàng ID: " + customerID + " =====");
        if (cartItems.isEmpty()) {
            System.out.println("Giỏ hàng trống.");
            return;
        }
        for (CartItem item : cartItems) {
            System.out.println("- " + item.getProduct().getName() +
                               " | Giá: " + item.getProduct().getPrice() +
                               " | SL: " + item.getQuantity() +
                               " | Thành tiền: " + item.calculateSubtotal());
        }
        System.out.println("Tổng tiền (sau khuyến mãi nếu có): " + calculateTotal() + " VND");
    }
}
