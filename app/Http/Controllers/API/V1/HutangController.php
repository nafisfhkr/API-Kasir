<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Hutang;
use App\Http\Requests\HutangRequest;
use App\Http\Resources\HutangResource;
use Illuminate\Http\JsonResponse;

class HutangController extends Controller
{
    public function index(): JsonResponse
    {
        $hutangs = Hutang::all();
        return response()->json(HutangResource::collection($hutangs));
    }

    public function store(HutangRequest $request): JsonResponse
    {
        $hutang = Hutang::create($request->validated());
        return response()->json(new HutangResource($hutang), 201);
    }

    public function show(Hutang $hutang): JsonResponse
    {
        return response()->json(new HutangResource($hutang));
    }

    public function update(UpdateHutangRequest $request, Hutang $hutang): JsonResponse
    {
        $hutang->update($request->validated());
        return response()->json(new HutangResource($hutang));
    }

    public function destroy(Hutang $hutang): JsonResponse
    {
        $hutang->delete();
        return response()->json(['message' => 'Hutang deleted successfully']);
    }
}
