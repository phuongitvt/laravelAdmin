<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_role', function (Blueprint $table) {
            $table->bigInteger("id_member")->unsigned();
            $table->bigInteger("id_role")->unsigned();

            $table->foreign("id_member")->references("id")->on("members")->cascadeOnDelete();
            $table->foreign("id_role")->references("id")->on("roles")->cascadeOnDelete();
        });
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
