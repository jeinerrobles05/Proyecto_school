<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebinarAssignmentAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinar_assignment_attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('creator_id');
            $table->unsignedInteger('assignment_id')->index('webinar_assignment_attachments_assignment_id_foreign');
            $table->string('title');
            $table->string('attach');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webinar_assignment_attachments');
    }
}
