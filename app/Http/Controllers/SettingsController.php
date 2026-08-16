<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('settings', compact('user'));
    }

    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'org_name'              => 'required|string|max:255',
            'currency'              => 'required|string|max:10',
            'forecasting_intensity' => 'nullable|string',
        ]);

        // Simpan permanen di Session agar tidak riset saat pindah page
        session([
            'org_name'              => $validated['org_name'],
            'currency'              => $validated['currency'],
            'forecasting_intensity' => $request->forecasting_intensity ?? '2'
        ]);

        return response()->json([
            'status'  => 'success', 
            'message' => 'Pengaturan Organisasi berhasil disimpan!'
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . ($user->id ?? 0),
            'password' => 'nullable|min:8',
        ]);

        if ($user) {
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
        }

        return response()->json([
            'status'  => 'success', 
            'message' => 'Profil pengguna berhasil diperbarui!'
        ]);
    }
}