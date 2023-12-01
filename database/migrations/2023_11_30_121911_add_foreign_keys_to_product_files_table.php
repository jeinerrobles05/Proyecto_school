<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_files', function (Blueprint $table) {
            $table->foreign(['creator_id'], 'file_creator_id')->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['product_id'], 'file_product_id')->references(['id'])->on('products')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_files', function (Blueprint $table) {
            $table->dropForeign('file_creator_id');
            $table->dropForeign('file_product_id');
        });
    }
}
