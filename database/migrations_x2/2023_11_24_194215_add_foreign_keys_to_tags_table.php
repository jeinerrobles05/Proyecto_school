<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->foreign(['webinar_id'])->references(['id'])->on('webinars')->onDelete('CASCADE');
            $table->foreign(['upcoming_course_id'])->references(['id'])->on('upcoming_courses')->onDelete('CASCADE');
            $table->foreign(['bundle_id'])->references(['id'])->on('bundles')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropForeign('tags_webinar_id_foreign');
            $table->dropForeign('tags_upcoming_course_id_foreign');
            $table->dropForeign('tags_bundle_id_foreign');
        });
    }
}
