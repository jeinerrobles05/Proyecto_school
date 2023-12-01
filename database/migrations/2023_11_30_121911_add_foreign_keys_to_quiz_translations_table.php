<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToQuizTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quiz_translations', function (Blueprint $table) {
            $table->foreign(['quiz_id'])->references(['id'])->on('quizzes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz_translations', function (Blueprint $table) {
            $table->dropForeign('quiz_translations_quiz_id_foreign');
        });
    }
}
