<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductFaqTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_faq_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('product_faq_id')->index('product_faq_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->text('answer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_faq_translations');
    }
}
