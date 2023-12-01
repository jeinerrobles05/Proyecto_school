<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebinarAssignmentHistoryMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinar_assignment_history_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('assignment_history_id')->index('webinar_assignment_history_id');
            $table->unsignedInteger('sender_id');
            $table->text('message');
            $table->string('file_title')->nullable();
            $table->string('file_path')->nullable();
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
        Schema::dropIfExists('webinar_assignment_history_messages');
    }
}
