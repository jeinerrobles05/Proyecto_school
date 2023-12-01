<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebinarExtraDescriptionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinar_extra_description_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('webinar_extra_description_id')->index('webinar_extra_description_id_foreign');
            $table->string('locale')->index();
            $table->text('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webinar_extra_description_translations');
    }
}
