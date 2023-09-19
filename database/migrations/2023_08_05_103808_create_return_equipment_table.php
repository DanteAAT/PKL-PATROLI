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
        Schema::create('return_equipment', function (Blueprint $table) {
            $table->increments('return_equipment_id');
            $table->integer('personil_id');
            $table->integer('take_equipment_id');
            $table->integer('no_return_equipment',);
            $table->dateTime('return_date');
            $table->text('return_equipment_checklist');
            $table->text('information_per_item');
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
        Schema::dropIfExists('return_equipment');
    }
};
