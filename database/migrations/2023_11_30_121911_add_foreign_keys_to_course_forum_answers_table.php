<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCourseForumAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_forum_answers', function (Blueprint $table) {
            $table->foreign(['forum_id'])->references(['id'])->on('course_forums')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_forum_answers', function (Blueprint $table) {
            $table->dropForeign('course_forum_answers_forum_id_foreign');
            $table->dropForeign('course_forum_answers_user_id_foreign');
        });
    }
}
