<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTestimonialTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('testimonial_translations', function (Blueprint $table) {
            $table->foreign(['testimonial_id'])->references(['id'])->on('testimonials')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testimonial_translations', function (Blueprint $table) {
            $table->dropForeign('testimonial_translations_testimonial_id_foreign');
        });
    }
}
