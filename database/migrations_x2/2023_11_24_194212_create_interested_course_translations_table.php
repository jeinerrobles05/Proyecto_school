<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestedCourseTranslationsTable extends Migration
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
            $table->unsignedInteger('interested_courses_id')->index('interested_course_translations_interested_courses_id_foreign');
            $table->unsignedInteger('webinar_id')->index('interested_course_translations_webinar_id_foreign');
            $table->integer('created_at');
            $table->integer('updated_at')->nullable();
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
