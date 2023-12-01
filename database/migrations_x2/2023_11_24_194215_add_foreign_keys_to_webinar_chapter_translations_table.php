<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWebinarChapterTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('webinar_chapter_translations', function (Blueprint $table) {
            $table->foreign(['webinar_chapter_id'], 'webinar_chapter_id')->references(['id'])->on('webinar_chapters')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('webinar_chapter_translations', function (Blueprint $table) {
            $table->dropForeign('webinar_chapter_id');
        });
    }
}
