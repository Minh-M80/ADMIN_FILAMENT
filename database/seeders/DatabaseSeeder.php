<?php

namespace Database\Seeders;

use App\Enums\ProductStatus;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin23810310259@example.com'],
            [
                'name' => 'Admin 23810310259',
                'password' => 'password',
            ],
        );

        $fashion = Category::updateOrCreate(
            ['slug' => 'thoi-trang-nam'],
            [
                'name' => 'Thoi trang nam',
                'description' => 'Danh muc san pham thoi trang danh cho nam.',
                'is_visible' => true,
            ],
        );

        $accessory = Category::updateOrCreate(
            ['slug' => 'phu-kien-cong-nghe'],
            [
                'name' => 'Phu kien cong nghe',
                'description' => 'Danh muc phu kien va do dung cong nghe.',
                'is_visible' => true,
            ],
        );

        Product::updateOrCreate(
            ['slug' => 'ao-khoac-the-thao'],
            [
                'category_id' => $fashion->id,
                'name' => 'Ao khoac the thao',
                'description' => '<p>Ao khoac chat lieu mem, phu hop di hoc va di choi.</p>',
                'price' => 850000,
                'stock_quantity' => 15,
                'status' => ProductStatus::Published,
                'discount_percent' => 10,
            ],
        );

        Product::updateOrCreate(
            ['slug' => 'tai-nghe-bluetooth'],
            [
                'category_id' => $accessory->id,
                'name' => 'Tai nghe bluetooth',
                'description' => '<p>Tai nghe ket noi nhanh, am thanh ro rang va pin ben.</p>',
                'price' => 1250000,
                'stock_quantity' => 0,
                'status' => ProductStatus::OutOfStock,
                'discount_percent' => 5,
            ],
        );
    }
}
