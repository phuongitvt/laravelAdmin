<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => "admin", "fix" => 1]);
        Role::create(['name' => "user", "fix" => 1]);
    }
}
