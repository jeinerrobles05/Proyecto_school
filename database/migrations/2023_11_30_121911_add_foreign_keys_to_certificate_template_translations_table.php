<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCertificateTemplateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificate_template_translations', function (Blueprint $table) {
            $table->foreign(['certificate_template_id'], 'certificate_template_id')->references(['id'])->on('certificates_templates')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificate_template_translations', function (Blueprint $table) {
            $table->dropForeign('certificate_template_id');
        });
    }
}
