<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDiscountGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discount_groups', function (Blueprint $table) {
            $table->foreign(['discount_id'])->references(['id'])->on('discounts')->onDelete('CASCADE');
            $table->foreign(['group_id'])->references(['id'])->on('groups')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discount_groups', function (Blueprint $table) {
            $table->dropForeign('discount_groups_discount_id_foreign');
            $table->dropForeign('discount_groups_group_id_foreign');
        });
    }
}
