<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create(['name' => "Members", "group" => "admin", 'description' => "Members"]);
        Menu::create(['name' => "Permission", "group" => "admin", 'description' => "Permission"]);
        Menu::create(['name' => "Roles", "group" => "admin", 'description' => "Roles"]);
        Menu::create(['name' => "Members", "group" => "admin", 'description' => "Members"]);
    }
}
