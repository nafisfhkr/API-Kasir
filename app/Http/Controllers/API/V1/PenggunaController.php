<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\PenggunaResource;
use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Http\Requests\StorePenggunaRequest;
use App\Http\Requests\UpdatePenggunaRequest;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PenggunaResource::collection(Pengguna::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePenggunaRequest $request)
    {
        $pengguna = Pengguna::create($request->validated());
        return PenggunaResource::make($pengguna);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengguna $pengguna)
    {
        return PenggunaResource::make($pengguna);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengguna $pengguna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePenggunaRequest $request, Pengguna $pengguna)
    {
        $pengguna->update($request->validated());
        return PenggunaResource::make($pengguna);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengguna $pengguna)
    {
       $pengguna->delete();
       return response()->json(['message' => 'Data Delete','pengguna' => $pengguna]);
    }
}
