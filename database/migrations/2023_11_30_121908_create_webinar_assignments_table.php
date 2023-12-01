<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebinarAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinar_assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->index('webinar_assignments_creator_id_foreign');
            $table->unsignedInteger('webinar_id')->index('webinar_assignments_webinar_id_foreign');
            $table->unsignedInteger('chapter_id')->index('webinar_assignments_chapter_id_foreign');
            $table->unsignedInteger('grade')->nullable();
            $table->unsignedInteger('pass_grade')->nullable();
            $table->unsignedInteger('deadline')->nullable();
            $table->unsignedInteger('attempts')->nullable();
            $table->boolean('check_previous_parts')->default(false);
            $table->unsignedInteger('access_after_day')->nullable();
            $table->enum('status', ['active', 'inactive']);
            $table->unsignedBigInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webinar_assignments');
    }
}
