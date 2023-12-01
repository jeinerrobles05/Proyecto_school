<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserBankSpecificationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_bank_specification_translations', function (Blueprint $table) {
            $table->foreign(['user_bank_specification_id'], 'user_bank_specification_id')->references(['id'])->on('user_bank_specifications')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_bank_specification_translations', function (Blueprint $table) {
            $table->dropForeign('user_bank_specification_id');
        });
    }
}
