<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDiscountCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discount_courses', function (Blueprint $table) {
            $table->foreign(['course_id'])->references(['id'])->on('webinars')->onDelete('CASCADE');
            $table->foreign(['discount_id'])->references(['id'])->on('discounts')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discount_courses', function (Blueprint $table) {
            $table->dropForeign('discount_courses_course_id_foreign');
            $table->dropForeign('discount_courses_discount_id_foreign');
        });
    }
}
