<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class staff extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create( [
            'username' => 'syaikhani staff indrawan',
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'role' => 'staff',
            'address' => 'disini di cibereum',
            'nis' => '12108806',
            'password' => Hash::make('staff123')
        ]);
    }
}
