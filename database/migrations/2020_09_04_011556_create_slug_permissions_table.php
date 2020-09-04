<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlugPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable("slug_permissions")) {
            Schema::create('slug_permissions', function (Blueprint $table) {
                $table->id();
                $table->bigInteger("id_slug")->unsigned();
                $table->bigInteger("id_permission")->unsigned();

                $table->foreign('id_slug')->references('id')->on('slugs')->cascadeOnDelete()->cascadeOnUpdate();
                $table->foreign('id_permission')->references('id')->on('permissions')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('slug_permissions');
    }
}
