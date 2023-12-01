<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPromotionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promotion_translations', function (Blueprint $table) {
            $table->foreign(['promotion_id'])->references(['id'])->on('promotions')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promotion_translations', function (Blueprint $table) {
            $table->dropForeign('promotion_translations_promotion_id_foreign');
        });
    }
}
