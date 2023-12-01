<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWebinarAssignmentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('webinar_assignment_translations', function (Blueprint $table) {
            $table->foreign(['webinar_assignment_id'], 'webinar_assignment_id_translate_foreign')->references(['id'])->on('webinar_assignments')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('webinar_assignment_translations', function (Blueprint $table) {
            $table->dropForeign('webinar_assignment_id_translate_foreign');
        });
    }
}
