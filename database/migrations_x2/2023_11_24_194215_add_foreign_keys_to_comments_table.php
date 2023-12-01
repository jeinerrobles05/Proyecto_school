<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign(['webinar_id'])->references(['id'])->on('webinars')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['upcoming_course_id'])->references(['id'])->on('upcoming_courses')->onDelete('CASCADE');
            $table->foreign(['review_id'])->references(['id'])->on('webinar_reviews')->onDelete('CASCADE');
            $table->foreign(['reply_id'])->references(['id'])->on('comments')->onDelete('CASCADE');
            $table->foreign(['product_id'])->references(['id'])->on('products')->onDelete('CASCADE');
            $table->foreign(['blog_id'], 'comments_ibfk_1')->references(['id'])->on('blog')->onDelete('CASCADE');
            $table->foreign(['bundle_id'])->references(['id'])->on('bundles')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_webinar_id_foreign');
            $table->dropForeign('comments_user_id_foreign');
            $table->dropForeign('comments_upcoming_course_id_foreign');
            $table->dropForeign('comments_review_id_foreign');
            $table->dropForeign('comments_reply_id_foreign');
            $table->dropForeign('comments_product_id_foreign');
            $table->dropForeign('comments_ibfk_1');
            $table->dropForeign('comments_bundle_id_foreign');
        });
    }
}
