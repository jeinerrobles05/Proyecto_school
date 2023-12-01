<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToForumTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_topics', function (Blueprint $table) {
            $table->foreign(['creator_id'])->references(['id'])->on('users')->onDelete('CASCADE');
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
        Schema::table('forum_topics', function (Blueprint $table) {
            $table->dropForeign('forum_topics_creator_id_foreign');
            $table->dropForeign('forum_topics_forum_id_foreign');
        });
    }
}
