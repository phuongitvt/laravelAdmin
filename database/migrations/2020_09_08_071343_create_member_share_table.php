<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberShareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_member_share', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("member_id")->unsigned();
            $table->bigInteger("agency_id")->unsigned();
            $table->tinyInteger("agency_level");
            $table->tinyInteger("share_percent");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_member_share');
    }
}
