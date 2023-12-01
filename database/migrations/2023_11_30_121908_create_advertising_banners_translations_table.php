<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisingBannersTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertising_banners_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('advertising_banner_id')->index('advertising_banners_translations_advertising_banner_id_foreign');
            $table->string('locale')->index();
            $table->string('title');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertising_banners_translations');
    }
}
