<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PenggunaResource;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class JenisPenggunaController extends Controller
{
    public function __invoke(Request $request, Pengguna $pengguna)
    {
        $pengguna->jenis_pengguna = $request->jenis_pengguna;
        $pengguna->save();

        $pengguna_rsc=PenggunaResource::make($pengguna)->toArray($request);
        $pengguna_rsc['jenis_pengguna'] = $pengguna->jenis_pengguna;
        return response()->json(["data"=>$pengguna_rsc]);
    }
}
