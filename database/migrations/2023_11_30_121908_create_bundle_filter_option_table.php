<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundleFilterOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundle_filter_option', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bundle_id')->index('bundle_filter_option_bundle_id_foreign');
            $table->unsignedInteger('filter_option_id')->index('bundle_filter_option_filter_option_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bundle_filter_option');
    }
}
