<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToGroupsRegistrationPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups_registration_packages', function (Blueprint $table) {
            $table->foreign(['group_id'])->references(['id'])->on('groups')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('groups_registration_packages', function (Blueprint $table) {
            $table->dropForeign('groups_registration_packages_group_id_foreign');
        });
    }
}
