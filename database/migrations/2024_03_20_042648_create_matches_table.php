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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stadium_id');
            $table->foreignId('competition_id');
            $table->foreign('stadium_id')->references('id')->on('stadiums');
            $table->foreign('competition_id')->references('id')->on('competitions');
            $table->time('match_time');
            $table->date('match_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
