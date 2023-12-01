<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloatingBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floating_bars', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('start_at')->nullable();
            $table->bigInteger('end_at')->nullable();
            $table->string('title_color')->nullable();
            $table->string('description_color')->nullable();
            $table->string('icon')->nullable();
            $table->string('background_color')->nullable();
            $table->string('background_image')->nullable();
            $table->string('btn_url')->nullable();
            $table->string('btn_color')->nullable();
            $table->string('btn_text_color')->nullable();
            $table->integer('bar_height')->nullable();
            $table->enum('position', ['top', 'bottom']);
            $table->boolean('fixed')->default(false);
            $table->boolean('enable')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('floating_bars');
    }
}
