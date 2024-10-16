<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('driver_trips', function (Blueprint $table) {



            $table->foreignId('driver_id');
            $table->foreignId('stadium_id');
            $table->foreignId('bus_id');
            $table->foreignId('station_id');

            $table->date('trip_date');
            $table->time('travel_time');

            $table->primary(['driver_id','stadium_id','bus_id','station_id','trip_date']);

            $table->foreign('driver_id')->references('id')->on('employees');
            $table->foreign('stadium_id')->references('id')->on('stadiums');
            $table->foreign('bus_id')->references('id')->on('buses');
            $table->foreign('station_id')->references('id')->on('stations');




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_trips');
    }
};
