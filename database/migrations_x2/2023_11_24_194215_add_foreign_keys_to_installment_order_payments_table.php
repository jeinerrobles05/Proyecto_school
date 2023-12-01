<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInstallmentOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('installment_order_payments', function (Blueprint $table) {
            $table->foreign(['step_id'])->references(['id'])->on('installment_steps')->onDelete('CASCADE');
            $table->foreign(['sale_id'])->references(['id'])->on('sales')->onDelete('CASCADE');
            $table->foreign(['installment_order_id'], 'installment_order_id')->references(['id'])->on('installment_orders')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('installment_order_payments', function (Blueprint $table) {
            $table->dropForeign('installment_order_payments_step_id_foreign');
            $table->dropForeign('installment_order_payments_sale_id_foreign');
            $table->dropForeign('installment_order_id');
        });
    }
}
