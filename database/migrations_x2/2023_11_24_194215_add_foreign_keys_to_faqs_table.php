<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->foreign(['webinar_id'])->references(['id'])->on('webinars')->onDelete('CASCADE');
            $table->foreign(['upcoming_course_id'])->references(['id'])->on('upcoming_courses')->onDelete('CASCADE');
            $table->foreign(['creator_id'])->references(['id'])->on('users')->onDelete('CASCADE');
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
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropForeign('faqs_webinar_id_foreign');
            $table->dropForeign('faqs_upcoming_course_id_foreign');
            $table->dropForeign('faqs_creator_id_foreign');
            $table->dropForeign('faqs_bundle_id_foreign');
        });
    }
}
