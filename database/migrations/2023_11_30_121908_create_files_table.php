<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('files_creator_id_foreign');
            $table->unsignedInteger('webinar_id')->index('files_webinar_id_foreign');
            $table->unsignedInteger('chapter_id')->nullable()->index('files_chapter_id_foreign');
            $table->enum('accessibility', ['free', 'paid']);
            $table->boolean('downloadable')->nullable()->default(false);
            $table->enum('storage', ['upload', 'youtube', 'vimeo', 'external_link', 'google_drive', 'dropbox', 'iframe', 's3', 'upload_archive', 'secure_host']);
            $table->text('file');
            $table->string('volume', 64);
            $table->string('file_type', 64);
            $table->enum('interactive_type', ['adobe_captivate', 'i_spring', 'custom'])->nullable();
            $table->string('interactive_file_name')->nullable();
            $table->string('interactive_file_path')->nullable();
            $table->boolean('check_previous_parts')->default(false);
            $table->unsignedInteger('access_after_day')->nullable();
            $table->boolean('online_viewer')->default(false);
            $table->unsignedInteger('order')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('created_at');
            $table->integer('updated_at')->nullable();
            $table->integer('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
