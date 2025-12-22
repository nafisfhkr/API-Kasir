<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with(['penggunas', 'customers', 'detailTransactions'])->get();
        return TransactionResource::collection($transactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request)
{
   
    return DB::transaction(function () use ($request) {
    
    $userLoggedIn = auth()->user();
    $pengguna = $userLoggedIn->pengguna; 

    if (!$pengguna) {
        throw new \Exception("Profil pengguna tidak ditemukan.");
    }

    $transaction = Transaction::create([
        'penggunaID' => $pengguna->id, // Diambil otomatis dari sistem
        'CustomerID' => $request->CustomerID,
        'Tanggal_transaksi' => now(),
        'total_harga' => 0,
        'metode_pembayaran' => $request->metode_pembayaran
    ]);

        $totalHarga = 0;

        // 2. Loop setiap item yang dikirim dari frontend
        foreach ($request->items as $item) {
            $barang = Barang::findOrFail($item['BarangID']);

            // Cek apakah stok mencukupi
            if ($barang->Stok < $item['qty']) {
                throw new \Exception("Stok barang '{$barang->Nama_barang}' tidak mencukupi. Sisa stok: {$barang->Stok}");
            }

            // Hitung subtotal untuk item ini
            $subtotal = $barang->Harga_jual * $item['qty'];
            $totalHarga += $subtotal;

            // 3. Simpan ke Detail Transaksi
            DetailTransaction::create([
                'TransaksiID' => $transaction->TransaksiID,
                'BarangID' => $barang->BarangID,
                'Jumlah_barang' => $item['qty'],
                'harga_satuan' => $barang->Harga_jual,
                'Subtotal' => $subtotal
            ]);

            // 4. Kurangi stok barang
            $barang->decrement('Stok', $item['qty']);
        }

        // 5. Update total_harga akhir di tabel transactions
        $transaction->update(['total_harga' => $totalHarga]);

        // Return hasil dengan relasi detail agar frontend bisa menampilkan struk
        return new TransactionResource($transaction->load(['detailTransactions.barang', 'customer']));
    });
}
}
