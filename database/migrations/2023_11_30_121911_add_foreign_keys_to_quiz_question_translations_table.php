<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToQuizQuestionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quiz_question_translations', function (Blueprint $table) {
            $table->foreign(['quizzes_question_id'], 'quiz_question_translations_quiz_question_id_foreign')->references(['id'])->on('quizzes_questions')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz_question_translations', function (Blueprint $table) {
            $table->dropForeign('quiz_question_translations_quiz_question_id_foreign');
        });
    }
}
