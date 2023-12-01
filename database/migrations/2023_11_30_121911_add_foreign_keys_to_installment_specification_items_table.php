<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInstallmentSpecificationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('installment_specification_items', function (Blueprint $table) {
            $table->foreign(['bundle_id'])->references(['id'])->on('bundles')->onDelete('CASCADE');
            $table->foreign(['category_id'])->references(['id'])->on('categories')->onDelete('CASCADE');
            $table->foreign(['installment_id'])->references(['id'])->on('installments')->onDelete('CASCADE');
            $table->foreign(['instructor_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['product_id'])->references(['id'])->on('products')->onDelete('CASCADE');
            $table->foreign(['registration_package_id'])->references(['id'])->on('registration_packages')->onDelete('CASCADE');
            $table->foreign(['seller_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['subscribe_id'])->references(['id'])->on('subscribes')->onDelete('CASCADE');
            $table->foreign(['webinar_id'])->references(['id'])->on('webinars')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('installment_specification_items', function (Blueprint $table) {
            $table->dropForeign('installment_specification_items_bundle_id_foreign');
            $table->dropForeign('installment_specification_items_category_id_foreign');
            $table->dropForeign('installment_specification_items_installment_id_foreign');
            $table->dropForeign('installment_specification_items_instructor_id_foreign');
            $table->dropForeign('installment_specification_items_product_id_foreign');
            $table->dropForeign('installment_specification_items_registration_package_id_foreign');
            $table->dropForeign('installment_specification_items_seller_id_foreign');
            $table->dropForeign('installment_specification_items_subscribe_id_foreign');
            $table->dropForeign('installment_specification_items_webinar_id_foreign');
        });
    }
}
