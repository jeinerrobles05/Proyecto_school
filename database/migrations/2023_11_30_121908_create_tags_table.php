<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64);
            $table->unsignedInteger('webinar_id')->nullable()->index('tags_webinar_id_foreign');
            $table->unsignedInteger('bundle_id')->nullable()->index('tags_bundle_id_foreign');
            $table->unsignedInteger('upcoming_course_id')->nullable()->index('tags_upcoming_course_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
