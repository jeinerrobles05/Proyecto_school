<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductSelectedSpecificationMultiValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_selected_specification_multi_values', function (Blueprint $table) {
            $table->foreign(['specification_multi_value_id'], 'specification_multi_value_id')->references(['id'])->on('product_specification_multi_values')->onDelete('CASCADE');
            $table->foreign(['selected_specification_id'], 'selected_specification_id')->references(['id'])->on('product_selected_specifications')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_selected_specification_multi_values', function (Blueprint $table) {
            $table->dropForeign('specification_multi_value_id');
            $table->dropForeign('selected_specification_id');
        });
    }
}
