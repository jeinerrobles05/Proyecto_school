<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductSelectedFilterOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_selected_filter_options', function (Blueprint $table) {
            $table->foreign(['filter_option_id'])->references(['id'])->on('product_filter_options')->onDelete('CASCADE');
            $table->foreign(['product_id'])->references(['id'])->on('products')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_selected_filter_options', function (Blueprint $table) {
            $table->dropForeign('product_selected_filter_options_filter_option_id_foreign');
            $table->dropForeign('product_selected_filter_options_product_id_foreign');
        });
    }
}
