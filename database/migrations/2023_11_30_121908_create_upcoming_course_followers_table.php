<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpcomingCourseFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upcoming_course_followers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('upcoming_course_id')->index('upcoming_course_followers_upcoming_course_id_foreign');
            $table->unsignedInteger('user_id')->index('upcoming_course_followers_user_id_foreign');
            $table->unsignedBigInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upcoming_course_followers');
    }
}
