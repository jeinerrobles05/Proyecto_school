<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToNavbarButtonTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('navbar_button_translations', function (Blueprint $table) {
            $table->foreign(['navbar_button_id'])->references(['id'])->on('navbar_buttons')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('navbar_button_translations', function (Blueprint $table) {
            $table->dropForeign('navbar_button_translations_navbar_button_id_foreign');
        });
    }
}
