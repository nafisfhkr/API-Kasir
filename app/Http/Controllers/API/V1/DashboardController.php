<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Transaction;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $startDate = $request->query('start_date', Carbon::today()->toDateString());
    $endDate = $request->query('end_date', Carbon::today()->toDateString());

   
    $start = Carbon::parse($startDate)->startOfDay();
    $end = Carbon::parse($endDate)->endOfDay();

    // 2. Total Pendapatan berdasarkan rentang tanggal
    $totalRevenue = Transaction::whereBetween('created_at', [$start, $end])
        ->sum('total_harga');

    // 3. Jumlah Transaksi berdasarkan rentang tanggal
    $transactionCount = Transaction::whereBetween('created_at', [$start, $end])->count();

    // 4. Produk Terlaris berdasarkan rentang tanggal
    $topProducts = DB::table('detail_transactions')
        ->join('barang', 'detail_transactions.BarangID', '=', 'barang.BarangID')
        ->join('transactions', 'detail_transactions.TransaksiID', '=', 'transactions.TransaksiID')
        ->whereBetween('transactions.created_at', [$start, $end])
        ->select('barang.Nama_barang', DB::raw('SUM(detail_transactions.jumlah_barang) as total_sold'))
        ->groupBy('barang.BarangID', 'barang.Nama_barang')
        ->orderBy('total_sold', 'desc')
        ->limit(5)
        ->get();

    // 5. Peringatan Stok (tetap ambil semua yang stoknya tipis)
    $lowStockProducts = Barang::where('Stok', '<', 10)->get(['Nama_barang', 'Stok']);

    return response()->json([
        'success' => true,
        'message' => "Data dashboard dari $startDate sampai $endDate",
        'data' => [
            'period_stats' => [
                'revenue' => (float) $totalRevenue,
                'transactions' => $transactionCount,
            ],
            'top_products' => $topProducts,
            'low_stock_warning' => $lowStockProducts
        ]
    ]);
}
}