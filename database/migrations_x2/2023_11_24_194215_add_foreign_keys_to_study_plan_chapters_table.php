<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStudyPlanChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('study_plan_chapters', function (Blueprint $table) {
            $table->foreign(['webinar_id'], 'study_plan_chapters_ibfk_2')->references(['id'])->on('webinars')->onDelete('CASCADE');
            $table->foreign(['user_id'], 'study_plan_chapters_ibfk_1')->references(['id'])->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('study_plan_chapters', function (Blueprint $table) {
            $table->dropForeign('study_plan_chapters_ibfk_2');
            $table->dropForeign('study_plan_chapters_ibfk_1');
        });
    }
}
