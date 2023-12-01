<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSelectedSpecificationMultiValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_selected_specification_multi_values', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('selected_specification_id')->index('selected_specification_id');
            $table->unsignedInteger('specification_multi_value_id')->index('specification_multi_value_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_selected_specification_multi_values');
    }
}
