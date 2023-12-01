<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('discount_id')->index('discount_groups_discount_id_foreign');
            $table->unsignedInteger('group_id')->index('discount_groups_group_id_foreign');
            $table->unsignedInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_groups');
    }
}
