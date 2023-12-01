<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('quiz_id')->index('quiz_translations_quiz_id_foreign');
            $table->string('locale')->index();
            $table->text('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_translations');
    }
}
