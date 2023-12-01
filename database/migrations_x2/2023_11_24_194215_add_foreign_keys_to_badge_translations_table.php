<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBadgeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('badge_translations', function (Blueprint $table) {
            $table->foreign(['badge_id'])->references(['id'])->on('badges')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('badge_translations', function (Blueprint $table) {
            $table->dropForeign('badge_translations_badge_id_foreign');
        });
    }
}
