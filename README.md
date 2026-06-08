# Mini Clinic App 🏥

Một ứng dụng web PHP nhỏ gọn dùng để hiển thị danh sách lịch khám và xử lý đăng ký lịch khám bệnh thông qua API. Dự án được viết bằng PHP thuần, tuân thủ kiến trúc MVC cơ bản và sử dụng `vlucas/phpdotenv` để quản lý biến môi trường.

---

## 🚀 Yêu cầu hệ thống

* **PHP:** Phiên bản 7.4 hoặc mới hơn (khuyên dùng PHP 8.x).
* **Composer:** Để cài đặt các thư viện phụ thuộc (dependencies).

---

## 🛠️ Hướng dẫn cài đặt

**Bước 1: Cài đặt các thư viện (Dependencies)**
Mở terminal tại thư mục gốc của dự án và chạy lệnh:
```bash
composer install
Bước 2: Thiết lập file môi trường (.env)
Tạo một file có tên là .env ở thư mục gốc của dự án và khai báo tên phòng khám của bạn:

Code snippet
CLINIC_NAME="Tên Phòng Khám Của Bạn"
Bước 3: Khởi chạy máy chủ (Local Server)
Sử dụng PHP Built-in Server để chạy ứng dụng (giả sử file routing chính của bạn nằm ở thư mục gốc hoặc thư mục public):

Bash
php -S localhost:8000
Truy cập http://localhost:8000 trên trình duyệt để xem trang chủ.

📂 Cấu trúc dự án tham khảo
Plaintext
/
├── src/
│   ├── Controller/
│   │   └── AppointmentController.php # Xử lý logic API và Web
│   ├── Data/
│   │   └── appointments.php          # Dữ liệu tĩnh (Mock database)
│   └── Support/
│       └── Env.php                   # Helper đọc biến môi trường
├── views/
│   └── home.php                      # Giao diện trang chủ (Web View)
├── vendor/                           # Thư mục chứa thư viện Composer
├── .env                              # File cấu hình môi trường
├── index.php                         # Entry point (Router)
└── README.md
📡 Tài liệu API (API Endpoints)
1. Trang chủ (Web View)
URL: /

Method: GET

Mô tả: Trả về giao diện HTML hiển thị tên phòng khám và danh sách các lịch khám hiện có.

2. Lấy danh sách lịch khám
URL: /appointments

Method: GET

Mô tả: Trả về toàn bộ dữ liệu lịch khám dưới dạng JSON.

Response: 200 OK

3. Đăng ký lịch khám
URL: /appointments

Method: POST

Headers:

Content-Type: application/json

Body (JSON):

JSON
{
  "patient_name": "Nguyen Van A",
  "appointment_id": 1,
  "quantity": 1
}
(Lưu ý: quantity là không bắt buộc, mặc định hệ thống kiểm tra logic dựa trên số lượng chỗ còn trống available).

Responses:

201 Created: Đăng ký thành công.

404 Not Found: Không tìm thấy ID lịch khám (appointment_id).

415 Unsupported Media Type: Sai định dạng Content-Type (Bắt buộc là application/json).

422 Unprocessable Entity: Dữ liệu đầu vào không hợp lệ (sai định dạng JSON, thiếu tên, hết chỗ,...).

4. Kiểm tra Header
URL: /appointments

Method: HEAD

Mô tả: Trả về HTTP Headers (không có body) chứa thông tin X-Resource: appointments.

5. Kiểm tra phương thức được hỗ trợ
URL: /appointments

Method: OPTIONS

Mô tả: Trả về danh sách các HTTP Methods được API này hỗ trợ (GET, POST, HEAD, OPTIONS).
