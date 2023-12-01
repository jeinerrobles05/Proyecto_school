<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('order_id')->index('order_items_order_id_foreign');
            $table->unsignedInteger('webinar_id')->nullable()->index('order_items_webinar_id_foreign');
            $table->unsignedInteger('bundle_id')->nullable();
            $table->unsignedInteger('subscribe_id')->nullable()->index('order_items_subscribe_id_foreign');
            $table->unsignedInteger('promotion_id')->nullable()->index('order_items_promotion_id_foreign');
            $table->unsignedInteger('gift_id')->nullable()->index('order_items_gift_id_foreign');
            $table->unsignedInteger('registration_package_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('product_order_id')->nullable();
            $table->unsignedInteger('installment_payment_id')->nullable();
            $table->unsignedInteger('reserve_meeting_id')->nullable()->index('order_items_reserve_meeting_id_foreign');
            $table->unsignedInteger('ticket_id')->nullable()->index('order_items_ticket_id_foreign');
            $table->integer('discount_id')->nullable();
            $table->unsignedInteger('become_instructor_id')->nullable();
            $table->double('amount', 15, 2)->unsigned()->nullable();
            $table->unsignedInteger('tax')->nullable();
            $table->double('tax_price', 15, 2)->nullable();
            $table->unsignedInteger('commission')->nullable();
            $table->double('commission_price', 15, 2)->nullable();
            $table->double('discount', 15, 2)->nullable();
            $table->double('total_amount', 15, 2)->nullable();
            $table->double('product_delivery_fee', 15, 2)->nullable();
            $table->unsignedInteger('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
