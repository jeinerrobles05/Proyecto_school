<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebinarTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinar_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('webinar_id')->index('webinar_translations_webinar_id_foreign');
            $table->string('locale')->index();
            $table->string('title');
            $table->text('seo_description')->nullable();
            $table->longText('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webinar_translations');
    }
}
