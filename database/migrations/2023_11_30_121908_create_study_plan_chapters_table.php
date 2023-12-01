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
            $table->integer('id', true);
            $table->unsignedInteger('user_id')->nullable()->index('user_id');
            $table->unsignedInteger('webinar_id')->nullable()->index('webinar_id');
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->integer('order')->nullable();
            $table->unsignedInteger('created_at')->nullable();
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
