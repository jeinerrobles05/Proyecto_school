<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->index('product_reviews_product_id_foreign');
            $table->unsignedInteger('creator_id')->index('product_reviews_creator_id_foreign');
            $table->unsignedInteger('product_quality');
            $table->unsignedInteger('purchase_worth');
            $table->unsignedInteger('delivery_quality');
            $table->unsignedInteger('seller_quality');
            $table->char('rates', 10);
            $table->text('description')->nullable();
            $table->unsignedInteger('created_at');
            $table->enum('status', ['pending', 'active']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_reviews');
    }
}
