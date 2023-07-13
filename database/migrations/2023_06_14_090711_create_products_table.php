<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->integer('admin_id')->nullable();
            $table->string('added_by')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_color')->nullable();
            $table->string('product_price')->nullable();
            $table->string('product_weight')->nullable();
            $table->string('product_discount')->nullable();
            $table->float('product_gst')->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_video')->nullable();
            $table->string('short_description')->nullable();
            $table->string('long_description')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->enum('is_feature',['No','Yes']);
            $table->enum('is_bestseller',['No','Yes']);
            $table->tinyInteger('status')->default('1');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
