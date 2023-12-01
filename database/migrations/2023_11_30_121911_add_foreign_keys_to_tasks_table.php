<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign(['creator_id'], 'task_creator_id_foreign')->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['group_id'], 'task_group_id_foreign')->references(['id'])->on('course_groups')->onDelete('CASCADE');
            $table->foreign(['webinar_id'], 'task_webinar_id_foreign')->references(['id'])->on('webinars')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('task_creator_id_foreign');
            $table->dropForeign('task_group_id_foreign');
            $table->dropForeign('task_webinar_id_foreign');
        });
    }
}
