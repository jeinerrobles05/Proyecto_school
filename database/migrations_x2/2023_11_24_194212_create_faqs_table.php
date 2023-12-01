<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('faqs_creator_id_foreign');
            $table->unsignedInteger('webinar_id')->nullable()->index('faqs_webinar_id_foreign');
            $table->unsignedInteger('bundle_id')->nullable()->index('faqs_bundle_id_foreign');
            $table->unsignedInteger('upcoming_course_id')->nullable()->index('faqs_upcoming_course_id_foreign');
            $table->unsignedInteger('order')->nullable();
            $table->unsignedInteger('created_at')->nullable();
            $table->unsignedInteger('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs');
    }
}
