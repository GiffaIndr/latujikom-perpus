<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class userAcc extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'syaikhani user indrawan',
            'name' => 'user',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'address' => 'disini di cibereum',
            'nis' => '12108808',
            'password' => Hash::make('user123')
        ]);
    }
}
