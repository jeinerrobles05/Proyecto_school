<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumTopicAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_topic_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('forum_topic_attachments_creator_id_foreign');
            $table->unsignedInteger('topic_id')->index('forum_topic_attachments_topic_id_foreign');
            $table->string('path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forum_topic_attachments');
    }
}
