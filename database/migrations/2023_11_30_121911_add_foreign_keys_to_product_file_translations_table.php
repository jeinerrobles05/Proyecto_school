<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductFileTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_file_translations', function (Blueprint $table) {
            $table->foreign(['product_file_id'], 'product_file_id')->references(['id'])->on('product_files')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_file_translations', function (Blueprint $table) {
            $table->dropForeign('product_file_id');
        });
    }
}
