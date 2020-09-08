<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['user_name' => "admin", "email" => "test@test.com", 'password' => Hash::make("12345678")]);
        User::create(['user_name' => "phuong", "email" => 'test1@test.com', 'password' => Hash::make("12345678")]);
    }
}
