<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('payouts_user_id_foreign');
            $table->unsignedInteger('user_selected_bank_id')->index('payout_user_selected_bank_id');
            $table->decimal('amount', 13);
            $table->enum('status', ['waiting', 'done', 'reject']);
            $table->integer('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payouts');
    }
}
