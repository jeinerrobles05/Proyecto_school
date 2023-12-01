<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('webinar_id')->nullable()->index('quizzes_webinar_id_foreign');
            $table->unsignedInteger('creator_id')->index('quizzes_creator_id_foreign');
            $table->unsignedInteger('chapter_id')->nullable()->index('quizzes_chapter_id_foreign');
            $table->integer('time')->nullable()->default(0);
            $table->integer('attempt')->nullable();
            $table->integer('pass_mark');
            $table->boolean('certificate');
            $table->enum('status', ['active', 'inactive']);
            $table->unsignedInteger('total_mark')->nullable();
            $table->boolean('display_limited_questions')->default(false);
            $table->unsignedInteger('display_number_of_questions')->nullable();
            $table->boolean('display_questions_randomly')->default(false);
            $table->unsignedInteger('expiry_days')->nullable();
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
        Schema::dropIfExists('quizzes');
    }
}
