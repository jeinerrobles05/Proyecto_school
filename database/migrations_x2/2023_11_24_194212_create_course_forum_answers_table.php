<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseForumAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_forum_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('forum_id')->index('course_forum_answers_forum_id_foreign');
            $table->unsignedInteger('user_id')->index('course_forum_answers_user_id_foreign');
            $table->text('description');
            $table->boolean('pin')->default(false);
            $table->boolean('resolved')->default(false);
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
        Schema::dropIfExists('course_forum_answers');
    }
}
