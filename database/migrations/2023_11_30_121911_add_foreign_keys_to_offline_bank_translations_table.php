<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOfflineBankTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offline_bank_translations', function (Blueprint $table) {
            $table->foreign(['offline_bank_id'])->references(['id'])->on('offline_banks')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offline_bank_translations', function (Blueprint $table) {
            $table->dropForeign('offline_bank_translations_offline_bank_id_foreign');
        });
    }
}
