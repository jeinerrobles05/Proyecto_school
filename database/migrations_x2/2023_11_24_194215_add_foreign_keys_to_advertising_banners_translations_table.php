<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAdvertisingBannersTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertising_banners_translations', function (Blueprint $table) {
            $table->foreign(['advertising_banner_id'])->references(['id'])->on('advertising_banners')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertising_banners_translations', function (Blueprint $table) {
            $table->dropForeign('advertising_banners_translations_advertising_banner_id_foreign');
        });
    }
}
