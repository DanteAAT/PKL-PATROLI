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
        Schema::create('personil_scheduling', function (Blueprint $table) {
            $table->increments('personil_scheduling_id');
            $table->integer('personil_id');
            $table->integer('patrol_schedule_id');
            $table->json('patrol_day')->nullable();
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
        Schema::dropIfExists('personil_scheduling');
    }
};
