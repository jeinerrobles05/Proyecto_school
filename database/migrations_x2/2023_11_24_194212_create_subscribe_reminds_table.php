<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribeRemindsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribe_reminds', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('subscribe_reminds_user_id_foreign');
            $table->unsignedInteger('subscribe_id')->index('subscribe_reminds_subscribe_id_foreign');
            $table->unsignedBigInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribe_reminds');
    }
}
