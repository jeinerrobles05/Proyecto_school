<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestedCoursesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interested_course_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('interested_courses_id')->unsigned();
            $table->integer('webinar_id')->unsigned();
            $table->integer('created_at');
            $table->integer('updated_at')->nullable();

            $table->foreign('interested_courses_id')->on('interested_courses')->references('id')->onDelete('cascade');
            $table->foreign('webinar_id')->references('id')->on('webinars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interested_course_translations');
    }
}
