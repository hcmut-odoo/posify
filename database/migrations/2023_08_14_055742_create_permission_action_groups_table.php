<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePermissionActionGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_action_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('action_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('action_id')->references('id')->on('actions');
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

        Schema::dropIfExists('permission_action_groups');

        // Re-enable foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
