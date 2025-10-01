package entity;

public class Admin extends User {
    // ===== Thuộc tính riêng của Admin =====
    private int adminID; // Mã định danh quản trị viên

    // ===== Constructor =====
    public Admin(int adminID, String name, String email, String password,
                 String phone, String address, String role) {
        super(name, email, password, phone, address, role); // Gọi constructor lớp User
        this.adminID = adminID;
    }

    // ===== Getter & Setter =====
    public int getAdminID() {
        return adminID;
    }

    public void setAdminID(int adminID) {
        this.adminID = adminID;
    }
}
