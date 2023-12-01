<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgoraHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agora_history', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('session_id')->index('agora_history_session_id_foreign');
            $table->unsignedInteger('start_at');
            $table->unsignedInteger('end_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agora_history');
    }
}
