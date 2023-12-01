<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installment_order_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('installment_order_id')->index('installment_order_id');
            $table->unsignedInteger('sale_id')->nullable()->index('installment_order_payments_sale_id_foreign');
            $table->enum('type', ['upfront', 'step']);
            $table->unsignedInteger('step_id')->nullable()->index('installment_order_payments_step_id_foreign');
            $table->double('amount', 15, 2);
            $table->enum('status', ['paying', 'paid', 'canceled', 'refunded'])->default('paying');
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
        Schema::dropIfExists('installment_order_payments');
    }
}
