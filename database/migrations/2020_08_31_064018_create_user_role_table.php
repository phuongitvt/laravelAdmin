<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable("user_role")) {
            Schema::create('user_role', function (Blueprint $table) {
                $table->id();
                $table->bigInteger("id_user")->unsigned();
                $table->bigInteger("id_role")->unsigned();

                $table->foreign("id_user")->references("id")->on("users")->cascadeOnDelete();
                $table->foreign("id_role")->references("id")->on("roles")->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_role');
    }
}
