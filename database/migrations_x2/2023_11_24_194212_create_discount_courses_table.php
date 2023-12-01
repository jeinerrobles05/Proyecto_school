<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('discount_id')->index('discount_courses_discount_id_foreign');
            $table->unsignedInteger('course_id')->index('discount_courses_course_id_foreign');
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
        Schema::dropIfExists('discount_courses');
    }
}
