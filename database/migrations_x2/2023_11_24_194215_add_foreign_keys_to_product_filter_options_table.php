<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductFilterOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_filter_options', function (Blueprint $table) {
            $table->foreign(['filter_id'])->references(['id'])->on('product_filters')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_filter_options', function (Blueprint $table) {
            $table->dropForeign('product_filter_options_filter_id_foreign');
        });
    }
}
