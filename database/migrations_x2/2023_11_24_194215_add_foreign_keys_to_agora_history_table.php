<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAgoraHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agora_history', function (Blueprint $table) {
            $table->foreign(['session_id'])->references(['id'])->on('sessions')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agora_history', function (Blueprint $table) {
            $table->dropForeign('agora_history_session_id_foreign');
        });
    }
}
