<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_deal_chat', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("deal_id")->unsigned();
            $table->string("type",50);//buyer seller
            $table->integer("amount");
            $table->tinyInteger("status");
            $table->timestamp("created_at",0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_deal_chat');
    }
}
