<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUpcomingCourseTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('upcoming_course_translations', function (Blueprint $table) {
            $table->foreign(['upcoming_course_id'])->references(['id'])->on('upcoming_courses')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('upcoming_course_translations', function (Blueprint $table) {
            $table->dropForeign('upcoming_course_translations_upcoming_course_id_foreign');
        });
    }
}
