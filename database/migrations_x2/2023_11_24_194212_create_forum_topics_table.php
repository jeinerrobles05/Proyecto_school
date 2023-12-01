<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('forum_topics_creator_id_foreign');
            $table->unsignedInteger('forum_id')->index('forum_topics_forum_id_foreign');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('description');
            $table->boolean('pin')->default(false);
            $table->boolean('close')->default(false);
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
        Schema::dropIfExists('forum_topics');
    }
}
