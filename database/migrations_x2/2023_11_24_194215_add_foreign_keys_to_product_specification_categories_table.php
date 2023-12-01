<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductSpecificationCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_specification_categories', function (Blueprint $table) {
            $table->foreign(['specification_id'])->references(['id'])->on('product_specifications')->onDelete('CASCADE');
            $table->foreign(['category_id'])->references(['id'])->on('product_categories')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_specification_categories', function (Blueprint $table) {
            $table->dropForeign('product_specification_categories_specification_id_foreign');
            $table->dropForeign('product_specification_categories_category_id_foreign');
        });
    }
}
