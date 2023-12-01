<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSubscribeRemindsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribe_reminds', function (Blueprint $table) {
            $table->foreign(['subscribe_id'])->references(['id'])->on('subscribes')->onDelete('CASCADE');
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
        Schema::table('subscribe_reminds', function (Blueprint $table) {
            $table->dropForeign('subscribe_reminds_subscribe_id_foreign');
            $table->dropForeign('subscribe_reminds_user_id_foreign');
        });
    }
}
