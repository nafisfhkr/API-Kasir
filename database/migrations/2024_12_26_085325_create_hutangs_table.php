<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hutangs', function (Blueprint $table) {
            $table->id('hutangID'); // Primary Key
            $table->unsignedBigInteger('SuplierID'); // Foreign Key ke tabel supplier
            $table->date('tanggal_hutang');
            $table->date('jatuh_tempo');
            $table->decimal('total_hutang', 15, 2);
            $table->enum('status_pembayaran', ['belum_lunas', 'lunas'])->default('belum_lunas');
            $table->timestamps();

            // Relasi Foreign Key
            $table->foreign('SuplierID')->references('SuplierID')->on('supplier')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hutangs');
    }
};
