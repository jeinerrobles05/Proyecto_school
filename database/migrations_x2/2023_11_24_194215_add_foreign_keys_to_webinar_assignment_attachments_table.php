<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWebinarAssignmentAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('webinar_assignment_attachments', function (Blueprint $table) {
            $table->foreign(['assignment_id'])->references(['id'])->on('webinar_assignments')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('webinar_assignment_attachments', function (Blueprint $table) {
            $table->dropForeign('webinar_assignment_attachments_assignment_id_foreign');
        });
    }
}
