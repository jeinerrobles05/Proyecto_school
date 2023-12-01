<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('seller_id');
            $table->unsignedInteger('buyer_id')->nullable();
            $table->unsignedInteger('sale_id')->nullable();
            $table->unsignedInteger('installment_order_id')->nullable()->index('product_orders_installment_order_id_foreign');
            $table->unsignedInteger('gift_id')->nullable()->index('product_orders_gift_id_foreign');
            $table->text('specifications')->nullable();
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('discount_id')->nullable();
            $table->text('message_to_seller')->nullable();
            $table->string('tracking_code')->nullable();
            $table->enum('status', ['pending', 'waiting_delivery', 'shipped', 'success', 'canceled']);
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
        Schema::dropIfExists('product_orders');
    }
}
