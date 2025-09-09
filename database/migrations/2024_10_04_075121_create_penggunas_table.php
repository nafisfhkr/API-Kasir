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
        Schema::create('penggunas', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users
            $table->string('Nama');
            $table->string('Email')->unique(); // Unique untuk email
            $table->string('Password');
            $table->string('No_hp');
            $table->string('Code_referral')->nullable();
            $table->string('Role')->default('user'); // Kolom Role
            $table->timestamps();

            // Foreign Key Relasi
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunas');
    }
};
