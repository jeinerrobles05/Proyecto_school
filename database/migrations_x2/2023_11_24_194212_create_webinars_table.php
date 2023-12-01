<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebinarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinars', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('teacher_id')->index('webinars_teacher_id_foreign');
            $table->unsignedInteger('creator_id')->index('webinars_creator_id_foreign');
            $table->unsignedInteger('category_id')->nullable()->index('webinars_category_id_foreign');
            $table->enum('type', ['webinar', 'course', 'text_lesson', 'classroom_course']);
            $table->boolean('private')->default(false);
            $table->string('slug')->index();
            $table->integer('start_date')->nullable();
            $table->unsignedInteger('duration')->nullable();
            $table->string('timezone')->nullable();
            $table->string('thumbnail');
            $table->string('image_cover');
            $table->string('video_demo')->nullable();
            $table->enum('video_demo_source', ['upload', 'youtube', 'vimeo', 'external_link'])->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->double('price', 15, 2)->unsigned()->nullable();
            $table->double('organization_price', 15, 2)->unsigned()->nullable();
            $table->boolean('support')->nullable()->default(false);
            $table->boolean('certificate')->default(false);
            $table->boolean('downloadable')->nullable()->default(false);
            $table->boolean('partner_instructor')->nullable()->default(false);
            $table->boolean('subscribe')->nullable()->default(false);
            $table->boolean('forum')->default(false);
            $table->boolean('enable_waitlist')->default(false);
            $table->unsignedInteger('access_days')->nullable()->comment('Number of days to access the course');
            $table->integer('points')->nullable();
            $table->text('message_for_reviewer')->nullable();
            $table->enum('status', ['active', 'pending', 'is_draft', 'inactive']);
            $table->integer('created_at');
            $table->integer('updated_at')->nullable();
            $table->integer('deleted_at')->nullable();

            $table->unique(['slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webinars');
    }
}
