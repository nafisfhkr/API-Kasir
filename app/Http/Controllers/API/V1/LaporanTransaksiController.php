<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\LaporanTransaksi;
use App\Http\Resources\LaporanTransaksiResource;
use App\Http\Requests\LaporanTransaksiRequest;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class LaporanTransaksiController extends Controller
{
    public function index(Request $request)
{
    $startDate = $request->query('start_date', Carbon::now()->startOfMonth());
    $endDate = $request->query('end_date', Carbon::now()->endOfMonth());

    // Mengelompokkan transaksi per hari untuk laporan harian
    $summary = Transaction::select(
            DB::raw('DATE(Tanggal_transaksi) as tanggal'),
            DB::raw('COUNT(TransaksiID) as total_transaksi'),
            DB::raw('SUM(total_harga) as total_pendapatan')
        )
        ->whereBetween('Tanggal_transaksi', [$startDate, $endDate])
        ->groupBy('tanggal')
        ->get();

    return response()->json([
        'success' => true,
        'periode' => "$startDate sampai $endDate",
        'data' => $summary
    ]);
}

    public function store(LaporanTransaksiRequest $request)
    {
        $laporan = LaporanTransaksi::create($request->validated());
        return response()->json($laporan, 201);
    }

    public function show(LaporanTransaksi $laporanTransaksi)
    {
        return response()->json($laporanTransaksi);
    }

    public function update(LaporanTransaksiRequest $request, LaporanTransaksi $laporanTransaksi)
    {
        $laporanTransaksi->update($request->validated());
        return response()->json($laporanTransaksi);
    }

    public function destroy(LaporanTransaksi $laporanTransaksi)
    {
        $laporanTransaksi->delete();
        return response()->json(null, 204);
    }

    public function dashboardStats()
{
    // 1. Total Penjualan Hari Ini
    $todaySales = Transaction::whereDate('Tanggal_transaksi', Carbon::today())->sum('total_harga');

    // 2. Jumlah Transaksi Hari Ini
    $todayCount = Transaction::whereDate('Tanggal_transaksi', Carbon::today())->count();

    // 3. Barang Paling Laris (Top 5)
    $topProducts = DB::table('detail_transactions')
        ->join('barang', 'detail_transactions.BarangID', '=', 'barang.BarangID')
        ->select('barang.Nama_barang', DB::raw('SUM(detail_transactions.Jumlah_barang) as total_terjual'))
        ->groupBy('barang.BarangID', 'barang.Nama_barang')
        ->orderBy('total_terjual', 'desc')
        ->limit(5)
        ->get();

    return response()->json([
        'success' => true,
        'data' => [
            'total_pendapatan_hari_ini' => $todaySales,
            'total_transaksi_hari_ini' => $todayCount,
            'produk_terlaris' => $topProducts
        ]
    ]);
}
}
