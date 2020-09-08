<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_order', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("product_id")->unsigned();
            $table->bigInteger("deal_id")->unsigned();
            $table->bigInteger("seller_id")->unsigned();
            $table->bigInteger("buyer_id")->unsigned();
            $table->double("price",10,2);
            $table->double("price_final",10,2);
            $table->string("price_detail",255);
            $table->string("note",255);
            $table->string("note_buyer",255);
            $table->string("note_seller",255);
            $table->tinyInteger("status");
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
        Schema::dropIfExists('au_order');
    }
}
