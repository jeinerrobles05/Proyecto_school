<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeatureWebinarTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_webinar_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('feature_webinar_id')->index('feature_webinar_translations_feature_webinar_id_foreign');
            $table->string('locale')->index();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature_webinar_translations');
    }
}
