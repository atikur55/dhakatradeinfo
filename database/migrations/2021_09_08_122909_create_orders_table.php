<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->string('track_no')->nullable();
            $table->string('product_name')->nullable();
            $table->string('final_quantity')->nullable();
            $table->string('final_checkout_price')->nullable();
            $table->string('sub_total_price')->nullable();
            $table->string('shipp_rate')->nullable();
            $table->string('confirm_total_price')->nullable();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->longText('address')->nullable();
            $table->longText('add_require')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('policeStation')->nullable();
            $table->string('payment')->nullable();
            $table->string('send_account_number')->nullable();
            $table->string('transactionid')->nullable();
            $table->string('reference')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
