<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSelectedSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_selected_specifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('product_selected_specifications_creator_id_foreign');
            $table->unsignedInteger('product_id')->index('product_selected_specifications_product_id_foreign');
            $table->unsignedInteger('product_specification_id')->index('product_selected_specifications_product_specification_id_foreign');
            $table->enum('type', ['textarea', 'multi_value']);
            $table->boolean('allow_selection')->default(false);
            $table->unsignedInteger('order')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_selected_specifications');
    }
}
