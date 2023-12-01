<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSelectedBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_selected_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('user_selected_banks_user_id_foreign');
            $table->unsignedInteger('user_bank_id')->index('user_selected_banks_user_bank_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_selected_banks');
    }
}
