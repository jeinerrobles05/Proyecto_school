<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCashbackRuleSpecificationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cashback_rule_specification_items', function (Blueprint $table) {
            $table->foreign(['registration_package_id'], 'rules_registration_package_id')->references(['id'])->on('registration_packages')->onDelete('CASCADE');
            $table->foreign(['webinar_id'])->references(['id'])->on('webinars')->onDelete('CASCADE');
            $table->foreign(['subscribe_id'])->references(['id'])->on('subscribes')->onDelete('CASCADE');
            $table->foreign(['seller_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['product_id'])->references(['id'])->on('products')->onDelete('CASCADE');
            $table->foreign(['instructor_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['category_id'])->references(['id'])->on('categories')->onDelete('CASCADE');
            $table->foreign(['cashback_rule_id'])->references(['id'])->on('cashback_rules')->onDelete('CASCADE');
            $table->foreign(['bundle_id'])->references(['id'])->on('bundles')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cashback_rule_specification_items', function (Blueprint $table) {
            $table->dropForeign('rules_registration_package_id');
            $table->dropForeign('cashback_rule_specification_items_webinar_id_foreign');
            $table->dropForeign('cashback_rule_specification_items_subscribe_id_foreign');
            $table->dropForeign('cashback_rule_specification_items_seller_id_foreign');
            $table->dropForeign('cashback_rule_specification_items_product_id_foreign');
            $table->dropForeign('cashback_rule_specification_items_instructor_id_foreign');
            $table->dropForeign('cashback_rule_specification_items_category_id_foreign');
            $table->dropForeign('cashback_rule_specification_items_cashback_rule_id_foreign');
            $table->dropForeign('cashback_rule_specification_items_bundle_id_foreign');
        });
    }
}
