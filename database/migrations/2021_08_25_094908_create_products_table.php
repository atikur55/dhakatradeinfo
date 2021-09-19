<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->integer('added_by')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->integer('childcategory_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('price_dollar')->nullable();
            $table->string('price')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('country_origin')->nullable();
            $table->string('color')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_quantity')->nullable();
            $table->string('min_order_quantity')->nullable();
            $table->string('product_quantity_one')->nullable();
            $table->string('product_price_one')->nullable();
            $table->string('product_price_one_dollar')->nullable();
            $table->string('product_quantity_two')->nullable();
            $table->string('product_price_two')->nullable();
            $table->string('product_price_two_dollar')->nullable();
            $table->string('product_quantity_three')->nullable();
            $table->string('product_price_three')->nullable();
            $table->string('product_price_three_dollar')->nullable();
            $table->longText('description')->nullable();
            $table->longText('video_link')->nullable();
            $table->string('domain_url')->nullable();
            $table->string('quantity')->nullable();
            $table->string('quprice')->nullable();
            $table->string('domain_url')->nullable();
            $table->string('image')->default('photo.jpg');
            $table->integer('status')->default(0);
            $table->string('slug')->nullable();
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
}
