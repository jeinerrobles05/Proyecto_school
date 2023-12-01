<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('orders_user_id_foreign');
            $table->enum('status', ['pending', 'paying', 'paid', 'fail']);
            $table->enum('payment_method', ['credit', 'payment_channel'])->nullable();
            $table->boolean('is_charge_account')->default(false);
            $table->double('amount', 15, 2)->unsigned();
            $table->decimal('tax', 13)->nullable();
            $table->decimal('total_discount', 13)->nullable();
            $table->decimal('total_amount', 13)->nullable();
            $table->decimal('product_delivery_fee', 13)->nullable();
            $table->text('reference_id')->nullable();
            $table->text('payment_data')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
