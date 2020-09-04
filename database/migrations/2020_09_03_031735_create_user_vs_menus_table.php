<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVsMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable("user_vs_menus")) {
            Schema::create('user_vs_menus', function (Blueprint $table) {
                $table->id();
                $table->bigInteger("id_menu")->unsigned();
                $table->bigInteger("id_user")->unsigned();
                $table->timestamps();

                $table->foreign('id_menu')->references('id')->on('menus')->cascadeOnDelete()->cascadeOnUpdate();
                $table->foreign('id_user')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('user_vs_menus');
    }
}
