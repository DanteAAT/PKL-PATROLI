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
        Schema::create('take_equipment', function (Blueprint $table) {
            $table->increments('take_equipment_id');
            $table->integer('personil_id');
            $table->integer('patrol_id');
            $table->string('no_take_equipment',);
            $table->dateTime('date_and_time_pick_up');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('take_equipment');
    }
};
