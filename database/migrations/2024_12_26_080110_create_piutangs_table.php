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
        Schema::create('piutangs', function (Blueprint $table) {
            $table->id('piutangID'); // Primary Key
            $table->unsignedBigInteger('TransaksiID'); // Foreign Key ke tabel transaksi
            $table->unsignedBigInteger('CustomerID'); // Foreign Key ke tabel customer
            $table->date('tanggal_piutang');
            $table->date('jatuh_tempo');
            $table->decimal('total_piutang', 15, 2);
            $table->enum('status_pembayaran', ['belum_lunas', 'lunas'])->default('belum_lunas');
            $table->timestamps();
            // Relasi Foreign Key
            $table->foreign('TransaksiID')->references('TransaksiID')->on('transactions')->onDelete('cascade');
            $table->foreign('CustomerID')->references('CustomerID')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piutangs');
    }
};
