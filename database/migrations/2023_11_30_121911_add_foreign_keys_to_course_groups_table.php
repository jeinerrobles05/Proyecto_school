<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCourseGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_groups', function (Blueprint $table) {
            $table->foreign(['curso_id'], 'course_group_curso_id_foreign')->references(['id'])->on('webinars')->onDelete('CASCADE');
            $table->foreign(['instructor_id'], 'course_group_instructor_id_foreign')->references(['id'])->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_groups', function (Blueprint $table) {
            $table->dropForeign('course_group_curso_id_foreign');
            $table->dropForeign('course_group_instructor_id_foreign');
        });
    }
}
