<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('products_creator_id_foreign');
            $table->enum('type', ['virtual', 'physical'])->index();
            $table->string('slug')->index();
            $table->unsignedInteger('category_id')->nullable()->index('products_category_id_foreign');
            $table->double('price', 15, 2)->unsigned()->nullable();
            $table->unsignedBigInteger('point')->nullable();
            $table->boolean('unlimited_inventory')->default(false);
            $table->boolean('ordering')->default(false);
            $table->unsignedInteger('inventory')->nullable();
            $table->unsignedInteger('inventory_warning')->nullable();
            $table->unsignedBigInteger('inventory_updated_at')->nullable();
            $table->double('delivery_fee', 15, 2)->unsigned()->nullable();
            $table->unsignedInteger('delivery_estimated_time')->nullable();
            $table->text('message_for_reviewer')->nullable();
            $table->unsignedInteger('tax')->nullable();
            $table->unsignedInteger('commission')->nullable();
            $table->enum('status', ['active', 'pending', 'draft', 'inactive']);
            $table->unsignedBigInteger('updated_at');
            $table->unsignedBigInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
