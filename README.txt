ADMIN_FILAMENT - MSSV 23810310259

1. Yeu cau de tai da hoan thanh
- Laravel 11 + Filament 3.3.x tuong thich voi yeu cau ^3.2
- Prefix MSSV cho bang va Filament resource slug
- Category Resource: auto slug, table, filter is_visible
- Product Resource: Grid layout, Rich Editor, upload 1 anh, search ten, filter danh muc, format VNÐ, validation gia va ton kho
- Truong sang tao: discount_percent + logic tinh gia sau giam
- Doi primary color Filament sang #0f766e

2. Tai khoan admin mac dinh
- Email: admin23810310259@example.com
- Password: password

3. Cach chay nhanh
- composer install
- php artisan migrate:fresh --seed
- php artisan storage:link
- php artisan serve
- Mo: http://127.0.0.1:8000/admin

4. Ghi chu database
- Mac dinh dang dung sqlite de chay ngay
- Neu muon doi sang MySQL XAMPP, sua file .env va tao database admin_filament_23810310259
