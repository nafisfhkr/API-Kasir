<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\V1\BaseController as BaseController;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:225',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone_number' => 'required|string|max:225',
            'jenis_pengguna' => ['nullable', Rule::in(['admin', 'kasir', 'pembeli'])],
            'referal_code' => 'nullable|string|max:5'
        ]);
    
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
    
        // Buat user baru di tabel users
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    
        // Buat pengguna baru di tabel penggunas
        $pengguna = \App\Models\Pengguna::create([
            'user_id' => $user->id, // Masukkan ID user ke user_id
            'Nama' => $request->name,
            'Email' => $request->email,
            'Password' => bcrypt($request->password),
            'No_hp' => $request->phone_number,
            'Code_referral' => $request->referal_code,
            'Role' => $request->jenis_pengguna ?? 'pembeli',
        ]);
    
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;
    
        return $this->sendResponse($success, 'User registered successfully.');
    }
    

    public function login(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if ($validator->fails()) {
        return $this->sendError('Validation Error.', $validator->errors(), 422);
    }

    // Autentikasi user
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = Auth::user();
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User login successfully.');
    } else {
        return $this->sendError('Unauthorized.', ['error' => 'Invalid credentials'], 401);
    }
}


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'User logged out successfully'
        ]);
    }
}
