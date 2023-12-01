<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('attendance_id')->index('attendance_translations_attendance_id_foreign');
            $table->unsignedInteger('student_id')->index('attendance_translations_student_id_foreign');
            $table->enum('status', ['present', 'absent']);
            $table->integer('confirmed_assistance')->nullable();
            $table->integer('created_at');
            $table->integer('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_translations');
    }
}
