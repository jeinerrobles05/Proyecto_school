<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('product_discounts_creator_id_foreign');
            $table->unsignedInteger('product_id')->index('product_discounts_product_id_foreign');
            $table->string('name')->nullable();
            $table->unsignedInteger('percent');
            $table->unsignedInteger('count')->nullable();
            $table->enum('status', ['active', 'inactive']);
            $table->unsignedInteger('start_date');
            $table->unsignedInteger('end_date');
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
        Schema::dropIfExists('product_discounts');
    }
}
