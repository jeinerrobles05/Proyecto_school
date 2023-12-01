<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTasksResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks_results', function (Blueprint $table) {
            $table->foreign(['task_id'])->references(['id'])->on('tasks')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks_results', function (Blueprint $table) {
            $table->dropForeign('tasks_results_task_id_foreign');
            $table->dropForeign('tasks_results_user_id_foreign');
        });
    }
}
