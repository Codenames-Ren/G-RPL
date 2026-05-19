<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Asesor;
use App\Models\RplManager;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:asesor,manager',

            // asesor
            'nidn' => 'required_if:role,asesor',
            'bidang_keahlian' => 'required_if:role,asesor',
            'prodi_ids' => 'required_if:role,asesor|array',
            'prodi_ids.*' => 'exists:prodis,id',

            // manager
            'jabatan' => 'required_if:role,manager',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => now(),
        ]);

        // create asesor profile
        if ($request->role === 'asesor') {

            $asesor = Asesor::create([
                'user_id' => $user->id,
                'nama' => $request->name,
                'nidn' => $request->nidn,
                'bidang_keahlian' => $request->bidang_keahlian,
            ]);

            // attach prodi to pivot table
            $asesor->prodis()->attach(
                $request->prodi_ids
            );
        }

        // create manager profile
        if ($request->role === 'manager') {

            RplManager::create([
                'user_id' => $user->id,
                'nama' => $request->name,
                'jabatan' => $request->jabatan,
            ]);
        }

        $user->load(['asesor.prodis', 'rplManager']);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    }

    public function getUsers()
    {
        $users = User::with(['asesor.prodis', 'rplManager'])
        ->where('role', '!=', 'superadmin')
        ->latest()
        ->get();

        return response()->json($users);
    }

    public function toggleUserStatus($id)
    {
        $user = User::find($id);

        if(!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        if ($user->role === 'superadmin') {
            return response()->json([
                'message' => 'Cannot change superadmin status'
            ], 403);
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return response()->json([
            'message' => 'User status updated successfully',
            'is_active' => $user->is_active
        ]);
    }
}
