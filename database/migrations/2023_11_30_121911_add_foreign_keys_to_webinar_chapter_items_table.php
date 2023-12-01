<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWebinarChapterItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('webinar_chapter_items', function (Blueprint $table) {
            $table->foreign(['user_id'], 'user_id')->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['chapter_id'])->references(['id'])->on('webinar_chapters')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('webinar_chapter_items', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('webinar_chapter_items_chapter_id_foreign');
        });
    }
}
