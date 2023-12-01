<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseNoticeboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_noticeboards', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('course_noticeboards_creator_id_foreign');
            $table->unsignedInteger('webinar_id')->index('course_noticeboards_webinar_id_foreign');
            $table->enum('color', ['warning', 'danger', 'neutral', 'info', 'success']);
            $table->string('title');
            $table->text('message');
            $table->unsignedBigInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_noticeboards');
    }
}
