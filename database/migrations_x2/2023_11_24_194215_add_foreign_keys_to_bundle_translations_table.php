<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBundleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bundle_translations', function (Blueprint $table) {
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
        Schema::table('bundle_translations', function (Blueprint $table) {
            $table->dropForeign('bundle_translations_bundle_id_foreign');
        });
    }
}
