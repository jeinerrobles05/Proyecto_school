<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_orders', function (Blueprint $table) {
            $table->foreign(['gift_id'])->references(['id'])->on('gifts')->onDelete('CASCADE');
            $table->foreign(['installment_order_id'])->references(['id'])->on('installment_orders')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_orders', function (Blueprint $table) {
            $table->dropForeign('product_orders_gift_id_foreign');
            $table->dropForeign('product_orders_installment_order_id_foreign');
        });
    }
}
