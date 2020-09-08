<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\GroupMenu;

class GroupMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupMenu::create(['name' => "admin","description"=>"admin area"]);
        GroupMenu::create(['name' => "control","description"=>"control area"]);
    }
}
