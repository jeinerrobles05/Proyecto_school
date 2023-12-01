<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavbarButtonTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navbar_button_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('navbar_button_id')->index('navbar_button_translations_navbar_button_id_foreign');
            $table->string('locale')->index();
            $table->string('title');
            $table->string('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navbar_button_translations');
    }
}
