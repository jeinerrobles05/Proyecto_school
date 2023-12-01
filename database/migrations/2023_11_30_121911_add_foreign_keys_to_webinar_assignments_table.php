<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWebinarAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('webinar_assignments', function (Blueprint $table) {
            $table->foreign(['chapter_id'])->references(['id'])->on('webinar_chapters')->onDelete('CASCADE');
            $table->foreign(['creator_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['webinar_id'])->references(['id'])->on('webinars')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('webinar_assignments', function (Blueprint $table) {
            $table->dropForeign('webinar_assignments_chapter_id_foreign');
            $table->dropForeign('webinar_assignments_creator_id_foreign');
            $table->dropForeign('webinar_assignments_webinar_id_foreign');
        });
    }
}
