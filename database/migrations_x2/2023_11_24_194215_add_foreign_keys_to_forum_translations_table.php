<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToForumTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_translations', function (Blueprint $table) {
            $table->foreign(['forum_id'])->references(['id'])->on('forums')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forum_translations', function (Blueprint $table) {
            $table->dropForeign('forum_translations_forum_id_foreign');
        });
    }
}
