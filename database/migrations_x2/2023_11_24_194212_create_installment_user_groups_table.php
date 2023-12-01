<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installment_user_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('installment_id')->index('installment_user_groups_installment_id_foreign');
            $table->unsignedInteger('group_id')->nullable()->index('installment_user_groups_group_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('installment_user_groups');
    }
}
