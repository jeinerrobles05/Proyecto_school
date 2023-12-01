<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashbackRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashback_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('target_type', ['all', 'courses', 'store_products', 'bundles', 'meetings', 'registration_packages', 'subscription_packages', 'recharge_wallet']);
            $table->string('target')->nullable();
            $table->unsignedBigInteger('start_date')->nullable();
            $table->unsignedBigInteger('end_date')->nullable();
            $table->double('amount', 15, 2)->nullable();
            $table->enum('amount_type', ['fixed_amount', 'percent'])->nullable();
            $table->boolean('apply_cashback_per_item')->default(false);
            $table->double('max_amount', 15, 2)->nullable();
            $table->double('min_amount', 15, 2)->nullable();
            $table->boolean('enable')->default(false);
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
        Schema::dropIfExists('cashback_rules');
    }
}
