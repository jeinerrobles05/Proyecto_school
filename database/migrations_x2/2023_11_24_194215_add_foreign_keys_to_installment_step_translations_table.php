<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInstallmentStepTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('installment_step_translations', function (Blueprint $table) {
            $table->foreign(['installment_step_id'])->references(['id'])->on('installment_steps')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('installment_step_translations', function (Blueprint $table) {
            $table->dropForeign('installment_step_translations_installment_step_id_foreign');
        });
    }
}
