<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersRegistrationPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_registration_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->index('users_registration_packages_user_id_foreign');
            $table->integer('instructors_count')->nullable();
            $table->integer('students_count')->nullable();
            $table->integer('courses_capacity')->nullable();
            $table->integer('courses_count')->nullable();
            $table->integer('meeting_count')->nullable();
            $table->enum('status', ['disabled', 'active']);
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
        Schema::dropIfExists('users_registration_packages');
    }
}
