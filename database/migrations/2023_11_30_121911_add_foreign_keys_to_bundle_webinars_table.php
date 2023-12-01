<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBundleWebinarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bundle_webinars', function (Blueprint $table) {
            $table->foreign(['bundle_id'])->references(['id'])->on('bundles')->onDelete('CASCADE');
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
        Schema::table('bundle_webinars', function (Blueprint $table) {
            $table->dropForeign('bundle_webinars_bundle_id_foreign');
            $table->dropForeign('bundle_webinars_webinar_id_foreign');
        });
    }
}
