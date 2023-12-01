<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductSelectedSpecificationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_selected_specification_translations', function (Blueprint $table) {
            $table->foreign(['product_selected_specification_id'], 'product_selected_specification_id_translations')->references(['id'])->on('product_selected_specifications')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_selected_specification_translations', function (Blueprint $table) {
            $table->dropForeign('product_selected_specification_id_translations');
        });
    }
}
