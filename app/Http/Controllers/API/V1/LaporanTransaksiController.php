<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\LaporanTransaksi;
use App\Http\Resources\LaporanTransaksiResource;
use App\Http\Requests\LaporanTransaksiRequest;
use Illuminate\Http\Request;

class LaporanTransaksiController extends Controller
{
    public function index()
    {
        $laporan = LaporanTransaksi::all();
        return response()->json($laporan);
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
}
