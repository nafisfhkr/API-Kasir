<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Piutang;
use App\Http\Requests\StorePiutangRequest;
use App\Http\Requests\UpdatePiutangRequest;
use App\Http\Resources\PiutangResource;
use Illuminate\Http\JsonResponse;

class PiutangController extends Controller
{
    public function index(): JsonResponse
    {
        $piutangs = Piutang::all();
        return response()->json(PiutangResource::collection($piutangs));
    }

    public function store(StorePiutangRequest $request): JsonResponse
    {
        $piutang = Piutang::create($request->validated());
        return response()->json(new PiutangResource($piutang), 201);
    }

    public function show(Piutang $piutang): JsonResponse
    {
        return response()->json(new PiutangResource($piutang));
    }

    public function update(UpdatePiutangRequest $request, Piutang $piutang): JsonResponse
    {
        $piutang->update($request->validated());
        return response()->json(new PiutangResource($piutang));
    }

    public function destroy(Piutang $piutang): JsonResponse
    {
        $piutang->delete();
        return response()->json(['message' => 'Piutang deleted successfully']);
    }
}
