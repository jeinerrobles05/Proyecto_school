<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebinarChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinar_chapters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('webinar_chapters_user_id_foreign');
            $table->unsignedInteger('webinar_id')->index('webinar_chapters_webinar_id_foreign');
            $table->unsignedInteger('order')->nullable();
            $table->boolean('check_all_contents_pass')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
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
        Schema::dropIfExists('webinar_chapters');
    }
}
