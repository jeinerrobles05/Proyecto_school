<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountBundlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_bundles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('discount_id')->index('discount_bundles_discount_id_foreign');
            $table->unsignedInteger('bundle_id')->index('discount_bundles_bundle_id_foreign');
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
        Schema::dropIfExists('discount_bundles');
    }
}
