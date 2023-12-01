<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_forums', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('webinar_id')->index('course_forums_webinar_id_foreign');
            $table->unsignedInteger('user_id')->index('course_forums_user_id_foreign');
            $table->string('title');
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
        Schema::dropIfExists('course_forums');
    }
}
