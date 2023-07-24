<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateApiKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_keys', function (Blueprint $table) {
            $table->id();
            $table->string('value', 50);
            $table->unsignedBigInteger('user_id');
            $table->timestamp('expired_at');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Disable foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::dropIfExists('api_keys');

        // Re-enable foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}