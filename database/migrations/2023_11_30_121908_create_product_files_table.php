<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('file_creator_id');
            $table->unsignedInteger('product_id')->index('file_product_id');
            $table->string('path');
            $table->string('file_type')->nullable();
            $table->string('volume')->nullable();
            $table->boolean('online_viewer')->default(false);
            $table->unsignedInteger('order')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
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
        Schema::dropIfExists('product_files');
    }
}
