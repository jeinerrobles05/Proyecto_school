<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpcomingCourseTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upcoming_course_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('upcoming_course_id')->index('upcoming_course_translations_upcoming_course_id_foreign');
            $table->string('locale')->index();
            $table->string('title');
            $table->text('seo_description')->nullable();
            $table->longText('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upcoming_course_translations');
    }
}
