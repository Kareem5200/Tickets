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
            Schema::create('trip_prices', function (Blueprint $table) {
                $table->foreignId('stadium_id');
                $table->foreignId('station_id');
                $table->primary(['stadium_id','station_id']);

                $table->foreign('stadium_id')->references('id')->on('stadiums');
                $table->foreign('station_id')->references('id')->on('stations');

                $table->float('trip_price');
                $table->float('seat_price');

                $table->timestamps();
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_prices');
    }
};
