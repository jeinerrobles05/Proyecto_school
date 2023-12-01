<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInstallmentOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('installment_orders', function (Blueprint $table) {
            $table->foreign(['bundle_id'])->references(['id'])->on('bundles')->onDelete('CASCADE');
            $table->foreign(['installment_id'])->references(['id'])->on('installments')->onDelete('CASCADE');
            $table->foreign(['product_id'])->references(['id'])->on('products')->onDelete('CASCADE');
            $table->foreign(['registration_package_id'])->references(['id'])->on('registration_packages')->onDelete('CASCADE');
            $table->foreign(['subscribe_id'])->references(['id'])->on('subscribes')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['webinar_id'])->references(['id'])->on('webinars')->onDelete('CASCADE');
            $table->foreign(['product_order_id'], 'installment_product_order_id')->references(['id'])->on('product_orders')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('installment_orders', function (Blueprint $table) {
            $table->dropForeign('installment_orders_bundle_id_foreign');
            $table->dropForeign('installment_orders_installment_id_foreign');
            $table->dropForeign('installment_orders_product_id_foreign');
            $table->dropForeign('installment_orders_registration_package_id_foreign');
            $table->dropForeign('installment_orders_subscribe_id_foreign');
            $table->dropForeign('installment_orders_user_id_foreign');
            $table->dropForeign('installment_orders_webinar_id_foreign');
            $table->dropForeign('installment_product_order_id');
        });
    }
}
