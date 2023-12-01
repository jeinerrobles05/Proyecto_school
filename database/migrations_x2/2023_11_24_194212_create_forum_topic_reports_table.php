<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumTopicReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_topic_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('forum_topic_reports_user_id_foreign');
            $table->unsignedInteger('topic_id')->nullable()->index('forum_topic_reports_topic_id_foreign');
            $table->unsignedInteger('topic_post_id')->nullable()->index('forum_topic_reports_topic_post_id_foreign');
            $table->text('message');
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
        Schema::dropIfExists('forum_topic_reports');
    }
}
