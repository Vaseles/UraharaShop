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
            
            $table->foreignId('user_id')->constraint('users')->onDelete('cascade');
            $table->foreignId('product_id')->constraint('products')->onDelete('cascade');

            $table->string('count');

            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('postalCode');

            $table->string('payMethod');
            $table->string('shippingPrice');
            $table->string('totalPrice');

            $table->string('isPaid');
            $table->string('isDeliver');

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
