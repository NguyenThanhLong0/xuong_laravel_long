<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('products')->insert([
            ['name' => 'Bàn gỗ', 'price' => 2000000, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ghế xoay', 'price' => 1500000, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tủ quần áo', 'price' => 5000000, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Giường ngủ', 'price' => 8000000, 'created_at' => now(), 'updated_at' => now()],
        ]);
        
        DB::table('sales')->insert([
            ['product_id' => 1, 'quantity' => 3, 'price' => 2000000, 'tax' => 600000, 'total' => 6600000, 'sale_date' => '2024-09-15', 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 2, 'quantity' => 1, 'price' => 1500000, 'tax' => 450000, 'total' => 1950000, 'sale_date' => '2024-09-17', 'created_at' => now(), 'updated_at' => now()],
        ]);
        
        DB::table('expenses')->insert([
            ['description' => 'Nhập hàng tháng 9', 'amount' => 5000000, 'expense_date' => '2024-09-05', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Quảng cáo', 'amount' => 3000000, 'expense_date' => '2024-09-10', 'created_at' => now(), 'updated_at' => now()],
        ]);
        
        DB::table('taxes')->insert([
            ['tax_name' => 'VAT', 'rate' => 10, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
