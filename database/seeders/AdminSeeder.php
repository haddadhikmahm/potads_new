<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@potadsjabar.or.id'],
            [
                'name' => 'Admin POTADS',
                'username' => 'admin_potads',
                'phone' => '082123899931',
                'profession' => 'Administrator',
                'city' => 'Bandung',
                'address' => 'Bandung, Jawa Barat',
                'role' => 'admin',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
                'is_parent' => false,
            ]
        );
    }
}
