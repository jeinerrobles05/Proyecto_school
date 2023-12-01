<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductSelectedSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_selected_specifications', function (Blueprint $table) {
            $table->foreign(['creator_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['product_id'])->references(['id'])->on('products')->onDelete('CASCADE');
            $table->foreign(['product_specification_id'])->references(['id'])->on('product_specifications')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_selected_specifications', function (Blueprint $table) {
            $table->dropForeign('product_selected_specifications_creator_id_foreign');
            $table->dropForeign('product_selected_specifications_product_id_foreign');
            $table->dropForeign('product_selected_specifications_product_specification_id_foreign');
        });
    }
}
