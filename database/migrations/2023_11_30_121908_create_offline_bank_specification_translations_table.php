<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfflineBankSpecificationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offline_bank_specification_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('offline_bank_specification_id')->index('offline_bank_specification_id');
            $table->string('locale')->index('locale');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offline_bank_specification_translations');
    }
}
