<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_fee_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("fee_id")->unsigned();
            $table->double("price_from",10,2);
            $table->double("price_to",10,2);
            $table->tinyInteger("type");
            $table->integer("amount");
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
        Schema::dropIfExists('au_fee_detail');
    }
}
