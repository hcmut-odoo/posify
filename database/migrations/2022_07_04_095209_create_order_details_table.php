<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('order_id');
            $table->string('product_id');
            $table->string('quantity');
            $table->timestamps();
        });

        // Schema::table('order_details', function (Blueprint $table) {
        //     $table->string('order_id');
        //     $table->foreign('order_id')->references('id')->on('orders');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
