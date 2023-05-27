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
                'status' => 'failed',
                'message' => 'Bad Credentials!'
            ], 404);
        }
        $token = $admin->createToken("sanctum_token")->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login Sukses!',
            'token' => $token
        ], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'name' => 'required|string|min:3',
            'password' => 'required|string|min:8'
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);

        if ($user) {
            return response()->json([
                'status' => 'success',
                'data' => $user,
                'message' => 'Berhasil register admin'
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'data' => $user,
                'message' => 'Gagal register admin'
            ]);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout Sukses!'
        ]);
    }

    public function get_user()
    {
        return response()->json([
            'status' => 'success',
            "user" => auth()->user()
        ], 200);
    }
}
