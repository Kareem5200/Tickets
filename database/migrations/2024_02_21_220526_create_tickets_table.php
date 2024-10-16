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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['match','bus']);
            $table->enum('status',['active','expired','deactive']);
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('dependent_id')->nullable();
            $table->foreign('dependent_id')->references('id')->on('dependents');
            $table->date('buy_date');
            $table->foreignId('department_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreignId('bus_id')->nullable();
            $table->foreign('bus_id')->references('id')->on('buses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
