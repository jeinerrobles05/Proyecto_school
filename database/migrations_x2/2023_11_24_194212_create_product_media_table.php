<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_media', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('media_creator_id');
            $table->unsignedInteger('product_id')->index('media_product_id');
            $table->enum('type', ['thumbnail', 'image', 'video']);
            $table->string('path');
            $table->unsignedInteger('order')->nullable();
            $table->unsignedInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_media');
    }
}
