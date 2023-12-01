<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSelectedSpecificationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_selected_specification_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('product_selected_specification_id')->index('product_selected_specification_id_translations');
            $table->string('locale')->index();
            $table->text('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_selected_specification_translations');
    }
}
