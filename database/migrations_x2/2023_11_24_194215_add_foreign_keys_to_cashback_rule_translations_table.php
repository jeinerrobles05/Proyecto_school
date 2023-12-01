<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCashbackRuleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cashback_rule_translations', function (Blueprint $table) {
            $table->foreign(['cashback_rule_id'])->references(['id'])->on('cashback_rules')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cashback_rule_translations', function (Blueprint $table) {
            $table->dropForeign('cashback_rule_translations_cashback_rule_id_foreign');
        });
    }
}
