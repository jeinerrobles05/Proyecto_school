<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInstallmentOrderAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('installment_order_attachments', function (Blueprint $table) {
            $table->foreign(['installment_order_id'], 'installment_order_id_attachment')->references(['id'])->on('installment_orders')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('installment_order_attachments', function (Blueprint $table) {
            $table->dropForeign('installment_order_id_attachment');
        });
    }
}
