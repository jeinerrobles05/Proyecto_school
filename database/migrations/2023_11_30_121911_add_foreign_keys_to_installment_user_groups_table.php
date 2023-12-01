<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInstallmentUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('installment_user_groups', function (Blueprint $table) {
            $table->foreign(['group_id'])->references(['id'])->on('groups')->onDelete('CASCADE');
            $table->foreign(['installment_id'])->references(['id'])->on('installments')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('installment_user_groups', function (Blueprint $table) {
            $table->dropForeign('installment_user_groups_group_id_foreign');
            $table->dropForeign('installment_user_groups_installment_id_foreign');
        });
    }
}
