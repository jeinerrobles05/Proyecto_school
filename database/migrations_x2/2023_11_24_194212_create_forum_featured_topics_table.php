<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumFeaturedTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_featured_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topic_id')->index('forum_featured_topics_topic_id_foreign');
            $table->string('icon');
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
        Schema::dropIfExists('forum_featured_topics');
    }
}
