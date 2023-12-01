<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWebinarAssignmentHistoryMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('webinar_assignment_history_messages', function (Blueprint $table) {
            $table->foreign(['assignment_history_id'], 'webinar_assignment_history_id')->references(['id'])->on('webinar_assignment_history')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('webinar_assignment_history_messages', function (Blueprint $table) {
            $table->dropForeign('webinar_assignment_history_id');
        });
    }
}
