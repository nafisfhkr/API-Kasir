<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Response;
use App\Models\Barang;
use App\Models\DetailTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
    public function store(Request $request)
{
    // 1. Mulai Database Transaction untuk keamanan data
    DB::beginTransaction();

    try {
     $transaction = Transaction::create([
    'penggunaID'        => $request->penggunaID,
    'CustomerID'        => $request->CustomerID,
    'Tanggal_transaksi' => $request->Tanggal_transaksi, 
    'total_harga'       => 0, 
    'metode_pembayaran' => $request->metode_pembayaran,
]);

        $totalHarga = 0;

        foreach ($request->items as $item) {
            // Ambil data barang berdasarkan ID
            $barang = Barang::find($item['BarangID']);

            // --- VALIDASI STOK (PENTING!) ---
            if (!$barang || $barang->Stok < $item['qty']) {
                // Batalkan semua proses jika ada satu saja barang yang kurang stoknya
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => "Stok untuk barang '{$barang->Nama_barang}' tidak mencukupi. Sisa stok: {$barang->Stok}"
                ], 400);
            }

            // Hitung subtotal
            $subtotal = $barang->Harga_jual * $item['qty'];
            $totalHarga += $subtotal;

            // Simpan ke detail_transactions menggunakan nama kolom 'jumlah_barang'
            DetailTransaction::create([
                'TransaksiID' => $transaction->TransaksiID,
                'BarangID' => $barang->BarangID,
                'jumlah_barang' => $item['qty'],
                'harga_satuan' => $barang->Harga_jual,
                'subtotal' => $subtotal,
            ]);

            // Kurangi stok barang
            $barang->decrement('Stok', $item['qty']);
        }

        // Update total harga di transaksi utama
        $transaction->update(['total_harga' => $totalHarga]);

        // Simpan semua perubahan
        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil disimpan',
            'data' => $transaction->load('details.barang')
        ]);

    } catch (\Exception $e) {
        // Jika ada eror sistem, batalkan semua perubahan data
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Gagal melakukan transaksi: ' . $e->getMessage()
        ], 500);
    }
}
}
