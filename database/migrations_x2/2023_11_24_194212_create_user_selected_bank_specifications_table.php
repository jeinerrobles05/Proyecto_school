<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSelectedBankSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_selected_bank_specifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_selected_bank_id')->index('user_selected_bank_id_specifications');
            $table->unsignedInteger('user_bank_specification_id')->index('user_bank_specification_id_specifications');
            $table->text('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_selected_bank_specifications');
    }
}
