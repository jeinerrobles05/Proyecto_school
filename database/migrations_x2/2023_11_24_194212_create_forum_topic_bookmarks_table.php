<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumTopicBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_topic_bookmarks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('forum_topic_bookmarks_user_id_foreign');
            $table->unsignedInteger('topic_id')->index('forum_topic_bookmarks_topic_id_foreign');
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
        Schema::dropIfExists('forum_topic_bookmarks');
    }
}
