<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToHomePageStatisticTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_page_statistic_translations', function (Blueprint $table) {
            $table->foreign(['home_page_statistic_id'], 'home_page_statistic_id')->references(['id'])->on('home_page_statistics')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_page_statistic_translations', function (Blueprint $table) {
            $table->dropForeign('home_page_statistic_id');
        });
    }
}
