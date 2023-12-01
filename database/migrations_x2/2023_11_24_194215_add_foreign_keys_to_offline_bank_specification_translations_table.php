<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOfflineBankSpecificationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offline_bank_specification_translations', function (Blueprint $table) {
            $table->foreign(['offline_bank_specification_id'], 'offline_bank_specification_id')->references(['id'])->on('offline_bank_specifications')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offline_bank_specification_translations', function (Blueprint $table) {
            $table->dropForeign('offline_bank_specification_id');
        });
    }
}
