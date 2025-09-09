<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Resources\SupplierResource;
use App\Http\Requests\SupplierRequest;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return SupplierResource::collection($suppliers);
    }

    public function store(SupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());
        return new SupplierResource($supplier);
    }

    public function show(Supplier $supplier)
    {
        return new SupplierResource($supplier);
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        return new SupplierResource($supplier);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response()->noContent();
    }
}
