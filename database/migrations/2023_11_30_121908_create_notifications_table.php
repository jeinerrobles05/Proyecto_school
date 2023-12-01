<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->index('notifications_user_id_foreign');
            $table->unsignedInteger('sender_id')->nullable();
            $table->unsignedInteger('group_id')->nullable()->index('notifications_group_id_foreign');
            $table->unsignedInteger('webinar_id')->nullable()->index('webinar_id');
            $table->string('title');
            $table->text('message');
            $table->enum('sender', ['system', 'admin'])->nullable()->default('system');
            $table->enum('type', ['single', 'all_users', 'students', 'instructors', 'organizations', 'group', 'course_students']);
            $table->unsignedInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
