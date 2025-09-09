<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\LaporanKeuangan;
use App\Http\Resources\LaporanKeuanganResource;
use App\Http\Requests\LaporanKeuanganRequest;
use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
    public function index()
    {
        $laporan = LaporanKeuangan::all();
        return response()->json($laporan);
    }

    public function store(LaporanKeuanganRequest $request)
    {
        $laporan = LaporanKeuangan::create($request->validated());
        return response()->json($laporan, 201);
    }

    public function show(LaporanKeuangan $laporanKeuangan)
    {
        return response()->json($laporanKeuangan);
    }

    public function update(LaporanKeuanganRequest $request, LaporanKeuangan $laporanKeuangan)
    {
        $laporanKeuangan->update($request->validated());
        return response()->json($laporanKeuangan);
    }

    public function destroy(LaporanKeuangan $laporanKeuangan)
    {
        $laporanKeuangan->delete();
        return response()->json(null, 204);
    }
}
