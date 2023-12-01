<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installment_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('installment_id')->index('installment_orders_installment_id_foreign');
            $table->unsignedInteger('user_id')->index('installment_orders_user_id_foreign');
            $table->unsignedInteger('webinar_id')->nullable()->index('installment_orders_webinar_id_foreign');
            $table->unsignedInteger('product_id')->nullable()->index('installment_orders_product_id_foreign');
            $table->unsignedInteger('bundle_id')->nullable()->index('installment_orders_bundle_id_foreign');
            $table->unsignedInteger('subscribe_id')->nullable()->index('installment_orders_subscribe_id_foreign');
            $table->unsignedInteger('registration_package_id')->nullable()->index('installment_orders_registration_package_id_foreign');
            $table->unsignedInteger('product_order_id')->nullable()->index('installment_product_order_id');
            $table->double('item_price', 15, 2)->default(0);
            $table->enum('status', ['paying', 'open', 'rejected', 'pending_verification', 'canceled', 'refunded'])->default('paying');
            $table->unsignedBigInteger('created_at');
            $table->unsignedBigInteger('refund_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('installment_orders');
    }
}
