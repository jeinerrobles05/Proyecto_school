<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('bundles_creator_id_foreign');
            $table->unsignedInteger('teacher_id')->index('bundles_teacher_id_foreign');
            $table->unsignedInteger('category_id')->nullable()->index('bundles_category_id_foreign');
            $table->string('slug')->index();
            $table->string('thumbnail');
            $table->string('image_cover');
            $table->string('video_demo')->nullable();
            $table->enum('video_demo_source', ['upload', 'youtube', 'vimeo', 'external_link'])->nullable();
            $table->integer('price')->nullable();
            $table->integer('points')->nullable();
            $table->boolean('subscribe')->default(false);
            $table->unsignedInteger('access_days')->nullable()->comment('Number of days to access the bundle');
            $table->text('message_for_reviewer')->nullable();
            $table->enum('status', ['active', 'pending', 'is_draft', 'inactive']);
            $table->unsignedBigInteger('created_at');
            $table->unsignedBigInteger('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bundles');
    }
}
