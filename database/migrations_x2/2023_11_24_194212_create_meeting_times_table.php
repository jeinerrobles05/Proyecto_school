<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_times', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('meeting_id')->index('meeting_times_meeting_id_foreign');
            $table->enum('meeting_type', ['all', 'in_person', 'online'])->default('all');
            $table->enum('day_label', ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday']);
            $table->string('time', 64);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('meeting_times');
    }
}
