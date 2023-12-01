<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('currency');
            $table->enum('currency_position', ['left', 'right', 'left_with_space', 'right_with_space']);
            $table->enum('currency_separator', ['dot', 'comma']);
            $table->unsignedInteger('currency_decimal')->nullable();
            $table->double('exchange_rate', 15, 2)->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->bigInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
