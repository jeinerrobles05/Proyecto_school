<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductSpecificationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_specification_translations', function (Blueprint $table) {
            $table->foreign(['product_specification_id'], 'product_specification_id')->references(['id'])->on('product_specifications')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_specification_translations', function (Blueprint $table) {
            $table->dropForeign('product_specification_id');
        });
    }
}
