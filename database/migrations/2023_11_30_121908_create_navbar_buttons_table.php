<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavbarButtonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navbar_buttons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id')->nullable()->index('navbar_buttons_role_id_foreign');
            $table->boolean('for_guest')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navbar_buttons');
    }
}
