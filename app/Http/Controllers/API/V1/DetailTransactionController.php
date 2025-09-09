<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use App\Models\Barang;

class DetailTransactionController extends Controller
{
    // Get all detail transactions
    public function index()
    {
        $details = DetailTransaction::with(['transactions', 'barang'])->get();
        return response()->json($details);
    }

    // Create a new detail transaction
    public function store(Request $request)
    {
        $validated = $request->validate([
            'TransaksiID' => 'required|exists:transactions,TransaksiID',
            'BarangID' => 'required|exists:barang,BarangID',
            'jumlah_barang' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        $validated['subtotal'] = $validated['jumlah_barang'] * $validated['harga_satuan'];

        $detail = DetailTransaction::create($validated);

        return response()->json([
            'message' => 'Detail transaction created successfully!',
            'data' => $detail,
        ]);
    }

    // Get a specific detail transaction
    public function show($id)
    {
        $detail = DetailTransaction::with(['transactions', 'barang'])->findOrFail($id);
        return response()->json($detail);
    }

    // Update a detail transaction
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jumlah_barang' => 'sometimes|required|integer|min:1',
            'harga_satuan' => 'sometimes|required|numeric|min:0',
        ]);

        $detail = DetailTransaction::findOrFail($id);
        $detail->update($validated);

        return response()->json([
            'message' => 'Detail transaction updated successfully!',
            'data' => $detail,
        ]);
    }

    // Delete a detail transaction
    public function destroy($id)
    {
        $detail = DetailTransaction::findOrFail($id);
        $detail->delete();

        return response()->json(['message' => 'Detail transaction deleted successfully!']);
    }
}
