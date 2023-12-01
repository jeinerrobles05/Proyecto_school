<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTicketTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_translations', function (Blueprint $table) {
            $table->foreign(['ticket_id'])->references(['id'])->on('tickets')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_translations', function (Blueprint $table) {
            $table->dropForeign('ticket_translations_ticket_id_foreign');
        });
    }
}
