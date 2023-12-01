<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUpcomingCourseReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('upcoming_course_reports', function (Blueprint $table) {
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
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
        Schema::table('upcoming_course_reports', function (Blueprint $table) {
            $table->dropForeign('upcoming_course_reports_user_id_foreign');
            $table->dropForeign('upcoming_course_reports_upcoming_course_id_foreign');
        });
    }
}
