<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('regions', function (Blueprint $table) {
            $table->foreign(['city_id'])->references(['id'])->on('regions')->onDelete('CASCADE');
            $table->foreign(['country_id'])->references(['id'])->on('regions')->onDelete('CASCADE');
            $table->foreign(['province_id'])->references(['id'])->on('regions')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('regions', function (Blueprint $table) {
            $table->dropForeign('regions_city_id_foreign');
            $table->dropForeign('regions_country_id_foreign');
            $table->dropForeign('regions_province_id_foreign');
        });
    }
}
