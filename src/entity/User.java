package entity;

import java.util.Date;

public class User {
    // ===== Thuộc tính =====
    private String name;        // Họ tên người dùng
    private String email;       // Địa chỉ email
    private String password;    // Mật khẩu
    private String phone;       // Số điện thoại
    private String address;     // Địa chỉ
    private boolean status;     // Trạng thái tài khoản: true = Active, false = Locked
    private Date createdAt;     // Ngày tạo tài khoản
    private String role;        // Vai trò: Admin, Customer, Staff

    // ===== Constructor =====
    public User() {
        this.createdAt = new Date(); // Mặc định là thời điểm tạo object
        this.status = true;          // Mặc định tài khoản active
    }

    public User(String name, String email, String password, String phone, String address, String role) {
        this.name = name;
        this.email = email;
        this.password = password;
        this.phone = phone;
        this.address = address;
        this.role = role;
        this.status = true;
        this.createdAt = new Date();
    }

    // ===== Getter & Setter =====
    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getPhone() {
        return phone;
    }

    public void setPhone(String phone) {
        this.phone = phone;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public boolean isStatus() {
        return status;
    }

    public void setStatus(boolean status) {
        this.status = status;
    }

    public Date getCreatedAt() {
        return createdAt;
    }

    public String getRole() {
        return role;
    }

    public void setRole(String role) {
        this.role = role;
    }

    // ===== Các phương thức nghiệp vụ =====
    // 1. Tạo tài khoản mới
    public void createUser(User newUser) {
        System.out.println("Tạo tài khoản thành công cho: " + newUser.getName() + " với vai trò: " + newUser.getRole());
        // Có thể thêm logic lưu vào database
    }

    // 2. Đăng nhập
    public boolean login(String email, String password) {
        if (this.email.equals(email) && this.password.equals(password) && this.status) {
            System.out.println("Đăng nhập thành công!");
            return true;
        } else {
            System.out.println("Đăng nhập thất bại! Email hoặc mật khẩu không đúng.");
            return false;
        }
    }

    // 3. Đăng xuất
    public void logout() {
        System.out.println(this.name + " đã đăng xuất.");
    }

    // 4. Đổi mật khẩu
    public boolean changePassword(String oldPassword, String newPassword) {
        if (this.password.equals(oldPassword)) {
            this.password = newPassword;
            System.out.println("Đổi mật khẩu thành công!");
            return true;
        } else {
            System.out.println("Mật khẩu cũ không đúng!");
            return false;
        }
    }

    // 5. Cập nhật thông tin cá nhân
    public void updateProfile(String name, String phone, String address) {
        this.name = name;
        this.phone = phone;
        this.address = address;
        System.out.println("Thông tin cá nhân đã được cập nhật!");
    }

    // ===== Hiển thị thông tin người dùng =====
    public void displayInfo() {
        System.out.println("=== Thông tin người dùng ===");
        System.out.println("Họ tên: " + name);
        System.out.println("Email: " + email);
        System.out.println("SĐT: " + phone);
        System.out.println("Địa chỉ: " + address);
        System.out.println("Vai trò: " + role);
        System.out.println("Trạng thái: " + (status ? "Active" : "Locked"));
        System.out.println("Ngày tạo: " + createdAt);
    }
}
