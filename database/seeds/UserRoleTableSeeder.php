<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\UserRole;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::create(['id_user' => "1", "id_role" => "1"]);
        UserRole::create(['id_user' => "1", "id_role" => "2"]);
    }
}
