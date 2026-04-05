# ADMIN_FILAMENT - MSSV 23810310259

Phan he Admin bang Laravel 11 + Filament 3 de quan ly danh muc va san pham theo yeu cau de bai.

## Tinh nang da hoan thanh
- Prefix MSSV cho tat ca bang database chinh va slug Filament Resource.
- Category Resource:
  - Tu dong tao slug tu ten danh muc.
  - Danh sach dang bang.
  - Bo loc `is_visible`.
- Product Resource:
  - Form Grid layout.
  - Rich Editor cho mo ta.
  - Upload 01 anh dai dien.
  - Tim kiem theo ten san pham.
  - Loc theo danh muc.
  - Dinh dang gia tien VNÐ.
  - Validation gia khong am, ton kho la so nguyen.
- Truong sang tao: `discount_percent`.
  - Tu dong tinh gia sau giam trong form va bang du lieu.
- Doi mau primary Filament thanh `#0f766e`.

## Tai khoan admin mac dinh
- Email: `admin23810310259@example.com`
- Password: `password`

## Huong dan chay project
1. `composer install`
2. `php artisan migrate:fresh --seed`
3. `php artisan storage:link`
4. `php artisan serve`
5. Mo `http://127.0.0.1:8000/admin`

## Cau hinh database
Project dang de mac dinh `sqlite` de chay nhanh trong thu muc local.

Neu ban muon dung MySQL XAMPP:
1. Tao database `admin_filament_23810310259`
2. Sua `.env`:
   - `DB_CONNECTION=mysql`
   - `DB_HOST=127.0.0.1`
   - `DB_PORT=3306`
   - `DB_DATABASE=admin_filament_23810310259`
   - `DB_USERNAME=root`
   - `DB_PASSWORD=`
3. Chay lai `php artisan migrate:fresh --seed`

## File goi y commit
Ban co the dung file `commit-suggestions.txt` de tu tao lich su commit theo tung phan cong viec khi day repo.
