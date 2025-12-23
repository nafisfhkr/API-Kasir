<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BarangRequest;
use App\Http\Resources\BarangResource;
use App\Models\Barang;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Ambil kata kunci dari query parameter 'search'
    $search = $request->query('search');

    // Jika ada kata kunci, cari berdasarkan Nama_barang
    $barang = Barang::when($search, function ($query, $search) {
        return $query->where('Nama_barang', 'like', "%{$search}%");
    })
    ->with('kategori') // Load relasi kategori agar informasinya lengkap
    ->latest()
    ->paginate(10); // Gunakan pagination agar API lebih profesional

    return response()->json([
        'success' => true,
        'message' => 'Daftar barang berhasil diambil',
        'data' => $barang
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangRequest $request)
    {
        $barang = Barang::create($request->validated());
        return new BarangResource($barang);
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return new BarangResource($barang);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BarangRequest $request, Barang $barang)
    {
        $barang->update($request->validated());
        return new BarangResource($barang);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return response()->json(['message' => 'Barang deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
