<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpcomingCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upcoming_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('upcoming_courses_creator_id_foreign');
            $table->unsignedInteger('teacher_id')->index('upcoming_courses_teacher_id_foreign');
            $table->unsignedInteger('category_id')->nullable()->index('upcoming_courses_category_id_foreign');
            $table->unsignedInteger('webinar_id')->nullable()->index('upcoming_courses_webinar_id_foreign')->comment('when assigned a course');
            $table->enum('type', ['webinar', 'course', 'text_lesson']);
            $table->string('slug')->unique();
            $table->string('thumbnail');
            $table->string('image_cover');
            $table->string('video_demo')->nullable();
            $table->enum('video_demo_source', ['upload', 'youtube', 'vimeo', 'external_link'])->nullable();
            $table->unsignedBigInteger('publish_date')->nullable();
            $table->string('timezone')->nullable();
            $table->unsignedInteger('points')->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->double('price', 15, 2)->nullable();
            $table->unsignedInteger('duration')->nullable();
            $table->unsignedInteger('sections')->nullable();
            $table->unsignedInteger('parts')->nullable();
            $table->unsignedInteger('course_progress')->nullable();
            $table->boolean('support')->default(false);
            $table->boolean('certificate')->default(false);
            $table->boolean('include_quizzes')->default(false);
            $table->boolean('downloadable')->default(false);
            $table->boolean('forum')->default(false);
            $table->text('message_for_reviewer')->nullable();
            $table->enum('status', ['active', 'pending', 'is_draft', 'inactive'])->default('is_draft');
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
        Schema::dropIfExists('upcoming_courses');
    }
}
