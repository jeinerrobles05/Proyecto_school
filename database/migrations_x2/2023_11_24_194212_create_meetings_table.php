<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('meetings_creator_id_foreign');
            $table->double('amount', 15, 2)->unsigned()->nullable();
            $table->integer('discount')->nullable();
            $table->boolean('in_person')->default(false);
            $table->double('in_person_amount', 15, 2)->nullable();
            $table->boolean('group_meeting')->default(false);
            $table->integer('online_group_min_student')->nullable();
            $table->integer('online_group_max_student')->nullable();
            $table->double('online_group_amount', 15, 2)->nullable();
            $table->integer('in_person_group_min_student')->nullable();
            $table->integer('in_person_group_max_student')->nullable();
            $table->double('in_person_group_amount', 15, 2)->nullable();
            $table->boolean('disabled')->nullable()->default(false);
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
        Schema::dropIfExists('meetings');
    }
}
