<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToQuizzesQuestionsAnswerTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quizzes_questions_answer_translations', function (Blueprint $table) {
            $table->foreign(['quizzes_questions_answer_id'], 'quizzes_questions_answer_id')->references(['id'])->on('quizzes_questions_answers')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quizzes_questions_answer_translations', function (Blueprint $table) {
            $table->dropForeign('quizzes_questions_answer_id');
        });
    }
}
