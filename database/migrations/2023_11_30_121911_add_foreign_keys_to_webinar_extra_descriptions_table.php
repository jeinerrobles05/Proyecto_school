<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWebinarExtraDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('webinar_extra_descriptions', function (Blueprint $table) {
            $table->foreign(['creator_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['upcoming_course_id'])->references(['id'])->on('upcoming_courses')->onDelete('CASCADE');
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
        Schema::table('webinar_extra_descriptions', function (Blueprint $table) {
            $table->dropForeign('webinar_extra_descriptions_creator_id_foreign');
            $table->dropForeign('webinar_extra_descriptions_upcoming_course_id_foreign');
            $table->dropForeign('webinar_extra_descriptions_webinar_id_foreign');
        });
    }
}
