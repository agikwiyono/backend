<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi sesuai input di signupage.dart
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'home_address' => 'required|string',
            'age' => 'required|integer|min:17',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'identity_file' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Simpan file identitas
        $path = $request->file('identity_file')->store('identities', 'public');

        $user = User::create([
            'full_name' => $request->full_name,
            'home_address' => $request->home_address,
            'age' => $request->age,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'identity_file' => $path,
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        // Login sesuai input di loginpage.dart
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
