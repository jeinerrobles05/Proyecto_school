<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUpcomingCourseFilterOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('upcoming_course_filter_option', function (Blueprint $table) {
            $table->foreign(['upcoming_course_id'])->references(['id'])->on('upcoming_courses')->onDelete('CASCADE');
            $table->foreign(['filter_option_id'])->references(['id'])->on('filter_options')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('upcoming_course_filter_option', function (Blueprint $table) {
            $table->dropForeign('upcoming_course_filter_option_upcoming_course_id_foreign');
            $table->dropForeign('upcoming_course_filter_option_filter_option_id_foreign');
        });
    }
}
