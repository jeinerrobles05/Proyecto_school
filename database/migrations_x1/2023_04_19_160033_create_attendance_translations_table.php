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
            $table->integer('attendance_id')->unsigned();;
            $table->integer('student_id')->unsigned();
            $table->enum('status', ['present', 'absent']);
            $table->integer('confirmed_assistance')->nullable();
            $table->integer('created_at');
            $table->integer('updated_at')->nullable();

            $table->foreign('attendance_id')->on('attendances')->references('id')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
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
