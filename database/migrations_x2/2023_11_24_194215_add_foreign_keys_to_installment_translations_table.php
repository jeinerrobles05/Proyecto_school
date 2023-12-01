<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInstallmentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('installment_translations', function (Blueprint $table) {
            $table->foreign(['installment_id'])->references(['id'])->on('installments')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('installment_translations', function (Blueprint $table) {
            $table->dropForeign('installment_translations_installment_id_foreign');
        });
    }
}
