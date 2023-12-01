<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('sessions_creator_id_foreign');
            $table->unsignedInteger('webinar_id')->nullable()->index('sessions_webinar_id_foreign');
            $table->unsignedInteger('chapter_id')->nullable()->index('sessions_chapter_id_foreign');
            $table->unsignedInteger('reserve_meeting_id')->nullable()->index('sessions_reserve_meeting_id_foreign');
            $table->integer('date');
            $table->integer('duration');
            $table->string('link')->nullable();
            $table->unsignedInteger('extra_time_to_join')->nullable()->comment('Specifies that the user can see the join button up to a few minutes after the start time of the webinar.');
            $table->text('zoom_start_link')->nullable();
            $table->string('zoom_id')->nullable();
            $table->enum('session_api', ['local', 'big_blue_button', 'zoom', 'agora', 'jitsi', 'google_meet'])->default('local');
            $table->string('api_secret')->nullable();
            $table->string('moderator_secret')->nullable();
            $table->text('agora_settings')->nullable();
            $table->boolean('check_previous_parts')->default(false);
            $table->unsignedInteger('access_after_day')->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('created_at');
            $table->integer('updated_at')->nullable();
            $table->integer('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
