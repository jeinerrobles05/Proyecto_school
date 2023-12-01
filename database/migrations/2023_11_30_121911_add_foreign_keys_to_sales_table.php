<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->foreign(['group_id'])->references(['id'])->on('course_groups')->onDelete('CASCADE');
            $table->foreign(['installment_payment_id'])->references(['id'])->on('installment_order_payments')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign('sales_group_id_foreign');
            $table->dropForeign('sales_installment_payment_id_foreign');
        });
    }
}
