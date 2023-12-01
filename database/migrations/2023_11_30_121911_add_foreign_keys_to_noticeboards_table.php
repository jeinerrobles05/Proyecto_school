<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToNoticeboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noticeboards', function (Blueprint $table) {
            $table->foreign(['instructor_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['organ_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
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
        Schema::table('noticeboards', function (Blueprint $table) {
            $table->dropForeign('noticeboards_instructor_id_foreign');
            $table->dropForeign('noticeboards_organ_id_foreign');
            $table->dropForeign('noticeboards_user_id_foreign');
            $table->dropForeign('noticeboards_webinar_id_foreign');
        });
    }
}
