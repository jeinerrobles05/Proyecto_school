<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSelectedFilterOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_selected_filter_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->index('product_selected_filter_options_product_id_foreign');
            $table->unsignedInteger('filter_option_id')->index('product_selected_filter_options_filter_option_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_selected_filter_options');
    }
}
