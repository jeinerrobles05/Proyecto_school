<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToGroupStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_students', function (Blueprint $table) {
            $table->foreign(['group_id'], 'group_student_group_id_foreign')->references(['id'])->on('course_groups')->onDelete('CASCADE');
            $table->foreign(['user_id'], 'group_student_user_id_foreign')->references(['id'])->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_students', function (Blueprint $table) {
            $table->dropForeign('group_student_group_id_foreign');
            $table->dropForeign('group_student_user_id_foreign');
        });
    }
}
