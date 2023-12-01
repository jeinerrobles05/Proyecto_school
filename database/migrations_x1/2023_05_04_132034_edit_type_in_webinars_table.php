<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditTypeInWebinarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('webinars', function (Blueprint $table) {
            DB::statement("ALTER TABLE `webinars` MODIFY COLUMN `type` ENUM('webinar','course','text_lesson','classroom_course') NOT NULL ");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('webinars', function (Blueprint $table) {
            DB::statement("ALTER TABLE `webinars` MODIFY COLUMN `type` ENUM('webinar','course','text_lesson') NOT NULL;");
        });
    }
}
