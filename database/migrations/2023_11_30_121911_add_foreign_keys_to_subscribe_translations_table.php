<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSubscribeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribe_translations', function (Blueprint $table) {
            $table->foreign(['subscribe_id'])->references(['id'])->on('subscribes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribe_translations', function (Blueprint $table) {
            $table->dropForeign('subscribe_translations_subscribe_id_foreign');
        });
    }
}
