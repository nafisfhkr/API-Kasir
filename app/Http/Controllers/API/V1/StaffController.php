<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Http\Resources\StaffResource;
use App\Models\Staff;
use Illuminate\Http\Response;
use Illuminate\Http\Request;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::with(['penggunas', 'transactions'])->get();
        return StaffResource::collection($staff);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'penggunaID' => 'required|exists:penggunas,id',
        'alamat' => 'required|string',
        'foto' => 'required|url',
        'jabatan' => 'required|string', 
        'gaji' => 'required|numeric',  
    ]);

    $staff = Staff::create($data);

    return response()->json([
        'message' => 'Staff created successfully',
        'data' => $staff
    ], 201);
}



    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        $staff->load(['penggunas', 'transactions']); // Muat relasi
        return new StaffResource($staff);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StaffRequest $request, Staff $staff)
    {
        $staff->update($request->validated());
        return new StaffResource($staff);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return response()->json(['message' => 'Staff deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
