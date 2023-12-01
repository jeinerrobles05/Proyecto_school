<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_results', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('task_id')->index('tasks_results_task_id_foreign');
            $table->unsignedInteger('user_id')->index('tasks_results_user_id_foreign');
            $table->text('results')->nullable();
            $table->string('attach')->nullable();
            $table->decimal('user_grade', 3, 1)->nullable();
            $table->enum('status', ['passed', 'failed', 'waiting']);
            $table->integer('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks_results');
    }
}
