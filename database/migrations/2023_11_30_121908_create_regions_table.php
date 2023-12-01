<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('country_id')->nullable()->index('regions_country_id_foreign');
            $table->unsignedInteger('province_id')->nullable()->index('regions_province_id_foreign');
            $table->unsignedInteger('city_id')->nullable()->index('regions_city_id_foreign');
            $table->point('geo_center')->nullable();
            $table->enum('type', ['country', 'province', 'city', 'district']);
            $table->string('title');
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
        Schema::dropIfExists('regions');
    }
}
