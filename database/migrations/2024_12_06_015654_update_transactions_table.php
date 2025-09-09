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
        Schema::table('transactions', function (Blueprint $table) {

            // Tambahkan kolom diskon
            $table->decimal('diskon', 15, 2)->default(0)->after('total_harga');

            // Tambahkan kolom cash_given
            $table->decimal('cash_given', 15, 2)->nullable()->after('diskon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Tambahkan kembali kolom StaffID
            $table->unsignedBigInteger('StaffID')->after('penggunaID');
            $table->foreign('StaffID')->references('StaffID')->on('staff')->onDelete('cascade');

            // Hapus kolom diskon
            $table->dropColumn('diskon');

            // Hapus kolom cash_given
            $table->dropColumn('cash_given');
        });
    }
};
