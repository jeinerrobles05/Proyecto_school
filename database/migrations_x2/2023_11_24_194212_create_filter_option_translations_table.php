<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterOptionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_option_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('filter_option_id')->index('filter_option_translations_filter_option_id_foreign');
            $table->string('locale')->index();
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filter_option_translations');
    }
}
