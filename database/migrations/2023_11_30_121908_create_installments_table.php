<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installments', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('target_type', ['all', 'courses', 'store_products', 'bundles', 'meetings', 'registration_packages', 'subscription_packages']);
            $table->string('target')->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->unsignedBigInteger('start_date')->nullable();
            $table->unsignedBigInteger('end_date')->nullable();
            $table->boolean('verification')->default(false);
            $table->boolean('request_uploads')->default(false);
            $table->boolean('bypass_verification_for_verified_users')->default(false);
            $table->double('upfront', 15, 2)->nullable();
            $table->enum('upfront_type', ['fixed_amount', 'percent'])->nullable();
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
        Schema::dropIfExists('installments');
    }
}
