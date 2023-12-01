<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserSelectedBankSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_selected_bank_specifications', function (Blueprint $table) {
            $table->foreign(['user_bank_specification_id'], 'user_bank_specification_id_specifications')->references(['id'])->on('user_bank_specifications')->onDelete('CASCADE');
            $table->foreign(['user_selected_bank_id'], 'user_selected_bank_id_specifications')->references(['id'])->on('user_selected_banks')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_selected_bank_specifications', function (Blueprint $table) {
            $table->dropForeign('user_bank_specification_id_specifications');
            $table->dropForeign('user_selected_bank_id_specifications');
        });
    }
}
