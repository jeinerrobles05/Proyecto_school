<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSpecificationMultiValueTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_specification_multi_value_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('product_specification_multi_value_id')->index('product_specification_multi_value_id');
            $table->string('locale')->index();
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_specification_multi_value_translations');
    }
}
