<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone' => '1234567890',
                'date_of_birth' => '1990-05-15',
                'hire_date' => now(),
                'salary' => 5000.00,
                'is_active' => 1,
                'department_id' => 1,
                'manager_id' => null,
                'address' => '123 Main St, Cityville',
                'profile_picture' => null,
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '0987654321',
                'date_of_birth' => '1985-09-20',
                'hire_date' => now(),
                'salary' => 6000.00,
                'is_active' => 1,
                'department_id' => 2,
                'manager_id' => 1,
                'address' => '456 Another St, Townsville',
                'profile_picture' => null,
            ]
        ]);
    }
}
