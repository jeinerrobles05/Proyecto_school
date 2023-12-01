<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWebinarExtraDescriptionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('webinar_extra_description_translations', function (Blueprint $table) {
            $table->foreign(['webinar_extra_description_id'], 'webinar_extra_description_id_foreign')->references(['id'])->on('webinar_extra_descriptions')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('webinar_extra_description_translations', function (Blueprint $table) {
            $table->dropForeign('webinar_extra_description_id_foreign');
        });
    }
}
