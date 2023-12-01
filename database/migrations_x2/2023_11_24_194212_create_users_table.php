<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name', 128)->nullable();
            $table->string('role_name', 64);
            $table->unsignedInteger('role_id');
            $table->integer('organ_id')->nullable();
            $table->string('mobile', 32)->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('bio', 128)->nullable();
            $table->string('password')->nullable();
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('remember_token')->nullable();
            $table->unsignedInteger('logged_count')->default(0);
            $table->boolean('verified')->default(false);
            $table->boolean('financial_approval')->default(false);
            $table->boolean('installment_approval')->nullable()->default(false);
            $table->boolean('enable_installments')->nullable()->default(true);
            $table->boolean('disable_cashback')->nullable()->default(false);
            $table->boolean('enable_registration_bonus')->default(false);
            $table->double('registration_bonus_amount', 15, 2)->nullable();
            $table->string('avatar')->nullable();
            $table->string('avatar_settings')->nullable();
            $table->string('cover_img')->nullable();
            $table->string('headline')->nullable();
            $table->text('about')->nullable();
            $table->string('address')->nullable();
            $table->unsignedInteger('country_id')->nullable()->index('users_country_id_foreign');
            $table->unsignedInteger('province_id')->nullable()->index('users_province_id_foreign');
            $table->unsignedInteger('city_id')->nullable()->index('users_city_id_foreign');
            $table->unsignedInteger('district_id')->nullable()->index('users_district_id_foreign');
            $table->point('location')->nullable();
            $table->boolean('level_of_training')->nullable();
            $table->enum('meeting_type', ['all', 'in_person', 'online'])->default('all');
            $table->enum('status', ['active', 'pending', 'inactive'])->default('active');
            $table->boolean('access_content')->default(true);
            $table->string('language')->nullable();
            $table->string('currency')->nullable();
            $table->string('timezone')->nullable();
            $table->boolean('newsletter')->default(false);
            $table->boolean('public_message')->default(false);
            $table->string('identity_scan', 128)->nullable();
            $table->string('certificate', 128)->nullable();
            $table->unsignedInteger('commission')->nullable();
            $table->boolean('affiliate')->default(true);
            $table->boolean('can_create_store')->default(false)->comment('Despite disabling the store feature in the settings, we can enable this feature for that user through the edit page of a user and turning on the store toggle.');
            $table->boolean('ban')->default(false);
            $table->unsignedInteger('ban_start_at')->nullable();
            $table->unsignedInteger('ban_end_at')->nullable();
            $table->boolean('offline')->default(false);
            $table->text('offline_message')->nullable();
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
        Schema::dropIfExists('users');
    }
}
