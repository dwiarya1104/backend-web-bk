<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        $admin = User::firstWhere('email', $request->email);
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'message' => 'Bad Credentials!'
            ], 404);
        }
        $token = $admin->createToken("sanctum_token")->plainTextToken;

        return response()->json([
            'message' => 'Login Sukses!',
            'token' => $token
        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout Sukses!'
        ]);
    }

    public function get_user()
    {
        return response()->json([
            "user" => auth()->user()
        ], 200);
    }
}
