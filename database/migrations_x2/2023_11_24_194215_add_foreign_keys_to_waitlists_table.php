<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWaitlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('waitlists', function (Blueprint $table) {
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
        Schema::table('waitlists', function (Blueprint $table) {
            $table->dropForeign('waitlists_webinar_id_foreign');
            $table->dropForeign('waitlists_user_id_foreign');
        });
    }
}
