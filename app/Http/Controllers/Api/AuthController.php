<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Applicant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',

            'nik' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'applicant',
        ]);

        event(new Registered($user));

        Applicant::create([
            'user_id' => $user->id,
            'nama' => $request->name,
            'nik' => $request->nik,
            'no_hp'=> $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return response()->json([
            'message' => 'Register success',
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // cek user ada atau tidak
        if (!$user) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // cek password
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // cek email verification
        if ($user->role === 'applicant' && !$user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email not verified'
            ], 403);
        }

        if(!$user->is_active) {
            return response()->json([
                'message' => "Account is inactive"
            ], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login success',
            'token' => $token,
            'user' => $user
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }
}