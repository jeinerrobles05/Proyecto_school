<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installment_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('installment_id')->index('installment_translations_installment_id_foreign');
            $table->string('locale')->index();
            $table->string('title');
            $table->string('main_title');
            $table->text('description');
            $table->string('banner')->nullable();
            $table->text('options')->nullable();
            $table->text('verification_description')->nullable();
            $table->string('verification_banner')->nullable();
            $table->string('verification_video')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('installment_translations');
    }
}
