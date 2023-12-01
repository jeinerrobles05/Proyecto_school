<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCashbackRuleUsersGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cashback_rule_users_groups', function (Blueprint $table) {
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['group_id'])->references(['id'])->on('groups')->onDelete('CASCADE');
            $table->foreign(['cashback_rule_id'])->references(['id'])->on('cashback_rules')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cashback_rule_users_groups', function (Blueprint $table) {
            $table->dropForeign('cashback_rule_users_groups_user_id_foreign');
            $table->dropForeign('cashback_rule_users_groups_group_id_foreign');
            $table->dropForeign('cashback_rule_users_groups_cashback_rule_id_foreign');
        });
    }
}
