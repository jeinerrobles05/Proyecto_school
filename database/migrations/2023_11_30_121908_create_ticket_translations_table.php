<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('ticket_id')->index('ticket_translations_ticket_id_foreign');
            $table->string('locale')->index();
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_translations');
    }
}
