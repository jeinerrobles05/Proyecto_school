<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->unsignedInteger('role_id')->nullable()->index('forums_role_id_foreign');
            $table->unsignedInteger('group_id')->nullable()->index('forums_group_id_foreign');
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('icon')->nullable();
            $table->enum('status', ['disabled', 'active'])->nullable();
            $table->boolean('close')->default(false);
            $table->integer('order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forums');
    }
}
