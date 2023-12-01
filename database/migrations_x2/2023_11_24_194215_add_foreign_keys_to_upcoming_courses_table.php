<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUpcomingCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('upcoming_courses', function (Blueprint $table) {
            $table->foreign(['webinar_id'])->references(['id'])->on('webinars')->onDelete('SET NULL');
            $table->foreign(['teacher_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['creator_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['category_id'])->references(['id'])->on('categories')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('upcoming_courses', function (Blueprint $table) {
            $table->dropForeign('upcoming_courses_webinar_id_foreign');
            $table->dropForeign('upcoming_courses_teacher_id_foreign');
            $table->dropForeign('upcoming_courses_creator_id_foreign');
            $table->dropForeign('upcoming_courses_category_id_foreign');
        });
    }
}
