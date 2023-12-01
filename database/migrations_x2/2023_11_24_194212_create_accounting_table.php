<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting', function (Blueprint $table) {
            $table->increments('id')->index('id');
            $table->unsignedInteger('user_id')->nullable()->index('user_id');
            $table->integer('creator_id')->nullable();
            $table->unsignedInteger('order_item_id')->nullable();
            $table->unsignedInteger('webinar_id')->nullable()->index('webinar_id');
            $table->unsignedInteger('bundle_id')->nullable();
            $table->unsignedInteger('meeting_time_id')->nullable()->index('meeting_time_id');
            $table->unsignedInteger('subscribe_id')->nullable()->index('subscribe_id');
            $table->unsignedInteger('promotion_id')->nullable()->index('promotion_id');
            $table->unsignedInteger('registration_package_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('installment_payment_id')->nullable()->index('accounting_installment_payment_id_foreign');
            $table->unsignedInteger('installment_order_id')->nullable()->comment('This field is filled in the seller\'s financial document to find the installment order');
            $table->unsignedInteger('gift_id')->nullable();
            $table->boolean('system')->default(false);
            $table->boolean('tax')->default(false);
            $table->decimal('amount', 13)->nullable();
            $table->enum('type', ['addiction', 'deduction']);
            $table->enum('type_account', ['income', 'asset', 'subscribe', 'promotion', 'registration_package', 'installment_payment'])->nullable();
            $table->enum('store_type', ['automatic', 'manual'])->default('automatic');
            $table->unsignedInteger('referred_user_id')->nullable();
            $table->boolean('is_affiliate_amount')->default(false);
            $table->boolean('is_affiliate_commission')->default(false);
            $table->boolean('is_registration_bonus')->default(false);
            $table->boolean('is_cashback')->default(false);
            $table->text('description')->nullable();
            $table->integer('created_at');

            $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounting');
    }
}
