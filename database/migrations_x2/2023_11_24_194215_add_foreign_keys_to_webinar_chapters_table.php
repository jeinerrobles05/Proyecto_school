<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWebinarChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('webinar_chapters', function (Blueprint $table) {
            $table->foreign(['webinar_id'])->references(['id'])->on('webinars')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('webinar_chapters', function (Blueprint $table) {
            $table->dropForeign('webinar_chapters_webinar_id_foreign');
            $table->dropForeign('webinar_chapters_user_id_foreign');
        });
    }
}
