<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSpecificationCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_specification_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('specification_id')->index('product_specification_categories_specification_id_foreign');
            $table->unsignedInteger('category_id')->index('product_specification_categories_category_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_specification_categories');
    }
}
