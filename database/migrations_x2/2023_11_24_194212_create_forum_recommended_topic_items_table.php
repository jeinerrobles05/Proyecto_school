<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumRecommendedTopicItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_recommended_topic_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('recommended_topic_id')->index('forum_recommended_topic_items_recommended_topic_id_foreign');
            $table->unsignedInteger('topic_id')->index('forum_recommended_topic_items_topic_id_foreign');
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
        Schema::dropIfExists('forum_recommended_topic_items');
    }
}
