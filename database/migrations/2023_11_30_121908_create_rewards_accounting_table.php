<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardsAccountingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards_accounting', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('rewards_accounting_user_id_foreign');
            $table->unsignedInteger('item_id')->nullable();
            $table->enum('type', ['account_charge', 'create_classes', 'buy', 'pass_the_quiz', 'certificate', 'comment', 'register', 'review_courses', 'instructor_meeting_reserve', 'student_meeting_reserve', 'newsletters', 'badge', 'referral', 'learning_progress_100', 'charge_wallet', 'withdraw', 'buy_store_product', 'pass_assignment', 'send_post_in_topic', 'make_topic', 'create_blog_by_instructor', 'comment_for_instructor_blog']);
            $table->unsignedInteger('score');
            $table->enum('status', ['addiction', 'deduction']);
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
        Schema::dropIfExists('rewards_accounting');
    }
}
