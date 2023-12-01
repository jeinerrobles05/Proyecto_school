<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->enum('type', ['quiz', 'course']);
            $table->string('position_x')->nullable();
            $table->string('position_y')->nullable();
            $table->string('font_size')->nullable();
            $table->string('text_color')->nullable();
            $table->enum('status', ['draft', 'publish']);
            $table->integer('created_at');
            $table->integer('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificates_templates');
    }
}
