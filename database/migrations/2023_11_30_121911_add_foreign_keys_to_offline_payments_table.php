<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOfflinePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offline_payments', function (Blueprint $table) {
            $table->foreign(['offline_bank_id'])->references(['id'])->on('offline_banks')->onDelete('SET NULL');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offline_payments', function (Blueprint $table) {
            $table->dropForeign('offline_payments_offline_bank_id_foreign');
            $table->dropForeign('offline_payments_user_id_foreign');
        });
    }
}
