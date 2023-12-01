<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSubscribeUsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribe_uses', function (Blueprint $table) {
            $table->foreign(['webinar_id'])->references(['id'])->on('webinars')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['subscribe_id'])->references(['id'])->on('subscribes')->onDelete('CASCADE');
            $table->foreign(['sale_id'])->references(['id'])->on('sales')->onDelete('CASCADE');
            $table->foreign(['installment_order_id'])->references(['id'])->on('installment_orders')->onDelete('CASCADE');
            $table->foreign(['bundle_id'])->references(['id'])->on('bundles')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribe_uses', function (Blueprint $table) {
            $table->dropForeign('subscribe_uses_webinar_id_foreign');
            $table->dropForeign('subscribe_uses_user_id_foreign');
            $table->dropForeign('subscribe_uses_subscribe_id_foreign');
            $table->dropForeign('subscribe_uses_sale_id_foreign');
            $table->dropForeign('subscribe_uses_installment_order_id_foreign');
            $table->dropForeign('subscribe_uses_bundle_id_foreign');
        });
    }
}
