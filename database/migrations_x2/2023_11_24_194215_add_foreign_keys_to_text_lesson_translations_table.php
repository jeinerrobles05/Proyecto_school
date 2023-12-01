<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTextLessonTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('text_lesson_translations', function (Blueprint $table) {
            $table->foreign(['text_lesson_id'], 'text_lesson_id')->references(['id'])->on('text_lessons')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('text_lesson_translations', function (Blueprint $table) {
            $table->dropForeign('text_lesson_id');
        });
    }
}
