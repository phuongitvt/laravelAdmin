<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_member', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->unsigned();
            $table->string("username",200);
            $table->string("codename",100);
            $table->double("balance", 10, 2);
            $table->integer("level");
            $table->string("manager",255);
            $table->string("manager_list",255);
            $table->tinyInteger("published");
            $table->tinyInteger("removed");
            $table->tinyInteger("memo");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_member');
    }
}
