<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBundleFilterOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bundle_filter_option', function (Blueprint $table) {
            $table->foreign(['filter_option_id'])->references(['id'])->on('filter_options')->onDelete('CASCADE');
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
        Schema::table('bundle_filter_option', function (Blueprint $table) {
            $table->dropForeign('bundle_filter_option_filter_option_id_foreign');
            $table->dropForeign('bundle_filter_option_bundle_id_foreign');
        });
    }
}
