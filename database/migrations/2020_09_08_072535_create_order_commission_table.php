<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCommissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_order_commission', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("order_id")->unsigned();
            $table->bigInteger("member_id")->unsigned();
            $table->bigInteger("agency_id")->unsigned();
            $table->tinyInteger("agency_level");
            $table->tinyInteger("share_percent");
            $table->tinyInteger("commission");
            $table->tinyInteger("collected");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_order_commission');
    }
}
