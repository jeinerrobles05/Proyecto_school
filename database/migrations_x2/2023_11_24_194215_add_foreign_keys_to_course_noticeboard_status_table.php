<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCourseNoticeboardStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_noticeboard_status', function (Blueprint $table) {
            $table->foreign(['noticeboard_id'])->references(['id'])->on('course_noticeboards')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_noticeboard_status', function (Blueprint $table) {
            $table->dropForeign('course_noticeboard_status_noticeboard_id_foreign');
        });
    }
}
