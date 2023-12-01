<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToShedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shedules', function (Blueprint $table) {
            $table->foreign(['course_group_id'], 'shedule_course_group_id_foreign')->references(['id'])->on('course_groups')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shedules', function (Blueprint $table) {
            $table->dropForeign('shedule_course_group_id_foreign');
        });
    }
}
