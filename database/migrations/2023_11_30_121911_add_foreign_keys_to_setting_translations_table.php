<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSettingTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting_translations', function (Blueprint $table) {
            $table->foreign(['setting_id'])->references(['id'])->on('settings')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting_translations', function (Blueprint $table) {
            $table->dropForeign('setting_translations_setting_id_foreign');
        });
    }
}
