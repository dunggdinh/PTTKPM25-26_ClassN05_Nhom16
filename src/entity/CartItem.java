import java.util.Date;

public class CartItem {
    // ===== Attributes =====
    private int cartItemID;    // Mã chi tiết giỏ hàng
    private int cartID;        // Mã giỏ hàng
    private Product product;   // Sản phẩm trong giỏ
    private int quantity;      // Số lượng sản phẩm
    private Date addedAt;      // Ngày thêm sản phẩm vào giỏ

    // ===== Constructor =====
    public CartItem(int cartItemID, int cartID, Product product, int quantity, Date addedAt) {
        this.cartItemID = cartItemID;
        this.cartID = cartID;
        this.product = product;
        this.quantity = quantity;
        this.addedAt = addedAt;
    }

    // ===== Getters & Setters =====
    public int getCartItemID() { return cartItemID; }
    public void setCartItemID(int cartItemID) { this.cartItemID = cartItemID; }

    public int getCartID() { return cartID; }
    public void setCartID(int cartID) { this.cartID = cartID; }

    public Product getProduct() { return product; }
    public void setProduct(Product product) { this.product = product; }

    public int getQuantity() { return quantity; }
    public void setQuantity(int quantity) { this.quantity = quantity; }

    public Date getAddedAt() { return addedAt; }
    public void setAddedAt(Date addedAt) { this.addedAt = addedAt; }

    // ===== Methods =====

    /**
     * Cập nhật số lượng sản phẩm
     */
    public void updateQuantity(int newQuantity) {
        if (newQuantity > 0) {
            this.quantity = newQuantity;
            System.out.println("Cập nhật số lượng sản phẩm thành: " + newQuantity);
        } else {
            System.out.println("Số lượng không hợp lệ. Phải lớn hơn 0.");
        }
    }

    /**
     * Tính thành tiền = đơn giá * số lượng
     */
    public double calculateSubtotal() {
        return product.getPrice() * quantity;
    }

    /**
     * Lấy thông tin chi tiết sản phẩm trong giỏ
     */
    public String getCartItemInfo() {
        return "CartItemID: " + cartItemID +
               ", CartID: " + cartID +
               ", Sản phẩm: " + product.getName() +
               ", Số lượng: " + quantity +
               ", Thành tiền: " + calculateSubtotal() +
               ", Ngày thêm: " + addedAt;
    }
}
