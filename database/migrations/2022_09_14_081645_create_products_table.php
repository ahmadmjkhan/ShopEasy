<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->integer('admin_id')->nullable();
            $table->string('admin_type')->nullable();
            $table->string('product_name');
            $table->string('product_code');
            $table->string('product_color');
            $table->string('product_price');
            $table->string('product_weight');
            $table->string('product_discount');
            $table->string('product_image')->nullable();
            $table->string('product_video')->nullable();
            $table->string('short_description');
            $table->string('long_descsription');
            $table->string('meta_title');
            $table->string('meta_keywords');
            $table->string('meta_description');
            $table->enum('is_feature',['No','Yes']);
            $table->tinyInteger('status')->default('1');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
