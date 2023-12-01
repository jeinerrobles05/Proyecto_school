<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundle_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('bundle_id')->index('bundle_translations_bundle_id_foreign');
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
        Schema::dropIfExists('bundle_translations');
    }
}
