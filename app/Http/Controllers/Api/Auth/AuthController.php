<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $token = $user->createToken('Personal Token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Registered',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ], 200);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        if (!Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Authentication',
            ], 401);
        }

        $user = User::where('email', $validated['email'])->first();

        $token = $user->createToken('Personal Token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Logged In',
            'data' => [
                'token' => $token,
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged Out',
        ], 200);
    }
}
