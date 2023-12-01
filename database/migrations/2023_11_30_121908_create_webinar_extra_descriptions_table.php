<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebinarExtraDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinar_extra_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('webinar_extra_descriptions_creator_id_foreign');
            $table->unsignedInteger('webinar_id')->nullable()->index('webinar_extra_descriptions_webinar_id_foreign');
            $table->unsignedInteger('upcoming_course_id')->nullable()->index('webinar_extra_descriptions_upcoming_course_id_foreign');
            $table->enum('type', ['learning_materials', 'company_logos', 'requirements']);
            $table->unsignedInteger('order')->nullable();
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
        Schema::dropIfExists('webinar_extra_descriptions');
    }
}
