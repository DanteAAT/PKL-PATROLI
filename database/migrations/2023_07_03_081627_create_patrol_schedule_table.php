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
        Schema::create('patrol_schedule', function (Blueprint $table) {
            $table->increments('patrol_schedule_id');
            $table->integer('location_id');
            $table->time('patrol_start_time');
            $table->time('patrol_end_time');
            $table->text('patrol_information');
            $table->integer('data_state')->default(0);
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
        Schema::dropIfExists('patrol_schedule');
    }
};
