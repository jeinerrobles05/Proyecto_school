<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRegistrationPackagesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registration_packages_translations', function (Blueprint $table) {
            $table->foreign(['registration_package_id'], 'registration_package')->references(['id'])->on('registration_packages')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registration_packages_translations', function (Blueprint $table) {
            $table->dropForeign('registration_package');
        });
    }
}
