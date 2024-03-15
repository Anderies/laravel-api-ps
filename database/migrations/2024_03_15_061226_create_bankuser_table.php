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
        Schema::create('bankuser', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name');
            $table->date('date_of_birth');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('account_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bankuser');
    }
};
