<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSupportDepartmentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('support_department_translations', function (Blueprint $table) {
            $table->foreign(['support_department_id'], 'support_department_id')->references(['id'])->on('support_departments')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('support_department_translations', function (Blueprint $table) {
            $table->dropForeign('support_department_id');
        });
    }
}
