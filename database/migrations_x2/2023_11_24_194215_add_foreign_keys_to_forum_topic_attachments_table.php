<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToForumTopicAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_topic_attachments', function (Blueprint $table) {
            $table->foreign(['topic_id'])->references(['id'])->on('forum_topics')->onDelete('CASCADE');
            $table->foreign(['creator_id'])->references(['id'])->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forum_topic_attachments', function (Blueprint $table) {
            $table->dropForeign('forum_topic_attachments_topic_id_foreign');
            $table->dropForeign('forum_topic_attachments_creator_id_foreign');
        });
    }
}
