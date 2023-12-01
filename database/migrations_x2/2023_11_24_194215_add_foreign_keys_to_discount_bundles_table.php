<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDiscountBundlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discount_bundles', function (Blueprint $table) {
            $table->foreign(['discount_id'])->references(['id'])->on('discounts')->onDelete('CASCADE');
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
        Schema::table('discount_bundles', function (Blueprint $table) {
            $table->dropForeign('discount_bundles_discount_id_foreign');
            $table->dropForeign('discount_bundles_bundle_id_foreign');
        });
    }
}
