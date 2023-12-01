<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToForumRecommendedTopicItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_recommended_topic_items', function (Blueprint $table) {
            $table->foreign(['recommended_topic_id'])->references(['id'])->on('forum_recommended_topics')->onDelete('CASCADE');
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
        Schema::table('forum_recommended_topic_items', function (Blueprint $table) {
            $table->dropForeign('forum_recommended_topic_items_recommended_topic_id_foreign');
            $table->dropForeign('forum_recommended_topic_items_topic_id_foreign');
        });
    }
}
