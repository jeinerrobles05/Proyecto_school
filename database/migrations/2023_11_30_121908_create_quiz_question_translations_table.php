<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_question_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('quizzes_question_id')->index('quiz_question_translations_quiz_question_id_foreign');
            $table->string('locale')->index();
            $table->text('title');
            $table->text('correct')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_question_translations');
    }
}
