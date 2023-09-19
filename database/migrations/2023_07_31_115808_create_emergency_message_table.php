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
        Schema::create('emergency_message', function (Blueprint $table) {
            $table->increments('emergency_message_id');
            $table->string('emergency_message_name');
            $table->string('emergency_message_phone_number');
            $table->string('emergency_message_text');
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
        Schema::dropIfExists('emergency_message');
    }
};
