<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductSpecificationMultiValueTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_specification_multi_value_translations', function (Blueprint $table) {
            $table->foreign(['product_specification_multi_value_id'], 'product_specification_multi_value_id')->references(['id'])->on('product_specification_multi_values')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_specification_multi_value_translations', function (Blueprint $table) {
            $table->dropForeign('product_specification_multi_value_id');
        });
    }
}
