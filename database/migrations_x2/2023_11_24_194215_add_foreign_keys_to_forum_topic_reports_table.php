<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToForumTopicReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_topic_reports', function (Blueprint $table) {
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['topic_post_id'])->references(['id'])->on('forum_topic_posts')->onDelete('CASCADE');
            $table->foreign(['topic_id'])->references(['id'])->on('forum_topics')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forum_topic_reports', function (Blueprint $table) {
            $table->dropForeign('forum_topic_reports_user_id_foreign');
            $table->dropForeign('forum_topic_reports_topic_post_id_foreign');
            $table->dropForeign('forum_topic_reports_topic_id_foreign');
        });
    }
}
