<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersCookieSecurityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_cookie_security', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('users_cookie_security_user_id_foreign');
            $table->enum('type', ['all', 'customize']);
            $table->text('settings')->nullable();
            $table->unsignedBigInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_cookie_security');
    }
}
