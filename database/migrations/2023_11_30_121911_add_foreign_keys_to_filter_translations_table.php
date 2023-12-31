<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFilterTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filter_translations', function (Blueprint $table) {
            $table->foreign(['filter_id'])->references(['id'])->on('filters')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filter_translations', function (Blueprint $table) {
            $table->dropForeign('filter_translations_filter_id_foreign');
        });
    }
}
