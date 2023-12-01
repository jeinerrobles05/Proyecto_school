<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToForumTopicPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_topic_posts', function (Blueprint $table) {
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['topic_id'])->references(['id'])->on('forum_topics')->onDelete('CASCADE');
            $table->foreign(['parent_id'])->references(['id'])->on('forum_topic_posts')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forum_topic_posts', function (Blueprint $table) {
            $table->dropForeign('forum_topic_posts_user_id_foreign');
            $table->dropForeign('forum_topic_posts_topic_id_foreign');
            $table->dropForeign('forum_topic_posts_parent_id_foreign');
        });
    }
}
