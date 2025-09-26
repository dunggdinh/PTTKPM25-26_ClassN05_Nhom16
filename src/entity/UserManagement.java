package entity;

import java.util.ArrayList;
import java.util.List;

public class UserManagement {
    // ===== Attributes =====
    private List<Customer> customers; // Danh sách khách hàng
    private List<Admin> admins;       // Danh sách quản trị viên

    // ===== Constructor =====
    public UserManagement() {
        this.customers = new ArrayList<>();
        this.admins = new ArrayList<>();
    }

    // ================= CUSTOMER METHODS =================

    /**
     * Lấy thông tin chi tiết khách hàng
     */
    public Customer getCustomerProfile(int customerID) {
        for (Customer c : customers) {
            if (c.getCustomerID() == customerID) {
                System.out.println("Thông tin khách hàng: " + c.getName() + ", Email: " + c.getEmail());
                return c;
            }
        }
        System.out.println("Không tìm thấy khách hàng với ID: " + customerID);
        return null;
    }

    /**
     * Cập nhật thông tin khách hàng
     */
    public void updateCustomerProfile(int customerID, Customer newProfile) {
        for (int i = 0; i < customers.size(); i++) {
            if (customers.get(i).getCustomerID() == customerID) {
                customers.set(i, newProfile);
                System.out.println("Cập nhật thông tin khách hàng thành công cho ID: " + customerID);
                return;
            }
        }
        System.out.println("Không tìm thấy khách hàng để cập nhật!");
    }

    /**
     * Xóa tài khoản khách hàng
     */
    public void deleteCustomerProfile(int customerID) {
        boolean removed = customers.removeIf(c -> c.getCustomerID() == customerID);
        if (removed) {
            System.out.println("Đã xóa khách hàng có ID: " + customerID);
        } else {
            System.out.println("Không tìm thấy khách hàng để xóa!");
        }
    }

    /**
     * Khóa tài khoản khách hàng
     */
    public void lockCustomerAccount(int customerID) {
        for (Customer c : customers) {
            if (c.getCustomerID() == customerID) {
                c.setStatus(false); // false = Locked
                System.out.println("Tài khoản khách hàng ID: " + customerID + " đã bị khóa.");
                return;
            }
        }
        System.out.println("Không tìm thấy khách hàng để khóa tài khoản!");
    }

    /**
     * Mở khóa tài khoản khách hàng
     */
    public void unlockCustomerAccount(int customerID) {
        for (Customer c : customers) {
            if (c.getCustomerID() == customerID) {
                c.setStatus(true); // true = Active
                System.out.println("Tài khoản khách hàng ID: " + customerID + " đã được mở khóa.");
                return;
            }
        }
        System.out.println("Không tìm thấy khách hàng để mở khóa!");
    }

    // ================= ADMIN METHODS =================

    /**
     * Lấy thông tin chi tiết quản trị viên
     */
    public Admin getAdminProfile(int adminID) {
        for (Admin a : admins) {
            if (a.getAdminID() == adminID) {
                System.out.println("Thông tin Admin: " + a.getName() + ", Email: " + a.getEmail());
                return a;
            }
        }
        System.out.println("Không tìm thấy Admin với ID: " + adminID);
        return null;
    }

    /**
     * Cập nhật thông tin quản trị viên
     */
    public void updateAdminProfile(int adminID, Admin newProfile) {
        for (int i = 0; i < admins.size(); i++) {
            if (admins.get(i).getAdminID() == adminID) {
                admins.set(i, newProfile);
                System.out.println("Cập nhật thông tin Admin thành công cho ID: " + adminID);
                return;
            }
        }
        System.out.println("Không tìm thấy Admin để cập nhật!");
    }

    /**
     * Xóa quản trị viên
     */
    public void deleteAdminProfile(int adminID) {
        boolean removed = admins.removeIf(a -> a.getAdminID() == adminID);
        if (removed) {
            System.out.println("Đã xóa Admin có ID: " + adminID);
        } else {
            System.out.println("Không tìm thấy Admin để xóa!");
        }
    }

    // ================= UTILITY METHODS =================

    public void addCustomer(Customer customer) {
        customers.add(customer);
        System.out.println("Đã thêm khách hàng: " + customer.getName());
    }

    public void addAdmin(Admin admin) {
        admins.add(admin);
        System.out.println("Đã thêm Admin: " + admin.getName());
    }

    public List<Customer> getAllCustomers() {
        return customers;
    }

    public List<Admin> getAllAdmins() {
        return admins;
    }
}
