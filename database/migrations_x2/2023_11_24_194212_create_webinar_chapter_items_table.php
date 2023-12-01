<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebinarChapterItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinar_chapter_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->index('user_id');
            $table->unsignedInteger('chapter_id')->index('webinar_chapter_items_chapter_id_foreign');
            $table->unsignedInteger('item_id');
            $table->enum('type', ['file', 'session', 'text_lesson', 'quiz', 'assignment']);
            $table->unsignedInteger('order')->nullable();
            $table->unsignedBigInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webinar_chapter_items');
    }
}
