<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashbackRuleSpecificationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashback_rule_specification_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cashback_rule_id')->index('cashback_rule_specification_items_cashback_rule_id_foreign');
            $table->unsignedInteger('category_id')->nullable()->index('cashback_rule_specification_items_category_id_foreign');
            $table->unsignedInteger('instructor_id')->nullable()->index('cashback_rule_specification_items_instructor_id_foreign');
            $table->unsignedInteger('seller_id')->nullable()->index('cashback_rule_specification_items_seller_id_foreign');
            $table->unsignedInteger('webinar_id')->nullable()->index('cashback_rule_specification_items_webinar_id_foreign');
            $table->unsignedInteger('product_id')->nullable()->index('cashback_rule_specification_items_product_id_foreign');
            $table->unsignedInteger('bundle_id')->nullable()->index('cashback_rule_specification_items_bundle_id_foreign');
            $table->unsignedInteger('subscribe_id')->nullable()->index('cashback_rule_specification_items_subscribe_id_foreign');
            $table->unsignedInteger('registration_package_id')->nullable()->index('rules_registration_package_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashback_rule_specification_items');
    }
}
