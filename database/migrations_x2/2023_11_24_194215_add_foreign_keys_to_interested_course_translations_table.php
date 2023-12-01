<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInterestedCourseTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interested_course_translations', function (Blueprint $table) {
            $table->foreign(['webinar_id'])->references(['id'])->on('webinars')->onDelete('CASCADE');
            $table->foreign(['interested_courses_id'])->references(['id'])->on('interested_courses')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interested_course_translations', function (Blueprint $table) {
            $table->dropForeign('interested_course_translations_webinar_id_foreign');
            $table->dropForeign('interested_course_translations_interested_courses_id_foreign');
        });
    }
}
