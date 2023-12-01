<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashbackRuleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashback_rule_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cashback_rule_id')->index('cashback_rule_translations_cashback_rule_id_foreign');
            $table->string('locale')->index();
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashback_rule_translations');
    }
}
