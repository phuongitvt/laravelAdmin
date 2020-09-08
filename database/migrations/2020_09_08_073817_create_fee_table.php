<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_fee', function (Blueprint $table) {
            $table->id();
            $table->string("name",255);
            $table->string("type",50)->default("fixed");
            $table->double("fee_for",10,2);
            $table->integer("amount");
            $table->tinyInteger("status");
            $table->tinyInteger("fee_detail")->default(0);
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
        Schema::dropIfExists('au_fee');
    }
}
