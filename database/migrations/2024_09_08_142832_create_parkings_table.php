<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained();
            $table->foreignId('vehicle_id')->constrained();
            $table->foreignId('zone_id')->constrained();
            $table->dateTime('start_time')->nullable();
            $table->timestamp('stop_time')->nullable();
            $table->integer('total_price')->nullable();
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
        Schema::dropIfExists('parkings');
    }
}
