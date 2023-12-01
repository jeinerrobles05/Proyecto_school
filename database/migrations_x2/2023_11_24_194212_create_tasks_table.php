<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('webinar_id')->nullable()->index('task_webinar_id_foreign');
            $table->unsignedInteger('creator_id')->index('task_creator_id_foreign');
            $table->integer('attempt')->nullable();
            $table->decimal('pass_mark', 3, 1);
            $table->text('description')->nullable();
            $table->string('attach')->nullable();
            $table->enum('status', ['active', 'inactive']);
            $table->unsignedInteger('expiry_days')->nullable();
            $table->integer('created_at');
            $table->integer('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
