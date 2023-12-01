<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpcomingCourseFilterOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upcoming_course_filter_option', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('upcoming_course_id')->index('upcoming_course_filter_option_upcoming_course_id_foreign');
            $table->unsignedInteger('filter_option_id')->index('upcoming_course_filter_option_filter_option_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upcoming_course_filter_option');
    }
}
