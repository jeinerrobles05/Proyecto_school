<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextLessonTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_lesson_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('text_lesson_id')->index('text_lesson_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->text('summary');
            $table->longText('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('text_lesson_translations');
    }
}
