<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class adminAcc extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'syaikhani giffa indrawan',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'address' => 'disini di cibereum',
            'nis' => '12108807',
            'password' => Hash::make('admin123')
        ]);
    }
}
