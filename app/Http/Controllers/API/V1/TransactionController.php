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
    public function store(TransactionRequest $request)
{
    \Log::info('Transaction Request:', $request->all()); 
    \Log::info('penggunaID value:', ['penggunaID' => $request->input('penggunaID')]);

    DB::beginTransaction();

    try {
     $transaction = Transaction::create([
    'penggunaID'        => $request->input('penggunaID'),
    'CustomerID'        => $request->input('CustomerID'),
    'Tanggal_transaksi' => $request->input('Tanggal_transaksi'), 
    'total_harga'       => 0, 
    'metode_pembayaran' => $request->input('metode_pembayaran'),
]);

        $totalHarga = 0;

        foreach ($request->items as $item) {
            $barang = Barang::find($item['BarangID']);

            if (!$barang || $barang->Stok < $item['qty']) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => "Stok untuk barang '{$barang->Nama_barang}' tidak mencukupi. Sisa stok: {$barang->Stok}"
                ], 400);
            }

            $subtotal = $barang->Harga_jual * $item['qty'];
            $totalHarga += $subtotal;

            DetailTransaction::create([
                'TransaksiID' => $transaction->TransaksiID,
                'BarangID' => $barang->BarangID,
                'jumlah_barang' => $item['qty'],
                'harga_satuan' => $barang->Harga_jual,
                'subtotal' => $subtotal,
            ]);

            $barang->decrement('Stok', $item['qty']);
        }

        $transaction->update(['total_harga' => $totalHarga]);

    
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
