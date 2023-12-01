<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyPlanChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_plan_chapters', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('webinar_id')->unsigned();
            $table->string('title');
            $table->longText('content')->nullable();
            $table->integer('order')->nullable();
            $table->integer('created_at')->unsigned();

            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('webinar_id')->on('webinars')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_plan_chapters');
    }
}
