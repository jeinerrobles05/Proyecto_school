<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gifts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('gifts_user_id_foreign');
            $table->unsignedInteger('webinar_id')->nullable()->index('gifts_webinar_id_foreign');
            $table->unsignedInteger('bundle_id')->nullable()->index('gifts_bundle_id_foreign');
            $table->unsignedInteger('product_id')->nullable()->index('gifts_product_id_foreign');
            $table->string('name');
            $table->string('email');
            $table->unsignedBigInteger('date')->nullable();
            $table->text('description')->nullable();
            $table->boolean('viewed')->default(false)->comment('for show modal in recipient user panel');
            $table->enum('status', ['active', 'pending', 'cancel'])->nullable()->default('pending');
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
        Schema::dropIfExists('gifts');
    }
}
