package entity;

import java.util.ArrayList;
import java.util.Date;
import java.util.Iterator;
import java.util.List;

public class DiscountManagement {

    // ===== Thuộc tính =====
    private List<Discount> discountCodes;    // Danh sách tất cả mã giảm giá
    private List<Discount> activeDiscounts;  // Danh sách mã đang có hiệu lực
    private List<Discount> expiredDiscounts; // Danh sách mã đã hết hạn

    // ===== Constructor =====
    public DiscountManagement() {
        this.discountCodes = new ArrayList<>();
        this.activeDiscounts = new ArrayList<>();
        this.expiredDiscounts = new ArrayList<>();
    }

    // ===== Phương thức =====

    /**
     * 1. Thêm mã giảm giá mới
     */
    public void createDiscountCode(Discount discount) {
        if (discount == null) {
            System.out.println("Không thể tạo mã giảm giá rỗng.");
            return;
        }
        discountCodes.add(discount);

        if (!discount.isExpired()) {
            activeDiscounts.add(discount);
        } else {
            expiredDiscounts.add(discount);
        }

        System.out.println("Đã thêm mã giảm giá: " + discount.getCode());
    }

    /**
     * 2. Sửa thông tin mã giảm giá
     */
    public void updateDiscountCode(String codeID, Discount newInfo) {
        for (int i = 0; i < discountCodes.size(); i++) {
            Discount existing = discountCodes.get(i);
            if (existing.getDiscountID().equalsIgnoreCase(codeID)) {
                discountCodes.set(i, newInfo);

                if (!newInfo.isExpired()) {
                    activeDiscounts.remove(existing);
                    activeDiscounts.add(newInfo);
                } else {
                    expiredDiscounts.add(newInfo);
                }

                System.out.println("Cập nhật thành công mã giảm giá: " + codeID);
                return;
            }
        }
        System.out.println("Không tìm thấy mã giảm giá có ID: " + codeID);
    }

    /**
     * 3. Xóa mã giảm giá
     */
    public void deleteDiscountCode(String codeID) {
        Iterator<Discount> iterator = discountCodes.iterator();
        boolean found = false;

        while (iterator.hasNext()) {
            Discount discount = iterator.next();
            if (discount.getDiscountID().equalsIgnoreCase(codeID)) {
                iterator.remove();
                activeDiscounts.remove(discount);
                expiredDiscounts.remove(discount);
                found = true;
                System.out.println("Đã xóa mã giảm giá: " + codeID);
                break;
            }
        }

        if (!found) {
            System.out.println("Không tìm thấy mã giảm giá để xóa.");
        }
    }

    /**
     * 4. Liệt kê tất cả mã đang có hiệu lực
     */
    public void listActiveDiscounts() {
        System.out.println("===== Danh sách mã giảm giá đang hoạt động =====");
        if (activeDiscounts.isEmpty()) {
            System.out.println("Không có mã giảm giá nào đang hoạt động.");
            return;
        }

        for (Discount discount : activeDiscounts) {
            System.out.println("- " + discount.getCode() + " | " + discount.getDescription() +
                    " | Hết hạn: " + discount.getEndDate());
        }
    }

    /**
     * 5. Ngưng hiệu lực mã giảm giá
     */
    public void expireDiscount(String codeID) {
        for (Discount discount : activeDiscounts) {
            if (discount.getDiscountID().equalsIgnoreCase(codeID)) {
                discount.setStatus("Ngưng hiệu lực");
                activeDiscounts.remove(discount);
                expiredDiscounts.add(discount);
                System.out.println("Mã giảm giá " + codeID + " đã bị ngưng hiệu lực.");
                return;
            }
        }
        System.out.println("Không tìm thấy mã giảm giá để ngưng hiệu lực.");
    }

    /**
     * 6. Tự động cập nhật trạng thái mã giảm giá khi hết hạn
     */
    public void autoUpdateExpiredDiscounts() {
        Date now = new Date();
        Iterator<Discount> iterator = activeDiscounts.iterator();

        while (iterator.hasNext()) {
            Discount discount = iterator.next();
            if (discount.getEndDate().before(now)) {
                discount.setStatus("Hết hạn");
                iterator.remove();
                expiredDiscounts.add(discount);
                System.out.println("Mã " + discount.getCode() + " đã tự động chuyển sang trạng thái Hết hạn.");
            }
        }
    }

    /**
     * 7. Tìm kiếm mã giảm giá theo code
     */
    public Discount findDiscountByCode(String code) {
        for (Discount discount : discountCodes) {
            if (discount.getCode().equalsIgnoreCase(code)) {
                return discount;
            }
        }
        return null;
    }

    /**
     * 8. Kiểm tra và áp dụng mã giảm giá
     */
    public double applyDiscount(String code, double orderAmount, List<String> orderCategories) {
        Discount discount = findDiscountByCode(code);

        if (discount == null) {
            System.out.println("Không tìm thấy mã giảm giá.");
            return 0.0;
        }

        if (!discount.validateDiscountCode(code, orderAmount, orderCategories)) {
            return 0.0;
        }

        discount.incrementUsedCount();
        System.out.println("Mã giảm giá áp dụng thành công!");
        return discount.calculateDiscount(orderAmount);
    }

    /**
     * 9. Hiển thị tất cả mã đã hết hạn
     */
    public void listExpiredDiscounts() {
        System.out.println("===== Danh sách mã giảm giá đã hết hạn =====");
        if (expiredDiscounts.isEmpty()) {
            System.out.println("Không có mã giảm giá nào đã hết hạn.");
            return;
        }

        for (Discount discount : expiredDiscounts) {
            System.out.println("- " + discount.getCode() + " | " + discount.getDescription() +
                    " | Hết hạn từ: " + discount.getEndDate());
        }
    }
}
