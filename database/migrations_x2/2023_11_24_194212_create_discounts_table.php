<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('discounts_creator_id_foreign');
            $table->string('title');
            $table->enum('discount_type', ['percentage', 'fixed_amount']);
            $table->enum('source', ['all', 'course', 'category', 'meeting', 'product', 'bundle']);
            $table->string('code', 64)->unique();
            $table->unsignedInteger('percent')->nullable();
            $table->unsignedInteger('amount')->nullable();
            $table->unsignedInteger('max_amount')->nullable();
            $table->unsignedInteger('minimum_order')->nullable();
            $table->integer('count')->default(1);
            $table->enum('user_type', ['all_users', 'special_users']);
            $table->enum('product_type', ['all', 'physical', 'virtual'])->nullable();
            $table->boolean('for_first_purchase')->default(false);
            $table->enum('status', ['active', 'disable'])->default('active');
            $table->unsignedInteger('expired_at');
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
        Schema::dropIfExists('discounts');
    }
}
