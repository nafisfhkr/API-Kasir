<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BarangRequest;
use App\Http\Resources\BarangResource;
use App\Models\Barang;
use Illuminate\Http\Response;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::all();
        return BarangResource::collection($barang);
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
