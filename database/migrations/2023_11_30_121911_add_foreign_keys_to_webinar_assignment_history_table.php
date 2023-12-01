<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWebinarAssignmentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('webinar_assignment_history', function (Blueprint $table) {
            $table->foreign(['assignment_id'])->references(['id'])->on('webinar_assignments')->onDelete('CASCADE');
            $table->foreign(['instructor_id'])->references(['id'])->on('users')->onDelete('CASCADE');
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
        Schema::table('webinar_assignment_history', function (Blueprint $table) {
            $table->dropForeign('webinar_assignment_history_assignment_id_foreign');
            $table->dropForeign('webinar_assignment_history_instructor_id_foreign');
            $table->dropForeign('webinar_assignment_history_student_id_foreign');
        });
    }
}
