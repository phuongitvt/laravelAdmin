<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("seller_id")->unsigned();
            $table->string("name",255);
            $table->bigInteger("category_id")->unsigned();
            $table->string("category_list",255);
            $table->double("price",10,2);
            $table->double("price_accept",10,2);
            $table->string("unit",100);
            $table->text("description");
            $table->string("image",255);
            $table->tinyInteger("status");
            $table->bigInteger("approval_by")->unsigned();
            $table->double("fee_special",10,2);
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
        Schema::dropIfExists('au_product');
    }
}
