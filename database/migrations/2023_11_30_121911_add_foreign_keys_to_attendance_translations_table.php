<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAttendanceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendance_translations', function (Blueprint $table) {
            $table->foreign(['attendance_id'])->references(['id'])->on('attendances')->onDelete('CASCADE');
            $table->foreign(['student_id'])->references(['id'])->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendance_translations', function (Blueprint $table) {
            $table->dropForeign('attendance_translations_attendance_id_foreign');
            $table->dropForeign('attendance_translations_student_id_foreign');
        });
    }
}
