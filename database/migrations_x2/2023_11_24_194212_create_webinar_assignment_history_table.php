<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebinarAssignmentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinar_assignment_history', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('instructor_id')->index('webinar_assignment_history_instructor_id_foreign');
            $table->unsignedInteger('student_id')->index('webinar_assignment_history_student_id_foreign');
            $table->unsignedInteger('assignment_id')->index('webinar_assignment_history_assignment_id_foreign');
            $table->unsignedInteger('grade')->nullable();
            $table->enum('status', ['pending', 'passed', 'not_passed', 'not_submitted']);
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
        Schema::dropIfExists('webinar_assignment_history');
    }
}
