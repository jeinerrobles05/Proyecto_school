<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('days');
            $table->double('price', 15, 2)->unsigned();
            $table->string('icon');
            $table->enum('role', ['instructors', 'organizations'])->index();
            $table->integer('instructors_count')->nullable();
            $table->integer('students_count')->nullable();
            $table->integer('courses_capacity')->nullable();
            $table->integer('courses_count')->nullable();
            $table->integer('meeting_count')->nullable();
            $table->unsignedInteger('product_count')->nullable();
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
        Schema::dropIfExists('registration_packages');
    }
}
