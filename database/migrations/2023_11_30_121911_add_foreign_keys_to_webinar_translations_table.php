<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWebinarTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('webinar_translations', function (Blueprint $table) {
            $table->foreign(['webinar_id'])->references(['id'])->on('webinars')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('webinar_translations', function (Blueprint $table) {
            $table->dropForeign('webinar_translations_webinar_id_foreign');
        });
    }
}
