<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_id');
            $table->string('cart_id');
            $table->string('size');
            $table->string('quantity');
            $table->text('note')->nullable();
            $table->timestamps();
        });

        // Schema::table('cart_items', function (Blueprint $table) {
        //     $table->string('cart_id');
        //     $table->foreign('id')->references('id')->on('carts');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
