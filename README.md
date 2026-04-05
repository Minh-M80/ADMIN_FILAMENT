# Họ tên: Nguyễn Đức Minh

# Lớp: D18CNPM4

# MSV: 23810310259

Phân hệ Admin bằng Laravel 11 + Filament 3 để quản lý danh mục và sản phẩm theo yêu cầu đề bài.

## Tính năng đã hoàn thành

* Prefix MSSV cho tất cả bảng database chính và slug Filament Resource.
* Category Resource:

  * Tự động tạo slug từ tên danh mục.
  * Danh sách dạng bảng.
  * Bộ lọc `is_visible`.
* Product Resource:

  * Form Grid layout.
  * Rich Editor cho mô tả.
  * Upload 01 ảnh đại diện.
  * Tìm kiếm theo tên sản phẩm.
  * Lọc theo danh mục.
  * Định dạng giá tiền VNĐ.
  * Validation giá không âm, tồn kho là số nguyên.
* Trường sáng tạo: `discount_percent`.

  * Tự động tính giá sau giảm trong form và bảng dữ liệu.
* Đổi màu primary Filament thành `#0f766e`.

## Tài khoản admin mặc định

* Email: `admin23810310259@example.com`
* Password: `password`

## Hướng dẫn chạy project

1. `composer install`
2. `php artisan migrate:fresh --seed`
3. `php artisan storage:link`
4. `php artisan serve`
5. Mở `http://127.0.0.1:8000/admin`




