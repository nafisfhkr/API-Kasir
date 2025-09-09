<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->id('detailID'); 
            $table->unsignedBigInteger('TransaksiID'); 
            $table->unsignedBigInteger('BarangID'); 
            $table->integer('jumlah_barang'); 
            $table->decimal('harga_satuan', 10, 2); 
            $table->decimal('subtotal', 10, 2); 
            $table->timestamps(); 

            // Relasi Foreign Key
            $table->foreign('TransaksiID')->references('TransaksiID')->on('transactions')->onDelete('cascade');
            $table->foreign('BarangID')->references('BarangID')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transactions');
    }
}
