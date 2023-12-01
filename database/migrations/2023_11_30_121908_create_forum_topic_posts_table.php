<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumTopicPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_topic_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('forum_topic_posts_user_id_foreign');
            $table->unsignedInteger('topic_id')->index('forum_topic_posts_topic_id_foreign');
            $table->unsignedInteger('parent_id')->nullable()->index('forum_topic_posts_parent_id_foreign');
            $table->text('description');
            $table->string('attach')->nullable();
            $table->boolean('pin')->default(false);
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
        Schema::dropIfExists('forum_topic_posts');
    }
}
