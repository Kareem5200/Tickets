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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('personal_image');
            $table->date('birth_date');
            $table->enum('gender',['male','female']);
            $table->enum('status',['allowes','panned']);
            $table->string('ssn_image');
            $table->integer('ssn');
            $table->string('passpord_id');
            $table->integer('phone_1');
            $table->integer('phone_2')->nullable();
            $table->string('address');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
