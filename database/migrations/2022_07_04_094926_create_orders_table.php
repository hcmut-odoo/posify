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
            $table->uuid('id');
            $table->string('user_id');
            $table->string('payment_method');
            $table->string('status');
            $table->timestamps();
        });

        // Schema::table('orders', function (Blueprint $table) {
        //     $table->string('user_id');
        //     $table->foreign('user_id')->references('id')->on('orders');
        // });
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
