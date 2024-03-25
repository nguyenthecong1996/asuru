<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'first_name' => 'admin',
            'last_name' => 'admin',
            'kata_first_name' => 'admin',
            'kata_last_name' => 'admin',
            'post_code' => '2120005',
            'phone' => '07089658688',
            'role' => 0,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ];
        Admin::insert($data);
    }
}
