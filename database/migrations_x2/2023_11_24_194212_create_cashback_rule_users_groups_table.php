<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashbackRuleUsersGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashback_rule_users_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cashback_rule_id')->index('cashback_rule_users_groups_cashback_rule_id_foreign');
            $table->unsignedInteger('group_id')->nullable()->index('cashback_rule_users_groups_group_id_foreign');
            $table->unsignedInteger('user_id')->nullable()->index('cashback_rule_users_groups_user_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashback_rule_users_groups');
    }
}
