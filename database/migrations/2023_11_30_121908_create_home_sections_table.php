<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('name', ['featured_classes', 'latest_bundles', 'latest_classes', 'best_rates', 'trend_categories', 'full_advertising_banner', 'best_sellers', 'discount_classes', 'free_classes', 'store_products', 'testimonials', 'subscribes', 'find_instructors', 'reward_program', 'become_instructor', 'forum_section', 'video_or_image_section', 'instructors', 'half_advertising_banner', 'organizations', 'blog', 'upcoming_courses'])->index();
            $table->unsignedInteger('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_sections');
    }
}
