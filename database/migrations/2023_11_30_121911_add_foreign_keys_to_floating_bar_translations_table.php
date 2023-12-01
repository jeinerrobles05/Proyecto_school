<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFloatingBarTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('floating_bar_translations', function (Blueprint $table) {
            $table->foreign(['floating_bar_id'])->references(['id'])->on('floating_bars')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('floating_bar_translations', function (Blueprint $table) {
            $table->dropForeign('floating_bar_translations_floating_bar_id_foreign');
        });
    }
}
