# PTTKPM25-26_ClassN05_Nhom16
# HỆ THỐNG QUẢN LÝ CỬA HÀNG THIẾT BỊ ĐIỆN TỬ TRỰC TUYẾN
Dự án mô phỏng một nền tảng thương mại điện tử chuyên về **thiết bị điện tử**, cho phép người dùng:
- Duyệt sản phẩm, lọc theo danh mục/giá/thương hiệu  
- Quản lý giỏ hàng và đặt hàng  
- Thanh toán trực tuyến an toàn qua cổng tích hợp (OTP/3DS)  
- Theo dõi trạng thái đơn hàng  
- Đánh giá và gửi yêu cầu hỗ trợ khách hàng  

Ở phía **quản trị**, hệ thống cung cấp:
- Quản lý sản phẩm, tồn kho, người dùng và đơn hàng  
- Theo dõi giao dịch, hoàn tiền, khuyến mãi, và thống kê báo cáo  

---

## 🎯 Mục tiêu dự án
1. Xây dựng hệ thống thương mại điện tử đầy đủ các chức năng cơ bản: quản lý sản phẩm, giỏ hàng, thanh toán, chăm sóc khách hàng.  
2. Đảm bảo tiêu chí **phi chức năng**: hiệu năng cao, khả năng mở rộng, bảo mật, và trải nghiệm người dùng tốt.  
3. Triển khai kiến trúc ba tầng **(Three-Tier Architecture)** gồm:
   - **Presentation Layer:** Giao diện người dùng (UI, Controller)
   - **Business Layer:** Logic nghiệp vụ (Service)
   - **Data Layer:** Xử lý dữ liệu (Repository, Database)

---

## 👨‍💻 Thành viên nhóm

| STT | Họ và tên | Mã SV |
|-----|------------|--------|
| 1 | Nguyễn Văn Thăng | 23010572 |
| 2 | Phạm Văn Sự | 23010523 |
| 3 | Đặng Anh Tuyền | 23010912 |
| 4 | Trần Đình Dũng | 23010596 |
| 5 | Nguyễn Huy Toàn | 23017052 |

---

## ⚙️ Công nghệ sử dụng
| Thành phần | Công nghệ/Framework |
|-------------|----------------------|
| **Front-End** | HTML5, CSS3, JavaScript, Bootstrap |
| **Back-End** | PHP (Laravel Framework) |
| **Cơ sở dữ liệu** | MySQL |
| **Quản lý phiên bản** | Git & GitHub |
| **Quy trình phát triển** | Agile – Scrum (chia Sprint, có Product Backlog và Review định kỳ) |

---

## 🧠 Kiến trúc hệ thống

### 1. Mô hình 3 lớp (Three-Tier Architecture)
- **Presentation Layer:**  
  Giao diện người dùng (CustomerUI, AdminUI) và Controller xử lý yêu cầu (ProductController, OrderController…).
- **Business Layer:**  
  Chứa logic nghiệp vụ chính (ProductService, OrderService, PaymentService…).
- **Data Access Layer:**  
  Giao tiếp trực tiếp với cơ sở dữ liệu thông qua các Repository.

### 2. Luồng xử lý chính
1. Người dùng truy cập website → tìm sản phẩm → thêm vào giỏ  
2. Tiến hành đặt hàng → chọn phương thức thanh toán  
3. Hệ thống gửi yêu cầu sang cổng thanh toán → nhận kết quả → cập nhật trạng thái đơn  
4. Quản trị viên xác nhận, đóng gói, giao hàng → cập nhật hệ thống  
5. Người dùng nhận hàng, đánh giá, yêu cầu hỗ trợ nếu cần  

---

## 🧩 Các module chính

### 👤 Khách hàng
- Đăng ký / đăng nhập / xác thực OTP  
- Tìm kiếm, xem chi tiết, lọc sản phẩm  
- Quản lý giỏ hàng, đặt hàng, thanh toán  
- Theo dõi trạng thái đơn hàng, xem lịch sử  
- Viết đánh giá, chat hỗ trợ, nhận thông báo

### 🧑‍💼 Quản trị viên
- Quản lý tài khoản người dùng  
- Quản lý sản phẩm, danh mục, tồn kho  
- Quản lý đơn hàng và xử lý hoàn tiền  
- Quản lý chương trình khuyến mãi, voucher  
- Theo dõi thống kê, xuất báo cáo doanh thu

---

## 🧪 Kiểm thử

---

## 🚀 Hướng phát triển tương lai

---

## 🏆 Đánh giá tổng quan
> Hệ thống đạt tiêu chí của một nền tảng bán hàng trực tuyến hiện đại — có tính mở rộng, bảo mật cao và thân thiện người dùng.  
> Cấu trúc code rõ ràng, tài liệu chi tiết, quy trình phát triển theo Agile giúp nhóm đảm bảo tiến độ và chất lượng sản phẩm.

---

### 📚 Tài liệu liên quan
- [📄 Báo cáo chi tiết dự án](https://github.com/user-attachments/files/23112311/PTTKPM25-26_ClassN05_Nhom16_ver3.docx)
- [💻 Mã nguồn trên GitHub](https://github.com/dunggdinh/PTTKPM25-26_ClassN05_Nhom16)

---


**© 2025 - Nhóm 16 | Đại học Phenikaa – Khoa CNTT**
