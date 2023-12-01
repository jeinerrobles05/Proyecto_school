<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyPlanTextLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_plan_text_lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creator_id');
            $table->integer('webinar_id');
            $table->integer('chapter_id');
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->unsignedInteger('created_at')->nullable();
            $table->unsignedInteger('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_plan_text_lessons');
    }
}
