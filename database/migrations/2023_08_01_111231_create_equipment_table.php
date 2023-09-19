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
        Schema::create('equipment', function (Blueprint $table) {
            $table->increments('equipment_id');
            $table->string('equipment_name');
            $table->integer('equipment_amount');
            $table->text('equipment_information')->nullable();
            $table->string('last_take_name')->nullable();
            $table->date('last_take_date')->nullable();
            $table->integer('quality')->comment('1 = Bagus 2 = Sedang 3 = Rusak');
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
        Schema::dropIfExists('equipment');
    }
};
