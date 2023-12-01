<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSessionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('session_translations', function (Blueprint $table) {
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
        Schema::table('session_translations', function (Blueprint $table) {
            $table->dropForeign('session_translations_session_id_foreign');
        });
    }
}
