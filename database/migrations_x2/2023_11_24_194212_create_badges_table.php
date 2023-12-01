<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->enum('type', ['register_date', 'course_count', 'course_rate', 'sale_count', 'support_rate', 'product_sale_count', 'make_topic', 'send_post_in_topic', 'instructor_blog'])->index();
            $table->string('condition', 128);
            $table->integer('score')->nullable();
            $table->unsignedInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badges');
    }
}
