<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installment_reminders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('installment_reminders_user_id_foreign');
            $table->unsignedInteger('installment_order_id');
            $table->unsignedInteger('installment_step_id');
            $table->enum('type', ['before_due', 'due', 'after_due']);
            $table->unsignedBigInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('installment_reminders');
    }
}
